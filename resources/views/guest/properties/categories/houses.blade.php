<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-indigo-50">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-green-600/20 to-blue-600/20"></div>
            <div class="relative max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-white/20 shadow-lg">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium text-gray-700">Family Living</span>
                    </div>
                    <h1 class="mt-6 text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 tracking-tight">
                        Dream
                        <span class="bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent">Homes</span>
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl md:text-2xl text-gray-600 leading-relaxed">
                        Discover spacious family homes with beautiful yards, modern amenities, and the perfect setting for creating lasting memories.
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
                            src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                            alt="Family Home"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                                Featured
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">4 Bedrooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Pool
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Garage
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        Yard
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-200">
                                    Suburban Family Home
                                </h3>
                                <p class="text-sm text-gray-600">Greenwood Estates</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Beautiful 4-bedroom family home with spacious living areas, modern kitchen, and large backyard perfect for family gatherings.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    $450,000
                                </div>
                                <a 
                                    href="#" 
                                    class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-blue-600 text-white font-medium rounded-lg hover:from-green-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
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
                            src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                            alt="Modern House"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Luxury
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">5 Bedrooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        Yard
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Garage
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Pool
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-200">
                                    Luxury Villa
                                </h3>
                                <p class="text-sm text-gray-600">Hillside View</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Premium 5-bedroom villa with panoramic views, gourmet kitchen, and resort-style backyard with pool and entertainment area.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    $750,000
                                </div>
                                <a 
                                    href="#" 
                                    class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-blue-600 text-white font-medium rounded-lg hover:from-green-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
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
                            src="https://images.unsplash.com/photo-1517433670267-08bbd4be89d7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                            alt="Cozy House"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                New Listing
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <div class="flex items-center justify-between">
                                <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-sm font-medium text-gray-700">3 Bedrooms</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        Yard
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Garage
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-200">
                                    Cozy Family Home
                                </h3>
                                <p class="text-sm text-gray-600">Maplewood Drive</p>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 leading-relaxed">
                                <p>
                                    Charming 3-bedroom home with updated interiors, large backyard, and walking distance to schools and parks.
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="text-2xl font-bold text-gray-900">
                                    $320,000
                                </div>
                                <a 
                                    href="#" 
                                    class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-blue-600 text-white font-medium rounded-lg hover:from-green-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
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
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Find Your Dream Home</h2>
                    <p class="text-gray-600 mb-8">Explore our complete collection of family homes and find the perfect place to build your future.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('properties.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse All Houses
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