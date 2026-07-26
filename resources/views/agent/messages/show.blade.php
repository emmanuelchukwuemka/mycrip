<x-agent-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('agent.messages.index') }}" class="inline-flex items-center text-sm font-medium transition-colors" style="color: #2B1810;">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Messages
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Chat Panel -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden flex flex-col" style="height: 75vh;">
                    
                    <!-- Chat Header -->
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between" style="background: linear-gradient(135deg, #A85C2E 0%, #2B1810 100%);">
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="h-10 w-10 rounded-full flex items-center justify-center text-white font-bold mr-3" style="background: #2B1810;">
                                    {{ strtoupper(substr($conversation->customer->name ?? 'C', 0, 1)) }}
                                </div>
                                @if($conversation->customer->isOnline())
                                    <span class="absolute bottom-0 right-3 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                                @endif
                            </div>
                            <div>
                                <h2 class="text-white font-bold">{{ $conversation->customer->name ?? 'Customer' }}</h2>
                                <span class="text-[10px] text-white/60 font-medium">
                                    {{ $conversation->customer->presence_status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-4" id="messages-container" style="background: #f9fafb;">
                        @foreach($conversation->messages as $message)
                            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-sm lg:max-w-md {{ $message->sender_id === auth()->id() ? '' : 'flex items-start space-x-2' }}">
                                    @if($message->sender_id !== auth()->id())
                                        <div class="flex-shrink-0 h-7 w-7 rounded-full flex items-center justify-center text-white text-xs font-bold mt-1" style="background: #2B1810;">
                                            {{ strtoupper(substr($conversation->customer->name ?? 'C', 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="px-4 py-3 rounded-2xl shadow-sm border {{ $message->sender_id === auth()->id() ? 'rounded-br-sm text-white' : 'rounded-bl-sm bg-white text-gray-800 border-gray-200' }}" 
                                             style="{{ $message->sender_id === auth()->id() ? 'background: #A85C2E; border-color: #A85C2E;' : '' }}">
                                            
                                            @if($message->attachment_path)
                                                <div class="mb-2">
                                                    @if(Str::startsWith($message->attachment_type, 'image/'))
                                                        <a href="{{ asset('storage/' . $message->attachment_path) }}" target="_blank" class="block rounded-lg overflow-hidden border border-white/20">
                                                            <img src="{{ asset('storage/' . $message->attachment_path) }}" alt="Attachment" class="w-full h-auto max-h-64 object-cover">
                                                        </a>
                                                    @elseif(Str::startsWith($message->attachment_type, 'audio/'))
                                                        <div class="flex items-center space-x-2 bg-black/10 p-2 rounded-lg">
                                                            <audio controls class="h-8 max-w-full">
                                                                <source src="{{ asset('storage/' . $message->attachment_path) }}" type="{{ $message->attachment_type }}">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        </div>
                                                    @else
                                                        <a href="{{ asset('storage/' . $message->attachment_path) }}" target="_blank" class="flex items-center space-x-2 p-2 rounded-lg bg-black/10 hover:bg-black/20 transition-colors">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                            </svg>
                                                            <div class="flex-1 truncate">
                                                                <p class="text-xs font-bold truncate text-current">{{ $message->attachment_name }}</p>
                                                                <p class="text-[10px] opacity-70">{{ number_format($message->file_size / 1024, 1) }} KB</p>
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                            
                                            @if($message->body)
                                                <p class="text-sm leading-relaxed">{{ $message->body }}</p>
                                            @endif
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-1 {{ $message->sender_id === auth()->id() ? 'text-right' : '' }}">
                                            {{ $message->created_at->format('g:i A') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Reply Area -->
                    <div class="px-6 py-4 border-t border-gray-100 bg-white" x-data="chatHandler()">
                        <form action="{{ route('agent.messages.reply', $conversation->id) }}" method="POST" enctype="multipart/form-data" id="reply-form">
                            @csrf
                            <div class="flex flex-col space-y-3">
                                <!-- Preview -->
                                <div x-show="previewUrl" class="relative inline-block w-24 h-24 rounded-xl overflow-hidden border-2 border-[#2B1810]">
                                    <template x-if="previewType === 'image'">
                                        <img :src="previewUrl" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="previewType === 'file'">
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50 text-[10px] p-2 text-center text-gray-400">
                                            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            <span class="truncate w-full" x-text="fileName"></span>
                                        </div>
                                    </template>
                                    <button type="button" @click="clearAttachment()" class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full p-1 shadow-lg">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>

                                <div class="flex items-end space-x-2">
                                    <label class="p-3 rounded-xl bg-gray-50 text-gray-400 hover:text-[#2B1810] hover:bg-gray-100 cursor-pointer transition-all border border-gray-100">
                                        <input type="file" name="attachment" class="hidden" @change="handleFile($event)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                    </label>

                                    <div class="flex-1 relative">
                                        <textarea name="body" rows="1" 
                                            class="w-full px-4 py-3 border border-gray-100 bg-gray-50 rounded-2xl focus:ring-4 focus:ring-[#2B1810]/5 focus:border-[#2B1810] focus:bg-white transition-all text-sm resize-none outline-none pr-12"
                                            placeholder="Type your message..." @keydown.enter.prevent="submitForm()"></textarea>
                                        
                                        <button type="button" @click="toggleRecording()" 
                                                class="absolute right-3 bottom-2 text-gray-400 hover:text-red-500 transition-colors p-1"
                                                :class="{ 'text-red-500 animate-pulse': isRecording }">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <button type="submit" 
                                        class="p-3.5 rounded-2xl text-white font-bold transition-all duration-300 shadow-lg shadow-[#2B1810]/20 hover:scale-105 active:scale-95"
                                        style="background: #2B1810;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Customer Details -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b border-gray-100" style="background: rgba(168, 92, 46, 0.02);">
                        <h3 class="text-sm font-bold" style="color: #A85C2E;">Customer Details</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="h-14 w-14 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4" style="background: #A85C2E;">
                                {{ strtoupper(substr($conversation->customer->name ?? 'C', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $conversation->customer->name ?? 'Customer' }}</p>
                                <p class="text-xs text-gray-500">{{ $conversation->customer->email ?? '' }}</p>
                            </div>
                        </div>
                        <div class="space-y-3 pt-4 border-t border-gray-50">
                            <div class="text-xs">
                                <span class="text-gray-400 block mb-1">Status</span>
                                <span class="font-medium {{ $conversation->customer->isOnline() ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $conversation->customer->presence_status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                @if($conversation->property)
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="px-5 py-3 border-b border-gray-100" style="background: rgba(168, 92, 46, 0.02);">
                            <h3 class="text-sm font-bold" style="color: #A85C2E;">Linked Property</h3>
                        </div>
                        <div class="p-6">
                            @if($conversation->property->images && $conversation->property->images->count() > 0)
                                <img src="{{ asset('storage/' . $conversation->property->images->first()->image_path) }}" 
                                     alt="Property" class="w-full h-32 object-cover rounded-xl mb-4">
                            @endif
                            <h4 class="font-bold text-gray-900 text-sm mb-1 truncate">{{ $conversation->property->title }}</h4>
                            <p class="text-lg font-black" style="color: #2B1810;">₦{{ number_format($conversation->property->price) }}</p>
                            <a href="{{ route('properties.show', $conversation->property->id) }}" class="mt-4 block text-center py-2 bg-gray-50 hover:bg-gray-100 rounded-lg text-xs font-bold transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function chatHandler() {
            return {
                previewUrl: null,
                previewType: null,
                fileName: '',
                isRecording: false,
                mediaRecorder: null,
                audioChunks: [],
                
                handleFile(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    this.fileName = file.name;
                    if (file.type.startsWith('image/')) {
                        this.previewType = 'image';
                        this.previewUrl = URL.createObjectURL(file);
                    } else {
                        this.previewType = 'file';
                        this.previewUrl = 'placeholder';
                    }
                },
                
                clearAttachment() {
                    this.previewUrl = null;
                    this.previewType = null;
                    document.querySelector('input[type="file"]').value = '';
                },

                async toggleRecording() {
                    if (this.isRecording) {
                        this.mediaRecorder.stop();
                        this.isRecording = false;
                    } else {
                        try {
                            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                            this.mediaRecorder = new MediaRecorder(stream);
                            this.audioChunks = [];
                            this.mediaRecorder.ondataavailable = (e) => this.audioChunks.push(e.data);
                            this.mediaRecorder.onstop = () => {
                                const audioBlob = new Blob(this.audioChunks, { type: 'audio/mp4' });
                                const audioFile = new File([audioBlob], 'voice_note.m4a', { type: 'audio/mp4' });
                                
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(audioFile);
                                document.querySelector('input[type="file"]').files = dataTransfer.files;
                                
                                this.previewType = 'file';
                                this.previewUrl = 'voice';
                                this.fileName = 'Voice Note (Ready to send)';
                            };
                            this.mediaRecorder.start();
                            this.isRecording = true;
                        } catch (err) {
                            alert('Mic access denied');
                        }
                    }
                },
                
                submitForm() {
                    document.getElementById('reply-form').submit();
                }
            }
        }

        const container = document.getElementById('messages-container');
        if (container) container.scrollTop = container.scrollHeight;
    </script>
</x-agent-layout>
