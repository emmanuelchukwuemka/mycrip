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
                        <span class="bg-clip-text text-transparent" style="background: linear-gradient(to right, #001F3F, #C6A664); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Hotels</span>
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl md:text-2xl text-gray-600 leading-relaxed">
                        Discover world-class hotels and resorts offering unparalleled comfort, premium amenities, and exceptional service.
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
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Hotels Found</h3>
                    <p class="text-gray-600 mb-8">We couldn't find any hotels matching your criteria at the moment.</p>
                    <a href="{{ route('properties.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white transition-all duration-200 shadow-md" style="background-color: #001F3F;">
                        Explore All Properties
                    </a>
                </div>
            @endif

            <!-- Hospitality Features Section -->
            <div class="mt-24 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Advanced Hospitality Features</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Our platform now supports specialized fields for hotel listings, ensuring you get all the information you need before booking or inquiring.
                    </p>
                    <ul class="space-y-4">
                        @foreach([
                            'Detailed room and suite counts',
                            'Pool, Gym, and Spa facility tracking',
                            'Conference and event space availability',
                            'Restaurant and dining options',
                            'Premium security levels including 24/7 surveillance'
                        ] as $feature)
                            <li class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-[#C6A664]/20 flex items-center justify-center mt-1">
                                    <svg class="w-4 h-4 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="ml-4 text-gray-700 font-medium">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Luxury Hotel" class="rounded-3xl shadow-2xl relative z-10">
                    <div class="absolute -bottom-6 -right-6 w-64 h-64 bg-[#C6A664]/10 rounded-full blur-3xl"></div>
                    <div class="absolute -top-6 -left-6 w-64 h-64 bg-[#001F3F]/10 rounded-full blur-3xl"></div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-24 text-center">
                <div class="bg-[#001F3F] rounded-[40px] shadow-2xl p-12 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                    <div class="relative z-10">
                        <h2 class="text-4xl font-bold text-white mb-6">List Your Hotel on MyCrip</h2>
                        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                            Join the premier real estate network in Africa and showcase your hospitality property to thousands of high-intent users.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-6 justify-center">
                            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-[#C6A664] text-white font-bold rounded-2xl hover:bg-[#B69654] transition-all duration-300 transform hover:scale-105 shadow-xl">
                                Become a Verified Agent
                            </a>
                            <a href="{{ route('faq') }}" class="inline-flex items-center px-8 py-4 bg-white/10 text-white font-bold rounded-2xl hover:bg-white/20 transition-all duration-300 backdrop-blur-sm border border-white/10">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
