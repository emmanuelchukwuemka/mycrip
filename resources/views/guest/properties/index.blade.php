<x-app-layout>
    <!-- Hero Section -->
    <div class="relative overflow-hidden" style="background-color: #001F3F;">
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
    <div class="bg-gradient-to-br from-gray-50 via-white to-gray-100 min-h-screen py-16" x-data="{ 
        view: 'grid',
        map: null,
        properties: @js($mapProperties),
        initMap() {
            if (this.map) return;
            this.$nextTick(() => {
                this.map = L.map('map').setView([9.0820, 8.6753], 6); // Default center (Nigeria)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(this.map);

                const markers = [];
                this.properties.forEach(prop => {
                    if (prop.lat && prop.lng) {
                        const marker = L.marker([prop.lat, prop.lng])
                            .addTo(this.map)
                            .bindPopup(`
                                <div class='w-48 overflow-hidden rounded-lg'>
                                    <img src='${prop.image}' class='w-full h-24 object-cover' />
                                    <div class='p-2'>
                                        <h4 class='font-bold text-sm'>${prop.title}</h4>
                                        <p class='text-indigo-600 font-semibold'>${prop.price}</p>
                                        <a href='${prop.link}' class='text-xs text-indigo-500 hover:underline mt-1 block'>View Details</a>
                                    </div>
                                </div>
                            `);
                        markers.push([prop.lat, prop.lng]);
                    }
                });

                if (markers.length > 0) {
                    this.map.fitBounds(markers);
                }
            });
        }
    }">
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
                                <h2 class="text-2xl font-bold" style="color: #001F3F;">Properties for Sale & Rent</h2>
                                <p class="mt-1" style="color: #1A1A1A;">Discover {{ $properties->total() }} premium listings</p>
                            </div>
                            
                            <!-- Sort & View Options -->
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <form action="{{ route('properties.index') }}" method="GET" class="flex gap-3">
                                    @foreach(request()->except('sort') as $key => $value)
                                        @if(is_array($value))
                                            @foreach($value as $v)
                                                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endif
                                    @endforeach
                                    
                                    <select name="sort" onchange="this.form.submit()" class="bg-white border rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 transition-all duration-300" style="border-color: #C6A664;">
                                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Sort by: Newest</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    </select>
                                </form>

                                <div class="flex bg-gray-100 rounded-lg p-1">
                                    <button @click="view = 'grid'" :class="view === 'grid' ? 'bg-white shadow-sm' : 'text-gray-500'" class="flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-md transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                                        Grid
                                    </button>
                                    <button @click="view = 'map'; initMap()" :class="view === 'map' ? 'bg-white shadow-sm' : 'text-gray-500'" class="flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-md transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Map
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Grid View -->
                    <div x-show="view === 'grid'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                            @forelse($properties as $property)
                                <x-property-card :property="$property" />
                            @empty
                                <div class="col-span-full text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    <h3 class="mt-4 text-lg font-medium text-gray-900">No properties found</h3>
                                    <a href="{{ route('properties.index') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-800">Clear filters →</a>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="mt-12 flex justify-center">
                            {{ $properties->links() }}
                        </div>
                    </div>

                    <!-- Map View -->
                    <div x-show="view === 'map'" id="map-container" class="rounded-2xl shadow-xl overflow-hidden border border-gray-200" style="height: 700px;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div id="map" class="h-full w-full z-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
