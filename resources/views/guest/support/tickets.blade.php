<x-agent-layout>
    <div class="max-w-6xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex mb-3" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        <li class="inline-flex items-center">
                            <a href="{{ route('agent.dashboard') }}" class="hover:text-amber-500 transition-colors">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-gray-600">Support Center</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Support Tickets</h1>
                <p class="mt-2 text-gray-500 font-medium">Need help? Track your existing inquiries or start a new conversation with our team.</p>
            </div>
            
            <a href="{{ route('support.tickets.create') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#A85C2E] text-white rounded-2xl font-bold hover:bg-[#002d5c] hover:shadow-xl hover:shadow-[#A85C2E]/20 transition-all duration-300 active:scale-[0.98]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Create New Ticket
            </a>
        </div>

        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Total Tickets</p>
                <h3 class="text-3xl font-black text-gray-900">{{ $tickets->total() }}</h3>
            </div>
            <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Open Cases</p>
                <h3 class="text-3xl font-black text-[#2B1810]">{{ $tickets->getCollection()->where('status', 'open')->count() }}</h3>
            </div>
            <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Avg. Response Time</p>
                <h3 class="text-3xl font-black text-gray-900">~2h</h3>
            </div>
        </div>

        <!-- Tickets Table Card -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-50">
                            <th class="px-8 py-6">Reference / Subject</th>
                            <th class="px-8 py-6">Priority</th>
                            <th class="px-8 py-6">Status</th>
                            <th class="px-8 py-6">Last Activity</th>
                            <th class="px-8 py-6"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($tickets as $ticket)
                            <tr class="group hover:bg-gray-50/50 transition-all duration-200">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-black text-amber-500 uppercase tracking-tighter">#TKT-{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        <a href="{{ route('support.tickets.show', $ticket) }}" class="text-sm font-bold text-gray-900 hover:text-amber-600 transition-colors line-clamp-1">{{ $ticket->subject }}</a>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $priorityClass = match($ticket->priority) {
                                            'urgent' => 'bg-red-50 text-red-600 border-red-100',
                                            'high' => 'bg-orange-50 text-orange-600 border-orange-100',
                                            'medium' => 'bg-amber-50 text-amber-600 border-amber-100',
                                            default => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full border {{ $priorityClass }} text-[9px] font-black uppercase tracking-wider">
                                        {{ $ticket->priority }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $ticket->status === 'open' ? 'bg-emerald-500 animate-pulse' : 'bg-gray-300' }}"></span>
                                        <span class="text-xs font-bold text-gray-700 capitalize">{{ $ticket->status }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs font-bold text-gray-700">{{ $ticket->updated_at->diffForHumans() }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium uppercase mt-0.5">{{ $ticket->updated_at->format('M d, Y') }}</p>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('support.tickets.show', $ticket) }}" class="p-2 text-gray-300 hover:text-amber-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-24 text-center">
                                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">No support tickets found</h3>
                                    <p class="text-gray-400 text-sm mt-2 max-w-xs mx-auto">Have a question? We're here for you. Create a ticket and we'll help you out.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($tickets->hasPages())
                <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/20">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>

        <!-- FAQ Quick Links -->
        <div class="bg-gradient-to-br from-[#A85C2E] to-[#2B1810] rounded-[3rem] p-12 text-white overflow-hidden relative group">
            <div class="absolute -top-12 -right-12 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl group-hover:bg-amber-500/20 transition-all duration-700"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                <div class="flex-1 space-y-4 text-center md:text-left">
                    <h2 class="text-3xl font-black tracking-tight">Got a quick question?</h2>
                    <p class="text-white/60 text-lg leading-relaxed max-w-xl">Check our comprehensive Frequently Asked Questions page for instant answers to common inquiries about listings, billing, and system usage.</p>
                </div>
                <a href="{{ route('support.faq') }}" class="px-10 py-4 bg-amber-500 text-[#A85C2E] rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-amber-400 transition-all duration-300 shadow-xl shadow-amber-500/20 active:scale-[0.98]">
                    Explore FAQ
                </a>
            </div>
        </div>
    </div>
</x-agent-layout>
