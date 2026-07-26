<x-app-layout>
    <div class="min-h-screen" style="background: linear-gradient(to bottom right, #F5F5F5, #FFFFFF, #F5F5F5);">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0" style="background-color: #A85C2E; opacity: 0.1;"></div>
            <div class="relative max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-white/20 shadow-lg">
                        <div class="w-2 h-2 rounded-full mr-2" style="background-color: #2B1810;"></div>
                        <span class="text-sm font-medium text-gray-700">Comfortable Stays</span>
                    </div>
                    <h1 class="mt-6 text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 tracking-tight">
                        Premium
                        <span class="bg-clip-text text-transparent" style="background: linear-gradient(to right, #A85C2E, #2B1810); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Lodge</span>
                        Listings
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl md:text-2xl text-gray-600 leading-relaxed">
                        Find affordable and comfortable lodges perfect for short stays, business trips, and budget-friendly travel across Africa.
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
                            src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                            alt="City Lodge"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                                Popular
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">40 Rooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        AC Rooms
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Parking
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 transition-colors duration-200" style="" onmouseover="this.parentElement.parentElement.parentElement.classList.contains('group') && (this.style.color='#A85C2E')" onmouseout="this.style.color=''">
                                    City Center Lodge
                                </h3>
                                <p class="text-sm text-gray-600">Ikeja, Lagos</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Well-maintained 40-room lodge in the heart of Ikeja with air-conditioned rooms, 24/7 power supply, secure parking, and easy access to the airport.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    ₦12,000<span class="text-sm font-normal text-gray-500">/night</span>
                                </div>
                                <a 
                                    href="#" 
                                    class="inline-flex items-center px-4 py-2.5 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105" style="background-color: #A85C2E;" onmouseover="this.style.backgroundColor='#2B1810'" onmouseout="this.style.backgroundColor='#A85C2E'"
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
                            src="https://images.unsplash.com/photo-1445019980597-93fa8acb246c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                            alt="Executive Lodge"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Executive
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">25 Rooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Restaurant
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Security
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-amber-600 transition-colors duration-200">
                                    Royal Executive Lodge
                                </h3>
                                <p class="text-sm text-gray-600">Wuse, Abuja</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Comfortable 25-room executive lodge with on-site restaurant, constant power supply, premium security, and close proximity to business districts.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    ₦18,000<span class="text-sm font-normal text-gray-500">/night</span>
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
                            src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                            alt="Budget Lodge"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Budget Friendly
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">15 Rooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        WiFi
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        Generator
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-amber-600 transition-colors duration-200">
                                    Comfort Inn Lodge
                                </h3>
                                <p class="text-sm text-gray-600">Nsukka, Enugu</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Affordable 15-room lodge near the university campus with free WiFi, standby generator, clean rooms, and friendly staff for students and visitors.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    ₦7,500<span class="text-sm font-normal text-gray-500">/night</span>
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
                    <h2 class="text-3xl font-bold mb-4" style="color: #A85C2E;">Find Your Perfect Lodge</h2>
                    <p class="text-gray-600 mb-8">Explore our complete collection of lodges and find comfortable, affordable accommodation for your stay.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('properties.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105" style="background-color: #A85C2E;" onmouseover="this.style.backgroundColor='#2B1810'" onmouseout="this.style.backgroundColor='#A85C2E'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse All Lodges
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
