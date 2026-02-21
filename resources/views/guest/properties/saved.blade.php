<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-[#001F3F] tracking-tight">Saved Properties</h1>
                    <p class="mt-2 text-gray-500 font-medium">Manage your favorite listings and tracks changes.</p>
                </div>
                <div class="bg-white p-2 rounded-xl border-2 border-[#C6A664]/20 shadow-sm">
                    <span class="px-4 py-1.5 bg-[#001F3F] text-white text-xs font-bold rounded-lg uppercase tracking-widest">
                        {{ $savedProperties->total() }} Total
                    </span>
                </div>
            </div>

            @if($savedProperties->isEmpty())
                <div class="bg-white rounded-3xl p-16 text-center shadow-xl border border-gray-100 max-w-2xl mx-auto">
                    <div class="w-24 h-24 bg-[#C6A664]/10 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-12 h-12 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-[#001F3F] mb-4">No saved properties yet</h2>
                    <p class="text-gray-500 mb-8 max-w-sm mx-auto font-medium">Browse our property listings and click the heart icon to save them for later.</p>
                    <a href="{{ route('properties.index') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-[#001F3F] text-white font-bold rounded-2xl hover:bg-[#00152B] transition-all duration-300 shadow-lg hover:shadow-[#001F3F]/20 transform hover:-translate-y-1">
                        Explore Properties
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($savedProperties as $saved)
                        @php $property = $saved->property; @endphp
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full transform hover:-translate-y-2">
                            <!-- Image Container -->
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img src="{{ $property->images->first()->image_path ?? asset('images/placeholder-property.jpg') }}" 
                                     alt="{{ $property->title }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                
                                <!-- Status Badges -->
                                <div class="absolute top-4 left-4 flex flex-col gap-2">
                                    <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-[#001F3F] text-[10px] font-bold rounded-lg uppercase tracking-widest shadow-lg">
                                        {{ str_replace('_', ' ', $property->category) }}
                                    </span>
                                </div>

                                <!-- Unsave Button -->
                                <form action="{{ route('properties.save', $property->id) }}" method="POST" class="absolute top-4 right-4">
                                    @csrf
                                    <button type="submit" class="p-3 bg-white/90 backdrop-blur-md rounded-2xl text-red-500 hover:bg-red-50 to-white transition-all shadow-lg hover:scale-110">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </button>
                                </form>

                                <!-- Price Overlay -->
                                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/80 to-transparent">
                                    <p class="text-white text-2xl font-black">
                                        ₦{{ number_format($property->price) }}
                                        <span class="text-sm font-medium text-white/70">/ {{ $property->category == 'house_rental' ? 'year' : 'total' }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="mb-4">
                                    <h3 class="text-xl font-bold text-[#001F3F] line-clamp-1 group-hover:text-[#C6A664] transition-colors">{{ $property->title }}</h3>
                                    <p class="text-gray-500 flex items-center mt-2 text-sm font-medium">
                                        <svg class="w-4 h-4 mr-1 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.922A2 2 0 0111.172 20.922L6.929 16.657m11.086 0A8 8 0 104.343 4.343m13.714 8.286c0-1.104-.224-2.144-.648-3.09"/>
                                        </svg>
                                        {{ $property->city }}, {{ $property->state }}
                                    </p>
                                </div>

                                <!-- Features -->
                                <div class="flex items-center justify-between py-4 border-y border-gray-50 mb-6">
                                    <div class="flex flex-col items-center">
                                        <span class="text-[#001F3F] font-black">{{ $property->bedrooms }}</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Beds</span>
                                    </div>
                                    <div class="w-px h-6 bg-gray-100"></div>
                                    <div class="flex flex-col items-center">
                                        <span class="text-[#001F3F] font-black">{{ $property->bathrooms }}</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Baths</span>
                                    </div>
                                    <div class="w-px h-6 bg-gray-100"></div>
                                    <div class="flex flex-col items-center">
                                        <span class="text-[#001F3F] font-black">{{ $property->toilets }}</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Toilets</span>
                                    </div>
                                </div>

                                <!-- Action -->
                                <div class="mt-auto pt-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-[#001F3F] flex items-center justify-center text-white text-[10px] font-bold">
                                            {{ strtoupper(substr($property->user->name, 0, 1)) }}
                                        </div>
                                        <span class="ml-2 text-xs font-bold text-gray-600 truncate max-w-[100px]">{{ $property->user->name }}</span>
                                    </div>
                                    <a href="{{ route('properties.show', $property->id) }}" 
                                       class="px-5 py-2.5 bg-[#C6A664]/10 text-[#C6A664] text-xs font-bold rounded-xl hover:bg-[#C6A664] hover:text-white transition-all duration-300">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $savedProperties->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
