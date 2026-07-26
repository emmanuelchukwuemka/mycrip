<x-agent-layout>
    <div class="max-w-5xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex mb-3" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        <li class="inline-flex items-center">
                            <a href="{{ route('agent.dashboard') }}" class="hover:text-amber-500 transition-colors">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-gray-600">Activity Log</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Timeline & Activity</h1>
                <p class="mt-2 text-gray-500 font-medium">A complete audit trail of your account actions and system interactions.</p>
            </div>
            
            <button class="flex items-center gap-2 px-5 py-2.5 bg-white text-gray-600 rounded-2xl border border-gray-100 font-bold text-sm shadow-sm hover:shadow-md hover:bg-gray-50 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download Log
            </button>
        </div>

        <!-- Activity Table Card -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden min-h-[500px] flex flex-col">
            <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between bg-gray-50/30">
                <div class="flex items-center gap-4">
                    <div class="p-2 bg-white rounded-xl shadow-sm border border-gray-100">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-gray-900">Audit Trail</h2>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Showing last {{ $logs->count() }} activities</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">Live Monitoring</span>
                </div>
            </div>

            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-50/50">
                            <th class="px-8 py-5">Action / Event</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5">IP Address</th>
                            <th class="px-8 py-5">Date & Time</th>
                            <th class="px-8 py-5"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50/50">
                        @forelse($logs as $log)
                            <tr class="group hover:bg-gray-50/50 transition-colors duration-200">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-2xl bg-gray-50 text-gray-400 flex items-center justify-center group-hover:bg-white group-hover:shadow-sm transition-all duration-300">
                                            @php
                                                $icon = match($log->action) {
                                                    'login' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />',
                                                    'password_update' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />',
                                                    'profile_update' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />',
                                                    default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
                                                };
                                            @endphp
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                {!! $icon !!}
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 leading-none">{{ ucwords(str_replace('_', ' ', $log->action)) }}</p>
                                            <p class="text-xs text-gray-400 mt-1.5 font-medium max-w-[200px] truncate">{{ $log->description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase rounded-lg border border-emerald-100 tracking-wider">
                                        Success
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <code class="text-xs font-mono text-gray-500 bg-gray-50 px-2 py-1 rounded-md">{{ $log->ip_address ?? '127.0.0.1' }}</code>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-xs font-bold text-gray-700">{{ $log->created_at->format('M d, Y') }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium mt-1">{{ $log->created_at->format('h:i A') }}</p>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button class="p-2 text-gray-300 hover:text-amber-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-24 text-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 4-8-4"/></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">No activity logged yet</h3>
                                    <p class="text-gray-400 text-sm mt-2 max-w-xs mx-auto">Your account is fresh and ready. Actions you take will appear here in real-time.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/20">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>

        <!-- Security Quick Tips -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-12">
            <div class="p-6 bg-gradient-to-br from-[#A85C2E] to-[#2B1810] rounded-[2rem] text-white flex items-center gap-6">
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center flex-shrink-0 backdrop-blur-md border border-white/10">
                    <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-base">Security Policy</h3>
                    <p class="text-white/60 text-xs mt-1 leading-relaxed">Activities are stored for 180 days after which they are automatically purged for privacy.</p>
                </div>
            </div>
            
            <div class="p-6 bg-amber-50 rounded-[2rem] border border-amber-100 flex items-center gap-6">
                <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center flex-shrink-0 shadow-sm border border-amber-100">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-base text-amber-900">Encrypted Logs</h3>
                    <p class="text-amber-700/60 text-xs mt-1 leading-relaxed">Your data sensitive actions are logged following strict security protocols and encryption.</p>
                </div>
            </div>
        </div>
    </div>
</x-agent-layout>
