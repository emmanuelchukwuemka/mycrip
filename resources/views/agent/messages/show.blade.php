<x-agent-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('agent.messages.index') }}" class="inline-flex items-center text-sm font-medium transition-colors" style="color: #C6A664;" onmouseover="this.style.color='#001F3F'" onmouseout="this.style.color='#C6A664'">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Messages
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Chat Panel -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden flex flex-col" style="height: 75vh;">
                    
                    <!-- Chat Header -->
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center" style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%);">
                        <div class="h-10 w-10 rounded-full flex items-center justify-center text-white font-bold mr-3" style="background: #C6A664;">
                            {{ strtoupper(substr($conversation->customer->name ?? 'C', 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-white font-bold">{{ $conversation->customer->name ?? 'Customer' }}</h2>
                            <p class="text-gray-400 text-xs">{{ $conversation->customer->email ?? '' }}</p>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-4" id="messages-container" style="background: #f9fafb;">
                        
                        @if($conversation->property)
                            <!-- Property Context Card -->
                            <div class="flex justify-center mb-4">
                                <div class="inline-flex items-center px-4 py-2 rounded-full text-xs font-medium bg-white border border-gray-200 shadow-sm">
                                    <svg class="w-3 h-3 mr-2" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span class="text-gray-600">Regarding: </span>
                                    <span class="font-semibold ml-1" style="color: #001F3F;">{{ $conversation->property->title ?? 'Property' }}</span>
                                </div>
                            </div>
                        @endif

                        @foreach($conversation->messages as $message)
                            @if($message->sender_id === auth()->id())
                                <!-- Agent Message (Right) -->
                                <div class="flex justify-end">
                                    <div class="max-w-sm lg:max-w-md">
                                        <div class="px-4 py-3 rounded-2xl rounded-br-sm text-white text-sm" style="background: #001F3F;">
                                            {{ $message->body }}
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1 text-right">{{ $message->created_at->format('M d, g:i A') }}</p>
                                    </div>
                                </div>
                            @else
                                <!-- Customer Message (Left) -->
                                <div class="flex justify-start">
                                    <div class="max-w-sm lg:max-w-md">
                                        <div class="px-4 py-3 rounded-2xl rounded-bl-sm bg-white border border-gray-200 text-sm text-gray-800 shadow-sm">
                                            {{ $message->body }}
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->format('M d, g:i A') }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Reply Form -->
                    <div class="px-6 py-4 border-t border-gray-100 bg-white">
                        @if(session('success'))
                            <div class="mb-3 flex items-center p-3 rounded-lg bg-emerald-50 border border-emerald-200">
                                <svg class="w-4 h-4 text-emerald-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-emerald-700 text-xs font-medium">{{ session('success') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('agent.messages.reply', $conversation->id) }}" method="POST" class="flex items-end space-x-3">
                            @csrf
                            <div class="flex-1">
                                <textarea name="body" rows="2" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C6A664]/30 focus:border-[#C6A664] transition-all text-sm resize-none outline-none"
                                    placeholder="Type your reply..." required></textarea>
                            </div>
                            <button type="submit" 
                                class="px-5 py-3 rounded-xl text-white font-bold text-sm transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center"
                                style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%); border-bottom: 3px solid #C6A664;">
                                <svg class="w-4 h-4 mr-2" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Send
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Customer Info -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b border-gray-100" style="background: rgba(0, 31, 63, 0.02);">
                        <h3 class="text-sm font-bold" style="color: #001F3F;">Customer Details</h3>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="h-14 w-14 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4" style="background: #001F3F;">
                                {{ strtoupper(substr($conversation->customer->name ?? 'C', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $conversation->customer->name ?? 'Customer' }}</p>
                                <p class="text-sm text-gray-500">{{ $conversation->customer->email ?? '' }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3 pt-3 border-t border-gray-100">
                            @if($conversation->customer->agent_phone)
                                <a href="tel:{{ $conversation->customer->agent_phone }}" class="flex items-center text-sm text-gray-600 hover:text-[#001F3F] transition-colors">
                                    <svg class="w-4 h-4 mr-2" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    {{ $conversation->customer->agent_phone }}
                                </a>
                            @endif
                            <a href="mailto:{{ $conversation->customer->email }}" class="flex items-center text-sm text-gray-600 hover:text-[#001F3F] transition-colors">
                                <svg class="w-4 h-4 mr-2" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $conversation->customer->email ?? 'N/A' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Property Quick View -->
                @if($conversation->property)
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="px-5 py-3 border-b border-gray-100" style="background: rgba(0, 31, 63, 0.02);">
                            <h3 class="text-sm font-bold" style="color: #001F3F;">Property</h3>
                        </div>
                        <div class="p-5">
                            @if($conversation->property->images && $conversation->property->images->count() > 0)
                                <img src="{{ asset('storage/' . $conversation->property->images->first()->image_path) }}" 
                                     alt="{{ $conversation->property->title }}"
                                     class="w-full h-32 object-cover rounded-xl mb-3">
                            @endif
                            <h4 class="font-semibold text-gray-900 text-sm mb-1">{{ $conversation->property->title }}</h4>
                            <p class="text-lg font-bold mb-2" style="color: #C6A664;">₦{{ number_format($conversation->property->price) }}</p>
                            <p class="text-xs text-gray-500">{{ $conversation->property->address ?? '' }}</p>
                            <a href="{{ route('properties.show', $conversation->property->id) }}" 
                               class="inline-flex items-center mt-3 text-xs font-medium" style="color: #C6A664;">
                                View Property
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Conversation Started -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-5 text-center">
                        <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-1">Conversation Started</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $conversation->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-scroll to bottom of messages
        const container = document.getElementById('messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    </script>
</x-agent-layout>
