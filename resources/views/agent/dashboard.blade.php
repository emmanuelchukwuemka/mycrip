<x-agent-layout>
<div class="space-y-6">

    {{-- ═══════════════════════════════════════════════════════
         TOP HERO BAR  (compact, professional)
    ═══════════════════════════════════════════════════════ --}}
    <div class="relative overflow-hidden rounded-2xl px-8 py-6 flex items-center justify-between gap-6"
         style="background:linear-gradient(135deg,#001F3F 0%,#00152B 60%,#001a35 100%);">

        {{-- Background decoration --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-8 -right-8 w-48 h-48 rounded-full opacity-10"
                 style="background:radial-gradient(circle,#C6A664,transparent)"></div>
            <div class="absolute -bottom-8 left-1/3 w-32 h-32 rounded-full opacity-5"
                 style="background:radial-gradient(circle,#C6A664,transparent)"></div>
            {{-- grid pattern --}}
            <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                <defs><pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
                    <path d="M 32 0 L 0 0 0 32" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern></defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        {{-- Left: avatar + name --}}
        <div class="relative z-10 flex items-center gap-5">
            {{-- Avatar (compact) --}}
            <div class="relative flex-shrink-0">
                <div class="w-14 h-14 rounded-xl overflow-hidden ring-2 ring-white/20 shadow-xl">
                    @if($user->agent_image)
                        <img src="{{ $user->agent_image_url }}" alt="{{ $user->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-xl font-black text-white"
                             style="background:linear-gradient(135deg,#C6A664,#a8894e)">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                {{-- Online dot --}}
                <span class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full bg-emerald-400 ring-2 ring-[#001F3F]"></span>
            </div>

            {{-- Name & meta --}}
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <h1 class="text-lg font-bold text-white leading-tight tracking-tight">{{ $user->name }}</h1>
                    @if($user->agent_verification_status === 'approved')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-400/20 text-emerald-300 border border-emerald-400/30">
                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Verified
                        </span>
                    @elseif($user->agent_verification_status === 'pending')
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-400/20 text-amber-300 border border-amber-400/30">Pending</span>
                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-red-400/20 text-red-300 border border-red-400/30">Unverified</span>
                    @endif
                </div>
                <div class="flex items-center gap-4 text-xs text-white/50">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Real Estate Agent
                    </span>
                    @if($user->agent_phone)
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $user->agent_phone }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right: quick-action buttons --}}
        <div class="relative z-10 flex items-center gap-3">
            <a href="{{ route('agent.properties.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0"
               style="background:linear-gradient(135deg,#C6A664,#a8894e); color:#001F3F;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                New Listing
            </a>
            <a href="{{ route('agent.profile.edit') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-white/10 hover:bg-white/20 text-white transition-all duration-200 border border-white/10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z"/>
                </svg>
                Edit Profile
            </a>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         KPI STAT CARDS
    ═══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Total Properties --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Listings</p>
                    <p class="text-3xl font-black text-gray-900 leading-none">{{ $totalProperties }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300 group-hover:scale-110"
                     style="background:rgba(0,31,63,0.08)">
                    <svg class="w-5 h-5" style="color:#001F3F" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-50">
                <span class="text-xs text-gray-400 font-medium">All time</span>
            </div>
        </div>

        {{-- Active Listings --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Live Now</p>
                    <p class="text-3xl font-black text-emerald-600 leading-none">{{ $approvedProperties }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 bg-emerald-50 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-50 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs text-emerald-500 font-semibold">Active & visible</span>
            </div>
        </div>

        {{-- Pending --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Pending Review</p>
                    <p class="text-3xl font-black text-amber-500 leading-none">{{ $pendingProperties }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 bg-amber-50 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-50">
                <span class="text-xs text-gray-400 font-medium">Awaiting approval</span>
            </div>
        </div>

        {{-- New Inquiries --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group relative overflow-hidden">
            {{-- Glow for >0 inquiries --}}
            @if($newInquiries > 0)
                <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
                     style="background:radial-gradient(circle at top right,#C6A664,transparent)"></div>
            @endif
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">New Inquiries</p>
                    <p class="text-3xl font-black leading-none" style="color:#C6A664">{{ $newInquiries }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300 group-hover:scale-110"
                     style="background:rgba(198,166,100,0.12)">
                    <svg class="w-5 h-5" style="color:#C6A664" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-50">
                <a href="{{ route('agent.inquiries.index') }}" class="text-xs font-semibold hover:underline transition-colors" style="color:#C6A664">View all →</a>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SUBSCRIPTION BANNER (only if inactive)
    ═══════════════════════════════════════════════════════ --}}
    @if(!$currentSubscription || !$currentSubscription->isActive())
        <div class="flex items-center justify-between gap-4 px-6 py-4 rounded-2xl border"
             style="background:rgba(198,166,100,0.06); border-color:rgba(198,166,100,0.25)">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                     style="background:rgba(198,166,100,0.15)">
                    <svg class="w-4 h-4" style="color:#C6A664" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800">You're on the Free Tier</p>
                    <p class="text-xs text-gray-500 mt-0.5">Upgrade to unlock featured listings, priority placement, and advanced analytics.</p>
                </div>
            </div>
            <a href="{{ url('/agent/subscription') }}"
               class="flex-shrink-0 px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 hover:shadow-md hover:-translate-y-0.5"
               style="background:linear-gradient(135deg,#C6A664,#a8894e); color:#001F3F;">
                Upgrade Plan
            </a>
        </div>
    @endif

    {{-- ═══════════════════════════════════════════════════════
         MAIN CONTENT GRID
    ═══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Properties (2/3 width) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                    <h2 class="text-sm font-bold text-gray-800 tracking-wide">Recent Listings</h2>
                    <a href="{{ route('agent.properties.index') }}"
                       class="text-xs font-semibold hover:underline" style="color:#C6A664">View All →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black uppercase tracking-widest text-gray-400 bg-gray-50/70">
                                <th class="px-6 py-3">Property</th>
                                <th class="px-6 py-3 text-center">Status</th>
                                <th class="px-6 py-3">Price</th>
                                <th class="px-6 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentProperties as $property)
                            <tr class="hover:bg-gray-50/60 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-9 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                                            @if($property->featured_image_url)
                                                <img src="{{ $property->featured_image_url }}"
                                                     class="w-full h-full object-cover" alt="">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-800 truncate max-w-[180px] group-hover:text-[#C6A664] transition-colors">{{ $property->title }}</p>
                                            <p class="text-[11px] text-gray-400 mt-0.5 truncate">{{ $property->city }}, {{ $property->state }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($property->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-50 text-emerald-700 uppercase tracking-wide">Live</span>
                                    @elseif($property->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-50 text-amber-700 uppercase tracking-wide">Pending</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-red-50 text-red-700 uppercase tracking-wide">Rejected</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-gray-700">{{ $property->formatted_price }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('agent.properties.edit', $property->id) }}"
                                       class="inline-flex items-center p-2 rounded-lg text-gray-400 hover:text-white hover:bg-[#001F3F] transition-all duration-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-200">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-400">No listings yet</p>
                                        <a href="{{ route('agent.properties.create') }}"
                                           class="text-sm font-bold hover:underline" style="color:#C6A664">+ Create your first listing</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-5">

            {{-- Recent Inquiries --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-50">
                    <h2 class="text-sm font-bold text-gray-800">Inquiries</h2>
                    <a href="{{ route('agent.inquiries.index') }}" class="text-xs font-semibold hover:underline" style="color:#C6A664">View All →</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse($inquiries as $inquiry)
                        <div class="px-5 py-3.5 hover:bg-gray-50/50 transition-colors">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg flex-shrink-0 flex items-center justify-center text-xs font-black text-white"
                                     style="background:linear-gradient(135deg,#001F3F,#003366)">
                                    {{ strtoupper(substr($inquiry->guest_name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-xs font-bold text-gray-800 truncate">{{ $inquiry->guest_name }}</p>
                                        @if($inquiry->status === 'new')
                                            <span class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#C6A664"></span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] text-gray-400 mt-0.5 truncate italic">{{ $inquiry->property->title ?? '' }}</p>
                                    <p class="text-[11px] text-gray-500 mt-1 line-clamp-1">{{ $inquiry->message }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-10 text-center text-sm text-gray-400">No recent inquiries</div>
                    @endforelse
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="text-sm font-bold text-gray-800 mb-3">Quick Actions</h2>
                <div class="space-y-2">
                    @foreach([
                        ['route' => 'agent.messages.index',    'label' => 'Messages',         'icon' => 'M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z'],
                        ['route' => 'agent.tours.index',       'label' => 'Tour Requests',    'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'],
                        ['route' => 'agent.analytics',         'label' => 'Analytics',        'icon' => 'M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z'],
                        ['route' => 'agent.profile.edit',      'label' => 'Edit Profile',     'icon' => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z'],
                    ] as $link)
                        <a href="{{ route($link['route']) }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors group">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 transition-colors group-hover:bg-[#001F3F]"
                                 style="background:rgba(0,31,63,0.07)">
                                <svg class="w-3.5 h-3.5 group-hover:text-white transition-colors" style="color:#001F3F"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900">{{ $link['label'] }}</span>
                            <svg class="w-3 h-3 text-gray-300 ml-auto group-hover:text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</div>
</x-agent-layout>
