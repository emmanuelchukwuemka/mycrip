<div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto -mt-24 relative z-10">
    <form wire:submit.prevent="search">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="col-span-1 md:col-span-2">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input wire:model.live="location" type="text" id="location" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="e.g. Lagos, Abuja">
            </div>
            
            <div class="col-span-1">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Property Type</label>
                <select wire:model.live="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Any</option>
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                    <option value="land">Land</option>
                    <option value="office">Office</option>
                </select>
            </div>

            <div class="col-span-1 flex items-end">
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    Search
                </button>
            </div>
        </div>
        
        <div class="mt-4 flex flex-wrap gap-4 text-sm text-gray-500">
            <span class="font-medium">Recent searches:</span>
            <button type="button" class="hover:text-indigo-600">Lekki Phase 1</button>
            <button type="button" class="hover:text-indigo-600">2 Bedroom Flat</button>
            <button type="button" class="hover:text-indigo-600">Abuja Central</button>
        </div>
    </form>
</div>
