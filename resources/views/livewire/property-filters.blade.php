<div class="bg-gradient-to-br from-white via-indigo-50 to-purple-50 rounded-2xl shadow-xl border border-white/20 backdrop-blur-sm sticky top-24">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Advanced Filters
            </h3>
            <button wire:click="resetFilters" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-300">
                Clear All
            </button>
        </div>
        
        <!-- Location Search -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <input wire:model.live="location" type="text" placeholder="Search by city, neighborhood..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition-all duration-300">
            </div>
        </div>

        <!-- Price Range -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-3">Price Range (₦)</label>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <input wire:model.live="minPrice" type="number" placeholder="Min Price" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition-all duration-300">
                </div>
                <div>
                    <input wire:model.live="maxPrice" type="number" placeholder="Max Price" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition-all duration-300">
                </div>
            </div>
        </div>

        <!-- Property Type -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-3">Property Type</label>
            <div class="grid grid-cols-2 gap-3">
                <button wire:click="$set('type', 'apartment')" class="p-3 text-left rounded-xl border-2 transition-all duration-300 hover:shadow-md {{ $type === 'apartment' ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Apartment</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                </button>
                <button wire:click="$set('type', 'house')" class="p-3 text-left rounded-xl border-2 transition-all duration-300 hover:shadow-md {{ $type === 'house' ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="font-medium">House</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                </button>
                <button wire:click="$set('type', 'land')" class="p-3 text-left rounded-xl border-2 transition-all duration-300 hover:shadow-md {{ $type === 'land' ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Land</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </button>
                <button wire:click="$set('type', 'commercial')" class="p-3 text-left rounded-xl border-2 transition-all duration-300 hover:shadow-md {{ $type === 'commercial' ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Commercial</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </button>
            </div>
        </div>

        <!-- Bedrooms -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-3">Bedrooms</label>
            <div class="flex flex-wrap gap-2">
                <button wire:click="$set('bedrooms', 1)" class="px-4 py-2 rounded-xl border-2 font-medium transition-all duration-300 hover:shadow-md {{ $bedrooms == 1 ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-300' }}">1</button>
                <button wire:click="$set('bedrooms', 2)" class="px-4 py-2 rounded-xl border-2 font-medium transition-all duration-300 hover:shadow-md {{ $bedrooms == 2 ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-300' }}">2</button>
                <button wire:click="$set('bedrooms', 3)" class="px-4 py-2 rounded-xl border-2 font-medium transition-all duration-300 hover:shadow-md {{ $bedrooms == 3 ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-300' }}">3</button>
                <button wire:click="$set('bedrooms', 4)" class="px-4 py-2 rounded-xl border-2 font-medium transition-all duration-300 hover:shadow-md {{ $bedrooms == 4 ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-300' }}">4+</button>
            </div>
        </div>

        <!-- Amenities -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-3">Amenities</label>
            <div class="space-y-3">
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="pool" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4.5 4.5 0 00-4.496 4.032H3.75a.75.75 0 00-.75.75v4.5a.75.75 0 00.75.75h3.754a4.5 4.5 0 008.992 0H20.25a.75.75 0 00.75-.75v-4.5a.75.75 0 00-.75-.75h-3.754a4.5 4.5 0 00-.004-8.064z"/>
                        </svg>
                        Swimming Pool
                    </label>
                </div>
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="gym" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                        Gym
                    </label>
                </div>
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="security" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        24/7 Security
                    </label>
                </div>
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="parking" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Parking Space
                    </label>
                </div>
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="garden" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Garden
                    </label>
                </div>
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="wifi" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                        </svg>
                        High-Speed WiFi
                    </label>
                </div>
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="serviced" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Serviced
                    </label>
                </div>
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="power_supply" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Power Supply
                    </label>
                </div>
                <div class="flex items-center space-x-3">
                    <input wire:model.live="amenities" value="water_supply" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300">
                    <label class="flex items-center text-sm text-gray-900 cursor-pointer hover:text-indigo-600 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-2m-2 0H6m-2 0H2m4 0h12"/>
                        </svg>
                        Water Supply
                    </label>
                </div>
            </div>
        </div>

        <!-- Apply Filters -->
        <div class="space-y-4">
            <button wire:click="applyFilters" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Apply Filters
            </button>
            
            <div class="text-center text-sm text-gray-500">
                <span wire:loading wire:target="applyFilters">Applying filters...</span>
            </div>
        </div>
    </div>
</div>
