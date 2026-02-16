<x-app-layout>
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
                                         class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75 transition {{ $index === 0 ? 'ring-2 ring-indigo-500' : '' }}"
                                         onclick="document.getElementById('mainImage').src = this.src">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Details -->
                    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full mb-2">
                                    {{ $property->category_display_name }}
                                </span>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>
                                <p class="text-gray-500 mt-2 flex items-center">
                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $property->address ?? '' }}, {{ $property->city }}, {{ $property->state }}, {{ $property->country }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-indigo-600">{{ $property->formatted_price }}</p>
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
                                <div class="h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-150">
                                Send Inquiry
                            </button>
                        </form>
                        
                        @if($property->user)
                        <div class="mt-6 border-t pt-6 text-center">
                            <a href="{{ route('agents.index') }}?agent={{ $property->user->id }}" class="text-indigo-600 font-medium hover:text-indigo-800">View Agent Profile</a>
                        </div>
                        @endif
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
                            
                            <button onclick="navigator.clipboard.writeText('{{ url()->current() }}')" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                                Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Properties -->
            @if($relatedProperties->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Properties</h2>
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
