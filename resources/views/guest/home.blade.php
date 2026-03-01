<x-app-layout>
    <!-- Hero Section with Professional Slider -->
    <div class="relative overflow-hidden" style="background-color: #001F3F;">
        <!-- Hero Slider -->
        <div class="relative h-screen">
            <!-- Slide 1 -->
            <div class="absolute inset-0" style="background-color: #001F3F;">
                <div class="absolute inset-0 bg-black opacity-40"></div>
                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Luxury Apartment" class="w-full h-full object-cover">
            </div>
            
            <!-- Slide 2 -->
            <div class="absolute inset-0 opacity-0 transition-opacity duration-1000" style="background-color: #001F3F;">
                <div class="absolute inset-0 bg-black opacity-40"></div>
                <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Modern House" class="w-full h-full object-cover">
            </div>
            
            <!-- Slide 3 -->
            <div class="absolute inset-0 opacity-0 transition-opacity duration-1000" style="background-color: #001F3F;">
                <div class="absolute inset-0 bg-black opacity-40"></div>
                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Commercial Property" class="w-full h-full object-cover">
            </div>

            <!-- Animated Background Elements -->
            <div class="absolute inset-0">
                <div class="absolute top-0 left-0 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply dark:purple-400 dark:mix-blend-soft-light filter blur-xl opacity-20 animate-blob"></div>
                <div class="absolute top-0 right-0 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply dark:yellow-400 dark:mix-blend-soft-light filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
                <div class="absolute bottom-0 left-1/2 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply dark:pink-400 dark:mix-blend-soft-light filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
            </div>

            <!-- Hero Content -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                <div class="text-center w-full">
                    <!-- Animated Title -->
                    <div class="animate-fade-in-up">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl lg:text-7xl">
                            <span class="block">Find Your Perfect</span>
                            <span class="block" style="color: #C6A664;">
                                Home in Africa
                            </span>
                        </h1>
                        <p class="mt-6 max-w-2xl mx-auto text-lg md:text-xl text-gray-300 animate-fade-in-up animation-delay-300">
                            Discover the best properties for sale and rent across the continent. Verified listings, trusted agents, seamless experience.
                        </p>
                    </div>

                    <!-- Animated Search Section -->
                    <div class="mt-12 animate-fade-in-up animation-delay-600">
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl border border-white/20">
                            <livewire:property-search />
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="mt-10 animate-fade-in-up animation-delay-900">
                        <a href="{{ route('properties.index') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-semibold rounded-xl text-white transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl" style="background-color: #C6A664;" onmouseover="this.style.backgroundColor='#B89654'" onmouseout="this.style.backgroundColor='#C6A664'">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Start Your Search
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slider Navigation -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-4">
                <button class="slider-nav-btn active w-3 h-3 bg-white rounded-full opacity-50 hover:opacity-100 transition-all duration-300" data-slide="0"></button>
                <button class="slider-nav-btn w-3 h-3 bg-white rounded-full opacity-50 hover:opacity-100 transition-all duration-300" data-slide="1"></button>
                <button class="slider-nav-btn w-3 h-3 bg-white rounded-full opacity-50 hover:opacity-100 transition-all duration-300" data-slide="2"></button>
            </div>
        </div>
    </div>

            <!-- Featured Properties Section -->
    <div class="bg-gradient-to-br from-gray-50 via-white to-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in-up">
                <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl" style="color: #001F3F;">Featured Properties</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl" style="color: #1A1A1A;">
                    Handpicked premium listings just for you.
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($featuredProperties as $index => $property)
                <div class="group animate-fade-in-up animation-delay-{{ ($index + 1) * 300 }}">
                    <x-property-card :property="$property" />
                </div>
                @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-500 text-lg">No featured properties at the moment.</p>
                    <a href="{{ route('properties.index') }}" class="mt-4 inline-block" style="color: #001F3F;" onmouseover="this.style.color='#C6A664'" onmouseout="this.style.color='#001F3F'">Browse all properties →</a>
                </div>
                @endforelse
            </div>

            <div class="mt-16 text-center animate-fade-in-up animation-delay-2100">
                <a href="{{ route('properties.index') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-semibold rounded-xl text-white transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
                    View All Properties
                </a>
            </div>
        </div>
    </div>
    
    <!-- Recently Added Properties Section -->
    @if($recentProperties->count() > 0)
    <div class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in-up">
                <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl" style="color: #001F3F;">Recently Added</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl" style="color: #1A1A1A;">
                    Check out the latest property listings.
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                @foreach($recentProperties as $property)
                <div class="group">
                    <x-property-card :property="$property" />
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    
    <!-- Rental Properties Section -->
    @if($rentalProperties->count() > 0)
    <div class="bg-gradient-to-br from-gray-50 via-white to-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center animate-fade-in-up">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl" style="color: #001F3F;">Rentals</h2>
                    <p class="mt-4 text-xl" style="color: #1A1A1A;">
                        Find properties to rent.
                    </p>
                </div>
                <a href="{{ route('properties.index', ['category' => 'house_rental']) }}" class="hidden md:inline-flex items-center px-6 py-3 border border-transparent text-base font-semibold rounded-xl text-white transition-all duration-300" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
                    View All
                </a>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                @foreach($rentalProperties as $property)
                <div class="group">
                    <x-property-card :property="$property" />
                </div>
                @endforeach
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('properties.index', ['category' => 'house_rental']) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-semibold rounded-xl text-white" style="background-color: #001F3F;">
                    View All Rentals
                </a>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Purchase Properties Section -->
    @if($purchaseProperties->count() > 0)
    <div class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center animate-fade-in-up">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl" style="color: #001F3F;">For Sale</h2>
                    <p class="mt-4 text-xl" style="color: #1A1A1A;">
                        Properties available for purchase.
                    </p>
                </div>
                <a href="{{ route('properties.index', ['category' => 'house_purchase']) }}" class="hidden md:inline-flex items-center px-6 py-3 border border-transparent text-base font-semibold rounded-xl text-white transition-all duration-300" style="background-color: #C6A664;" onmouseover="this.style.backgroundColor='#B89654'" onmouseout="this.style.backgroundColor='#C6A664'">
                    View All
                </a>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                @foreach($purchaseProperties as $property)
                <div class="group">
                    <x-property-card :property="$property" />
                </div>
                @endforeach
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('properties.index', ['category' => 'house_purchase']) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-semibold rounded-xl text-white" style="background-color: #C6A664;">
                    View All Sales
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Categories Section -->
    <div class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in-up">
                <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl" style="color: #001F3F;">Browse by Category</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl" style="color: #1A1A1A;">
                    Find the perfect property type for your needs.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Category Cards with Enhanced Animation -->
                <div class="animate-fade-in-up animation-delay-300">
                    <a href="{{ route('properties.categories.apartments') }}" class="group relative rounded-2xl overflow-hidden h-64 block shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Apartments" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end">
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Apartments</h3>
                                <p class="text-gray-200 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">Urban living spaces</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="animate-fade-in-up animation-delay-600">
                    <a href="{{ route('properties.categories.houses') }}" class="group relative rounded-2xl overflow-hidden h-64 block shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Houses" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end">
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Houses</h3>
                                <p class="text-gray-200 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">Family homes</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="animate-fade-in-up animation-delay-900">
                    <a href="{{ route('properties.categories.land') }}" class="group relative rounded-2xl overflow-hidden h-64 block shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Land" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end">
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Land</h3>
                                <p class="text-gray-200 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">Investment opportunities</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="animate-fade-in-up animation-delay-1200">
                    <a href="{{ route('properties.categories.commercial') }}" class="group relative rounded-2xl overflow-hidden h-64 block shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Commercial" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end">
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Commercial</h3>
                                <p class="text-gray-200 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">Business spaces</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="py-20" style="background-color: #001F3F;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Why Choose MyCrib Africa?</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl" style="color: #FFFFFF; opacity: 0.9;">
                    We provide the best real estate experience in Africa.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="animate-fade-in-up animation-delay-300">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-xl text-white mb-6 shadow-lg" style="background-color: #C6A664;">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Verified Agents</h3>
                        <p class="text-white leading-relaxed">
                            All our agents go through a rigorous verification process to ensure your safety and provide the best service.
                        </p>
                    </div>
                </div>

                <div class="animate-fade-in-up animation-delay-600">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-xl text-white mb-6 shadow-lg" style="background-color: #C6A664;">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Fast Response</h3>
                        <p class="text-white leading-relaxed">
                            Get quick responses from agents and schedule inspections seamlessly with our advanced communication system.
                        </p>
                    </div>
                </div>

                <div class="animate-fade-in-up animation-delay-900">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-xl text-white mb-6 shadow-lg" style="background-color: #C6A664;">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Best Deals</h3>
                        <p class="text-white leading-relaxed">
                            Find properties that match your budget with our advanced search filters and exclusive listings.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Latest Blog Posts Section -->
    @if($recentPosts->count() > 0)
    <div class="bg-gray-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 animate-fade-in-up">
                <div class="max-w-2xl">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight mb-4">Latest from our <span style="color: #C6A664;">Blog</span></h2>
                    <p class="text-lg text-gray-600 leading-relaxed">Expert insights, market trends, and professional advice to help you navigate the African real estate landscape.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-[#001F3F] hover:text-[#C6A664] transition-colors group">
                    Explore All Articles
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($recentPosts as $index => $post)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 group animate-fade-in-up" style="animation-delay: {{ 200 * ($index + 1) }}ms">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-black uppercase tracking-widest text-[#001F3F] shadow-sm">
                                Insights
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                            <span>{{ $post->published_at->format('M d, Y') }}</span>
                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                            <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#C6A664] transition-colors mb-4 line-clamp-2">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-[#C6A664] hover:text-[#00152B] transition-colors">
                            Read Article
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- CTA Section -->
    <div class="py-20" style="background-color: #000000;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-fade-in-up">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Ready to Find Your Dream Home?</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-white">
                    Join thousands of satisfied customers who found their perfect property with MyCrib Africa.
                </p>
                
                <div class="mt-12 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex sm:justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-semibold rounded-xl text-white transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl" style="background-color: #C6A664;" onmouseover="this.style.backgroundColor='#B89654'" onmouseout="this.style.backgroundColor='#C6A664'">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Get Started
                    </a>
                    <a href="{{ route('register', ['role' => 'agent']) }}" class="inline-flex items-center px-8 py-4 border-2 border-[#C6A664] text-base font-semibold rounded-xl text-[#C6A664] hover:bg-[#C6A664] hover:text-white transform hover:scale-105 transition-all duration-300 shadow-xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Register as Agent
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Animations -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .animate-slide-in {
            animation: slideIn 0.8s ease-out forwards;
            opacity: 0;
        }

        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-600 { animation-delay: 0.6s; }
        .animation-delay-900 { animation-delay: 0.9s; }
        .animation-delay-1200 { animation-delay: 1.2s; }
        .animation-delay-1500 { animation-delay: 1.5s; }
        .animation-delay-1800 { animation-delay: 1.8s; }
        .animation-delay-2100 { animation-delay: 2.1s; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>

    <!-- JavaScript for Hero Slider -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.relative > div[class*="bg-gradient-to-br"]:not(:first-child)');
            const navButtons = document.querySelectorAll('.slider-nav-btn');
            let currentSlide = 0;
            let slideInterval;

            function showSlide(index) {
                // Hide all slides
                slides.forEach(slide => {
                    slide.classList.add('opacity-0');
                    slide.classList.remove('opacity-100');
                });
                
                // Remove active class from all nav buttons
                navButtons.forEach(btn => btn.classList.remove('active'));
                
                // Show current slide
                if (slides[index]) {
                    slides[index].classList.remove('opacity-0');
                    slides[index].classList.add('opacity-100');
                }
                
                // Add active class to current nav button
                navButtons[index].classList.add('active');
                currentSlide = index;
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            // Initialize slider
            showSlide(0);
            
            // Start auto-rotation
            slideInterval = setInterval(nextSlide, 5000);

            // Add click events to nav buttons
            navButtons.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    clearInterval(slideInterval);
                    showSlide(index);
                    slideInterval = setInterval(nextSlide, 5000);
                });
            });

            // Pause on hover
            const sliderContainer = document.querySelector('.relative.h-screen');
            sliderContainer.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });
            
            sliderContainer.addEventListener('mouseleave', () => {
                slideInterval = setInterval(nextSlide, 5000);
            });
        });
    </script>
</x-app-layout>
