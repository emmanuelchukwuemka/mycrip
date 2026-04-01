from fastapi import FastAPI
from pydantic import BaseModel

try:
    from query_agent import answer_question
except ImportError as e:
    print(f"WARNING: query_agent import failed: {e}")
    answer_question = None

app = FastAPI(title="MyCrib Local LLM Assistant")


class ChatRequest(BaseModel):
    role: str = "user"
    question: str


class ChatResponse(BaseModel):
    answer: str


@app.post("/chat", response_model=ChatResponse)
def chat(req: ChatRequest):
    if answer_question is None:
        return ChatResponse(answer="AI service dependencies not loaded. Check server logs.")
    try:
        answer = answer_question(req.question, role=req.role)
    except Exception as e:
        print(f"ERROR in answer_question: {e}")
        answer = f"Error processing question: {str(e)}"
    return ChatResponse(answer=answer)


@app.get("/health")
def health():
    return {"status": "ok", "ai_available": answer_question is not None}
