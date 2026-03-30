import json
from functools import lru_cache
from pathlib import Path

import faiss
import numpy as np
from sentence_transformers import SentenceTransformer
from transformers import AutoModelForCausalLM, AutoTokenizer, pipeline

BASE_DIR = Path(__file__).resolve().parent

@lru_cache(maxsize=1)
def load_index():
    index_path = BASE_DIR / "mycrip.index"
    if not index_path.exists():
        raise FileNotFoundError("mycrip.index not found; run build_index.py first")

    index = faiss.read_index(str(index_path))
    return index


@lru_cache(maxsize=1)
def load_meta():
    meta_path = BASE_DIR / "meta.jsonl"
    if not meta_path.exists():
        raise FileNotFoundError("meta.jsonl not found; run build_index.py first")

    records = []
    with meta_path.open("r", encoding="utf-8") as f:
        for line in f:
            records.append(json.loads(line))
    return records


@lru_cache(maxsize=1)
def load_embedder():
    return SentenceTransformer("sentence-transformers/all-MiniLM-L6-v2")


@lru_cache(maxsize=1)
def load_llm():
    model_name = "TheBloke/guanaco-7b"  # or your preferred local model
    tokenizer = AutoTokenizer.from_pretrained(model_name, use_fast=False)
    model = AutoModelForCausalLM.from_pretrained(
        model_name,
        device_map="auto",
        torch_dtype="auto",
        trust_remote_code=True,
    )
    gen = pipeline(
        "text-generation",
        model=model,
        tokenizer=tokenizer,
        max_new_tokens=450,
        temperature=0.3,
        top_p=0.92,
        repetition_penalty=1.1,
    )
    return gen


def retrieve_context(query: str, top_k: int = 5):
    embedder = load_embedder()
    qvec = embedder.encode([query], normalize_embeddings=True)

    index = load_index()
    distances, indices = index.search(qvec, top_k)

    meta = load_meta()
    context_items = []
    for idx, dist in zip(indices[0], distances[0]):
        if idx < 0 or idx >= len(meta):
            continue
        item = meta[idx]
        context_items.append(f"Source: {item.get('source')}\n{item.get('text')}")

    return "\n\n---\n\n".join(context_items)


def answer_question(question: str, role: str = "user", top_k: int = 5):
    context = retrieve_context(question, top_k=top_k)

    extrarole = ""
    if role.lower() == "admin":
        extrarole = "As an admin assistant, include policy details, security, and governance concerns."
    elif role.lower() == "user":
        extrarole = "As a user-facing assistant, answer clearly with step-by-step guidance and friendly tone."

    prompt = (
        "You are an expert assistant for MyCrip real estate website. Use the documented context to formulate an answer. "
        + extrarole
        + "\n\nCONTEXT:\n"
        + context
        + "\n\nQUESTION: "
        + question
        + "\n\nAnswer:" 
    )

    llm = load_llm()
    result = llm(prompt, max_new_tokens=450)
    if isinstance(result, list) and result:
        return result[0].get("generated_text", "").strip()

    return "No answer available."


if __name__ == "__main__":
    import argparse

    parser = argparse.ArgumentParser()
    parser.add_argument("question", help="Question to ask the assistant")
    parser.add_argument("--role", default="user", choices=["user", "admin"])
    args = parser.parse_args()

    print(answer_question(args.question, role=args.role))
