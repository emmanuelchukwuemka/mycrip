<x-app-layout>
    <!-- Hero Section with Animation -->
    <div class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply dark:purple-400 dark:mix-blend-soft-light filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 right-0 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply dark:yellow-400 dark:mix-blend-soft-light filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-0 left-1/2 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply dark:pink-400 dark:mix-blend-soft-light filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
            <div class="text-center">
                <!-- Animated Title -->
                <div class="animate-fade-in-up">
                    <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl lg:text-7xl">
                        <span class="block">Find Your Perfect</span>
                        <span class="block bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 bg-clip-text text-transparent">
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
                    <a href="{{ route('properties.index') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Start Your Search
                    </a>
                </div>
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-24 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="#fff"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="#fff"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86-7 170.73-18.5,257.44-39.1C1292,39.93,1368.36,35,1465,29.72V0Z" fill="#fff"></path>
            </svg>
        </div>
    </div>

    <!-- Featured Properties Section -->
    <div class="bg-gradient-to-br from-gray-50 via-white to-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in-up">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Featured Properties</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-600">
                    Handpicked premium listings just for you.
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Property Cards with Hover Animation -->
                <div class="group animate-fade-in-up animation-delay-300">
                    <x-property-card />
                </div>
                <div class="group animate-fade-in-up animation-delay-600">
                    <x-property-card />
                </div>
                <div class="group animate-fade-in-up animation-delay-900">
                    <x-property-card />
                </div>
                <div class="group animate-fade-in-up animation-delay-1200">
                    <x-property-card />
                </div>
                <div class="group animate-fade-in-up animation-delay-1500">
                    <x-property-card />
                </div>
                <div class="group animate-fade-in-up animation-delay-1800">
                    <x-property-card />
                </div>
            </div>

            <div class="mt-16 text-center animate-fade-in-up animation-delay-2100">
                <a href="{{ route('properties.index') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    View All Properties
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in-up">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Browse by Category</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-600">
                    Find the perfect property type for your needs.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Category Cards with Enhanced Animation -->
                <div class="animate-fade-in-up animation-delay-300">
                    <a href="{{ route('properties.apartments') }}" class="group relative rounded-2xl overflow-hidden h-64 block shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
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
                    <a href="{{ route('properties.houses') }}" class="group relative rounded-2xl overflow-hidden h-64 block shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
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
                    <a href="{{ route('properties.land') }}" class="group relative rounded-2xl overflow-hidden h-64 block shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
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
                    <a href="{{ route('properties.commercial') }}" class="group relative rounded-2xl overflow-hidden h-64 block shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
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
    <div class="bg-gradient-to-br from-indigo-700 via-purple-700 to-pink-700 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Why Choose MyCrib Africa?</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-indigo-200">
                    We provide the best real estate experience in Africa.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="animate-fade-in-up animation-delay-300">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 text-white mb-6 shadow-lg">
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
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-xl bg-gradient-to-r from-yellow-500 to-orange-500 text-white mb-6 shadow-lg">
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
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-xl bg-gradient-to-r from-green-500 to-blue-500 text-white mb-6 shadow-lg">
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

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-gray-900 to-black py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-fade-in-up">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Ready to Find Your Dream Home?</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-white">
                    Join thousands of satisfied customers who found their perfect property with MyCrib Africa.
                </p>
                
                <div class="mt-12 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex sm:justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Get Started
                    </a>
                    <a href="{{ route('agents.index') }}" class="inline-flex items-center px-8 py-4 border-2 border-white text-base font-semibold rounded-xl text-white hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-300 shadow-xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Contact Agent
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

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
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
</x-app-layout>
