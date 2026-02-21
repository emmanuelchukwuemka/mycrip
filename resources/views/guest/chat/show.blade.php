<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back -->
            <div class="mb-6">
                <a href="{{ route('chat.index') }}" class="inline-flex items-center text-sm font-medium transition-colors" style="color: #C6A664;">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    All Messages
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden flex flex-col" style="height: 80vh;">
                
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between" style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%);">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full flex items-center justify-center text-white font-bold mr-3" style="background: #C6A664;">
                            {{ strtoupper(substr($conversation->agent->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-white font-bold">{{ $conversation->agent->name ?? 'Agent' }}</h2>
                            @if($conversation->property)
                                <p class="text-xs" style="color: #C6A664;">{{ $conversation->property->title ?? '' }}</p>
                            @endif
                        </div>
                    </div>
                    @if($conversation->property)
                        <a href="{{ route('properties.show', $conversation->property->id) }}" 
                           class="text-xs text-white/70 hover:text-white transition-colors">
                            View Property →
                        </a>
                    @endif
                </div>

                <!-- Messages -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4" id="messages-container" style="background: #f9fafb;">
                    @foreach($conversation->messages as $message)
                        @if($message->sender_id === auth()->id())
                            <!-- Customer (Right) -->
                            <div class="flex justify-end">
                                <div class="max-w-sm lg:max-w-md">
                                    <div class="px-4 py-3 rounded-2xl rounded-br-sm text-white text-sm" style="background: #001F3F;">
                                        {{ $message->body }}
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1 text-right">{{ $message->created_at->format('M d, g:i A') }}</p>
                                </div>
                            </div>
                        @else
                            <!-- Agent (Left) -->
                            <div class="flex justify-start">
                                <div class="max-w-sm lg:max-w-md">
                                    <div class="flex items-start space-x-2">
                                        <div class="flex-shrink-0 h-7 w-7 rounded-full flex items-center justify-center text-white text-xs font-bold mt-1" style="background: #C6A664;">
                                            {{ strtoupper(substr($conversation->agent->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="px-4 py-3 rounded-2xl rounded-bl-sm bg-white border border-gray-200 text-sm text-gray-800 shadow-sm">
                                                {{ $message->body }}
                                            </div>
                                            <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->format('M d, g:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Reply -->
                <div class="px-6 py-4 border-t border-gray-100 bg-white">
                    @if(session('success'))
                        <div class="mb-3 flex items-center p-3 rounded-lg bg-emerald-50 border border-emerald-200">
                            <svg class="w-4 h-4 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-emerald-700 text-xs font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('chat.reply', $conversation->id) }}" method="POST" class="flex items-end space-x-3">
                        @csrf
                        <div class="flex-1">
                            <textarea name="body" rows="2" 
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C6A664]/30 focus:border-[#C6A664] transition-all text-sm resize-none outline-none"
                                placeholder="Type your message..." required></textarea>
                        </div>
                        <button type="submit" 
                            class="px-5 py-3 rounded-xl text-white font-bold text-sm transition-all duration-300 shadow-lg flex items-center"
                            style="background: #C6A664;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('messages-container');
        if (container) container.scrollTop = container.scrollHeight;
    </script>
</x-app-layout>
