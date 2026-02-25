<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Hero Section -->
        <div class="bg-[#001F3F] py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6">The Buyer Wall</h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto italic">Buyers tell us what they want, and verified agents find the perfect match. Browse active requests below.</p>
                
                @auth
                    <div class="mt-10">
                        <a href="{{ route('requests.create') }}" class="px-8 py-4 bg-[#C6A664] text-white font-bold rounded-2xl hover:bg-[#B59553] transition-all duration-300 shadow-xl inline-block">
                            Post Your Property Request
                        </a>
                    </div>
                @else
                    <div class="mt-10">
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-[#C6A664] text-white font-bold rounded-2xl hover:bg-[#B59553] transition-all duration-300 shadow-xl inline-block">
                            Login to Post a Request
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-8">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Requests Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-[#001F3F]">Active Requests</h2>
                    <p class="text-gray-500">Helping buyers and agents connect faster.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($requests as $req)
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 group relative flex flex-col h-full">
                        <div class="flex items-center justify-between mb-6">
                            <span class="px-3 py-1 bg-gray-50 text-[#001F3F] text-[10px] font-bold rounded-full uppercase tracking-widest border border-gray-100">
                                {{ ucfirst($req->category) }}
                            </span>
                            <span class="text-xs font-bold text-gray-400 italic">
                                {{ $req->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-[#001F3F] mb-2 leading-tight group-hover:text-[#C6A664] transition-colors">
                            Looking for {{ $req->category }} in {{ $req->location }}
                        </h3>

                        <div class="flex gap-4 mb-6 text-sm font-semibold text-gray-500">
                            @if($req->min_price || $req->max_price)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @if($req->min_price && $req->max_price)
                                        ₦{{ number_format($req->min_price/1000000, 1) }}M - {{ number_format($req->max_price/1000000, 1) }}M
                                    @elseif($req->max_price)
                                        Under ₦{{ number_format($req->max_price/1000000, 1) }}M
                                    @else
                                        Above ₦{{ number_format($req->min_price/1000000, 1) }}M
                                    @endif
                                </div>
                            @endif

                            @if($req->bedrooms)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    {{ $req->bedrooms }}+ Bed
                                </div>
                            @endif
                        </div>

                        <div class="text-gray-600 text-sm line-clamp-4 leading-relaxed bg-gray-50/50 p-4 rounded-2xl mb-8 flex-grow">
                            "{{ $req->description }}"
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-[#001F3F] flex items-center justify-center text-white text-[10px] font-bold mr-3 shadow-sm">
                                    {{ strtoupper(substr($req->user->name, 0, 1)) }}
                                </div>
                                <span class="text-xs font-bold text-[#001F3F]">{{ $req->user->name }}</span>
                            </div>

                            @if(auth()->check() && auth()->user()->role === 'agent')
                                <a href="{{ route('chat.start', ['property_id' => null, 'agent_id' => auth()->id(), 'user_id' => $req->user_id]) }}" 
                                   class="text-[10px] font-extrabold text-[#C6A664] uppercase tracking-tighter hover:underline flex items-center">
                                    Contact Buyer
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-gray-50 rounded-[40px] text-center">
                        <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-gray-100">
                            <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-[#001F3F] mb-2">The wall is empty!</h3>
                        <p class="text-gray-500 max-w-sm mx-auto">Be the first to post a request and let our agents find your dream property.</p>
                        @auth
                            <a href="{{ route('requests.create') }}" class="mt-8 px-6 py-3 bg-[#001F3F] text-white font-bold rounded-xl hover:bg-[#C6A664] transition-all duration-300 inline-block">Post Initial Request</a>
                        @endauth
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $requests->links() }}
            </div>
        </div>

        <!-- How it works -->
        <div class="bg-[#F8F9FA] py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-3xl font-bold text-[#001F3F] mb-4">How the Buyer Wall Works</h2>
                    <p class="text-gray-500 italic max-w-xl mx-auto">Connecting demand with supply in three simple steps.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-xl group-hover:scale-110 transition-transform duration-500 border border-gray-100">
                            <span class="text-4xl font-black text-[#C6A664]/20 absolute opacity-30 select-none">01</span>
                            <svg class="w-8 h-8 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <h4 class="text-xl font-bold text-[#001F3F] mb-4">Post Your Request</h4>
                        <p class="text-gray-500 leading-relaxed text-sm">Describe what you're looking for (location, budget, type) concisely.</p>
                    </div>

                    <div class="text-center group">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-xl group-hover:scale-110 transition-transform duration-500 border border-gray-100">
                            <span class="text-4xl font-black text-[#C6A664]/20 absolute opacity-30 select-none">02</span>
                            <svg class="w-8 h-8 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h4 class="text-xl font-bold text-[#001F3F] mb-4">Agents Filter Needs</h4>
                        <p class="text-gray-500 leading-relaxed text-sm">Verified agents browse the wall to find requests that match their current stock.</p>
                    </div>

                    <div class="text-center group">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-xl group-hover:scale-110 transition-transform duration-500 border border-gray-100">
                            <span class="text-4xl font-black text-[#C6A664]/20 absolute opacity-30 select-none">03</span>
                            <svg class="w-8 h-8 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <h4 class="text-xl font-bold text-[#001F3F] mb-4">Direct Connection</h4>
                        <p class="text-gray-500 leading-relaxed text-sm">Agents contact you directly via our secure chat system to present offers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
