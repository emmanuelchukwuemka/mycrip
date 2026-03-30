from fastapi import FastAPI
from pydantic import BaseModel

app = FastAPI(title="MyCrip Local LLM Assistant")

class ChatResponse(BaseModel):
    answer: str

@app.post("/chat", response_model=ChatResponse)
def chat(question: str, role: str = "user"):
    return ChatResponse(answer=f"Echo: {question} (role={role})")

@app.get("/health")
def health():
    return {"status": "ok"}
