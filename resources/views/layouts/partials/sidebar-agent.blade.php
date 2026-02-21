<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-72 transition duration-300 transform overflow-y-auto lg:translate-x-0 lg:static lg:inset-0" style="background: linear-gradient(180deg, #001F3F 0%, #00152B 100%);">
    
    <!-- Logo Section -->
    <div class="flex items-center justify-center h-20 border-b" style="border-color: rgba(198, 166, 100, 0.2);">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-10 rounded-xl flex items-center justify-center shadow-lg" style="background-color: #C6A664;">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <div>
                <span class="text-xl font-bold text-white tracking-wide">MyCrib</span>
                <span class="text-xs block font-medium tracking-widest" style="color: #C6A664;">AGENT PORTAL</span>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-8 px-4">
        <!-- Dashboard Section -->
        <div class="mb-4">
            <p class="text-xs font-semibold uppercase tracking-widest px-4 mb-3" style="color: rgba(198, 166, 100, 0.6);">Main Menu</p>
        </div>

        <a class="sidebar-link flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 {{ request()->routeIs('agent.dashboard') ? 'text-white' : '' }}" 
           href="{{ route('agent.dashboard') }}" 
           style="{{ request()->routeIs('agent.dashboard') ? 'background: rgba(198, 166, 100, 0.15); border: 1px solid rgba(198, 166, 100, 0.2);' : 'color: #C6A664;' }}">
            <div class="p-2 rounded-lg mr-3 shadow-sm" style="background-color: {{ request()->routeIs('agent.dashboard') ? '#C6A664' : 'rgba(198, 166, 100, 0.15)' }};">
                <svg class="h-5 w-5" style="color: {{ request()->routeIs('agent.dashboard') ? '#fff' : '#C6A664' }};" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Listings Section -->
        <div class="my-6 border-t" style="border-color: rgba(198, 166, 100, 0.15);"></div>
        
        <div class="mb-4">
            <p class="text-xs font-semibold uppercase tracking-widest px-4 mb-3" style="color: rgba(198, 166, 100, 0.6);">Listings Management</p>
        </div>

        <a class="sidebar-link flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 {{ request()->routeIs('agent.properties.index') ? 'text-white' : '' }}" 
           href="{{ route('agent.properties.index') }}"
           style="{{ request()->routeIs('agent.properties.index') ? 'background: rgba(198, 166, 100, 0.15); border: 1px solid rgba(198, 166, 100, 0.2);' : 'color: #C6A664;' }}">
            <div class="p-2 rounded-lg mr-3 shadow-sm" style="background-color: {{ request()->routeIs('agent.properties.index') ? '#C6A664' : 'rgba(198, 166, 100, 0.15)' }};">
                <svg class="h-5 w-5" style="color: {{ request()->routeIs('agent.properties.index') ? '#fff' : '#C6A664' }};" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="font-medium">My Properties</span>
        </a>

        <a class="sidebar-link flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 {{ request()->routeIs('agent.properties.create') ? 'text-white' : '' }}" 
           href="{{ route('agent.properties.create') }}"
           style="{{ request()->routeIs('agent.properties.create') ? 'background: rgba(198, 166, 100, 0.15); border: 1px solid rgba(198, 166, 100, 0.2);' : 'color: #C6A664;' }}">
            <div class="p-2 rounded-lg mr-3 shadow-sm" style="background-color: {{ request()->routeIs('agent.properties.create') ? '#C6A664' : 'rgba(198, 166, 100, 0.15)' }};">
                <svg class="h-5 w-5" style="color: {{ request()->routeIs('agent.properties.create') ? '#fff' : '#C6A664' }};" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <span class="font-medium">Add Property</span>
        </a>

        <!-- Interactions Section -->
        <div class="my-6 border-t" style="border-color: rgba(198, 166, 100, 0.15);"></div>

        <div class="mb-4">
            <p class="text-xs font-semibold uppercase tracking-widest px-4 mb-3" style="color: rgba(198, 166, 100, 0.6);">Interactions</p>
        </div>

        <a class="sidebar-link flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 {{ request()->routeIs('agent.messages.*') ? 'text-white' : '' }}" 
           href="{{ route('agent.messages.index') }}"
           style="{{ request()->routeIs('agent.messages.*') ? 'background: rgba(198, 166, 100, 0.15); border: 1px solid rgba(198, 166, 100, 0.2);' : 'color: #C6A664;' }}">
            <div class="p-2 rounded-lg mr-3 shadow-sm" style="background-color: {{ request()->routeIs('agent.messages.*') ? '#C6A664' : 'rgba(198, 166, 100, 0.15)' }};">
                <svg class="h-5 w-5" style="color: {{ request()->routeIs('agent.messages.*') ? '#fff' : '#C6A664' }};" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="font-medium">Messages</span>
        </a>

        <!-- Settings Section -->
        <div class="my-6 border-t" style="border-color: rgba(198, 166, 100, 0.15);"></div>

        <div class="mb-4">
            <p class="text-xs font-semibold uppercase tracking-widest px-4 mb-3" style="color: rgba(198, 166, 100, 0.6);">Settings</p>
        </div>

        <a class="sidebar-link flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 {{ request()->routeIs('agent.profile.edit') ? 'text-white' : '' }}" 
           href="{{ route('agent.profile.edit') }}"
           style="{{ request()->routeIs('agent.profile.edit') ? 'background: rgba(198, 166, 100, 0.15); border: 1px solid rgba(198, 166, 100, 0.2);' : 'color: #C6A664;' }}">
            <div class="p-2 rounded-lg mr-3 shadow-sm" style="background-color: {{ request()->routeIs('agent.profile.edit') ? '#C6A664' : 'rgba(198, 166, 100, 0.15)' }};">
                <svg class="h-5 w-5" style="color: {{ request()->routeIs('agent.profile.edit') ? '#fff' : '#C6A664' }};" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="font-medium">Profile</span>
        </a>
    </nav>

    <!-- Bottom Section -->
    <div class="absolute bottom-0 left-0 right-0 p-4 space-y-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full py-3 px-4 rounded-xl transition-all duration-200 text-red-400 hover:bg-red-500/10 hover:text-red-300 group">
                <div class="p-2 rounded-lg mr-3 bg-red-500/15 group-hover:bg-red-500/20">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <span class="font-medium">Sign Out</span>
            </button>
        </form>
        <div class="rounded-xl p-3" style="background: rgba(198, 166, 100, 0.1); border: 1px solid rgba(198, 166, 100, 0.15);">
            <p class="text-xs text-center" style="color: rgba(255,255,255,0.5);">MyCrib Africa &copy; {{ date('Y') }}</p>
        </div>
    </div>
</div>

<style>
    .sidebar-link:not(.text-white):hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.08);
    }
    .sidebar-link:not(.text-white):hover svg {
        color: #ffffff !important;
    }
</style>
