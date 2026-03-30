import json
import os
import re
from pathlib import Path

BASE_DIR = Path(__file__).resolve().parent

def clean_text(text: str) -> str:
    # Remove HTML/PHP tags
    text = re.sub(r"<\/?[a-zA-Z0-9\-_=\"'\s:;.,()\\]+>", " ", text)
    text = re.sub(r"\{\{.*?\}\}|\@\w+", " ", text)  # blade tags/expressions
    text = re.sub(r"\s+", " ", text).strip()
    return text


def extract_file_text(path: Path) -> str:
    source = path.suffix.lower()
    try:
        raw = path.read_text(encoding="utf-8", errors="ignore")
    except Exception:
        return ""

    if source in [".php", ".blade.php"]:
        raw = re.sub(r"<script[\s\S]*?<\/script>", " ", raw, flags=re.I)
        raw = re.sub(r"<style[\s\S]*?<\/style>", " ", raw, flags=re.I)
        raw = clean_text(raw)
    elif source in [".md", ".txt"]:
        raw = re.sub(r"#.*", "", raw)
        raw = clean_text(raw)
    elif source in [".json", ".yml", ".yaml"]:
        raw = clean_text(raw)
    else:
        raw = clean_text(raw)

    return raw


def chunk_text(text: str, max_tokens: int = 400) -> list[str]:
    words = text.split()
    if not words:
        return []

    chunks = []
    chunk = []
    for word in words:
        chunk.append(word)
        if len(chunk) >= max_tokens:
            chunks.append(" ".join(chunk).strip())
            chunk = []

    if chunk:
        chunks.append(" ".join(chunk).strip())
    return chunks


def collect_corpus(output_path: Path):
    search_paths = ["resources/views", "app/Http/Controllers", "app/Models", "routes", "app", "README.md"]
    doc_id = 0
    with output_path.open("w", encoding="utf-8") as out:
        for rel in search_paths:
            p = BASE_DIR / rel
            if p.is_file():
                files = [p]
            elif p.is_dir():
                files = list(p.rglob("*.*"))
            else:
                continue

            for f in files:
                if not f.is_file():
                    continue
                if f.suffix.lower() in [".jpg", ".jpeg", ".png", ".gif", ".ico", ".pdf", ".zip"]:
                    continue

                text = extract_file_text(f)
                if not text:
                    continue

                chunks = chunk_text(text, max_tokens=300)
                for chunk in chunks:
                    doc_id += 1
                    record = {
                        "id": f"doc-{doc_id}",
                        "source": str(f.relative_to(BASE_DIR)),
                        "text": chunk,
                    }
                    out.write(json.dumps(record, ensure_ascii=False) + "\n")

    print(f"Saved corpus with {doc_id} chunks to {output_path}")


if __name__ == "__main__":
    output = BASE_DIR / "corpus.jsonl"
    collect_corpus(output)
