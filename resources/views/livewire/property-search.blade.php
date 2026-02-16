<div class="bg-gradient-to-br from-white via-indigo-50 to-purple-50 p-8 rounded-2xl shadow-xl max-w-6xl mx-auto -mt-24 relative z-10 border border-white/20 backdrop-blur-sm">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Find Your Dream Property</h2>
        <p class="text-gray-600">Search thousands of listings across Africa</p>
    </div>
    
    <form wire:submit.prevent="search">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <input wire:model.live="location" type="text" id="location" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition-all duration-300" placeholder="e.g. Lagos, Abuja, Accra">
                </div>
            </div>
            
            <div class="md:col-span-1">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                <select wire:model.live="type" id="type" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition-all duration-300">
                    <option value="">All Types</option>
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                    <option value="land">Land</option>
                    <option value="commercial">Commercial</option>
                </select>
            </div>

            <div class="md:col-span-1">
                <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">Budget Range</label>
                <select wire:model.live="budget" id="budget" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition-all duration-300">
                    <option value="">Any Price</option>
                    <option value="under-500k">Under ₦500K</option>
                    <option value="500k-1m">₦500K - ₦1M</option>
                    <option value="1m-5m">₦1M - ₦5M</option>
                    <option value="5m-10m">₦5M - ₦10M</option>
                    <option value="over-10m">Over ₦10M</option>
                </select>
            </div>

            <div class="md:col-span-1 flex items-end">
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Search Properties
                </button>
            </div>
        </div>
        
        <div class="mt-6 flex flex-wrap gap-3">
            <span class="font-medium text-gray-700 text-sm">Popular searches:</span>
            <button type="button" wire:click="$set('location', 'Lekki Phase 1')" class="px-4 py-2 bg-white text-indigo-600 rounded-full text-sm font-medium hover:bg-indigo-50 hover:text-indigo-700 transition-all duration-300 shadow-sm border border-gray-200 transform hover:scale-105">
                Lekki Phase 1
            </button>
            <button type="button" wire:click="$set('location', 'Victoria Island')" class="px-4 py-2 bg-white text-indigo-600 rounded-full text-sm font-medium hover:bg-indigo-50 hover:text-indigo-700 transition-all duration-300 shadow-sm border border-gray-200 transform hover:scale-105">
                Victoria Island
            </button>
            <button type="button" wire:click="$set('location', 'Abuja Central')" class="px-4 py-2 bg-white text-indigo-600 rounded-full text-sm font-medium hover:bg-indigo-50 hover:text-indigo-700 transition-all duration-300 shadow-sm border border-gray-200 transform hover:scale-105">
                Abuja Central
            </button>
            <button type="button" wire:click="$set('type', 'apartment')" class="px-4 py-2 bg-white text-purple-600 rounded-full text-sm font-medium hover:bg-purple-50 hover:text-purple-700 transition-all duration-300 shadow-sm border border-gray-200 transform hover:scale-105">
                2 Bedroom Apartment
            </button>
        </div>
    </form>
</div>
