{{--
  Agent Sidebar – Resizable / Collapsible Edition
  • Desktop: collapses to icon-rail (w-20) on toggle, expands to full (w-72)
  • Mobile: slides in as an overlay when sidebarOpen = true
  • Mouse can drag the resize handle to set any custom width
--}}

<aside id="agentSidebar"
       class="agent-sidebar fixed inset-y-0 left-0 z-40 flex flex-col transition-all duration-300 ease-in-out select-none
              lg:static lg:translate-x-0"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
       x-bind:style="`background:linear-gradient(180deg,#001F3F 0%,#00152B 100%);border-right:1px solid rgba(255,255,255,0.06);width:${sidebarCollapsed ? '72px' : 'var(--sidebar-w,288px)'}`">

    {{-- ══════════════════════════════════════════════════════
         LOGO / HEADER
    ══════════════════════════════════════════════════════ --}}
    <div class="flex-shrink-0 flex items-center h-[70px] px-5 border-b border-white/[0.07] relative overflow-hidden">
        {{-- accent glow --}}
        <div class="absolute -top-6 -left-6 w-24 h-24 rounded-full blur-2xl opacity-20"
             style="background:radial-gradient(circle,#C6A664,transparent)"></div>

        {{-- Logo icon --}}
        <div class="relative z-10 flex items-center justify-center w-10 h-10 rounded-xl flex-shrink-0 shadow-xl"
             style="background:linear-gradient(135deg,#C6A664,#a8894e)">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
            </svg>
        </div>

        {{-- Brand text --}}
        <div class="ml-3 overflow-hidden transition-all duration-300 whitespace-nowrap"
             :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-auto opacity-100'">
            <p class="text-white font-extrabold text-base tracking-tight leading-none uppercase">MyCrip</p>
            <p class="text-[11px] font-black tracking-[.2em] mt-1" style="color:#C6A664">AGENT PORTAL</p>
        </div>

        {{-- Collapse toggle (desktop) --}}
        <button @click="sidebarCollapsed = !sidebarCollapsed"
                class="absolute right-3 top-1/2 -translate-y-1/2 hidden lg:flex items-center justify-center w-7 h-7 rounded-lg transition-all duration-200 hover:bg-white/10 text-white/40 hover:text-white focus:outline-none"
                :class="sidebarCollapsed ? 'right-1/2 translate-x-1/2' : 'right-3'"
                title="Collapse sidebar">
            <svg class="w-4 h-4 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''"
                 fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
        </button>

        {{-- Mobile close --}}
        <button @click="sidebarOpen = false" class="lg:hidden absolute right-3 top-1/2 -translate-y-1/2 text-white/50 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- ══════════════════════════════════════════════════════
         NAVIGATION
    ══════════════════════════════════════════════════════ --}}
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-5 px-3 space-y-6 no-scrollbar">

        {{-- MAIN --}}
        <div>
            <p class="sidebar-group-label px-3 mb-2 text-[10px] font-black uppercase tracking-[.2em] text-white/70 transition-all duration-300 whitespace-nowrap overflow-hidden"
               :class="sidebarCollapsed ? 'opacity-0 h-0 mb-0' : 'opacity-100 h-auto'">Main</p>
            <div class="space-y-0.5">
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.dashboard'),
                    'label'  => 'Dashboard',
                    'active' => request()->routeIs('agent.dashboard'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zm9.75-9.75A1.125 1.125 0 0111.625 2.25h2.25c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V3.375zm9.75 4.5A1.125 1.125 0 0121.375 6.75h-2.25a1.125 1.125 0 00-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125v-12z"/>',
                ])
            </div>
        </div>

        {{-- REAL ESTATE --}}
        <div>
            <p class="sidebar-group-label px-3 mb-2 text-[10px] font-black uppercase tracking-[.2em] text-white/70 transition-all duration-300 whitespace-nowrap overflow-hidden"
               :class="sidebarCollapsed ? 'opacity-0 h-0 mb-0' : 'opacity-100 h-auto'">Real Estate</p>
            <div class="space-y-0.5">
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.properties.index'),
                    'label'  => 'My Listings',
                    'active' => request()->routeIs('agent.properties.index'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.properties.create'),
                    'label'  => 'New Listing',
                    'active' => request()->routeIs('agent.properties.create'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>',
                    'accent' => true,
                ])
            </div>
        </div>

        {{-- COMMUNICATION --}}
        <div>
            <p class="sidebar-group-label px-3 mb-2 text-[10px] font-black uppercase tracking-[.2em] text-white/70 transition-all duration-300 whitespace-nowrap overflow-hidden"
               :class="sidebarCollapsed ? 'opacity-0 h-0 mb-0' : 'opacity-100 h-auto'">Communication</p>
            <div class="space-y-0.5">
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.messages.index'),
                    'label'  => 'Messages',
                    'active' => request()->routeIs('agent.messages.*'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.inquiries.index'),
                    'label'  => 'Inquiries',
                    'active' => request()->routeIs('agent.inquiries.*'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.tours.index'),
                    'label'  => 'Tour Bookings',
                    'active' => request()->routeIs('agent.tours.*'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.message-templates.index'),
                    'label'  => 'Msg Templates',
                    'active' => request()->routeIs('agent.message-templates.*'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>',
                ])
            </div>
        </div>

        {{-- ANALYTICS --}}
        <div>
            <p class="sidebar-group-label px-3 mb-2 text-[10px] font-black uppercase tracking-[.2em] text-white/70 transition-all duration-300 whitespace-nowrap overflow-hidden"
               :class="sidebarCollapsed ? 'opacity-0 h-0 mb-0' : 'opacity-100 h-auto'">Analytics</p>
            <div class="space-y-0.5">
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.analytics'),
                    'label'  => 'Performance',
                    'active' => request()->routeIs('agent.analytics'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z"/>',
                ])
            </div>
        </div>

        {{-- PAYMENTS --}}
        <div>
            <p class="sidebar-group-label px-3 mb-2 text-[9px] font-black uppercase tracking-[.2em] text-white/50 transition-all duration-300 whitespace-nowrap overflow-hidden"
               :class="sidebarCollapsed ? 'opacity-0 h-0 mb-0' : 'opacity-100 h-auto'">Payments</p>
            <div class="space-y-0.5">
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.subscription'),
                    'label'  => 'Subscription',
                    'active' => request()->routeIs('agent.payments.*') || request()->is('agent/subscription*'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.billing'),
                    'label'  => 'Billing History',
                    'active' => request()->is('agent/billing*'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.properties.index'),
                    'label'  => 'Boost Listing',
                    'active' => false,
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>',
                ])
            </div>
        </div>

        {{-- ACCOUNT --}}
        <div>
            <p class="sidebar-group-label px-3 mb-2 text-[9px] font-black uppercase tracking-[.2em] text-white/50 transition-all duration-300 whitespace-nowrap overflow-hidden"
               :class="sidebarCollapsed ? 'opacity-0 h-0 mb-0' : 'opacity-100 h-auto'">Account</p>
            <div class="space-y-0.5">
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('agent.profile.edit'),
                    'label'  => 'My Profile',
                    'active' => request()->routeIs('agent.profile.edit'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('account.security'),
                    'label'  => 'Security',
                    'active' => request()->routeIs('account.security'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('account.activity'),
                    'label'  => 'Activity Log',
                    'active' => request()->routeIs('account.activity'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/>',
                ])
                @include('layouts.partials.sidebar-agent-item', [
                    'href'   => route('support.tickets'),
                    'label'  => 'Support',
                    'active' => request()->routeIs('support.*'),
                    'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.712 4.33a9.027 9.027 0 011.652 1.306c.51.51.944 1.064 1.306 1.652M16.712 4.33l-3.448 4.138m3.448-4.138a9.014 9.014 0 00-9.424 0M19.67 7.288l-4.138 3.448m4.138-3.448a9.014 9.014 0 010 9.424m-4.138-5.976a3.736 3.736 0 00-.88-1.388 3.737 3.737 0 00-1.388-.88m2.268 2.268a3.765 3.765 0 010 2.528m-2.268-4.796a3.765 3.765 0 00-2.528 0m4.796 4.796c-.181.506-.475.982-.88 1.388a3.736 3.736 0 01-1.388.88m2.268-2.268l4.138 3.448m0 0a9.027 9.027 0 01-1.306 1.652c-.51.51-1.064.944-1.652 1.306m0 0l-3.448-4.138m3.448 4.138a9.014 9.014 0 01-9.424 0m5.976-4.138a3.765 3.765 0 01-2.528 0m0 0a3.736 3.736 0 01-1.388-.88 3.737 3.737 0 01-.88-1.388m2.268 2.268L7.288 19.67m0 0a9.024 9.024 0 01-1.652-1.306 9.027 9.027 0 01-1.306-1.652m0 0l4.138-3.448M4.33 16.712a9.014 9.014 0 010-9.424m4.138 5.976a3.765 3.765 0 010-2.528m0 0c.181-.506.475-.982.88-1.388a3.736 3.736 0 011.388-.88m-2.268 2.268L4.33 7.288m6.406 1.18L7.288 4.33m0 0a9.024 9.024 0 00-1.652 1.306A9.025 9.025 0 004.33 7.288"/>',
                ])
            </div>
        </div>

    </nav>

    {{-- ══════════════════════════════════════════════════════
         USER PROFILE FOOTER
    ══════════════════════════════════════════════════════ --}}
    <div class="flex-shrink-0 border-t border-white/[0.07] p-3">
        <div class="group relative flex items-center gap-3 rounded-xl p-3 transition-all duration-200 hover:bg-white/5 cursor-pointer overflow-hidden">
            {{-- Avatar --}}
            <div class="relative flex-shrink-0">
                <div class="w-8 h-8 rounded-lg overflow-hidden ring-1 ring-white/20 group-hover:ring-white/40 transition-all duration-300 flex items-center justify-center"
                     style="background:linear-gradient(135deg,#C6A664,#a8894e)">
                    @if(Auth::user()->agent_image)
                        <img class="w-full h-full object-cover" src="{{ Auth::user()->agent_image_url }}" alt="{{ Auth::user()->name }}">
                    @else
                        <span class="text-xs font-black text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    @endif
                </div>
                <span class="absolute -bottom-0.5 -right-0.5 w-2 h-2 bg-emerald-400 rounded-full ring-1 ring-[#001F3F]"></span>
            </div>

            {{-- Name / Role --}}
            <div class="min-w-0 flex-1 overflow-hidden transition-all duration-300 whitespace-nowrap"
                 :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                <p class="text-xs font-bold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                <p class="text-[9px] text-white/60 font-semibold uppercase tracking-widest mt-0.5">
                    @if(Auth::user()->agent_verification_status === 'approved')
                        <span class="text-emerald-400 font-bold">✓ Verified Agent</span>
                    @else
                        <span class="text-white/70">Real Estate Agent</span>
                    @endif
                </p>
            </div>

            {{-- Actions on hover --}}
            <div class="flex-shrink-0 flex gap-1 transition-all duration-300"
                 :class="sidebarCollapsed ? 'opacity-0 w-0 pointer-events-none' : 'opacity-0 group-hover:opacity-100'">
                <a href="{{ route('agent.profile.edit') }}"
                   class="w-6 h-6 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 text-white/60 hover:text-white transition-all duration-150"
                   title="Edit Profile">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                    </svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-6 h-6 flex items-center justify-center rounded-lg bg-white/10 hover:bg-red-500/30 text-white/60 hover:text-red-300 transition-all duration-150"
                            title="Logout">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- Version --}}
        <div class="mt-2 px-3 flex items-center justify-between transition-all duration-300 overflow-hidden"
             :class="sidebarCollapsed ? 'opacity-0 h-0' : 'opacity-100'">
            <span class="text-[8px] font-bold tracking-[.18em] text-white/20 uppercase">MyCrip Africa</span>
            <span class="text-[8px] font-bold text-white/20">v2.1</span>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════
         DRAG RESIZE HANDLE
    ══════════════════════════════════════════════════════ --}}
    <div id="sidebarResizer"
         class="hidden lg:block absolute top-0 right-0 h-full w-1.5 cursor-col-resize group/resize z-50
                hover:bg-white/10 active:bg-blue-400/30 transition-colors duration-150"
         title="Drag to resize">
        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-0.5 h-12 rounded-full bg-white/10 group-hover/resize:bg-blue-400/60 transition-colors duration-200"></div>
    </div>

</aside>

{{-- ══════════════════════════════════════════════════════
     MOBILE OVERLAY
══════════════════════════════════════════════════════ --}}
<div class="fixed inset-0 z-30 bg-black/60 backdrop-blur-sm lg:hidden transition-opacity duration-300"
     x-show="sidebarOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     style="display:none">
</div>

<style>
/* ── No scrollbar ─────────────────────────────────── */
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

/* ── Sidebar background (kept in CSS so Alpine :style doesn't wipe it) ── */
.agent-sidebar {
    background: linear-gradient(180deg, #001F3F 0%, #00152B 100%) !important;
    border-right: 1px solid rgba(255,255,255,0.06);
    will-change: width;
}

/* ── Tooltip for collapsed icon items ─────────────── */
[data-sidebar-tooltip] {
    position: relative;
}
[data-sidebar-tooltip]::after {
    content: attr(data-sidebar-tooltip);
    position: absolute;
    left: calc(100% + 12px);
    top: 50%;
    transform: translateY(-50%);
    background: #001F3F;
    color: #fff;
    font-size: 11px;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 7px;
    white-space: nowrap;
    pointer-events: none;
    opacity: 0;
    transition: opacity .15s ease, transform .15s ease;
    transform: translateY(-50%) translateX(-4px);
    border: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 8px 24px rgba(0,0,0,.35);
    z-index: 100;
}
[data-sidebar-tooltip]:hover::after {
    opacity: 1;
    transform: translateY(-50%) translateX(0);
}
</style>

<script>
(function () {
    // ── Drag-to-resize ─────────────────────────────────────────────────────
    const resizer  = document.getElementById('sidebarResizer');
    const sidebar  = document.getElementById('agentSidebar');
    if (!resizer || !sidebar) return;

    let startX, startW;

    resizer.addEventListener('mousedown', function (e) {
        startX = e.clientX;
        startW = sidebar.getBoundingClientRect().width;
        document.body.style.cursor = 'col-resize';
        document.body.style.userSelect = 'none';

        function onMove(e) {
            const diff = e.clientX - startX;
            const newW = Math.min(400, Math.max(72, startW + diff));
            sidebar.style.setProperty('--sidebar-w', newW + 'px');
            // Update Alpine collapsed state
            const al = sidebar._x_dataStack?.[0];
            if (al) al.sidebarCollapsed = newW <= 90;
        }

        function onUp() {
            document.body.style.cursor = '';
            document.body.style.userSelect = '';
            document.removeEventListener('mousemove', onMove);
            document.removeEventListener('mouseup', onUp);
        }

        document.addEventListener('mousemove', onMove);
        document.addEventListener('mouseup', onUp);
    });
})();
</script>
