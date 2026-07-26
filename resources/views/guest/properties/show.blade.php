<x-app-layout>
    @section('seo')
        <title>{{ $property->title }} | Villa Africa</title>
        <meta name="description" content="{{ Str::limit($property->description, 160) }}">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $property->title }} | Villa Africa">
        <meta property="og:description" content="{{ Str::limit($property->description, 160) }}">
        <meta property="og:image" content="{{ $property->featured_image_url }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $property->title }} | Villa Africa">
        <meta property="twitter:description" content="{{ Str::limit($property->description, 160) }}">
        <meta property="twitter:image" content="{{ $property->featured_image_url }}">
        
        <!-- Pannellum for 360° Virtual Tours -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
        <style>
            #pannellum-viewer { width: 100%; height: 100%; }
            .pnlm-load-button { background-color: #2B1810 !important; }
        </style>
    @endsection
    <div class="bg-gray-100 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">Home</a></li>
                    <li><span class="text-gray-300">/</span></li>
                    <li><a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-gray-500">Properties</a></li>
                    <li><span class="text-gray-300">/</span></li>
                    <li class="text-gray-600 font-medium">{{ $property->title }}</li>
                </ol>
            </nav>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Image Gallery -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8" x-data="{ activeImage: '{{ $property->images->where('label', 'General')->first()?->image_url ?? ($property->images->first()?->image_url ?? $property->featured_image_url) }}' }">
                        <!-- Main Image -->
                        <div class="relative h-[28rem] group">
                            <img :src="activeImage" alt="{{ $property->title }}" class="w-full h-full object-cover transition-all duration-500">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                                <span class="bg-[#2B1810] text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Explore Property</span>
                            </div>
                        </div>
                        
                        <!-- General Gallery Thumbnails -->
                        @php
                            $generalImages = $property->images->where('label', 'General');
                        @endphp
                        
                        @if($generalImages->count() > 1)
                            <div class="p-4 bg-gray-50 flex space-x-4 overflow-x-auto scrollbar-hide">
                                @foreach($generalImages as $index => $image)
                                    <div class="flex-shrink-0 w-24 h-20 rounded-xl overflow-hidden cursor-pointer border-2 transition-all duration-200"
                                         :class="activeImage === '{{ $image->image_url }}' ? 'border-[#2B1810] scale-105 shadow-md' : 'border-transparent opacity-60 hover:opacity-100'"
                                         @click="activeImage = '{{ $image->image_url }}'">
                                        <img src="{{ $image->image_url }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Categorized Galleries -->
                    @php
                        $subGalleries = $property->images->where('label', '!=', 'General')->groupBy('label');
                    @endphp

                    @if($subGalleries->count() > 0)
                        <div class="mb-8 space-y-6">
                            @foreach($subGalleries as $label => $images)
                                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                                    <div class="flex items-center justify-between mb-4 border-l-4 border-[#2B1810] pl-4">
                                        <h3 class="text-lg font-bold text-[#A85C2E]">{{ $label }}</h3>
                                        <span class="text-xs font-bold text-gray-400">{{ $images->count() }} Photos</span>
                                    </div>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                        @foreach($images as $image)
                                            <a href="{{ $image->image_url }}" target="_blank" class="block aspect-square rounded-xl overflow-hidden group relative">
                                                <img src="{{ $image->image_url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                                    </svg>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Video & Virtual Tour Content -->
                    @if($property->video_url || $property->virtual_tour_url)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                            <div class="border-b" x-data="{ activeMedia: '{{ $property->video_url ? 'video' : 'tour' }}' }">
                                <div class="flex">
                                    @if($property->video_url)
                                        <button @click="activeMedia = 'video'" :class="activeMedia === 'video' ? 'border-b-2 border-[#A85C2E] text-[#A85C2E]' : 'text-gray-500'" class="px-6 py-4 font-bold text-sm uppercase tracking-wider transition-all duration-200 outline-none">
                                            Video Walkthrough
                                        </button>
                                    @endif
                                    @if($property->virtual_tour_url)
                                        <button @click="activeMedia = 'tour'" :class="activeMedia === 'tour' ? 'border-b-2 border-[#A85C2E] text-[#A85C2E]' : 'text-gray-500'" class="px-6 py-4 font-bold text-sm uppercase tracking-wider transition-all duration-200 outline-none">
                                            Matterport Tour
                                        </button>
                                    @endif
                                    @if($property->images->where('is_360', true)->count() > 0)
                                        <button @click="activeMedia = 'internal_360'; initPannellum()" :class="activeMedia === 'internal_360' ? 'border-b-2 border-[#A85C2E] text-[#A85C2E]' : 'text-gray-500'" class="px-6 py-4 font-bold text-sm uppercase tracking-wider transition-all duration-200 outline-none">
                                            360° Photos
                                        </button>
                                    @endif
                                </div>

                                <div class="p-4 bg-gray-50">
                                    @if($property->video_url)
                                        <div x-show="activeMedia === 'video'" class="aspect-video rounded-xl overflow-hidden shadow-inner bg-black">
                                            @if($property->youtube_id)
                                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $property->youtube_id }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            @elseif($property->vimeo_id)
                                                <iframe src="https://player.vimeo.com/video/{{ $property->vimeo_id }}" class="w-full h-full" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                            @else
                                                <div class="flex items-center justify-center h-full text-white">
                                                    <a href="{{ $property->video_url }}" target="_blank" class="underline">Click to View Video</a>
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    @if($property->virtual_tour_url)
                                        <div x-show="activeMedia === 'tour'" class="aspect-video rounded-xl overflow-hidden shadow-inner bg-gray-200">
                                            <iframe src="{{ $property->virtual_tour_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    @endif

                                    <!-- 360 Image Viewer (Internal) -->
                                    @if($property->images->where('is_360', true)->count() > 0)
                                        <div x-show="activeMedia === 'internal_360'" class="aspect-video rounded-xl overflow-hidden shadow-inner bg-black relative">
                                            <div id="pannellum-viewer"></div>
                                            <div class="absolute bottom-4 left-4 flex space-x-2 overflow-x-auto max-w-[80%]" x-data="{ current360: '' }">
                                                @foreach($property->images->where('is_360', true) as $img)
                                                    <button @click="load360('{{ asset('storage/' . $img->image_path) }}')" 
                                                            class="flex-shrink-0 w-12 h-12 rounded border-2 border-white/50 hover:border-white transition-all overflow-hidden">
                                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- External 360 Check if no virtual_tour_url but has is_360 images -->
                    @if(!$property->virtual_tour_url && $property->images->where('is_360', true)->count() > 0 && !$property->video_url)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                             <div class="px-6 py-4 border-b flex items-center justify-between">
                                <h3 class="font-bold text-[#A85C2E] uppercase tracking-wider text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-[#2B1810]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Interactive 360° Walkthrough
                                </h3>
                             </div>
                             <div class="aspect-video relative bg-black">
                                <div id="pannellum-viewer-standalone" class="w-full h-full"></div>
                             </div>
                        </div>
                    @endif

                    <!-- Details -->
                    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <span class="inline-block text-sm font-semibold px-3 py-1 rounded-full mb-2" style="background-color: #F5F5F5; color: #A85C2E;">
                                    {{ $property->category_display_name }}
                                </span>
                                <h1 class="text-3xl font-bold" style="color: #A85C2E;">{{ $property->title }}</h1>
                                <p class="text-gray-500 mt-2 flex items-center">
                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $property->address ?? '' }}, {{ $property->city }}, {{ $property->state }}, {{ $property->country }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold" style="color: #A85C2E;">{{ $property->formatted_price }}</p>
                                @if($property->price_type !== 'fixed')
                                    <p class="text-gray-500">{{ ucfirst($property->price_type) }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Property Features -->
                        @if($property->bedrooms || $property->bathrooms || $property->shops || $property->warehouses || $property->size)
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mb-8 border-t border-b py-6 text-center">
                            @if($property->bedrooms)
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">{{ $property->bedrooms }}</span>
                                <span class="text-gray-500">Bedrooms</span>
                            </div>
                            @endif
                            @if($property->bathrooms)
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">{{ $property->bathrooms }}</span>
                                <span class="text-gray-500">Bathrooms</span>
                            </div>
                            @endif
                            @if($property->shops)
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">{{ $property->shops }}</span>
                                <span class="text-gray-500">Shops</span>
                            </div>
                            @endif
                            @if($property->warehouses)
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">{{ $property->warehouses }}</span>
                                <span class="text-gray-500">Warehouses</span>
                            </div>
                            @endif
                            @if($property->size)
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">{{ $property->size }}</span>
                                <span class="text-gray-500">Size (sqm)</span>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Hotel/Lodge Hospitality Features -->
                        @if($property->total_rooms || $property->security_level || $property->parking_capacity || $property->has_pool || $property->has_gym || $property->has_conference_room || $property->has_restaurant)
                        <div class="mb-8 p-6 rounded-2xl border border-[#2B1810]/20" style="background: linear-gradient(135deg, #2B1810/5, #A85C2E/5);">
                            <h3 class="text-lg font-bold text-[#A85C2E] mb-5 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#2B1810]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Premium Features
                            </h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
                                @if($property->total_rooms)
                                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-gray-100">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-[#A85C2E]/5 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#A85C2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <span class="block text-2xl font-bold text-[#A85C2E]">{{ $property->total_rooms }}</span>
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Rooms</span>
                                </div>
                                @endif
                                @if($property->parking_capacity)
                                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-gray-100">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-[#A85C2E]/5 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#A85C2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-4 4v4m-4-4h8a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="block text-2xl font-bold text-[#A85C2E]">{{ $property->parking_capacity }}</span>
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Parking Spaces</span>
                                </div>
                                @endif
                                @if($property->security_level)
                                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-gray-100">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-[#A85C2E]/5 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#A85C2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <span class="block text-lg font-bold text-[#A85C2E] capitalize">{{ $property->security_level }}</span>
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Security Level</span>
                                </div>
                                @endif
                                @if($property->has_pool)
                                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-gray-100">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-blue-50 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                        </svg>
                                    </div>
                                    <span class="block text-sm font-bold text-[#A85C2E]">Swimming Pool</span>
                                    <span class="text-xs text-green-600 font-semibold">Available</span>
                                </div>
                                @endif
                                @if($property->has_gym)
                                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-gray-100">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-orange-50 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="block text-sm font-bold text-[#A85C2E]">Fitness Gym</span>
                                    <span class="text-xs text-green-600 font-semibold">Available</span>
                                </div>
                                @endif
                                @if($property->has_conference_room)
                                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-gray-100">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-purple-50 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="block text-sm font-bold text-[#A85C2E]">Conference Room</span>
                                    <span class="text-xs text-green-600 font-semibold">Available</span>
                                </div>
                                @endif
                                @if($property->has_restaurant)
                                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-gray-100">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-red-50 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="block text-sm font-bold text-[#A85C2E]">Restaurant/Bar</span>
                                    <span class="text-xs text-green-600 font-semibold">Available</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Description -->
                        <div class="prose max-w-none text-gray-700 mb-8">
                            <h3 class="text-xl font-semibold mb-4">Description</h3>
                            <p>{{ $property->description }}</p>
                        </div>

                        <!-- Amenities/Features -->
                        <div class="mt-8 pb-8 border-b border-gray-100">
                            <h3 class="text-xl font-semibold mb-4 text-[#A85C2E]">Amenities</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @if($property->furnished)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Furnished
                                </div>
                                @endif
                                @if($property->serviced)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Serviced
                                </div>
                                @endif
                                @if($property->parking)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Parking Space
                                </div>
                                @endif
                                @if($property->security)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    24/7 Security
                                </div>
                                @endif
                                @if($property->water_supply)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Water Supply
                                </div>
                                @endif
                                @if($property->power_supply)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Power Supply
                                </div>
                                @endif
                                @if($property->has_pool)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Swimming Pool
                                </div>
                                @endif
                                @if($property->has_gym)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Fitness Gym
                                </div>
                                @endif
                                @if($property->has_conference_room)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Conference Room
                                </div>
                                @endif
                                @if($property->has_restaurant)
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Restaurant/Bar
                                </div>
                                @endif
                                @if(!empty($property->features['other_amenities']))
                                    @php
                                        $otherAmenities = explode(',', $property->features['other_amenities']);
                                    @endphp
                                    @foreach($otherAmenities as $amenity)
                                        @if(trim($amenity))
                                        <div class="flex items-center text-gray-600">
                                            <svg class="h-5 w-5 mr-2 text-[#2B1810]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            <span class="capitalize">{{ trim($amenity) }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Reviews Section -->
                        <div id="reviews" class="mt-8">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-xl font-bold text-[#A85C2E]">Property Reviews</h3>
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400 mr-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= round($property->average_rating) ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm font-bold text-[#A85C2E]">{{ number_format($property->average_rating, 1) }}</span>
                                </div>
                            </div>

                            <!-- Review List -->
                            <div class="space-y-6 mb-10">
                                @forelse($reviews as $review)
                                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 transition-hover duration-300 hover:shadow-md">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-[#A85C2E] text-white flex items-center justify-center font-bold text-sm">
                                                    {{ substr($review->reviewer->name, 0, 1) }}
                                                </div>
                                                <div class="ml-3">
                                                    <h4 class="text-sm font-bold text-[#A85C2E]">{{ $review->reviewer->name }}</h4>
                                                    <p class="text-[10px] text-gray-400 font-medium uppercase tracking-wider">{{ $review->created_at->format('M d, Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="flex text-yellow-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20">
                                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm leading-relaxed italic">
                                            "{{ $review->comment }}"
                                        </p>
                                    </div>
                                @empty
                                    <div class="text-center py-10 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                                        <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">No reviews yet. Share your experience!</p>
                                    </div>
                                @endforelse
                            </div>

                            <div class="mb-10">
                                {{ $reviews->links() }}
                            </div>

                            <!-- Review Form -->
                            @auth
                                @if(auth()->user()->id !== ($property->user->id ?? null))
                                    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                                        <h4 class="text-lg font-bold text-[#A85C2E] mb-6">Rate this Property</h4>
                                        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
                                            @csrf
                                            <input type="hidden" name="agent_id" value="{{ $property->user->id ?? '' }}">
                                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                                            
                                            <div x-data="{ rating: 0 }" class="space-y-3">
                                                <label class="block text-xs font-black uppercase tracking-[0.2em] text-gray-400">Rating Score</label>
                                                <div class="flex gap-2">
                                                    <template x-for="i in 5">
                                                        <button type="button" @click="rating = i" class="outline-none transition-transform duration-200 hover:scale-125">
                                                            <svg class="w-10 h-10 cursor-pointer" :class="i <= rating ? 'text-yellow-400 fill-current' : 'text-gray-200 fill-current'" viewBox="0 0 20 20">
                                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                            </svg>
                                                        </button>
                                                    </template>
                                                    <input type="hidden" name="rating" :value="rating" required>
                                                </div>
                                            </div>

                                            <div class="space-y-3">
                                                <label class="block text-xs font-black uppercase tracking-[0.2em] text-gray-400">Write your Review</label>
                                                <textarea name="comment" rows="4" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#2B1810]/10 focus:border-[#2B1810] transition-all duration-300 outline-none placeholder-gray-400 text-sm" placeholder="How was the property inspection? Any details for other seekers?"></textarea>
                                            </div>

                                            <button type="submit" class="inline-flex items-center px-8 py-4 bg-[#A85C2E] text-white font-bold rounded-2xl hover:bg-[#2B1810] transition-all duration-300 shadow-xl shadow-[#A85C2E]/20 active:scale-95">
                                                Post Review
                                                <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @else
                                <div class="text-center p-8 bg-gray-50 rounded-3xl border border-gray-100">
                                    <p class="text-gray-500 text-sm font-medium mb-4 italic">Login to share your thoughts on this property.</p>
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-[#A85C2E] text-white font-bold rounded-xl hover:bg-[#2B1810] transition-all duration-300">
                                        Login to Rate
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>

                    <!-- Map (Placeholder) -->
                    @if($property->latitude && $property->longitude)
                    <div class="bg-gray-200 rounded-lg shadow-lg h-96 flex items-center justify-center">
                        <span class="text-gray-500 font-semibold">Map: {{ $property->latitude }}, {{ $property->longitude }}</span>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Agent Card -->
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-8 mb-6">
                        <div class="flex items-center mb-6">
                            @if($property->user && $property->user->agent_image)
                                <img class="h-16 w-16 rounded-full object-cover mr-4" src="{{ $property->user->agent_image_url }}" alt="{{ $property->user->name }}">
                            @else
                                <div class="h-16 w-16 rounded-full flex items-center justify-center mr-4" style="background-color: #F5F5F5;">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #A85C2E;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $property->user->name ?? 'Agent' }}</h3>
                                @if($property->user && $property->user->agent_verification_status === 'approved')
                                    <p class="text-sm text-green-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Verified Agent
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Inquiry Form -->
                        <form action="{{ route('properties.inquiry', $property->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                                <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="tel" name="phone" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                <textarea name="message" rows="3" required
                                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">I am interested in this property...</textarea>
                            </div>
                            <button type="submit" class="w-full text-white font-bold py-2 px-4 rounded-md transition duration-150" style="background-color: #A85C2E;" onmouseover="this.style.backgroundColor='#2B1810'" onmouseout="this.style.backgroundColor='#A85C2E'">
                                Send Inquiry
                            </button>
                        </form>

                        <livewire:property-tour-booking :property="$property" />
                        
                        <!-- Chat with Agent -->
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            @auth
                                @if(auth()->user()->id !== ($property->user->id ?? null))
                                    <form action="{{ route('chat.start') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="agent_id" value="{{ $property->user->id ?? '' }}">
                                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                                        <div class="mb-3">
                                            <textarea name="message" rows="2" required
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#2B1810] focus:ring-[#2B1810] text-sm"
                                                placeholder="Hi, I'd like to chat about this property..."></textarea>
                                        </div>
                                        <button type="submit" class="w-full flex items-center justify-center text-white font-bold py-2.5 px-4 rounded-md transition-all duration-200 transform hover:scale-[1.02]" style="background-color: #2B1810;" onmouseover="this.style.backgroundColor='#A85C2E'" onmouseout="this.style.backgroundColor='#2B1810'">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            Chat with Agent
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="w-full flex items-center justify-center text-white font-bold py-2.5 px-4 rounded-md transition-all duration-200" style="background-color: #2B1810;">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    Login to Chat
                                </a>
                            @endauth
                        </div>

                        @if($property->user)
                        <div class="mt-6 border-t pt-6 text-center">
                            <a href="{{ route('agents.show', $property->user->id) }}" class="font-medium transition-colors" style="color: #A85C2E;" onmouseover="this.style.color='#2B1810'" onmouseout="this.style.color='#A85C2E'">View Agent Profile</a>
                        </div>
                        @endif
                    </div>

                    <!-- Title Verification CTA -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6 border-2 border-amber-100 relative group">
                        <div class="bg-amber-50 px-6 py-4 border-b border-amber-100 flex items-center justify-between">
                            <h3 class="font-bold text-amber-900 text-sm uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Title Verification
                            </h3>
                            <span class="text-[10px] font-black text-amber-600 bg-amber-100 px-2 py-0.5 rounded shadow-sm">PREMIUM</span>
                        </div>
                        <div class="p-6">
                            <p class="text-xs text-amber-800/80 mb-6 leading-relaxed bg-white p-3 rounded-xl border border-amber-50 shadow-inner italic">
                                "Afraid of title issues? Our legal experts will verify the C of O or Governor's Consent at the registry for you."
                            </p>
                            
                            @auth
                                <form action="{{ route('verification.verify', $property->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-4 bg-amber-600 text-white font-bold rounded-xl hover:bg-amber-700 transition-all duration-300 shadow-lg shadow-amber-200 flex items-center justify-center text-sm group-hover:scale-[1.02]">
                                        Verify Title Now (₦25k)
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="w-full py-4 bg-amber-600 text-white font-bold rounded-xl hover:bg-amber-700 transition-all duration-300 shadow-lg shadow-amber-200 flex items-center justify-center text-sm">
                                    Login to Verify Title
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Save/Share -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="flex flex-col space-y-3">
                            @auth
                                <form action="{{ route('properties.save', $property->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        @if(Auth::user()->savedProperties->contains('property_id', $property->id))
                                            <svg class="h-5 w-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            Saved
                                        @else
                                            <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            Save Property
                                        @endif
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    Login to Save
                                </a>
                            @endauth
                            
                            <div class="grid grid-cols-3 gap-2">
                                <a href="https://wa.me/?text={{ urlencode($property->title . ' - ' . url()->current()) }}" target="_blank" class="flex items-center justify-center p-2 rounded-lg bg-[#25D366] text-white hover:opacity-90 transition-all duration-200 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="flex items-center justify-center p-2 rounded-lg bg-[#1877F2] text-white hover:opacity-90 transition-all duration-200 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854V15.468H7.378V12.073H10.125V9.482c0-2.715 1.614-4.215 4.092-4.215 1.186 0 2.428.212 2.428.212v2.669h-1.367c-1.345 0-1.764.835-1.764 1.691v2.032h3.007l-.481 3.395h-2.526V23.927C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($property->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="flex items-center justify-center p-2 rounded-lg bg-[#1DA1F2] text-white hover:opacity-90 transition-all duration-200 shadow-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Properties -->
            @if($relatedProperties->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-8" style="color: #A85C2E;">Related Properties</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProperties as $related)
                        <x-property-card :property="$related" />
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    <script>
        let viewer = null;
        
        function initPannellum() {
            if (viewer) return;
            @php
                $first360 = $property->images->where('is_360', true)->first();
            @endphp
            @if($first360)
                setTimeout(() => {
                    viewer = pannellum.viewer('pannellum-viewer', {
                        "type": "equirectangular",
                        "panorama": "{{ asset('storage/' . $first360->image_path) }}",
                        "autoLoad": true,
                        "compass": true
                    });
                }, 100);
            @endif
        }

        @if(!$property->virtual_tour_url && $property->images->where('is_360', true)->count() > 0 && !$property->video_url)
            window.addEventListener('load', function() {
                pannellum.viewer('pannellum-viewer-standalone', {
                    "type": "equirectangular",
                    "panorama": "{{ asset('storage/' . $property->images->where('is_360', true)->first()->image_path) }}",
                    "autoLoad": true,
                    "compass": true
                });
            });
        @endif

        function load360(url) {
            if (viewer) {
                viewer.destroy();
            }
            viewer = pannellum.viewer('pannellum-viewer', {
                "type": "equirectangular",
                "panorama": url,
                "autoLoad": true,
                "compass": true
            });
        }
    </script>
</x-app-layout>
