<x-agent-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Hero Header -->
        <div class="relative overflow-hidden rounded-3xl p-8 mb-8 text-white shadow-2xl" style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%);">
            <div class="absolute top-0 right-0 -mt-16 -mr-16 w-64 h-64 bg-[#C6A664] opacity-15 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-64 h-64 bg-[#C6A664] opacity-10 rounded-full blur-3xl"></div>
            
            <div class="relative flex flex-col md:flex-row items-center justify-between z-10">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight">Property Inquiries</h1>
                    <p class="text-white/60 mt-2 text-sm">Manage and respond to client inquiries for your properties</p>
                </div>
                <a href="{{ route('agent.dashboard') }}" 
                   class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-[#C6A664] text-[#001F3F] font-bold rounded-xl hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Inquiries</p>
                        <h3 class="text-3xl font-bold mt-1" style="color: #001F3F;">{{ $totalInquiries }}</h3>
                    </div>
                    <div class="p-3 rounded-xl transition-all duration-300" style="background: rgba(0, 31, 63, 0.08); color: #001F3F;">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">New Today</p>
                        <h3 class="text-3xl font-bold mt-1" style="color: #C6A664;">{{ $newInquiries }}</h3>
                    </div>
                    <div class="p-3 rounded-xl transition-all duration-300" style="background: rgba(198, 166, 100, 0.12); color: #C6A664;">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Read</p>
                        <h3 class="text-3xl font-bold text-emerald-600 mt-1">{{ $readInquiries }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-emerald-50 text-emerald-600 transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Replied</p>
                        <h3 class="text-3xl font-bold text-amber-500 mt-1">{{ $repliedInquiries }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-amber-50 text-amber-500 transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inquiries Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-8 py-6 border-b border-gray-50 bg-gray-50/50">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Recent Inquiries</h3>
                    <p class="text-xs text-gray-400 mt-1">Manage and respond to client inquiries</p>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    <div class="flex items-center px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>{{ $totalInquiries }} total</span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs font-bold uppercase tracking-wider text-gray-400" style="background-color: #F8F9FC;">
                            <th class="px-8 py-4">Client</th>
                            <th class="px-8 py-4">Property</th>
                            <th class="px-8 py-4">Message</th>
                            <th class="px-8 py-4">Date</th>
                            <th class="px-8 py-4 text-center">Status</th>
                            <th class="px-8 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-xl flex items-center justify-center text-white font-bold text-sm" style="background-color: #001F3F;">
                                        {{ strtoupper(substr($inquiry->guest_name, 0, 2)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-800 group-hover:text-[#C6A664] transition-colors">{{ $inquiry->guest_name }}</div>
                                        <div class="text-xs text-gray-400">{{ $inquiry->guest_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-medium text-gray-800">{{ $inquiry->property->title ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-400">{{ $inquiry->property->city ?? '' }}{{ $inquiry->property->state ? ', ' . $inquiry->property->state : '' }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm text-gray-600 max-w-xs truncate leading-relaxed">
                                    {{ $inquiry->message }}
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $inquiry->created_at->diffForHumans() }}</div>
                                <div class="text-[10px] text-gray-300 mt-0.5">{{ $inquiry->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if($inquiry->status === 'new')
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold uppercase" style="background: rgba(198, 166, 100, 0.12); color: #C6A664;">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#C6A664] mr-2 animate-pulse"></span>
                                        New
                                    </span>
                                @elseif($inquiry->status === 'read')
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 uppercase">
                                        Read
                                    </span>
                                @elseif($inquiry->status === 'replied')
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 uppercase">
                                        Replied
                                    </span>
                                @elseif($inquiry->status === 'closed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-600 uppercase">
                                        Closed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-amber-50 text-amber-700 uppercase">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('agent.inquiries.show', $inquiry->id) }}" 
                                       class="inline-flex items-center px-4 py-2 text-white text-sm font-bold rounded-xl hover:shadow-lg transition-all duration-200" style="background-color: #001F3F;">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                    @if($inquiry->status === 'new')
                                    <form action="{{ route('agent.inquiries.show', $inquiry->id) }}" method="GET">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border text-sm font-medium rounded-xl hover:bg-gray-50 transition-all duration-200" style="border-color: #C6A664; color: #C6A664;">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Mark Read
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 rounded-full flex items-center justify-center text-gray-200 mb-4" style="background: rgba(0, 31, 63, 0.04);">
                                        <svg class="h-10 w-10" style="color: rgba(0, 31, 63, 0.15);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-400 font-medium">No inquiries yet.</p>
                                    <p class="text-gray-300 text-sm mt-1">When clients inquire about your properties, they'll appear here.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-agent-layout>