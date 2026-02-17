<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b sticky top-0 z-50 shadow-sm" style="border-color: #C6A664;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300" style="background-color: #001F3F;">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold" style="color: #001F3F;">
                            MyCrib Africa
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:ml-12 md:flex md:space-x-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-300 border-b-2 border-transparent" style="color: #001F3F;" onmouseover="this.style.color='#C6A664'; this.style.borderColor='#C6A664'" onmouseout="this.style.color='#001F3F'; this.style.borderColor='transparent'">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>
                    <a href="{{ route('properties.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-300 border-b-2 border-transparent" style="color: #1A1A1A;" onmouseover="this.style.color='#C6A664'; this.style.borderColor='#C6A664'" onmouseout="this.style.color='#1A1A1A'; this.style.borderColor='transparent'">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Properties
                    </a>
                    <a href="{{ route('agents.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-300 border-b-2 border-transparent" style="color: #1A1A1A;" onmouseover="this.style.color='#C6A664'; this.style.borderColor='#C6A664'" onmouseout="this.style.color='#1A1A1A'; this.style.borderColor='transparent'">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        Agents
                    </a>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-300 border-b-2 border-transparent" style="color: #C6A664;" onmouseover="this.style.borderColor='#C6A664'" onmouseout="this.style.borderColor='transparent'">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Admin
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden md:flex md:items-center md:space-x-4">
                <!-- CTA Buttons -->
                <a href="{{ route('register') }}" class="text-white px-6 py-2 rounded-lg font-medium transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
                    Get Started
                </a>
                
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 bg-white border-2 px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-md" style="border-color: #C6A664;" onmouseover="this.style.borderColor='#001F3F'" onmouseout="this.style.borderColor='#C6A664'">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-semibold" style="background-color: #001F3F;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="font-medium" style="color: #1A1A1A;">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50" style="display: none;">
                            <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </a>
                            @if(auth()->user()->role === 'agent')
                                <a href="{{ route('agent.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                    Dashboard
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
                                @csrf
                                <button type="submit" class="w-full flex items-center text-left text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="font-medium transition-colors duration-300" style="color: #1A1A1A;" onmouseover="this.style.color='#001F3F'" onmouseout="this.style.color='#1A1A1A'">
                        Sign In
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg :class="{'hidden': open, 'inline-flex': ! open }" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg :class="{'hidden': ! open, 'inline-flex': open }" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="md:hidden border-t border-gray-200 bg-white/95 backdrop-blur-sm">
        <div class="pt-4 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block pl-4 pr-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-50 hover:text-indigo-600 transition-colors duration-300">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Home
            </a>
            <a href="{{ route('properties.index') }}" class="block pl-4 pr-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors duration-300">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Properties
            </a>
            <a href="{{ route('agents.index') }}" class="block pl-4 pr-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors duration-300">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
                Agents
            </a>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block pl-4 pr-3 py-2 text-base font-medium text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-300">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Admin
                </a>
            @endif
        </div>
        
        @auth
            <div class="border-t border-gray-200 pt-4 pb-3">
                <div class="flex items-center px-4 space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors duration-300">
                        Profile
                    </a>
                    @if(auth()->user()->role === 'agent')
                        <a href="{{ route('agent.dashboard') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors duration-300">
                            Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                        @csrf
                        <button type="submit" class="w-full text-left text-base font-medium text-gray-700 hover:text-gray-900 transition-colors duration-300">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="border-t border-gray-200 pt-4 pb-3">
                <div class="px-4 space-y-4">
                    <a href="{{ route('register') }}" class="block w-full text-white text-center py-3 px-4 rounded-lg font-medium transform hover:scale-105 transition-all duration-300 shadow-lg" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="block w-full text-center py-3 px-4 font-medium border rounded-lg transition-colors duration-300" style="color: #1A1A1A; border-color: #C6A664; background-color: #FFFFFF;" onmouseover="this.style.backgroundColor='#F5F5F5'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                        Sign In
                    </a>
                </div>
            </div>
        @endauth
    </div>
</nav>
