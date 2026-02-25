<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Services\AIService;
use Illuminate\Http\Request;

class AIController extends Controller
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Generate a professional property description via AI.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'keywords' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string',
        ]);

        $keywords = array_map('trim', explode(',', $request->keywords));
        
        $description = $this->aiService->generateDescription($keywords, $request->category, $request->location);

        return response()->json([
            'success' => true,
            'description' => $description
        ]);
    }
}
