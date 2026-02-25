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
                <span class="text-xs block font-medium tracking-widest" style="color: #C6A664;">ADMIN PANEL</span>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-8 px-4">
        <div class="mb-4">
            <p class="text-xs font-semibold uppercase tracking-widest px-4 mb-3" style="color: rgba(198, 166, 100, 0.6);">Main Menu</p>
        </div>

        <a class="flex items-center py-3 px-4 rounded-xl mb-2 text-white transition-all duration-200" href="{{ route('admin.dashboard') }}" style="background: rgba(198, 166, 100, 0.15); border: 1px solid rgba(198, 166, 100, 0.2);">
            <div class="p-2 rounded-lg mr-3" style="background-color: #C6A664;">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="font-medium">Dashboard</span>
        </a>

        <a class="flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 hover:bg-white/10" href="{{ route('admin.users.index') }}" style="color: rgba(255,255,255,0.7);" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
            <div class="p-2 rounded-lg mr-3" style="background: rgba(255,255,255,0.1);">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="font-medium">Users</span>
        </a>

        <a class="flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 hover:bg-white/10" href="{{ route('admin.properties.index') }}" style="color: rgba(255,255,255,0.7);" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
            <div class="p-2 rounded-lg mr-3" style="background: rgba(255,255,255,0.1);">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="font-medium">Properties</span>
        </a>

        <a class="flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 hover:bg-white/10 {{ Request::is('admin/blog*') ? 'bg-white/10 text-white' : '' }}" href="{{ route('admin.blog.index') }}" style="color: rgba(255,255,255,0.7);" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
            <div class="p-2 rounded-lg mr-3" style="background: rgba(255,255,255,0.1);">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7 8h3m-3 4h10m-10 4h10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="font-medium">Blog Posts</span>
        </a>

        <a class="flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 hover:bg-white/10" href="#" style="color: rgba(255,255,255,0.7);" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
            <div class="p-2 rounded-lg mr-3" style="background: rgba(255,255,255,0.1);">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="font-medium">Reports</span>
        </a>

        <!-- Divider -->
        <div class="my-6 border-t" style="border-color: rgba(198, 166, 100, 0.15);"></div>

        <div class="mb-4">
            <p class="text-xs font-semibold uppercase tracking-widest px-4 mb-3" style="color: rgba(198, 166, 100, 0.6);">Settings</p>
        </div>

        <a class="flex items-center py-3 px-4 rounded-xl mb-2 transition-all duration-200 hover:bg-white/10" href="#" style="color: rgba(255,255,255,0.7);" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
            <div class="p-2 rounded-lg mr-3" style="background: rgba(255,255,255,0.1);">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="font-medium">Settings</span>
        </a>
    </nav>

    <!-- Bottom Section -->
    <div class="absolute bottom-0 left-0 right-0 p-4 space-y-3">
        <a href="{{ route('logout') }}" class="flex items-center w-full py-3 px-4 rounded-xl transition-all duration-200 text-red-400 hover:bg-red-500/10 hover:text-red-300">
                <div class="p-2 rounded-lg mr-3" style="background: rgba(239, 68, 68, 0.15);">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <span class="font-medium">Sign Out</span>
        </a>
        <div class="rounded-xl p-3" style="background: rgba(198, 166, 100, 0.1); border: 1px solid rgba(198, 166, 100, 0.15);">
            <p class="text-xs text-center" style="color: rgba(255,255,255,0.5);">MyCrib Africa &copy; {{ date('Y') }}</p>
        </div>
    </div>
</div>
