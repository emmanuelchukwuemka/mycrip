<x-app-layout>
    <div class="min-h-screen" style="background: linear-gradient(to bottom right, #F5F5F5, #FFFFFF, #F5F5F5);">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0" style="background-color: #001F3F; opacity: 0.1;"></div>
            <div class="relative max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-white/20 shadow-lg">
                        <div class="w-2 h-2 rounded-full mr-2" style="background-color: #C6A664;"></div>
                        <span class="text-sm font-medium text-gray-700">Comfortable Stays</span>
                    </div>
                    <h1 class="mt-6 text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 tracking-tight">
                        Secured
                        <span class="bg-clip-text text-transparent" style="background: linear-gradient(to right, #001F3F, #C6A664); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Lodges</span>
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl md:text-2xl text-gray-600 leading-relaxed">
                        Find affordable and secure lodge accommodations near major landmarks, institutions, and travel hubs.
                    </p>
                </div>
            </div>
        </div>

        <!-- Properties Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            @if(isset($properties) && $properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($properties as $property)
                        <x-property-card :property="$property" />
                    @endforeach
                </div>
                <div class="mt-12">
                    {{ $properties->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                    <div class="mx-auto w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Lodges Found</h3>
                    <p class="text-gray-600 mb-8">We couldn't find any lodges matching your search at this time.</p>
                    <a href="{{ route('properties.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white transition-all duration-200 shadow-md" style="background-color: #001F3F;">
                        Explore All Properties
                    </a>
                </div>
            @endif

            <!-- Lodge Features Section -->
            <div class="mt-24 bg-white rounded-[40px] shadow-xl border border-gray-100 overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="p-12 lg:p-16">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Built for Security & Peace of Mind</h2>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            Our lodge listings emphasize safety and location, making them ideal for travelers, students, and professionals looking for reliable short to medium-term housing.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach([
                                ['title' => 'Top Tier Security', 'desc' => 'Verified high security levels and surveillance.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 21.438c-3.333-2-6.666-4-10-6V10c3.333 2 6.666 4 10 6s6.666-4 10-6v5.438c-3.333 2-6.666 4-10 6z'],
                                ['title' => 'Great Locations', 'desc' => 'Close to schools, businesses, and transit.', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'],
                                ['title' => 'Verified Agents', 'desc' => 'All lodges are listed by platform-verified agents.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['title' => 'Essential Amenities', 'desc' => 'Focus on water, power, and connectivity.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z']
                            ] as $item)
                                <div class="space-y-2">
                                    <div class="w-12 h-12 bg-[#001F3F]/5 rounded-2xl flex items-center justify-center text-[#C6A664]">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-bold text-gray-900">{{ $item['title'] }}</h4>
                                    <p class="text-sm text-gray-500">{{ $item['desc'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="relative min-h-[400px]">
                        <img src="https://images.unsplash.com/photo-1449156001433-46321eeed874?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Lodge Interior" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-white lg:from-white via-white/50 lg:via-white/20 to-transparent"></div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-24 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Ready to Find Your Lodge?</h2>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('properties.index') }}" class="inline-flex items-center px-8 py-4 bg-[#001F3F] text-white font-bold rounded-2xl hover:bg-[#00152B] transition-all duration-300">
                        View All Listings
                    </a>
                    <a href="{{ route('requests.create') }}" class="inline-flex items-center px-8 py-4 border-2 border-gray-200 text-gray-700 font-bold rounded-2xl hover:bg-gray-50 transition-all duration-300">
                        Post a Request
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
