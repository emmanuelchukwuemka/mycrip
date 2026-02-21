<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="bg-white rounded-[2.5rem] p-10 mb-10 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden relative">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#C6A664]/5 rounded-full blur-3xl"></div>
                <div class="relative z-10 text-center md:text-left">
                    <h1 class="text-3xl font-black text-[#001F3F] tracking-tight">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                    <p class="mt-2 text-gray-500 font-medium">Your personal real estate hub is ready. What would you like to do today?</p>
                </div>
                <div class="relative z-10 flex space-x-4">
                    <a href="{{ route('properties.index') }}" class="px-6 py-3 bg-[#001F3F] text-white font-bold rounded-2xl hover:bg-[#00152B] transition-all shadow-xl hover:shadow-[#001F3F]/20 active:scale-95">
                        Browse Properties
                    </a>
                </div>
            </div>

            <!-- Quick Stats/Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Messages Card -->
                <a href="{{ route('chat.index') }}" class="group bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:border-[#C6A664]/20 transition-all duration-500 transform hover:-translate-y-2 relative overflow-hidden">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-[#001F3F] mb-2">My Messages</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">View and reply to messages from property agents.</p>
                    <div class="mt-6 flex items-center text-xs font-black text-blue-600 uppercase tracking-widest">
                        Open Portal
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4 4H3"/>
                        </svg>
                    </div>
                </a>

                <!-- Saved Properties Card -->
                <a href="{{ route('properties.saved') }}" class="group bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:border-[#C6A664]/20 transition-all duration-500 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-[#001F3F] mb-2">Saved Items</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">Quick access to the properties you've liked and saved.</p>
                    <div class="mt-6 flex items-center text-xs font-black text-red-500 uppercase tracking-widest">
                        View Favorites
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4 4H3"/>
                        </svg>
                    </div>
                </a>

                <!-- Inquiries Card -->
                <a href="{{ route('inquiries.index') }}" class="group bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:border-[#C6A664]/20 transition-all duration-500 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-[#001F3F] mb-2">My Inquiries</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">Keep track of all property requests you've submitted.</p>
                    <div class="mt-6 flex items-center text-xs font-black text-amber-600 uppercase tracking-widest">
                        Track Requests
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4 4H3"/>
                        </svg>
                    </div>
                </a>
            </div>

            <!-- Home Finder Promotional Banner -->
            <div class="bg-gradient-to-br from-[#001F3F] to-[#00152B] rounded-[3rem] p-12 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-[#C6A664]/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -top-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 max-w-2xl text-center md:text-left">
                    <h2 class="text-3xl font-black mb-4"><span class="text-[#C6A664]">Can't find</span> what you're looking for?</h2>
                    <p class="text-lg text-white/70 font-medium mb-8 leading-relaxed">Try our premium Home Finder service. Tell us your requirements, and our agents will source the perfect property for you, off-market.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="px-8 py-4 bg-[#C6A664] text-white font-black rounded-2xl hover:bg-[#B39554] transition-all transform active:scale-95 shadow-lg shadow-[#C6A664]/20">
                            Request Custom Search
                        </button>
                        @if(Auth::user()->role !== 'agent')
                        <a href="{{ route('register', ['role' => 'agent']) }}" class="px-8 py-4 bg-white/10 backdrop-blur-md text-white font-black rounded-2xl border border-white/20 hover:bg-white/20 transition-all">
                            Become an Agent
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            
            @if(auth()->user()->role === 'admin')
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-gray-900 text-white rounded-xl font-bold hover:bg-black transition-all">
                        Go to Admin Dashboard
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
