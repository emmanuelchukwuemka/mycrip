<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\MessageTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageTemplateController extends Controller
{

    public function index()
    {
        $templates = Auth::user()->messageTemplates()->orderBy('title')->get();
        return view('agent.message-templates.index', compact('templates'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:100', 'body' => 'required|string|max:2000']);
        Auth::user()->messageTemplates()->create($request->only('title','body'));
        return back()->with('success', 'Template saved.');
    }

    public function update(Request $request, MessageTemplate $template)
    {
        if ($template->user_id !== Auth::id()) abort(403);
        $request->validate(['title' => 'required|string|max:100', 'body' => 'required|string|max:2000']);
        $template->update($request->only('title','body'));
        return back()->with('success', 'Template updated.');
    }

    public function destroy(MessageTemplate $template)
    {
        if ($template->user_id !== Auth::id()) abort(403);
        $template->delete();
        return back()->with('success', 'Template deleted.');
    }
}
