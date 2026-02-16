<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Properties</h3>
        
        <!-- Price Range -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <input wire:model.live="minPrice" type="number" placeholder="Min" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <input wire:model.live="maxPrice" type="number" placeholder="Max" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>
        </div>

        <!-- Bedrooms -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Bedrooms</label>
            <div class="flex flex-wrap gap-2">
                <button wire:click="$set('bedrooms', 1)" class="px-3 py-1 border rounded-md hover:bg-indigo-50 {{ $bedrooms == 1 ? 'bg-indigo-100 border-indigo-500 text-indigo-700' : 'border-gray-300 text-gray-700' }}">1</button>
                <button wire:click="$set('bedrooms', 2)" class="px-3 py-1 border rounded-md hover:bg-indigo-50 {{ $bedrooms == 2 ? 'bg-indigo-100 border-indigo-500 text-indigo-700' : 'border-gray-300 text-gray-700' }}">2</button>
                <button wire:click="$set('bedrooms', 3)" class="px-3 py-1 border rounded-md hover:bg-indigo-50 {{ $bedrooms == 3 ? 'bg-indigo-100 border-indigo-500 text-indigo-700' : 'border-gray-300 text-gray-700' }}">3</button>
                <button wire:click="$set('bedrooms', 4)" class="px-3 py-1 border rounded-md hover:bg-indigo-50 {{ $bedrooms == 4 ? 'bg-indigo-100 border-indigo-500 text-indigo-700' : 'border-gray-300 text-gray-700' }}">4+</button>
            </div>
        </div>

        <!-- Amenities -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Amenities</label>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input wire:model.live="amenities" value="pool" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-900">Swimming Pool</label>
                </div>
                <div class="flex items-center">
                    <input wire:model.live="amenities" value="gym" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-900">Gym</label>
                </div>
                <div class="flex items-center">
                    <input wire:model.live="amenities" value="security" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-900">24/7 Security</label>
                </div>
                <div class="flex items-center">
                    <input wire:model.live="amenities" value="parking" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-900">Parking Space</label>
                </div>
            </div>
        </div>

        <button wire:click="resetFilters" class="w-full border border-gray-300 rounded-md py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Reset Filters
        </button>
    </div>
</div>
