<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500 font-medium">Home</a></li>
                    <li><svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li><a href="{{ route('agents.index') }}" class="text-gray-400 hover:text-gray-500 font-medium">Agents</a></li>
                    <li><svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-[#001F3F] font-bold">{{ $agent->name }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar Profile Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 sticky top-8">
                        <div class="relative h-48 bg-[#001F3F]">
                            <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                                <div class="w-32 h-32 rounded-3xl border-4 border-white shadow-lg overflow-hidden bg-gray-100">
                                    <img src="{{ $agent->agent_image_url ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                                         alt="{{ $agent->name }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                        <div class="pt-16 pb-8 px-6 text-center">
                            <h2 class="text-2xl font-bold text-[#001F3F] mb-1">{{ $agent->name }}</h2>
                            <p class="text-sm font-medium text-[#C6A664] mb-4 uppercase tracking-wider">Licensed Agent</p>
                            
                            <!-- Rating -->
                            <div class="flex items-center justify-center mb-6">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= round($agent->average_rating) ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm font-bold text-[#001F3F]">{{ number_format($agent->average_rating, 1) }}</span>
                                <span class="ml-1 text-xs text-gray-500">({{ $agent->reviewsAsAgent()->count() }} reviews)</span>
                            </div>

                            <div class="space-y-3 mb-8">
                                @if($agent->agent_phone)
                                    <a href="tel:{{ $agent->agent_phone }}" class="flex items-center justify-center p-3 rounded-2xl bg-gray-50 text-gray-700 hover:bg-[#001F3F] hover:text-white transition-all duration-300 group">
                                        <svg class="w-5 h-5 mr-3 text-[#C6A664] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        <span class="text-sm font-semibold">Call Agent</span>
                                    </a>
                                @endif
                                @if($agent->agent_whatsapp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->agent_whatsapp) }}" target="_blank" class="flex items-center justify-center p-3 rounded-2xl bg-green-50 text-green-700 hover:bg-[#25D366] hover:text-white transition-all duration-300 group">
                                        <svg class="w-5 h-5 mr-3 text-[#25D366] group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                        <span class="text-sm font-semibold">WhatsApp Chat</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Bio & Stats -->
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 p-8 mb-8">
                        <div class="flex flex-wrap items-center justify-between mb-8 gap-4">
                            <h3 class="text-2xl font-bold text-[#001F3F]">About Agent</h3>
                            <div class="flex gap-4">
                                <div class="px-6 py-3 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                                    <div class="text-lg font-bold text-[#001F3F]">{{ $agent->properties->count() }}</div>
                                    <div class="text-xs text-gray-500 uppercase font-bold tracking-widest">Listings</div>
                                </div>
                                <div class="px-6 py-3 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                                    <div class="text-lg font-bold text-[#001F3F]">{{ $agent->experience_years ?? rand(5, 12) }}+</div>
                                    <div class="text-xs text-gray-500 uppercase font-bold tracking-widest">Years Exp.</div>
                                </div>
                            </div>
                        </div>
                        <div class="prose max-w-none text-gray-600 leading-relaxed mb-8">
                            {{ $agent->bio ?? 'Dedicated and experienced real estate professional committed to providing exceptional service. With deep knowledge of the local market and a focus on client satisfaction, I help buyers find their dream homes and sellers achieve top market value.' }}
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($agent->specialties)
                                <div>
                                    <h4 class="text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">Specialties</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $agent->specialties) as $specialty)
                                            <span class="px-3 py-1 bg-gray-100 text-[#001F3F] text-xs font-bold rounded-full">{{ trim($specialty) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if($agent->license_number)
                                <div>
                                    <h4 class="text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">Professional Credentials</h4>
                                    <div class="flex items-center text-gray-600 text-sm">
                                        <svg class="w-4 h-4 mr-2 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        License Registry: {{ $agent->license_number }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Listings -->
                    @if($recentProperties->count() > 0)
                        <div class="mb-12">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-2xl font-bold text-[#001F3F]">Recent Listings</h3>
                                <a href="{{ route('properties.index') }}?agent={{ $agent->id }}" class="text-sm font-bold text-[#C6A664] hover:underline">View All</a>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($recentProperties as $property)
                                    <x-property-card :property="$property" />
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Reviews Section -->
                    <div id="reviews" class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-2xl font-bold text-[#001F3F]">Client Reviews</h3>
                            @auth
                                <button onclick="document.getElementById('reviewForm').scrollIntoView({behavior: 'smooth'})" class="text-sm font-bold text-[#C6A664] hover:underline">Write a Review</button>
                            @endauth
                        </div>

                        <!-- Review List -->
                        <div class="space-y-8 mb-12">
                            @forelse($reviews as $review)
                                <div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-[#001F3F] font-bold">
                                                {{ substr($review->reviewer->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="text-sm font-bold text-[#001F3F]">{{ $review->reviewer->name }}</h4>
                                                <p class="text-xs text-gray-400">{{ $review->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-gray-600 text-sm italic leading-relaxed">
                                        {{ $review->comment }}
                                    </p>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="w-12 h-12 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                    <p class="text-gray-400 font-medium">No reviews yet. Be the first to share your experience!</p>
                                </div>
                            @endforelse
                        </div>

                        {{ $reviews->links() }}

                        <!-- Review Form -->
                        @auth
                            @if(auth()->user()->id !== $agent->id)
                                <div id="reviewForm" class="mt-8 pt-8 border-t border-gray-100">
                                    <h4 class="text-lg font-bold text-[#001F3F] mb-6">Leave a Review</h4>
                                    
                                    @if(session('success'))
                                        <div class="p-4 mb-6 bg-green-50 border border-green-100 text-green-700 rounded-2xl text-sm font-medium">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if(session('error'))
                                        <div class="p-4 mb-6 bg-red-50 border border-red-100 text-red-700 rounded-2xl text-sm font-medium">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
                                        @csrf
                                        <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                                        
                                        <div x-data="{ rating: 0 }">
                                            <label class="block text-sm font-bold text-[#001F3F] mb-3 uppercase tracking-widest">Your Rating</label>
                                            <div class="flex gap-2">
                                                <template x-for="i in 5">
                                                    <button type="button" @click="rating = i" class="outline-none transition-transform duration-200 hover:scale-110">
                                                        <svg class="w-8 h-8 cursor-pointer" :class="i <= rating ? 'text-yellow-400 fill-current' : 'text-gray-200 fill-current'" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    </button>
                                                </template>
                                                <input type="hidden" name="rating" :value="rating" required>
                                            </div>
                                            @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-bold text-[#001F3F] mb-3 uppercase tracking-widest">Share Your Experience</label>
                                            <textarea name="comment" rows="5" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] transition-all duration-300 outline-none placeholder-gray-400" placeholder="Tell us about the service you received..."></textarea>
                                            @error('comment') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        <button type="submit" class="inline-flex items-center px-8 py-4 bg-[#001F3F] text-white font-bold rounded-2xl hover:bg-[#C6A664] transition-all duration-300 transform hover:scale-[1.02] shadow-xl">
                                            Submit Review
                                            <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @else
                            <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                                <p class="text-gray-400 text-sm mb-4">Please log in to leave a review</p>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-2 border-2 border-[#001F3F] text-[#001F3F] font-bold rounded-xl hover:bg-[#001F3F] hover:text-white transition-all duration-300">Login to Rate</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
