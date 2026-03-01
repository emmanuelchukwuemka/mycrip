<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dispute;
use App\Models\Faq;
use App\Models\Feedback;
use App\Models\Newsletter;
use App\Models\Property;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminSupportController extends Controller
{
    // ── Tickets ──────────────────────────────────────────────────────────────

    public function tickets(Request $request)
    {
        $tickets = Ticket::with('user')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate(20);
        return view('admin.support.tickets', compact('tickets'));
    }

    public function showTicket(Ticket $ticket)
    {
        $ticket->load('replies.user', 'user');
        return view('admin.support.show-ticket', compact('ticket'));
    }

    public function replyTicket(Request $request, Ticket $ticket)
    {
        $request->validate([
            'body'   => 'required|string|min:10|max:5000',
            'status' => 'nullable|in:open,in_progress,resolved,closed',
        ]);

        TicketReply::create([
            'ticket_id'      => $ticket->id,
            'user_id'        => Auth::id(),
            'body'           => $request->body,
            'is_admin_reply' => true,
        ]);

        if ($request->status) {
            $ticket->update(['status' => $request->status]);
        }

        return back()->with('success', 'Reply sent.');
    }

    // ── Disputes ──────────────────────────────────────────────────────────────

    public function disputes(Request $request)
    {
        $disputes = Dispute::with(['reporter','property'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate(20);
        return view('admin.support.disputes', compact('disputes'));
    }

    public function resolveDispute(Request $request, Dispute $dispute)
    {
        $request->validate([
            'status'      => 'required|in:resolved,rejected,under_review',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $dispute->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
            'resolved_by' => Auth::id(),
            'resolved_at' => in_array($request->status, ['resolved','rejected']) ? now() : null,
        ]);

        return back()->with('success', 'Dispute updated.');
    }

    // ── FAQ ──────────────────────────────────────────────────────────────────

    public function faqs()
    {
        $faqs = Faq::orderBy('category')->orderBy('sort_order')->get();
        return view('admin.support.faqs', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string|max:5000',
            'category'   => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);
        Faq::create($request->only('question','answer','category','sort_order'));
        return back()->with('success', 'FAQ added.');
    }

    public function updateFaq(Request $request, Faq $faq)
    {
        $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string|max:5000',
            'category'   => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'boolean',
        ]);
        $faq->update($request->only('question','answer','category','sort_order','is_active'));
        return back()->with('success', 'FAQ updated.');
    }

    public function destroyFaq(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ deleted.');
    }

    // ── Newsletter ────────────────────────────────────────────────────────────

    public function newsletter()
    {
        $subscribers = Newsletter::active()->orderByDesc('subscribed_at')->paginate(30);
        $total   = Newsletter::active()->count();
        $total_all = Newsletter::count();
        return view('admin.support.newsletter', compact('subscribers','total','total_all'));
    }

    public function sendNewsletter(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:200',
            'body'    => 'required|string',
        ]);

        $subscribers = Newsletter::active()->get();
        $count = 0;

        foreach ($subscribers as $sub) {
            try {
                Mail::html($request->body, function ($message) use ($sub, $request) {
                    $message->to($sub->email, $sub->name ?? $sub->email)
                        ->subject($request->subject)
                        ->from(config('mail.from.address'), 'MyCrip');
                });
                $count++;
            } catch (\Exception $e) {
                Log::error("Newsletter send failed for {$sub->email}: " . $e->getMessage());
            }
        }

        return back()->with('success', "Newsletter sent to {$count} subscribers.");
    }

    // ── Market Insights ───────────────────────────────────────────────────────

    public function insights()
    {
        $avgByCategory = Property::selectRaw('category, AVG(price) as avg_price, COUNT(*) as count')
            ->where('status', 'active')
            ->groupBy('category')
            ->get();

        $byLocation = Property::selectRaw('location, COUNT(*) as count')
            ->groupBy('location')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        $monthlyListings = Property::selectRaw("strftime('%Y-%m', created_at) as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->take(12)
            ->get();

        $totalUsers      = User::count();
        $totalProperties = Property::count();
        $totalAgents     = User::where('role', 'agent')->count();

        $avgRating = \App\Models\Review::avg('rating') ?? 0;
        $feedbackAvg = Feedback::avg('rating') ?? 0;

        return view('admin.insights', compact(
            'avgByCategory','byLocation','monthlyListings',
            'totalUsers','totalProperties','totalAgents','avgRating','feedbackAvg'
        ));
    }

    // ── Log Viewer ────────────────────────────────────────────────────────────

    public function logs()
    {
        $logPath = storage_path('logs/laravel.log');
        $lines = [];

        if (file_exists($logPath)) {
            $file = new \SplFileObject($logPath);
            $file->seek(PHP_INT_MAX);
            $total = $file->key();
            $start = max(0, $total - 400); // last 400 lines
            $file->seek($start);

            while (!$file->eof()) {
                $line = trim($file->fgets());
                if ($line) {
                    $level = 'info';
                    if (str_contains($line, '.ERROR') || str_contains($line, ' error ')) $level = 'error';
                    elseif (str_contains($line, '.WARNING')) $level = 'warning';
                    $lines[] = ['text' => $line, 'level' => $level];
                }
            }
            $lines = array_reverse($lines);
        }

        return view('admin.logs', compact('lines'));
    }

    // ── Property Documents verification ───────────────────────────────────────

    public function pendingDocuments()
    {
        $documents = \App\Models\PropertyDocument::with('property.user')
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();
        return view('admin.support.documents', compact('documents'));
    }

    public function verifyDocument(Request $request, \App\Models\PropertyDocument $document)
    {
        $request->validate(['status' => 'required|in:verified,rejected', 'admin_notes' => 'nullable|string|max:500']);
        $document->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);
        return back()->with('success', 'Document ' . $request->status . '.');
    }
}
