<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-blue-600/20"></div>
            <div class="relative max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-white/20 shadow-lg">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium text-gray-700">Expert Team</span>
                    </div>
                    <h1 class="mt-6 text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 tracking-tight">
                        Meet Our
                        <span class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">Exceptional</span>
                        Agents
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl md:text-2xl text-gray-600 leading-relaxed">
                        Dedicated professionals with years of experience, committed to finding your perfect property match with personalized service and market expertise.
                    </p>
                </div>
            </div>
        </div>

        <!-- Agent Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($agents as $agent)
                    <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100">
                        <!-- Agent Image with Overlay -->
                        <div class="relative overflow-hidden rounded-t-2xl">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent z-10"></div>
                            <img 
                                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" 
                                src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80" 
                                alt="{{ $agent->name }}"
                            >
                            <div class="absolute bottom-4 left-4 right-4 z-20">
                                <div class="flex items-center justify-between">
                                    <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                        <span class="text-sm font-medium text-gray-700">Verified Agent</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Agent Details -->
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">
                                        {{ $agent->name }}
                                    </h3>
                                    <p class="text-sm text-indigo-600 font-medium uppercase tracking-wide">Real Estate Professional</p>
                                </div>
                                
                                <div class="prose prose-sm text-gray-600 leading-relaxed">
                                    <p>
                                        {{ $agent->name }} brings years of market expertise and personalized service to every client relationship, ensuring exceptional results in every transaction.
                                    </p>
                                </div>

                                <!-- Contact & Social -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex space-x-3">
                                        <a href="#" class="p-2 text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                                            <span class="sr-only">Twitter</span>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                            </svg>
                                        </a>
                                        <a href="#" class="p-2 text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                                            <span class="sr-only">LinkedIn</span>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z" clip-rule="evenodd" />
                                                <circle cx="4" cy="4" r="2" />
                                            </svg>
                                        </a>
                                    </div>
                                    
                                    <a 
                                        href="mailto:{{ $agent->email }}" 
                                        class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                    >
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.82 0L21 8M4 12h16"></path>
                                        </svg>
                                        Contact
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100">
                                <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900">No agents available</h3>
                            <p class="mt-2 text-gray-600">Our team of verified agents will be available soon. Please check back later or contact us for assistance.</p>
                            <div class="mt-6">
                                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition-colors duration-200">
                                    Return Home
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            
            @if($agents->hasPages())
                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                        {{ $agents->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
