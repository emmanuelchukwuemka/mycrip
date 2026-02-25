<x-app-layout>
    @section('seo')
        <title>{{ $property->title }} | MyCrib Africa</title>
        <meta name="description" content="{{ Str::limit($property->description, 160) }}">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $property->title }} | MyCrib Africa">
        <meta property="og:description" content="{{ Str::limit($property->description, 160) }}">
        <meta property="og:image" content="{{ $property->featured_image_url }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $property->title }} | MyCrib Africa">
        <meta property="twitter:description" content="{{ Str::limit($property->description, 160) }}">
        <meta property="twitter:image" content="{{ $property->featured_image_url }}">
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
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <!-- Main Image -->
                        @if($property->images->count() > 0)
                            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}" class="w-full h-96 object-cover" id="mainImage">
                        @elseif($property->featured_image)
                            <img src="{{ asset('storage/' . $property->featured_image) }}" alt="{{ $property->title }}" class="w-full h-96 object-cover" id="mainImage">
                        @else
                            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="{{ $property->title }}" class="w-full h-96 object-cover" id="mainImage">
                        @endif
                        
                        <!-- Thumbnail Images -->
                        @if($property->images->count() > 1)
                            <div class="p-4 grid grid-cols-4 gap-4">
                                @foreach($property->images as $index => $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75 transition {{ $index === 0 ? 'ring-2' : '' }}" style="{{ $index === 0 ? 'border-color: #C6A664;' : '' }}"
                                         onclick="document.getElementById('mainImage').src = this.src">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Video & Virtual Tour Content -->
                    @if($property->video_url || $property->virtual_tour_url)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                            <div class="border-b" x-data="{ activeMedia: '{{ $property->video_url ? 'video' : 'tour' }}' }">
                                <div class="flex">
                                    @if($property->video_url)
                                        <button @click="activeMedia = 'video'" :class="activeMedia === 'video' ? 'border-b-2 border-[#001F3F] text-[#001F3F]' : 'text-gray-500'" class="px-6 py-4 font-bold text-sm uppercase tracking-wider transition-all duration-200 outline-none">
                                            Video Walkthrough
                                        </button>
                                    @endif
                                    @if($property->virtual_tour_url)
                                        <button @click="activeMedia = 'tour'" :class="activeMedia === 'tour' ? 'border-b-2 border-[#001F3F] text-[#001F3F]' : 'text-gray-500'" class="px-6 py-4 font-bold text-sm uppercase tracking-wider transition-all duration-200 outline-none">
                                            360° Virtual Tour
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
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Details -->
                    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <span class="inline-block text-sm font-semibold px-3 py-1 rounded-full mb-2" style="background-color: #F5F5F5; color: #001F3F;">
                                    {{ $property->category_display_name }}
                                </span>
                                <h1 class="text-3xl font-bold" style="color: #001F3F;">{{ $property->title }}</h1>
                                <p class="text-gray-500 mt-2 flex items-center">
                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $property->address ?? '' }}, {{ $property->city }}, {{ $property->state }}, {{ $property->country }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold" style="color: #001F3F;">{{ $property->formatted_price }}</p>
                                @if($property->price_type !== 'fixed')
                                    <p class="text-gray-500">{{ ucfirst($property->price_type) }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Property Features -->
                        @if($property->bedrooms || $property->bathrooms || $property->size)
                        <div class="grid grid-cols-3 gap-6 mb-8 border-t border-b py-6 text-center">
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
                            @if($property->size)
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">{{ $property->size }}</span>
                                <span class="text-gray-500">Size</span>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Description -->
                        <div class="prose max-w-none text-gray-700 mb-8">
                            <h3 class="text-xl font-semibold mb-4">Description</h3>
                            <p>{{ $property->description }}</p>
                        </div>

                        <!-- Amenities/Features -->
                        <div class="mt-8">
                            <h3 class="text-xl font-semibold mb-4">Amenities</h3>
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
                            </div>
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
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #001F3F;">
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
                            <button type="submit" class="w-full text-white font-bold py-2 px-4 rounded-md transition duration-150" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
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
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#C6A664] focus:ring-[#C6A664] text-sm"
                                                placeholder="Hi, I'd like to chat about this property..."></textarea>
                                        </div>
                                        <button type="submit" class="w-full flex items-center justify-center text-white font-bold py-2.5 px-4 rounded-md transition-all duration-200 transform hover:scale-[1.02]" style="background-color: #C6A664;" onmouseover="this.style.backgroundColor='#B89654'" onmouseout="this.style.backgroundColor='#C6A664'">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            Chat with Agent
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="w-full flex items-center justify-center text-white font-bold py-2.5 px-4 rounded-md transition-all duration-200" style="background-color: #C6A664;">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    Login to Chat
                                </a>
                            @endauth
                        </div>

                        @if($property->user)
                        <div class="mt-6 border-t pt-6 text-center">
                            <a href="{{ route('agents.show', $property->user->id) }}" class="font-medium transition-colors" style="color: #001F3F;" onmouseover="this.style.color='#C6A664'" onmouseout="this.style.color='#001F3F'">View Agent Profile</a>
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
                <h2 class="text-2xl font-bold mb-8" style="color: #001F3F;">Related Properties</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProperties as $related)
                        <x-property-card :property="$related" />
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
