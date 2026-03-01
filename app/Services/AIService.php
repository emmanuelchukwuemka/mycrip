<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected ?string $openaiKey;
    protected ?string $geminiKey;

    public function __construct()
    {
        $this->openaiKey = config('services.openai.key') ?: env('OPENAI_API_KEY');
        $this->geminiKey = config('services.gemini.key') ?: env('GEMINI_API_KEY');
    }

    public function isConfigured(): bool
    {
        return !empty($this->openaiKey) || !empty($this->geminiKey);
    }

    /**
     * Generate a professional property description.
     */
    public function generateDescription(array $keywords, string $category, string $location): string
    {
        $prompt = "Write a compelling real estate listing description (3 paragraphs, 150-200 words) for a {$category} in {$location}, Africa. Key features: " . implode(', ', $keywords) . ". Use professional Nigerian/African real estate tone. Do not use first-person pronouns.";

        if ($this->openaiKey) {
            return $this->callOpenAI($prompt) ?? $this->fallbackDescription($keywords, $category, $location);
        }

        if ($this->geminiKey) {
            return $this->callGemini($prompt) ?? $this->fallbackDescription($keywords, $category, $location);
        }

        return $this->fallbackDescription($keywords, $category, $location);
    }

    /**
     * Generate an SEO-optimised listing title.
     */
    public function generateSeoTitle(string $category, string $location, array $features = []): string
    {
        $prompt = "Write a short SEO-optimised property listing title (max 70 characters) for a {$category} in {$location}. Key features: " . implode(', ', $features) . ". Return only the title, nothing else.";

        if ($this->openaiKey) {
            return $this->callOpenAI($prompt) ?? ucfirst($category) . ' for Sale in ' . $location;
        }

        return ucfirst($category) . ' for Sale in ' . $location;
    }

    protected function callOpenAI(string $prompt): ?string
    {
        try {
            $response = Http::withToken($this->openaiKey)
                ->timeout(30)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model'    => 'gpt-4o-mini',
                    'messages' => [['role' => 'user', 'content' => $prompt]],
                    'max_tokens' => 400,
                ]);

            if ($response->successful()) {
                return trim($response->json('choices.0.message.content'));
            }

            Log::error('OpenAI call failed', ['response' => $response->json()]);
        } catch (\Exception $e) {
            Log::error('OpenAI exception', ['message' => $e->getMessage()]);
        }

        return null;
    }

    protected function callGemini(string $prompt): ?string
    {
        try {
            $response = Http::timeout(30)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$this->geminiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                ]);

            if ($response->successful()) {
                return trim($response->json('candidates.0.content.parts.0.text'));
            }

            Log::error('Gemini call failed', ['response' => $response->json()]);
        } catch (\Exception $e) {
            Log::error('Gemini exception', ['message' => $e->getMessage()]);
        }

        return null;
    }

    protected function fallbackDescription(array $keywords, string $category, string $location): string
    {
        $keywordStr  = implode(', ', $keywords);
        $description = "Experience premium living in this stunning " . ucfirst($category) . " located in the heart of " . $location . ".\n\n";
        $description .= "This exquisite property boasts " . $keywordStr . ", meticulously designed to offer the perfect blend of comfort and elegance. ";
        $description .= "Whether you're looking for a serene retreat or a vibrant space to call home, this property delivers on every front.\n\n";
        $description .= "Key highlights include its strategic location, modern architecture, and a sense of luxury that is hard to find elsewhere. ";
        $description .= "Don't miss out on this incredible opportunity to own a piece of " . $location . "'s finest real estate. Schedule a viewing today!";
        return $description;
    }
}
