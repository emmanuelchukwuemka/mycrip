<x-admin-layout>
    <!-- Dashboard Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-3xl font-bold" style="color: #001F3F;">Dashboard Overview</h2>
                <p class="mt-1 text-gray-500">Monitor your platform's performance at a glance.</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-3">
                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-green-100 text-green-800">
                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>
                    System Online
                </span>
                <span class="text-sm text-gray-500">{{ now()->format('M d, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl" style="background: rgba(0, 31, 63, 0.08);">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #001F3F;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-700">
                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    5.4%
                </span>
            </div>
            <h4 class="text-3xl font-bold" style="color: #001F3F;">{{ number_format($stats['totalUsers']) }}</h4>
            <p class="text-sm text-gray-500 mt-1">Total Users</p>
            <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full rounded-full" style="width: 75%; background-color: #001F3F;"></div>
            </div>
        </div>

        <!-- Total Properties -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl" style="background: rgba(198, 166, 100, 0.12);">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #C6A664;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-700">
                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    12%
                </span>
            </div>
            <h4 class="text-3xl font-bold" style="color: #001F3F;">{{ number_format($stats['totalProperties']) }}</h4>
            <p class="text-sm text-gray-500 mt-1">Properties Listed</p>
            <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full rounded-full" style="width: 88%; background-color: #C6A664;"></div>
            </div>
        </div>

        <!-- Verified Agents -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-emerald-50">
                    <svg class="h-7 w-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-600">
                    Daily
                </span>
            </div>
            <h4 class="text-3xl font-bold" style="color: #001F3F;">{{ number_format($stats['verifiedAgents']) }}</h4>
            <p class="text-sm text-gray-500 mt-1">Verified Agents</p>
            <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full rounded-full bg-emerald-500" style="width: 62%;"></div>
            </div>
        </div>

        <!-- Pending Reports -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-amber-50">
                    <svg class="h-7 w-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-100 text-amber-700">
                    Action Needed
                </span>
            </div>
            <h4 class="text-3xl font-bold" style="color: #001F3F;">{{ number_format($stats['pendingAgents']) }}</h4>
            <p class="text-sm text-gray-500 mt-1">Pending Verifications</p>
            <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full rounded-full bg-amber-500" style="width: 15%;"></div>
            </div>
        </div>
    </div>

    <!-- Charts & Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Growth Chart — spans 2 cols -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h4 class="text-lg font-bold" style="color: #001F3F;">Platform Analytics</h4>
                    <p class="text-sm text-gray-500">Users & property growth over the last 6 months</p>
                </div>
                <div class="flex items-center space-x-4 text-sm">
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full mr-2" style="background-color: #001F3F;"></span>
                        <span class="text-gray-600">Users</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full mr-2" style="background-color: #C6A664;"></span>
                        <span class="text-gray-600">Properties</span>
                    </div>
                </div>
            </div>
            <div class="relative h-72">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-bold" style="color: #001F3F;">Recent Activity</h4>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium" style="background: rgba(198, 166, 100, 0.12); color: #C6A664;">Live</span>
            </div>
            <div class="flow-root">
                <ul class="-mb-8">
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-100" aria-hidden="true"></span>
                            <div class="relative flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <span class="h-10 w-10 rounded-xl flex items-center justify-center ring-4 ring-white" style="background-color: #001F3F;">
                                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm text-gray-800 font-medium">New agent <span class="font-bold" style="color: #001F3F;">Sarah Connor</span> registered</p>
                                    <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-100" aria-hidden="true"></span>
                            <div class="relative flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <span class="h-10 w-10 rounded-xl flex items-center justify-center ring-4 ring-white" style="background-color: #C6A664;">
                                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm text-gray-800 font-medium">New property <span class="font-bold" style="color: #001F3F;">Luxury Villa</span> listed</p>
                                    <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-100" aria-hidden="true"></span>
                            <div class="relative flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <span class="h-10 w-10 rounded-xl flex items-center justify-center ring-4 ring-white bg-emerald-500">
                                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm text-gray-800 font-medium">Agent <span class="font-bold" style="color: #001F3F;">Michael Obi</span> verified</p>
                                    <p class="text-xs text-gray-400 mt-1">4 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="relative">
                            <div class="relative flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <span class="h-10 w-10 rounded-xl flex items-center justify-center ring-4 ring-white bg-amber-500">
                                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm text-gray-800 font-medium">Report on <span class="font-bold" style="color: #001F3F;">John Doe</span> filed</p>
                                    <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Property Approvals Table + Newest Members Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
        <!-- Property Approvals -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4 class="text-lg font-bold" style="color: #001F3F;">Property Approvals</h4>
                        <p class="text-sm text-gray-500">Listings awaiting verification</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="background-color: #F8F9FC;">
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Property</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Agent</th>
                                <th class="px-4 py-3 text-right text-xs font-bold uppercase tracking-wider text-gray-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($pendingProperties as $property)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-12 w-16 rounded-lg overflow-hidden flex-shrink-0 border bg-gray-50">
                                            @if($property->featured_image)
                                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $property->featured_image) }}" alt="">
                                            @else
                                                <div class="h-full w-full flex items-center justify-center text-gray-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4 max-w-[200px]">
                                            <div class="text-sm font-semibold truncate text-[#001F3F]">{{ $property->title }}</div>
                                            <div class="text-xs text-gray-500 truncate">{{ $property->city }}, {{ $property->state }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $property->user->name }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right space-x-2">
                                    <form action="{{ route('admin.properties.verify', $property->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors" title="Approve">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors" title="Reject">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-gray-400 text-sm">
                                    No properties awaiting approval
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Newest Members Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 pb-0">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4 class="text-lg font-bold" style="color: #001F3F;">Newest Members</h4>
                        <p class="text-sm text-gray-500">Recent user registrations</p>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background-color: #F8F9FC;">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #001F3F;">User</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #001F3F;">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #001F3F;">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider" style="color: #001F3F;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($newestUsers as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-xl overflow-hidden shadow-sm border-2" style="border-color: rgba(198, 166, 100, 0.3);">
                                        @if($user->role === 'agent' && $user->agent_image)
                                            <img class="h-full w-full object-cover" src="{{ asset('storage/' . $user->agent_image) }}" alt="{{ $user->name }}">
                                        @elseif($user->google_avatar)
                                            <img class="h-full w-full object-cover" src="{{ $user->google_avatar }}" alt="{{ $user->name }}">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold" style="color: #001F3F;">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg" 
                                      style="{{ $user->role === 'agent' ? 'background: rgba(0, 31, 63, 0.08); color: #001F3F;' : 'background: #F3F4F6; color: #4B5563;' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->role === 'agent')
                                    @if($user->agent_verification_status === 'approved')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg bg-emerald-100 text-emerald-700">
                                            Verified
                                        </span>
                                    @elseif($user->agent_verification_status === 'rejected')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg bg-red-100 text-red-700">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg bg-amber-100 text-amber-700">
                                            Pending
                                        </span>
                                    @endif
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg bg-emerald-100 text-emerald-700">
                                        Active
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                @if($user->role === 'agent' && $user->agent_verification_status === 'pending')
                                    @if($user->agent_id_document)
                                        <a href="{{ asset('storage/' . $user->agent_id_document) }}" target="_blank" class="inline-flex items-center px-2 py-1 rounded bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors text-xs font-medium">
                                            View ID
                                        </a>
                                    @endif
                                    
                                    <div class="inline-flex space-x-1">
                                        <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="p-1 rounded bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors" title="Approve Agent">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="p-1 rounded bg-red-50 text-red-600 hover:bg-red-100 transition-colors" title="Reject Agent">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                
                                <a href="{{ route('admin.users.show', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Details</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Charts Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Line Chart — Platform Analytics
            const ctx = document.getElementById('userGrowthChart').getContext('2d');
            
            const gradient1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradient1.addColorStop(0, 'rgba(0, 31, 63, 0.15)');
            gradient1.addColorStop(1, 'rgba(0, 31, 63, 0.01)');

            const gradient2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradient2.addColorStop(0, 'rgba(198, 166, 100, 0.15)');
            gradient2.addColorStop(1, 'rgba(198, 166, 100, 0.01)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'New Users',
                        data: [120, 190, 150, 250, 220, 310],
                        backgroundColor: gradient1,
                        borderColor: '#001F3F',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#001F3F',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Properties',
                        data: [80, 160, 200, 180, 250, 220],
                        backgroundColor: gradient2,
                        borderColor: '#C6A664',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#C6A664',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0, 0, 0, 0.04)' },
                            ticks: { color: '#6B7280', font: { size: 12 } }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#6B7280', font: { size: 12 } }
                        }
                    }
                }
            });

            // Doughnut Chart — Property Distribution
            const dctx = document.getElementById('propertyDistChart').getContext('2d');
            new Chart(dctx, {
                type: 'doughnut',
                data: {
                    labels: ['Apartments', 'Houses', 'Land', 'Commercial'],
                    datasets: [{
                        data: [42, 28, 18, 12],
                        backgroundColor: ['#001F3F', '#C6A664', '#10B981', '#F59E0B'],
                        borderWidth: 0,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</x-admin-layout>
