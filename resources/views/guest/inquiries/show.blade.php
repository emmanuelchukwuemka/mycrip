<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 items-center text-sm font-bold text-gray-400 uppercase tracking-widest" aria-label="Breadcrumb">
                <a href="{{ route('inquiries.index') }}" class="hover:text-[#001F3F] transition-colors">My Inquiries</a>
                <svg class="w-4 h-4 mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-[#C6A664]">Inquiry Details</span>
            </nav>

            <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden">
                <!-- Property Overview -->
                <div class="relative h-64">
                    <img src="{{ $inquiry->property->images->first()->image_path ?? asset('images/placeholder-property.jpg') }}" 
                         alt="{{ $inquiry->property->title }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#001F3F] to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="px-3 py-1 bg-[#C6A664] text-white text-[10px] font-black uppercase tracking-widest rounded-lg">
                                {{ str_replace('_', ' ', $inquiry->property->category) }}
                            </span>
                        </div>
                        <h1 class="text-3xl font-black text-white tracking-tight">{{ $inquiry->property->title }}</h1>
                        <p class="text-white/70 font-medium flex items-center mt-1">
                            <svg class="w-4 h-4 mr-2 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.922A2 2 0 0111.172 20.922L6.929 16.657m11.086 0A8 8 0 104.343 4.343m13.714 8.286c0-1.104-.224-2.144-.648-3.09"/>
                            </svg>
                            {{ $inquiry->property->city }}, {{ $inquiry->property->state }}
                        </p>
                    </div>
                    <a href="{{ route('properties.show', $inquiry->property->id) }}" 
                       class="absolute top-8 right-8 p-4 bg-white/10 backdrop-blur-md rounded-2xl text-white hover:bg-[#C6A664] transition-all transform hover:rotate-12">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>

                <!-- Inquiry Details -->
                <div class="p-10">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <!-- Left: Inquiry Content -->
                        <div class="lg:col-span-2">
                            <div class="mb-10">
                                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">My Message</h2>
                                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 italic text-gray-700 leading-relaxed font-medium">
                                    "{{ $inquiry->message }}"
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Interaction Timeline</h2>
                                <div class="space-y-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-10 h-10 rounded-2xl bg-[#001F3F] flex items-center justify-center text-white text-xs font-bold shrink-0">
                                            ME
                                        </div>
                                        <div class="flex-grow pt-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <p class="text-sm font-bold text-[#001F3F]">Inquiry Submitted</p>
                                                <span class="text-[10px] font-bold text-gray-400">{{ $inquiry->created_at->format('M d, Y · h:i A') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-500 font-medium font-medium">Your request has been received by the agent.</p>
                                        </div>
                                    </div>

                                    @if($inquiry->status === 'responded')
                                        <div class="flex items-start space-x-4">
                                            <div class="w-10 h-10 rounded-2xl bg-[#C6A664] flex items-center justify-center text-white text-xs font-bold shrink-0">
                                                {{ strtoupper(substr($inquiry->property->user->name, 0, 1)) }}
                                            </div>
                                            <div class="flex-grow pt-1">
                                                <div class="flex items-center justify-between mb-1">
                                                    <p class="text-sm font-bold text-[#001F3F]">Agent Responded</p>
                                                    <span class="text-[10px] font-bold text-gray-400">{{ $inquiry->updated_at->format('M d, Y · h:i A') }}</span>
                                                </div>
                                                <p class="text-sm text-gray-500 font-medium font-medium">The agent has reviewed and responded to your inquiry. Please check your messages for details.</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right: Agent Info -->
                        <div class="space-y-8">
                            <div>
                                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Listing Agent</h2>
                                <div class="bg-white rounded-3xl p-6 border-2 border-gray-100 flex flex-col items-center text-center shadow-sm">
                                    <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-[#001F3F] to-[#003366] p-1 mb-4 shadow-lg">
                                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
                                            <div class="w-[90%] h-[90%] rounded-full bg-[#001F3F] flex items-center justify-center text-white text-2xl font-black">
                                                {{ strtoupper(substr($inquiry->property->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="text-lg font-black text-[#001F3F]">{{ $inquiry->property->user->name }}</h3>
                                    <p class="text-xs font-bold text-[#C6A664] uppercase tracking-widest mt-1">Verified Agent</p>
                                    
                                    <div class="w-full h-px bg-gray-100 my-6"></div>
                                    
                                    <a href="{{ route('chat.index') }}" 
                                       class="w-full py-4 bg-[#001F3F] text-white font-black rounded-2xl hover:bg-[#00152B] transition-all shadow-xl hover:shadow-[#001F3F]/20 active:scale-95 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        Live Chat
                                    </a>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-[#001F3F] to-[#00152B] rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/5 rounded-full blur-2xl"></div>
                                <h3 class="text-lg font-black mb-2 relative z-10 text-[#C6A664]">Need Help?</h3>
                                <p class="text-xs font-medium text-white/70 relative z-10 leading-relaxed mb-6">Our support team is available 24/7 for any urgent issues regarding your property search.</p>
                                <a href="#" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-white/50 hover:text-white transition-colors">
                                    Contact Support
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4 4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
