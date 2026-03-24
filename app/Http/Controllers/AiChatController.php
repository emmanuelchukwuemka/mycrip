<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiChatController extends Controller
{
    /**
     * Handle an AI chat message using Google Gemini.
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'history' => 'nullable|array',
        ]);

        $apiKey = config('services.gemini.api_key');
        
        if (!$apiKey) {
            return response()->json([
                'reply' => 'AI assistant is currently unavailable. Please try again later.',
            ], 503);
        }

        // Build the conversation context
        $systemPrompt = "You are MyCrib AI, a friendly and knowledgeable real estate assistant for MyCrib Africa — a property platform connecting buyers, renters, and agents across Nigeria and Africa.\n\n" .
            "Your role:\n" .
            "- Help users find properties, understand the platform, and answer real estate questions.\n" .
            "- Guide users to post on the Buyer Wall if they're looking for a specific property.\n" .
            "- Explain how agents, listings, tours, and the chat system work.\n" .
            "- Provide general real estate advice for the African market (pricing, neighborhoods, tips).\n" .
            "- Be warm, professional, and concise. Use short paragraphs.\n" .
            "- If you don't know something specific about a listing, suggest the user contact an agent through the platform.\n\n" .
            "Never provide legal or financial advice. Always recommend consulting professionals for such matters.";

        $contents = [];

        // Add conversation history
        if ($request->history && is_array($request->history)) {
            foreach ($request->history as $msg) {
                $role = $msg['role'] === 'user' ? 'user' : 'model';
                $contents[] = [
                    'role' => $role,
                    'parts' => [['text' => $msg['content']]],
                ];
            }
        }

        // Add the current user message
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $request->message]],
        ];

        try {
            $response = Http::timeout(30)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}",
                [
                    'system_instruction' => [
                        'parts' => [['text' => $systemPrompt]],
                    ],
                    'contents' => $contents,
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 500,
                        'topP' => 0.9,
                    ],
                ]
            );

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'I couldn\'t generate a response. Please try again.';
                
                return response()->json(['reply' => $reply]);
            }

            Log::error('Gemini API error', ['status' => $response->status(), 'body' => $response->body()]);
            
            return response()->json([
                'reply' => 'I\'m having trouble connecting right now. Please try again in a moment.',
            ], 500);

        } catch (\Exception $e) {
            Log::error('AI Chat error: ' . $e->getMessage());
            
            return response()->json([
                'reply' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
