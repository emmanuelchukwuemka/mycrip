<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold" style="color: #001F3F;">My Messages</h1>
                    <p class="text-gray-500 mt-1">Your conversations with agents</p>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 text-gray-500 bg-white rounded-xl hover:bg-gray-50 transition-all text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>

            <!-- Conversations List -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                @if($conversations->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach($conversations as $conversation)
                            <a href="{{ route('chat.show', $conversation->id) }}" 
                               class="flex items-center px-6 py-5 hover:bg-gray-50 transition-all {{ $conversation->unread_count > 0 ? 'bg-amber-50/40' : '' }}">
                                
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-12 w-12 rounded-full flex items-center justify-center text-white font-bold" style="background: #001F3F;">
                                        {{ strtoupper(substr($conversation->agent->name ?? 'A', 0, 1)) }}
                                    </div>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="text-sm font-semibold text-gray-900">{{ $conversation->agent->name ?? 'Agent' }}</h3>
                                        <span class="text-xs text-gray-400">{{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans() : '' }}</span>
                                    </div>
                                    @if($conversation->property)
                                        <p class="text-xs font-medium mb-1" style="color: #C6A664;">{{ $conversation->property->title ?? 'Property' }}</p>
                                    @endif
                                    <p class="text-sm text-gray-500 truncate">
                                        @if($conversation->latestMessage)
                                            @if($conversation->latestMessage->sender_id === auth()->id())
                                                <span class="text-gray-400">You: </span>
                                            @endif
                                            {{ Str::limit($conversation->latestMessage->body, 60) }}
                                        @endif
                                    </p>
                                </div>

                                @if($conversation->unread_count > 0)
                                    <span class="ml-3 inline-flex items-center justify-center h-6 w-6 rounded-full text-xs font-bold text-white" style="background: #C6A664;">
                                        {{ $conversation->unread_count }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="px-8 py-16 text-center">
                        <div class="h-16 w-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background: rgba(0, 31, 63, 0.05);">
                            <svg class="h-8 w-8" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">No messages yet</h3>
                        <p class="text-gray-500 text-sm">Start a conversation by contacting an agent on any property listing.</p>
                        <a href="{{ route('properties.index') }}" class="inline-flex items-center mt-4 text-sm font-medium" style="color: #C6A664;">
                            Browse Properties
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
