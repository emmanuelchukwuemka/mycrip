import json
from pathlib import Path

import faiss
from sentence_transformers import SentenceTransformer

BASE_DIR = Path(__file__).resolve().parent

def load_corpus(corpus_path: Path):
    docs = []
    with corpus_path.open("r", encoding="utf-8") as f:
        for line in f:
            data = json.loads(line)
            docs.append(data)
    return docs


def build_faiss_index(texts, model_name="sentence-transformers/all-MiniLM-L6-v2"):
    model = SentenceTransformer(model_name)
    print("Encoding embeddings with", model_name)
    embeddings = model.encode(texts, show_progress_bar=True, convert_to_numpy=True, normalize_embeddings=True)

    dim = embeddings.shape[1]
    index = faiss.IndexFlatIP(dim)
    index.add(embeddings)
    return index


if __name__ == "__main__":
    corpus_file = BASE_DIR / "corpus.jsonl"
    if not corpus_file.exists():
        raise FileNotFoundError("corpus.jsonl not found; run knowledge_loader.py first")

    docs = load_corpus(corpus_file)
    texts = [d["text"] for d in docs]
    index = build_faiss_index(texts)

    faiss.write_index(index, str(BASE_DIR / "mycrip.index"))
    print("FAISS index saved to mycrip.index")

    with (BASE_DIR / "meta.jsonl").open("w", encoding="utf-8") as f:
        for d in docs:
            f.write(json.dumps(d, ensure_ascii=False) + "\n")
    print("Metadata saved to meta.jsonl")
