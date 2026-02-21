<x-agent-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Hero Header -->
        <div class="relative rounded-3xl overflow-hidden mb-8 shadow-2xl" style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%);">
            <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-10" style="background: #C6A664; filter: blur(80px);"></div>
            <div class="relative px-8 py-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white tracking-tight">Messages</h1>
                        <p class="text-gray-300 mt-2">Chat with your clients in real time</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        @if($totalUnread > 0)
                            <div class="px-4 py-2 rounded-xl text-sm font-bold" style="background: rgba(198, 166, 100, 0.2); color: #C6A664;">
                                {{ $totalUnread }} unread message{{ $totalUnread > 1 ? 's' : '' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Conversations List -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100" style="background: rgba(0, 31, 63, 0.02);">
                <h2 class="text-lg font-bold" style="color: #001F3F;">All Conversations</h2>
            </div>

            @if($conversations->count() > 0)
                <div class="divide-y divide-gray-100">
                    @foreach($conversations as $conversation)
                        <a href="{{ route('agent.messages.show', $conversation->id) }}" 
                           class="flex items-center px-6 py-5 hover:bg-gray-50/80 transition-all duration-200 group {{ $conversation->unread_count > 0 ? 'bg-amber-50/30' : '' }}">
                            
                            <!-- Avatar -->
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-12 w-12 rounded-full flex items-center justify-center text-white font-bold text-lg" style="background: #001F3F;">
                                    {{ strtoupper(substr($conversation->customer->name ?? 'C', 0, 1)) }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="text-sm font-semibold truncate {{ $conversation->unread_count > 0 ? 'text-gray-900' : 'text-gray-700' }}">
                                        {{ $conversation->customer->name ?? 'Customer' }}
                                    </h3>
                                    <span class="text-xs text-gray-400 flex-shrink-0 ml-2">
                                        {{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans() : $conversation->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                @if($conversation->property)
                                    <p class="text-xs mb-1 font-medium" style="color: #C6A664;">
                                        <svg class="inline w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        {{ $conversation->property->title ?? 'Property' }}
                                    </p>
                                @endif

                                <p class="text-sm text-gray-500 truncate">
                                    @if($conversation->latestMessage)
                                        @if($conversation->latestMessage->sender_id === auth()->id())
                                            <span class="text-gray-400">You: </span>
                                        @endif
                                        {{ Str::limit($conversation->latestMessage->body, 60) }}
                                    @else
                                        No messages yet
                                    @endif
                                </p>
                            </div>

                            <!-- Unread Badge -->
                            @if($conversation->unread_count > 0)
                                <div class="flex-shrink-0 ml-3">
                                    <span class="inline-flex items-center justify-center h-6 w-6 rounded-full text-xs font-bold text-white" style="background: #C6A664;">
                                        {{ $conversation->unread_count }}
                                    </span>
                                </div>
                            @else
                                <div class="flex-shrink-0 ml-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="px-8 py-16 text-center">
                    <div class="h-20 w-20 rounded-2xl flex items-center justify-center mx-auto mb-6" style="background: rgba(0, 31, 63, 0.05);">
                        <svg class="h-10 w-10" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No conversations yet</h3>
                    <p class="text-gray-500 max-w-sm mx-auto">When customers message you about your properties, their conversations will appear here.</p>
                </div>
            @endif
        </div>
    </div>
</x-agent-layout>
