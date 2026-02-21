<x-agent-layout>
    <div class="max-w-5xl mx-auto">
        <!-- Hero Header -->
        <div class="relative overflow-hidden rounded-3xl p-8 mb-8 text-white shadow-2xl" style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%);">
            <div class="absolute top-0 right-0 -mt-16 -mr-16 w-64 h-64 bg-[#C6A664] opacity-15 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-64 h-64 bg-[#C6A664] opacity-10 rounded-full blur-3xl"></div>
            
            <div class="relative flex flex-col md:flex-row items-center justify-between z-10">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight">Inquiry Details</h1>
                    <p class="text-white/60 mt-2 text-sm">View and respond to client inquiry</p>
                </div>
                <a href="{{ route('agent.inquiries.index') }}" 
                   class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-[#C6A664] text-[#001F3F] font-bold rounded-xl hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Inquiries
                </a>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column — Inquiry Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Client Info Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800">Client Information</h3>
                        <div class="p-2 rounded-lg" style="background: rgba(0, 31, 63, 0.06);">
                            <svg class="w-5 h-5" style="color: #001F3F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="flex items-center space-x-6">
                            <div class="flex-shrink-0">
                                <div class="h-20 w-20 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-lg" style="background-color: #001F3F;">
                                    {{ strtoupper(substr($inquiry->guest_name, 0, 2)) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Full Name</p>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $inquiry->guest_name }}</h3>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email Address</p>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $inquiry->guest_email }}</h3>
                                    </div>
                                    @if($inquiry->guest_phone)
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Phone Number</p>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $inquiry->guest_phone }}</h3>
                                    </div>
                                    @endif
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Submitted</p>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $inquiry->created_at->diffForHumans() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Info Card -->
                @if($inquiry->property)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800">Property Information</h3>
                        <div class="p-2 rounded-lg" style="background: rgba(198, 166, 100, 0.1);">
                            <svg class="w-5 h-5" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="flex flex-col md:flex-row gap-6">
                            @if($inquiry->property->featured_image_url)
                            <div class="md:w-1/3 flex-shrink-0">
                                <img src="{{ $inquiry->property->featured_image_url }}" 
                                     alt="{{ $inquiry->property->title }}" 
                                     class="w-full h-48 md:h-full object-cover rounded-2xl shadow-sm">
                            </div>
                            @endif
                            <div class="flex-1">
                                <h4 class="text-xl font-bold text-gray-800 group-hover:text-[#C6A664] transition-colors">{{ $inquiry->property->title }}</h4>
                                <p class="text-sm text-gray-400 mt-1">{{ $inquiry->property->city }}{{ $inquiry->property->state ? ', ' . $inquiry->property->state : '' }}</p>
                                
                                <div class="mt-4">
                                    <span class="text-2xl font-bold" style="color: #001F3F;">{{ $inquiry->property->formatted_price ?? 'Contact for price' }}</span>
                                    <span class="text-sm text-gray-400 ml-2">{{ ucfirst($inquiry->property->listing_type ?? '') }}</span>
                                </div>
                                
                                <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-gray-100">
                                    @if($inquiry->property->bedrooms)
                                    <div class="text-center">
                                        <div class="p-2 rounded-xl mx-auto w-fit" style="background: rgba(0, 31, 63, 0.05);">
                                            <svg class="w-5 h-5" style="color: #001F3F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                        </div>
                                        <p class="text-lg font-bold text-gray-800 mt-1">{{ $inquiry->property->bedrooms }}</p>
                                        <p class="text-xs text-gray-400">Bedrooms</p>
                                    </div>
                                    @endif
                                    @if($inquiry->property->bathrooms)
                                    <div class="text-center">
                                        <div class="p-2 rounded-xl mx-auto w-fit" style="background: rgba(0, 31, 63, 0.05);">
                                            <svg class="w-5 h-5" style="color: #001F3F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </div>
                                        <p class="text-lg font-bold text-gray-800 mt-1">{{ $inquiry->property->bathrooms }}</p>
                                        <p class="text-xs text-gray-400">Bathrooms</p>
                                    </div>
                                    @endif
                                    @if($inquiry->property->area)
                                    <div class="text-center">
                                        <div class="p-2 rounded-xl mx-auto w-fit" style="background: rgba(0, 31, 63, 0.05);">
                                            <svg class="w-5 h-5" style="color: #001F3F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                            </svg>
                                        </div>
                                        <p class="text-lg font-bold text-gray-800 mt-1">{{ $inquiry->property->area }}</p>
                                        <p class="text-xs text-gray-400">sqm</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Message Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800">Inquiry Message</h3>
                        <div class="p-2 rounded-lg" style="background: rgba(198, 166, 100, 0.1);">
                            <svg class="w-5 h-5" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="rounded-2xl p-6" style="background: rgba(0, 31, 63, 0.02); border: 1px solid rgba(0, 31, 63, 0.06);">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 h-12 w-12 rounded-xl flex items-center justify-center text-white font-bold text-sm" style="background-color: #001F3F;">
                                    {{ strtoupper(substr($inquiry->guest_name, 0, 2)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4 mb-3">
                                        <h4 class="text-base font-bold text-gray-800">{{ $inquiry->guest_name }}</h4>
                                        <span class="text-xs text-gray-400 px-2 py-0.5 bg-gray-100 rounded-full">{{ $inquiry->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-600 leading-relaxed">
                                        {{ $inquiry->message }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column — Actions Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800">Inquiry Status</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-center py-6">
                            @if($inquiry->status === 'new')
                                <span class="px-5 py-2.5 inline-flex items-center text-sm font-bold rounded-xl" style="background: rgba(198, 166, 100, 0.12); color: #C6A664;">
                                    <span class="w-2 h-2 rounded-full bg-[#C6A664] mr-2.5 animate-pulse"></span>
                                    New Inquiry
                                </span>
                            @elseif($inquiry->status === 'read')
                                <span class="px-5 py-2.5 inline-flex items-center text-sm font-bold rounded-xl bg-emerald-50 text-emerald-700">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2.5"></span>
                                    Read
                                </span>
                            @elseif($inquiry->status === 'replied')
                                <span class="px-5 py-2.5 inline-flex items-center text-sm font-bold rounded-xl bg-blue-50 text-blue-700">
                                    <span class="w-2 h-2 rounded-full bg-blue-500 mr-2.5"></span>
                                    Replied
                                </span>
                            @elseif($inquiry->status === 'closed')
                                <span class="px-5 py-2.5 inline-flex items-center text-sm font-bold rounded-xl bg-gray-100 text-gray-600">
                                    <span class="w-2 h-2 rounded-full bg-gray-400 mr-2.5"></span>
                                    Closed
                                </span>
                            @else
                                <span class="px-5 py-2.5 inline-flex items-center text-sm font-bold rounded-xl bg-amber-50 text-amber-700">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            @endif
                        </div>
                        <div class="space-y-4 mt-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400 font-medium">Received</span>
                                <span class="text-gray-700 font-bold">{{ $inquiry->created_at->diffForHumans() }}</span>
                            </div>
                            @if($inquiry->property)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400 font-medium">Property</span>
                                <span class="text-gray-700 font-bold text-right max-w-[140px] truncate">{{ $inquiry->property->title }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        @if($inquiry->guest_email)
                        <a href="mailto:{{ $inquiry->guest_email }}" class="w-full inline-flex items-center px-5 py-3.5 text-[#001F3F] font-bold rounded-xl hover:shadow-lg transition-all duration-300 group" style="background-color: #C6A664;">
                            <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Send Email Response
                        </a>
                        @endif
                        
                        @if($inquiry->guest_phone)
                        <a href="tel:{{ $inquiry->guest_phone }}" class="w-full inline-flex items-center px-5 py-3.5 border-2 text-gray-700 bg-white font-bold rounded-xl hover:bg-gray-50 transition-all duration-200" style="border-color: rgba(0, 31, 63, 0.15);">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Call Client
                        </a>
                        @endif
                        
                        @if($inquiry->guest_phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->guest_phone) }}" target="_blank" class="w-full inline-flex items-center px-5 py-3.5 border-2 text-gray-700 bg-white font-bold rounded-xl hover:bg-gray-50 transition-all duration-200" style="border-color: rgba(0, 31, 63, 0.15);">
                            <svg class="w-5 h-5 mr-3 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            WhatsApp Message
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Property Quick View -->
                @if($inquiry->property)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800">Property Quick View</h3>
                    </div>
                    <div class="p-6">
                        @if($inquiry->property->featured_image_url)
                        <div class="rounded-2xl overflow-hidden mb-4 shadow-sm">
                            <img src="{{ $inquiry->property->featured_image_url }}" alt="{{ $inquiry->property->title }}" class="w-full h-32 object-cover">
                        </div>
                        @endif
                        <h4 class="font-bold text-gray-800 text-sm">{{ $inquiry->property->title }}</h4>
                        <p class="text-xs text-gray-400 mt-1">{{ $inquiry->property->city }}{{ $inquiry->property->state ? ', ' . $inquiry->property->state : '' }}</p>
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <span class="text-lg font-bold" style="color: #001F3F;">{{ $inquiry->property->formatted_price ?? 'Contact' }}</span>
                        </div>
                        <a href="{{ route('agent.properties.edit', $inquiry->property->id) }}" 
                           class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-200 text-white hover:shadow-lg" style="background-color: #001F3F;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Property
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-agent-layout>