<x-agent-layout>
    <div class="max-w-5xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700 pb-20">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-50">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full border border-amber-100 text-[10px] font-black uppercase tracking-widest">
                        Case #TKT-{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="px-3 py-1 bg-gray-50 text-gray-500 rounded-full border border-gray-100 text-[10px] font-black uppercase tracking-widest">
                        Priority: {{ $ticket->priority }}
                    </span>
                </div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">{{ $ticket->subject }}</h1>
                <div class="flex items-center gap-4 text-xs font-medium text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Opened {{ $ticket->created_at->format('M d, h:i A') }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Status: <strong class="text-emerald-500 uppercase tracking-tighter ml-1">{{ $ticket->status }}</strong>
                    </span>
                </div>
            </div>
            
            <a href="{{ route('support.tickets') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-50 text-gray-600 rounded-xl font-bold text-sm hover:bg-gray-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Support
            </a>
        </div>

        <!-- Chat / Message Display -->
        <div class="space-y-6">
            
            <!-- Original User Ticket -->
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-[#A85C2E] text-white flex items-center justify-center flex-shrink-0 font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="bg-indigo-50/50 rounded-2xl rounded-tl-none p-6 shadow-sm border border-indigo-100 flex-1">
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-indigo-100/50">
                        <span class="text-xs font-black text-[#A85C2E] uppercase tracking-widest">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-gray-400 font-bold">{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $ticket->body }}</p>
                </div>
            </div>

            @foreach($ticket->replies as $reply)
                <div class="flex items-start gap-4 {{ $reply->is_admin_reply ? 'flex-row-reverse' : '' }}">
                    @if($reply->is_admin_reply)
                        <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center flex-shrink-0 font-bold shadow-lg shadow-amber-500/20">
                            A
                        </div>
                        <div class="bg-amber-50/50 rounded-2xl rounded-tr-none p-6 shadow-sm border border-amber-100 flex-1">
                            <div class="flex items-center justify-between mb-3 pb-2 border-b border-amber-100/50">
                                <span class="text-xs font-black text-amber-600 uppercase tracking-widest">Support Representative</span>
                                <span class="text-[10px] text-gray-400 font-bold">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $reply->body }}</p>
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-xl bg-[#A85C2E] text-white flex items-center justify-center flex-shrink-0 font-bold">
                            {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                        </div>
                        <div class="bg-gray-50 rounded-2xl rounded-tl-none p-6 shadow-sm border border-gray-100 flex-1">
                            <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-100/50">
                                <span class="text-xs font-black text-gray-600 uppercase tracking-widest">{{ $reply->user->name }}</span>
                                <span class="text-[10px] text-gray-400 font-bold">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $reply->body }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Reply Area -->
        @if($ticket->status !== 'closed')
            <div class="pt-8 mt-12 border-t border-gray-100">
                <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Send a Reply</h3>
                    <form action="{{ route('support.tickets.reply', $ticket) }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <textarea name="body" required rows="5"
                                class="w-full px-8 py-6 rounded-3xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none placeholder:text-gray-300 resize-none"
                                placeholder="Type your reply here..."></textarea>
                            @error('body')
                                <p class="text-xs text-red-500 font-bold mt-2 ml-4">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-10 py-4 bg-[#A85C2E] text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#002d5c] hover:shadow-xl hover:shadow-[#A85C2E]/30 transition-all duration-300 active:scale-[0.98]">
                                Send Response
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="p-8 bg-gray-50 rounded-[2rem] border border-gray-100 text-center">
                <p class="text-gray-500 font-bold text-sm">This ticket is closed and cannot be replied to.</p>
            </div>
        @endif
    </div>
</x-agent-layout>
