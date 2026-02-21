<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" 
     class="fixed z-30 inset-y-0 left-0 w-72 transition-all duration-300 transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col min-h-screen border-r border-white/5" 
     style="background: linear-gradient(180deg, #001F3F 0%, #00152B 100%);">
    
    <!-- Header/Logo Section -->
    <div class="flex-shrink-0 flex items-center px-6 h-20 border-b border-white/10">
        <div class="flex items-center space-x-3 group cursor-pointer">
            <div class="h-10 w-10 rounded-xl flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110" style="background-color: #C6A664;">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="text-xl font-bold text-white tracking-tight">MyCrib</span>
                <span class="text-[10px] font-bold tracking-[0.2em] -mt-1" style="color: #C6A664;">AGENT PORTAL</span>
            </div>
        </div>
    </div>

    <!-- Navigation Section -->
    <nav class="flex-1 mt-6 px-4 space-y-8 overflow-y-auto no-scrollbar pb-24">
        <!-- Main Navigation -->
        <div>
            <p class="px-3 text-[10px] font-bold uppercase tracking-[0.15em] mb-4 text-white/50">Main Dashboard</p>
            <div class="space-y-1">
                <a href="{{ route('agent.dashboard') }}" 
                   class="group flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('agent.dashboard') ? 'bg-[#C6A664]/10 border border-[#C6A664]/20 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ request()->routeIs('agent.dashboard') ? 'bg-[#C6A664] text-white shadow-lg shadow-[#C6A664]/20' : 'bg-white/10 text-[#C6A664] group-hover:bg-white/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold tracking-wide">Dashboard</span>
                    @if(request()->routeIs('agent.dashboard'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-[#C6A664] shadow-[0_0_8px_#C6A664]"></div>
                    @endif
                </a>
            </div>
        </div>

        <!-- Properties Management -->
        <div>
            <p class="px-3 text-[10px] font-bold uppercase tracking-[0.15em] mb-4 text-white/50">Real Estate</p>
            <div class="space-y-1">
                <a href="{{ route('agent.properties.index') }}" 
                   class="group flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('agent.properties.index') ? 'bg-[#C6A664]/10 border border-[#C6A664]/20 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ request()->routeIs('agent.properties.index') ? 'bg-[#C6A664] text-white shadow-lg shadow-[#C6A664]/20' : 'bg-white/10 text-[#C6A664] group-hover:bg-white/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold tracking-wide">My Listings</span>
                    @if(request()->routeIs('agent.properties.index'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-[#C6A664] shadow-[0_0_8px_#C6A664]"></div>
                    @endif
                </a>

                <a href="{{ route('agent.properties.create') }}" 
                   class="group flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('agent.properties.create') ? 'bg-[#C6A664]/10 border border-[#C6A664]/20 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ request()->routeIs('agent.properties.create') ? 'bg-[#C6A664] text-white shadow-lg shadow-[#C6A664]/20' : 'bg-white/10 text-[#C6A664] group-hover:bg-white/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold tracking-wide">New Listing</span>
                    @if(request()->routeIs('agent.properties.create'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-[#C6A664] shadow-[0_0_8px_#C6A664]"></div>
                    @endif
                </a>
            </div>
        </div>

        <!-- Interactions -->
        <div>
            <p class="px-3 text-[10px] font-bold uppercase tracking-[0.15em] mb-4 text-white/50">Intelligence</p>
            <div class="space-y-1">
                <a href="{{ route('agent.messages.index') }}" 
                   class="group flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('agent.messages.*') ? 'bg-[#C6A664]/10 border border-[#C6A664]/20 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ request()->routeIs('agent.messages.*') ? 'bg-[#C6A664] text-white shadow-lg shadow-[#C6A664]/20' : 'bg-white/10 text-[#C6A664] group-hover:bg-white/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold tracking-wide">Messages</span>
                    @if(request()->routeIs('agent.messages.*'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-[#C6A664] shadow-[0_0_8px_#C6A664]"></div>
                    @endif
                </a>

                <a href="{{ route('agent.inquiries.index') }}" 
                   class="group flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('agent.inquiries.*') ? 'bg-[#C6A664]/10 border border-[#C6A664]/20 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ request()->routeIs('agent.inquiries.*') ? 'bg-[#C6A664] text-white shadow-lg shadow-[#C6A664]/20' : 'bg-white/10 text-[#C6A664] group-hover:bg-white/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold tracking-wide">Inquiries</span>
                    @if(request()->routeIs('agent.inquiries.*'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-[#C6A664] shadow-[0_0_8px_#C6A664]"></div>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <!-- Bottom Account Section -->
    <div class="flex-shrink-0 p-4 border-t border-white/5" style="background: rgba(255, 255, 255, 0.02);">
        <div class="bg-white/5 rounded-2xl p-4 border border-white/5 relative group overflow-hidden">
            <!-- Glow Effect -->
            <div class="absolute -right-4 -top-4 w-16 h-16 bg-[#C6A664]/10 blur-2xl rounded-full transition-transform duration-500 group-hover:scale-150"></div>
            
            <div class="flex items-center space-x-3 mb-4 relative z-10">
                <div class="h-10 w-10 border border-white/10 ring-2 ring-[#C6A664]/20 ring-offset-2 ring-offset-transparent flex items-center justify-center bg-[#001F3F]/50 rounded-xl overflow-hidden shadow-2xl transition-all duration-300 group-hover:ring-[#C6A664]/40">
                    @if(Auth::user()->agent_image)
                        <img class="h-full w-full object-cover" src="{{ Auth::user()->agent_image_url }}" alt="{{ Auth::user()->name }}">
                    @else
                        <div class="h-full w-full bg-[#001F3F] flex items-center justify-center text-white text-xs font-bold font-sans">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-white truncate tracking-wide leading-tight group-hover:text-[#C6A664] transition-colors duration-300">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-white/60 truncate font-bold uppercase tracking-widest mt-0.5">Premium Agent</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2 relative z-10">
                <a href="{{ route('agent.profile.edit') }}" 
                   class="flex items-center justify-center p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white/80 hover:text-white transition-all duration-200 border border-white/10">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-[10px] font-bold">Profile</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center justify-center p-2 rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-100 hover:text-white transition-all duration-200 border border-red-500/10">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-[10px] font-bold">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-4 px-2 flex items-center justify-between text-[8px] font-bold tracking-[0.2em] text-white/40">
            <span>MYCRIB AFRICA</span>
            <span>v2.1.0</span>
        </div>
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
