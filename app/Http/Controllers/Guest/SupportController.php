<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    /** Public FAQ page */
    public function faq()
    {
        $faqs = Faq::active()->ordered()->get()->groupBy('category');
        return view('guest.support.faq', compact('faqs'));
    }

    /** User's support tickets list */
    public function tickets()
    {
        $tickets = Auth::user()->tickets()->orderByDesc('created_at')->paginate(10);
        return view('guest.support.tickets', compact('tickets'));
    }

    /** Create ticket form */
    public function createTicket()
    {
        return view('guest.support.create-ticket');
    }

    /** Submit new ticket */
    public function storeTicket(Request $request)
    {
        $request->validate([
            'subject'  => 'required|string|max:200',
            'body'     => 'required|string|min:50|max:5000',
            'priority' => 'nullable|in:low,medium,high,urgent',
        ]);

        Ticket::create([
            'user_id'  => Auth::id(),
            'subject'  => $request->subject,
            'body'     => $request->body,
            'priority' => $request->priority ?? 'medium',
        ]);

        return redirect()->route('support.tickets')
            ->with('success', 'Your support ticket has been submitted. We\'ll respond within 24 hours.');
    }

    /** View single ticket + replies */
    public function showTicket(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) abort(403);
        $ticket->load('replies.user');
        return view('guest.support.show-ticket', compact('ticket'));
    }

    /** Reply to ticket */
    public function replyTicket(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) abort(403);

        $request->validate(['body' => 'required|string|min:10|max:5000']);

        TicketReply::create([
            'ticket_id'      => $ticket->id,
            'user_id'        => Auth::id(),
            'body'           => $request->body,
            'is_admin_reply' => false,
        ]);

        return back()->with('success', 'Reply sent.');
    }
}
