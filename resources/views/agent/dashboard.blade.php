<x-agent-layout>
    <!-- Welcome Section with Profile -->
    <div class="relative overflow-hidden rounded-3xl p-8 mb-8 text-white shadow-2xl" style="background: linear-gradient(135deg, #001F3F 0%, #003366 100%);">
        <div class="absolute top-0 right-0 -mt-16 -mr-16 w-64 h-64 bg-[#C6A664] opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-64 h-64 bg-[#C6A664] opacity-5 rounded-full blur-3xl"></div>
        
        <div class="relative flex flex-col md:flex-row items-center justify-between z-10">
            <div class="flex items-center space-x-8 mb-6 md:mb-0">
                <div class="relative">
                    @if($user->agent_image)
                        <img src="{{ $user->agent_image_url }}" alt="{{ $user->name }}" class="w-28 h-28 rounded-2xl border-4 border-white/20 object-cover shadow-2xl">
                    @else
                        <div class="w-28 h-28 rounded-2xl border-4 border-white/20 bg-white/10 flex items-center justify-center shadow-2xl">
                            <svg class="w-14 h-14 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute -bottom-2 -right-2 p-1.5 rounded-lg border-2 border-[#001F3F] shadow-lg {{ $user->agent_verification_status === 'approved' ? 'bg-green-500' : ($user->agent_verification_status === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            @if($user->agent_verification_status === 'approved')
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            @elseif($user->agent_verification_status === 'pending')
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            @else
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            @endif
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-bold tracking-tight">Bonjour, {{ $user->name }}!</h2>
                    <div class="flex items-center mt-3 space-x-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 border border-white/20">
                            {{ $user->agent_verification_status ?? 'Member' }} Agent
                        </span>
                        @if($user->agent_phone)
                            <span class="flex items-center text-sm text-white/70">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ $user->agent_phone }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ route('agent.profile.edit') }}" class="inline-flex items-center px-6 py-3 bg-[#C6A664] text-[#001F3F] font-bold rounded-xl hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Profile
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-[#001F3F] group hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Properties</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProperties }}</h3>
                </div>
                <div class="p-3 rounded-xl bg-gray-50 text-[#001F3F] group-hover:bg-[#001F3F] group-hover:text-white transition-all duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-green-500 group hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Active Listings</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $approvedProperties }}</h3>
                </div>
                <div class="p-3 rounded-xl bg-gray-50 text-green-500 group-hover:bg-green-500 group-hover:text-white transition-all duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-yellow-500 group hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pending Review</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $pendingProperties }}</h3>
                </div>
                <div class="p-3 rounded-xl bg-gray-50 text-yellow-500 group-hover:bg-yellow-500 group-hover:text-white transition-all duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-[#C6A664] group hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">New Inquiries</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $newInquiries }}</h3>
                </div>
                <div class="p-3 rounded-xl bg-gray-50 text-[#C6A664] group-hover:bg-[#C6A664] group-hover:text-white transition-all duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Properties -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-8 py-6 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-800">My Recent Properties</h3>
                    <a href="{{ route('agent.properties.create') }}" class="inline-flex items-center px-4 py-2 bg-[#001F3F] text-white text-sm font-bold rounded-xl hover:shadow-lg transition-all duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Add New
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs font-bold uppercase tracking-wider text-gray-400 bg-gray-50/50">
                                <th class="px-8 py-4">Property</th>
                                <th class="px-8 py-4 text-center">Status</th>
                                <th class="px-8 py-4">Price</th>
                                <th class="px-8 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentProperties as $property)
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="h-12 w-16 rounded-xl overflow-hidden shadow-sm flex-shrink-0">
                                            @if($property->featured_image_url)
                                                <img class="h-full w-full object-cover" src="{{ $property->featured_image_url }}" alt="">
                                            @else
                                                <div class="h-full w-full bg-gray-100 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-bold text-gray-800 group-hover:text-[#C6A664] transition-colors">{{ $property->title }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $property->city }}, {{ $property->state }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($property->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-100 uppercase">Active</span>
                                    @elseif($property->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-100 uppercase">Pending</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-red-50 text-red-700 border border-red-100 uppercase">Rejected</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-bold text-gray-700">{{ $property->formatted_price }}</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('agent.properties.edit', $property->id) }}" class="p-2 rounded-lg bg-gray-50 text-gray-400 hover:bg-[#001F3F] hover:text-white transition-all duration-200 inline-flex items-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-20 h-20 rounded-full bg-gray-50 flex items-center justify-center text-gray-200 mb-4">
                                            <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </div>
                                        <p class="text-gray-400 font-medium">No properties yet.</p>
                                        <a href="{{ route('agent.properties.create') }}" class="mt-4 text-[#C6A664] font-bold hover:underline">+ Create Your First Listing</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Inquiries -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden h-full">
                <div class="flex items-center justify-between px-8 py-6 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-800">Recent Inquiries</h3>
                    <a href="{{ route('agent.inquiries.index') }}" class="text-sm font-bold text-[#C6A664] hover:text-[#001F3F] transition-colors">View All</a>
                </div>
                <div class="p-4 overflow-y-auto max-h-[600px]">
                    <div class="space-y-4">
                        @forelse($inquiries as $inquiry)
                        <div class="p-4 rounded-2xl border border-gray-50 hover:border-[#C6A664]/20 hover:bg-gray-50/50 transition-all duration-300 group">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-[#001F3F]/5 text-[#001F3F] flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($inquiry->guest_name, 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-bold text-gray-800 line-clamp-1">{{ $inquiry->guest_name }}</p>
                                        <p class="text-[10px] text-gray-400">{{ $inquiry->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @if($inquiry->status === 'new')
                                    <span class="w-2 h-2 rounded-full bg-[#C6A664] shadow-[0_0_8px_rgba(198,166,100,0.8)] animate-pulse"></span>
                                @endif
                            </div>
                            <p class="text-xs font-bold text-gray-500 line-clamp-1 italic">Re: {{ $inquiry->property->title }}</p>
                            <p class="text-xs text-gray-500 mt-2 line-clamp-2 leading-relaxed">{{ $inquiry->message }}</p>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <p class="text-gray-400 text-sm">No recent inquiries.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-agent-layout>
