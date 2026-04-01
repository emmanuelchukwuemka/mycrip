<x-app-layout>
    <div class="min-h-screen" style="background: linear-gradient(to bottom right, #F5F5F5, #FFFFFF, #F5F5F5);">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0" style="background-color: #001F3F; opacity: 0.1;"></div>
            <div class="relative max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-white/20 shadow-lg">
                        <div class="w-2 h-2 rounded-full mr-2" style="background-color: #C6A664;"></div>
                        <span class="text-sm font-medium text-gray-700">Premium Hospitality</span>
                    </div>
                    <h1 class="mt-6 text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 tracking-tight">
                        Luxury
                        <span class="bg-clip-text text-transparent" style="background: linear-gradient(to right, #001F3F, #C6A664); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Hotel</span>
                        Listings
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl md:text-2xl text-gray-600 leading-relaxed">
                        Discover world-class hotels and resorts offering unparalleled comfort, premium amenities, and exceptional service across Africa.
                    </p>
                </div>
            </div>
        </div>

        <!-- Featured Properties Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Property 1 -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100">
                    <div class="relative overflow-hidden rounded-t-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent z-10"></div>
                        <img 
                            class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" 
                            src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                            alt="Luxury Resort Hotel"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                5-Star
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">120 Rooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Pool
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Gym
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 transition-colors duration-200" style="" onmouseover="this.parentElement.parentElement.parentElement.classList.contains('group') && (this.style.color='#001F3F')" onmouseout="this.style.color=''">
                                    Grand Oceanic Resort & Spa
                                </h3>
                                <p class="text-sm text-gray-600">Victoria Island, Lagos</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Luxury 5-star beachfront resort featuring 120 premium rooms, infinity pool, full-service spa, conference center, and fine dining restaurant.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    ₦85,000<span class="text-sm font-normal text-gray-500">/night</span>
                                </div>
                                <a 
                                    href="#" 
                                    class="inline-flex items-center px-4 py-2.5 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property 2 -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100">
                    <div class="relative overflow-hidden rounded-t-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent z-10"></div>
                        <img 
                            class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" 
                            src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                            alt="Business Hotel"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Business
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">80 Rooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Conference
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Restaurant
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-amber-600 transition-colors duration-200">
                                    Metro Business Suites
                                </h3>
                                <p class="text-sm text-gray-600">Garki, Abuja</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Modern 4-star business hotel with 80 executive suites, high-speed WiFi, boardroom facilities, on-site dining, and premium security throughout.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    ₦45,000<span class="text-sm font-normal text-gray-500">/night</span>
                                </div>
                                <a 
                                    href="#" 
                                    class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-amber-600 to-green-600 text-white font-medium rounded-lg hover:from-amber-700 hover:to-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property 3 -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100">
                    <div class="relative overflow-hidden rounded-t-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent z-10"></div>
                        <img 
                            class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" 
                            src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                            alt="Boutique Hotel"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Boutique
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">30 Rooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Pool
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Bar & Lounge
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-amber-600 transition-colors duration-200">
                                    Heritage Boutique Hotel
                                </h3>
                                <p class="text-sm text-gray-600">GRA, Port Harcourt</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Charming 30-room boutique hotel with rooftop pool, artisan bar & lounge, gym facilities, and 24/7 elite security in a serene GRA neighborhood.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    ₦35,000<span class="text-sm font-normal text-gray-500">/night</span>
                                </div>
                                <a 
                                    href="#" 
                                    class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-amber-600 to-green-600 text-white font-medium rounded-lg hover:from-amber-700 hover:to-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                    <h2 class="text-3xl font-bold mb-4" style="color: #001F3F;">Find Your Perfect Hotel</h2>
                    <p class="text-gray-600 mb-8">Explore our complete collection of hotels and resorts and find the perfect accommodation for your stay.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('properties.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse All Hotels
                        </a>
                        <a href="{{ route('agents.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Contact an Agent
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
