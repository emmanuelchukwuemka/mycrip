<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Properties" class="w-full h-96 object-cover">
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Discover Your Dream Property
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto">
                    Browse through thousands of premium listings across Africa. Find your perfect home, investment, or commercial space.
                </p>
            </div>
        </div>
    </div>

    <!-- Properties Grid -->
    <div class="bg-gradient-to-br from-gray-50 via-white to-gray-100 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <div class="w-full lg:w-1/4">
                    <livewire:property-filters />
                </div>

                <!-- Main Content -->
                <div class="w-full lg:w-3/4">
                    <!-- Header with Stats -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Properties for Sale & Rent</h2>
                                <p class="text-gray-600 mt-1">Discover 1,234+ premium listings</p>
                            </div>
                            
                            <!-- Sort Options -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                <select class="bg-white border border-gray-200 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                                    <option>Sort by: Newest</option>
                                    <option>Price: Low to High</option>
                                    <option>Price: High to Low</option>
                                    <option>Bedrooms: High to Low</option>
                                    <option>Size: Large to Small</option>
                                </select>
                                
                                <div class="flex bg-gray-100 rounded-lg p-1">
                                    <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-white rounded-md shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                                        </svg>
                                        Grid
                                    </button>
                                    <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                        List
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                        <!-- Property Cards -->
                        <x-property-card />
                        <x-property-card />
                        <x-property-card />
                        <x-property-card />
                        <x-property-card />
                        <x-property-card />
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        <nav class="relative z-0 inline-flex rounded-xl shadow-lg bg-white border border-gray-200 overflow-hidden">
                            <a href="#" class="relative inline-flex items-center px-4 py-3 border-r border-gray-200 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </a>
                            <a href="#" class="relative inline-flex items-center px-4 py-3 border-r border-gray-200 bg-indigo-50 text-sm font-medium text-indigo-700 hover:bg-indigo-100 transition-all duration-300">1</a>
                            <a href="#" class="relative inline-flex items-center px-4 py-3 border-r border-gray-200 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-all duration-300">2</a>
                            <a href="#" class="relative inline-flex items-center px-4 py-3 border-r border-gray-200 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-all duration-300">3</a>
                            <a href="#" class="relative inline-flex items-center px-4 py-3 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-all duration-300">
                                Next
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
