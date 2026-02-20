<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 shadow-2xl" style="background: linear-gradient(180deg, #001F3F 0%, #00152B 100%);">
    <div class="flex items-center justify-center py-8 px-6">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg" style="background-color: #C6A664;">
                <svg class="w-6 h-6 text-[#001F3F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <span class="text-white text-xl font-bold tracking-tight">Agent Portal</span>
        </div>
    </div>

    <nav class="mt-6 px-4 pb-20 space-y-6">
        <!-- Main Section -->
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-white/40 px-4 mb-2">Main</p>
            <a class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 group {{ request()->routeIs('agent.dashboard') ? 'bg-[#C6A664] text-[#001F3F]' : 'text-white hover:text-[#C6A664] hover:bg-white/10' }}" href="{{ route('agent.dashboard') }}">
                <svg class="h-5 w-5 {{ request()->routeIs('agent.dashboard') ? 'text-[#001F3F]' : 'text-white group-hover:text-[#C6A664]' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="mx-3 font-medium">Dashboard</span>
            </a>
            <a class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 group text-white hover:text-[#C6A664] hover:bg-white/10" href="#">
                <svg class="h-5 w-5 text-white group-hover:text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="mx-3 font-medium">Analytics</span>
            </a>
        </div>

        <!-- Inventory Section -->
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-white/40 px-4 mb-2">Inventory</p>
            <a class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 group {{ request()->routeIs('agent.properties.index') ? 'bg-[#C6A664] text-[#001F3F]' : 'text-white hover:text-[#C6A664] hover:bg-white/10' }}" href="{{ route('agent.properties.index') }}">
                <svg class="h-5 w-5 {{ request()->routeIs('agent.properties.index') ? 'text-[#001F3F]' : 'text-white group-hover:text-[#C6A664]' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12L5 12M5 12L19 12M5 12L5 4C5 2.89543 5.89543 2 7 2H17C18.1046 2 19 2.89543 19 4V12M19 12L21 12M19 12V20C19 21.1046 18.1046 22 17 22H7C5.89543 22 5 21.1046 5 20V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="mx-3 font-medium">My Properties</span>
            </a>
            <a class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 group text-white hover:text-[#C6A664] hover:bg-white/10" href="{{ route('agent.properties.create') }}">
                <svg class="h-5 w-5 text-white group-hover:text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="mx-3 font-medium">Add New Property</span>
            </a>
        </div>

        <!-- Leads Section -->
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-white/40 px-4 mb-2">Leads</p>
            <a class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 group {{ request()->routeIs('agent.inquiries.index') ? 'bg-[#C6A664] text-[#001F3F]' : 'text-white hover:text-[#C6A664] hover:bg-white/10' }}" href="{{ route('agent.inquiries.index') }}">
                <svg class="h-5 w-5 {{ request()->routeIs('agent.inquiries.index') ? 'text-[#001F3F]' : 'text-white group-hover:text-[#C6A664]' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 6V12L16 14M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="mx-3 font-medium">Messages</span>
            </a>
            <a class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 group text-white hover:text-[#C6A664] hover:bg-white/10" href="#">
                <svg class="h-5 w-5 text-white group-hover:text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="mx-3 font-medium">Appointments</span>
            </a>
        </div>

        <!-- Account Section -->
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-white/40 px-4 mb-2">Account</p>
            <a class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 group {{ request()->routeIs('agent.profile.edit') ? 'bg-[#C6A664] text-[#001F3F]' : 'text-white hover:text-[#C6A664] hover:bg-white/10' }}" href="{{ route('agent.profile.edit') }}">
                <svg class="h-5 w-5 {{ request()->routeIs('agent.profile.edit') ? 'text-[#001F3F]' : 'text-white group-hover:text-[#C6A664]' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="mx-3 font-medium">Profile Settings</span>
            </a>
            <a class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 group text-white hover:text-[#C6A664] hover:bg-white/10" href="#">
                <svg class="h-5 w-5 text-white group-hover:text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="mx-3 font-medium">Help Center</span>
            </a>
        </div>
    </nav>

    <div class="absolute bottom-8 w-full px-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full py-3 px-4 rounded-xl text-white hover:bg-red-500/10 hover:text-[#C6A664] transition-all duration-200 group">
                <svg class="h-5 w-5 text-white group-hover:text-[#C6A664]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H9m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="mx-3 font-medium">Sign Out</span>
            </button>
        </form>
    </div>
</div>


