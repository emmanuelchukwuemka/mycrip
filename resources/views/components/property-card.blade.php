@props(['property'])

<div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 group h-full flex flex-col">
    <!-- Image Section -->
    <div class="relative overflow-hidden flex-shrink-0">
        @if($property && $property->featured_image_url)
            <img class="h-56 w-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $property->featured_image_url }}" alt="{{ $property->title }}">
        @else
            <img class="h-56 w-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Property Image">
        @endif
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        
        <!-- Category Badge -->
        <div class="absolute top-4 left-4">
            <span class="text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg" style="background-color: #001F3F;">
                {{ $property->category_display_name }}
            </span>
        </div>
        
        <!-- Action Buttons -->
        <div class="absolute top-4 right-4 flex space-x-2">
            <!-- Save Button -->
            @auth
                <form action="{{ route('properties.save', $property->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-white/90 text-gray-600 p-2 rounded-full hover:bg-white hover:text-red-500 transition-all duration-300 shadow-lg transform hover:scale-110" title="Save property">
                        <svg class="h-5 w-5" fill="{{ Auth::user()->savedProperties->contains('property_id', $property->id) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-white/90 text-gray-600 p-2 rounded-full hover:bg-white hover:text-red-500 transition-all duration-300 shadow-lg transform hover:scale-110" title="Save property (Login required)">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </a>
            @endauth
            
            <!-- Share Button -->
            <button onclick="navigator.clipboard.writeText('{{ route('properties.show', $property->id) }}')" class="bg-white/90 text-gray-600 p-2 rounded-full hover:bg-white transition-all duration-300 shadow-lg transform hover:scale-110" title="Share property" style="" onmouseover="this.style.color='#001F3F'" onmouseout="this.style.color=''">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Content Section -->
    <div class="p-5 flex flex-col flex-grow">
        <div class="flex justify-between items-start mb-3">
            <div class="flex-grow">
                <h3 class="text-lg font-bold text-gray-900 transition-colors duration-300 line-clamp-1" style="" onmouseover="this.parentElement.parentElement.parentElement.parentElement.classList.contains('group') && (this.style.color='#001F3F')" onmouseout="this.style.color=''">
                    {{ $property->title }}
                </h3>
                <p class="text-gray-600 text-sm flex items-center mt-1">
                    <svg class="h-4 w-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="truncate">{{ $property->city }}, {{ $property->state }}</span>
                </p>
            </div>
            <div class="text-right ml-2 flex-shrink-0">
                <p class="text-xl font-bold" style="color: #001F3F;">{{ $property->formatted_price }}</p>
            </div>
        </div>
        
        <!-- Features -->
        <div class="grid grid-cols-3 gap-2 mb-4 text-xs text-gray-600">
            @if($property->bedrooms)
            <div class="flex items-center">
                <svg class="h-4 w-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>{{ $property->bedrooms }} {{ Str::plural('Bed', $property->bedrooms) }}</span>
            </div>
            @endif
            @if($property->bathrooms)
            <div class="flex items-center">
                <svg class="h-4 w-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                </svg>
                <span>{{ $property->bathrooms }} {{ Str::plural('Bath', $property->bathrooms) }}</span>
            </div>
            @endif
            @if($property->size)
            <div class="flex items-center">
                <svg class="h-4 w-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                </svg>
                <span>{{ $property->size }}</span>
            </div>
            @endif
        </div>

        <!-- Agent & View Button -->
        <div class="border-t pt-3 mt-auto flex justify-between items-center">
            <div class="flex items-center">
                @if($property->user && $property->user->agent_image)
                    <img class="h-8 w-8 rounded-full object-cover border-2 border-indigo-200 flex-shrink-0" src="{{ $property->user->agent_image_url }}" alt="{{ $property->user->name }}">
                @else
                    <div class="h-8 w-8 rounded-full flex items-center justify-center border-2 flex-shrink-0" style="background-color: #F5F5F5; border-color: #C6A664;">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #001F3F;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                @endif
                <div class="ml-2">
                    <p class="text-xs font-semibold text-gray-900 truncate max-w-[100px]">{{ $property->user->name ?? 'Agent' }}</p>
                    @if($property->user && $property->user->agent_verification_status === 'approved')
                        <p class="text-xs text-green-600 flex items-center">
                            <svg class="h-3 w-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Verified
                        </p>
                    @endif
                </div>
            </div>
            <a href="{{ route('properties.show', $property->id) }}" class="text-white px-4 py-2 rounded-lg text-sm font-semibold transform hover:scale-105 transition-all duration-300 shadow-md" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
                View Details
            </a>
        </div>
    </div>
</div>
