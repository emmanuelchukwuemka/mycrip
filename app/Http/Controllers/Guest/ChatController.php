<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Start or resume a conversation with an agent about a property.
     */
    public function start(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:users,id',
            'property_id' => 'nullable|exists:properties,id',
            'message' => 'required|string|max:5000',
        ]);

        $user = Auth::user();

        // Find or create the conversation
        $conversation = Conversation::firstOrCreate(
            [
                'customer_id' => $user->id,
                'agent_id' => $request->agent_id,
                'property_id' => $request->property_id,
            ],
            [
                'last_message_at' => now(),
            ]
        );

        // Create the first message
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'body' => $request->message,
        ]);

        $conversation->update(['last_message_at' => now()]);

        return redirect()->route('chat.show', $conversation->id)
            ->with('success', 'Message sent to agent!');
    }

    /**
     * Show a conversation from the customer side.
     */
    public function show($id)
    {
        $user = Auth::user();

        $conversation = Conversation::forCustomer($user->id)
            ->with(['agent', 'property', 'messages.sender'])
            ->findOrFail($id);

        // Mark agent messages as read
        $conversation->markAsReadFor($user->id);

        return view('guest.chat.show', compact('conversation'));
    }

    /**
     * Customer sends a reply.
     */
    public function reply(Request $request, $id)
    {
        $user = Auth::user();

        $conversation = Conversation::forCustomer($user->id)->findOrFail($id);

        $request->validate([
            'body' => 'required|string|max:5000',
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'body' => $request->body,
        ]);

        $conversation->update(['last_message_at' => now()]);

        return redirect()->route('chat.show', $conversation->id)
            ->with('success', 'Message sent!');
    }

    /**
     * List all customer conversations.
     */
    public function index()
    {
        $user = Auth::user();

        $conversations = Conversation::forCustomer($user->id)
            ->with(['agent', 'property', 'latestMessage'])
            ->withCount(['messages as unread_count' => function ($query) use ($user) {
                $query->where('sender_id', '!=', $user->id)->where('is_read', false);
            }])
            ->orderByDesc('last_message_at')
            ->get();

        return view('guest.chat.index', compact('conversations'));
    }
}
