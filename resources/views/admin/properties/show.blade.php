<x-admin-layout>
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('admin.properties.index') }}" class="text-gray-500 hover:text-[#001F3F] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <span class="text-sm text-gray-400">Back to Listings</span>
            </div>
            <h2 class="text-3xl font-bold" style="color: #001F3F;">{{ $property->title }}</h2>
            <p class="text-gray-500 mt-1 flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $property->address ?? $property->city . ', ' . $property->state }}
            </p>
        </div>

        @if($property->status === 'pending')
        <div class="mt-6 md:mt-0 flex items-center space-x-3">
            <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-2.5 rounded-xl border-2 border-red-100 text-red-600 font-bold hover:bg-red-50 transition-all font-medium">
                    Reject Listing
                </button>
            </form>
            <form action="{{ route('admin.properties.verify', $property->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-8 py-2.5 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">
                    Approve & Go Live
                </button>
            </form>
        </div>
        @else
        <div class="mt-6 md:mt-0">
            @if($property->status === 'approved')
                <span class="px-4 py-2 rounded-xl bg-emerald-100 text-emerald-700 font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Approved & Published
                </span>
            @else
                <span class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Rejected
                </span>
            @endif
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content (Left) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Image Gallery -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <h4 class="text-lg font-bold mb-4" style="color: #001F3F;">Property Gallery</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($property->images as $image)
                    <div class="aspect-video rounded-2xl overflow-hidden border">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover" alt="">
                    </div>
                    @empty
                    <div class="col-span-2 py-12 flex flex-col items-center justify-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-gray-400 font-medium">No images uploaded for this listing</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Details -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h4 class="text-xl font-bold mb-6" style="color: #001F3F;">Listing Details</h4>
                <p class="text-gray-600 leading-relaxed mb-8 whitespace-pre-line">{{ $property->description }}</p>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Bedrooms</span>
                        <p class="text-xl font-bold text-[#001F3F] mt-1">{{ $property->bedrooms ?? 'N/A' }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Bathrooms</span>
                        <p class="text-xl font-bold text-[#001F3F] mt-1">{{ $property->bathrooms ?? 'N/A' }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Toilets</span>
                        <p class="text-xl font-bold text-[#001F3F] mt-1">{{ $property->toilets ?? 'N/A' }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Size</span>
                        <p class="text-sm font-bold text-[#001F3F] mt-1 truncate">{{ $property->size ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Features/Amenities -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h4 class="text-xl font-bold mb-6" style="color: #001F3F;">Amenities & Features</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
                    @foreach([
                        ['label' => 'Furnished', 'value' => $property->furnished],
                        ['label' => 'Serviced', 'value' => $property->serviced],
                        ['label' => 'Parking', 'value' => $property->parking],
                        ['label' => 'Security', 'value' => $property->security],
                        ['label' => 'Water Supply', 'value' => $property->water_supply],
                        ['label' => 'Power Supply', 'value' => $property->power_supply],
                    ] as $feature)
                        <div class="flex items-center space-x-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center {{ $feature['value'] ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-400' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['value'] ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}"/></svg>
                            </span>
                            <span class="text-gray-700 font-medium">{{ $feature['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar Details (Right) -->
        <div class="space-y-8">
            <!-- Price Card -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-[#C6A664]/5 -mr-8 -mt-8 rounded-full"></div>
                <span class="text-xs text-gray-400 uppercase font-bold tracking-widest">Listing Price</span>
                <div class="text-4xl font-extrabold text-[#001F3F] mt-2 mb-1">
                    {{ $property->formatted_price }}
                </div>
                <div class="text-sm text-gray-400">
                    Category: <span class="capitalize font-bold text-gray-600">{{ str_replace('_', ' ', $property->category) }}</span>
                </div>
            </div>

            <!-- Agent Info -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h4 class="text-lg font-bold mb-6" style="color: #001F3F;">Listing Agent</h4>
                <div class="flex items-center mb-6">
                    <div class="h-16 w-16 rounded-2xl overflow-hidden border-2 p-0.5" style="border-color: #C6A664;">
                        @if($property->user->agent_image)
                            <img src="{{ asset('storage/' . $property->user->agent_image) }}" class="h-full w-full object-cover rounded-xl" alt="">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="ml-4">
                        <div class="text-lg font-bold text-[#001F3F]">{{ $property->user->name }}</div>
                        <div class="text-sm text-emerald-600 font-semibold flex items-center mt-0.5">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.633.304 1.225.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                            Verified Agent
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between text-sm py-3 border-b border-gray-50">
                        <span class="text-gray-400">Email</span>
                        <span class="font-semibold text-gray-700">{{ $property->user->email }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm py-3 border-b border-gray-50">
                        <span class="text-gray-400">ID Number</span>
                        <span class="font-semibold text-gray-700">{{ $property->user->agent_id_number ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm py-3">
                        <span class="text-gray-400">Phone</span>
                        <span class="font-semibold text-gray-700">{{ $property->user->agent_phone ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
