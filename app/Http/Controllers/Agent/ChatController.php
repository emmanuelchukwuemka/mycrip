<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * List all conversations for the agent.
     */
    public function index()
    {
        $user = Auth::user();

        $conversations = Conversation::forAgent($user->id)
            ->with(['customer', 'property', 'latestMessage'])
            ->withCount(['messages as unread_count' => function ($query) use ($user) {
                $query->where('sender_id', '!=', $user->id)->where('is_read', false);
            }])
            ->orderByDesc('last_message_at')
            ->get();

        $totalUnread = $conversations->sum('unread_count');

        return view('agent.messages.index', compact('conversations', 'totalUnread'));
    }

    /**
     * Show a conversation with all messages.
     */
    public function show($id)
    {
        $user = Auth::user();

        $conversation = Conversation::forAgent($user->id)
            ->with(['customer', 'property', 'messages.sender'])
            ->findOrFail($id);

        // Mark messages from customer as read
        $conversation->markAsReadFor($user->id);

        return view('agent.messages.show', compact('conversation'));
    }

    /**
     * Send a reply in a conversation.
     */
    public function reply(Request $request, $id)
    {
        $user = Auth::user();

        $conversation = Conversation::forAgent($user->id)->findOrFail($id);

        $request->validate([
            'body' => 'nullable|string|max:5000',
            'attachment' => 'nullable|file|max:10240',
        ]);

        if (!$request->body && !$request->hasFile('attachment')) {
            return back()->with('error', 'Message or attachment is required.');
        }

        $messageData = [
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'body' => $request->body ?? '',
        ];

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('chat_attachments/' . $conversation->id, 'public');
            $messageData['attachment_path'] = $path;
            $messageData['attachment_name'] = $file->getClientOriginalName();
            $messageData['attachment_type'] = $file->getClientMimeType();
            $messageData['file_size'] = $file->getSize();
        }

        Message::create($messageData);

        $conversation->update(['last_message_at' => now()]);

        return redirect()->route('agent.messages.show', $conversation->id)
            ->with('success', 'Message sent!');
    }
}
