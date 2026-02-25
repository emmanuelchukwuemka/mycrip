<x-agent-layout>
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Property</h1>
                <p class="text-gray-600 mt-2">Update your property listing details and media</p>
            </div>
            <a href="{{ route('agent.properties.index') }}" 
                class="inline-flex items-center px-6 py-3 border border-gray-200 text-gray-500 bg-white rounded-xl hover:bg-gray-50 transition-all duration-200 shadow-sm font-bold text-xs uppercase tracking-wider">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Listings
            </a>
        </div>

        <!-- Error/Success Messages -->
        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 px-6 py-4 rounded-xl shadow-sm mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-sm mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-sm mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <ul class="list-disc list-inside text-sm font-medium">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-8" style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%);">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-white/10 rounded-2xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white text-2xl font-bold tracking-tight">Modify Listing</h2>
                        <p class="text-gray-300 text-sm mt-1">Review and update your property details</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('agent.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-12" x-data="{ 
                    category: '{{ old('category', $property->category) }}',
                    priceType: '{{ old('price_type', $property->price_type) }}'
                }">
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <span class="flex items-center tracking-wide uppercase text-xs text-gray-400 mb-1">
                                    General Info
                                </span>
                                Property Title
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}"
                                class="w-full px-5 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-300 placeholder-gray-400 outline-none shadow-sm"
                                placeholder="e.g. Modern 3 Bedroom Flat with Balcony" required>
                        </div>

                        <!-- Custom Category Choice Grid -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Property Category</label>
                            <input type="hidden" name="category" :value="category" required>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach([
                                    'house_rental' => ['label' => 'House Rental', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                                    'house_purchase' => ['label' => 'House Sales', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    'land_purchase' => ['label' => 'Land Sales', 'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
                                    'shop_rental' => ['label' => 'Commercial', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                                    'student_lodge' => ['label' => 'Student Lodge', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253']
                                ] as $value => $data)
                                    <button type="button" 
                                        @click="category = '{{ $value }}'"
                                        :class="category === '{{ $value }}' ? 'border-[#C6A664] bg-[#C6A664]/5 shadow-sm ring-1 ring-[#C6A664]' : 'border-gray-100 bg-white hover:border-[#C6A664]/30 hover:bg-gray-50'"
                                        class="flex flex-col items-center justify-center p-4 rounded-2xl border-2 transition-all duration-300 group">
                                        <div :class="category === '{{ $value }}' ? 'text-[#C6A664]' : 'text-gray-400 group-hover:text-[#001F3F]'"
                                            class="p-2 mb-2 transition-colors duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $data['icon'] }}" />
                                            </svg>
                                        </div>
                                        <span :class="category === '{{ $value }}' ? 'text-[#001F3F] font-bold' : 'text-gray-600 font-medium text-xs'"
                                            class="text-xs text-center transition-colors duration-300">
                                            {{ $data['label'] }}
                                        </span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Custom Price Type Toggle -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Price Type / Payment Frequency</label>
                            <input type="hidden" name="price_type" :value="priceType">
                            <div class="flex p-1.5 bg-gray-100 rounded-2xl w-full max-w-md shadow-inner border border-gray-200">
                                @foreach(['fixed' => 'Fixed Price', 'monthly' => 'Per Month', 'yearly' => 'Per Year'] as $value => $label)
                                    <button type="button" 
                                        @click="priceType = '{{ $value }}'"
                                        :class="priceType === '{{ $value }}' ? 'bg-[#001F3F] text-white shadow-lg' : 'text-gray-500 hover:text-[#001F3F]'"
                                        class="flex-1 py-2.5 px-4 rounded-xl text-xs font-bold transition-all duration-300 outline-none">
                                        {{ $label }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Listing Price (₦)
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                    <span class="text-[#C6A664] font-bold text-xl">₦</span>
                                </div>
                                <input type="number" name="price" id="price" value="{{ old('price', $property->price) }}"
                                    class="w-full pl-14 pr-5 py-5 border-2 border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-300 placeholder-gray-400 outline-none font-bold text-2xl text-gray-900 bg-white shadow-inner"
                                    placeholder="0" step="0.01" required>
                            </div>
                        </div>

                        <div x-data="{ aiModalOpen: false, keywords: '', categories: [], location: '', loading: false }">
                            <div class="flex items-center justify-between mb-3">
                                <label class="block text-sm font-semibold text-gray-700">Description</label>
                                <button type="button" @click="aiModalOpen = true" 
                                        class="flex items-center text-xs font-bold text-[#001F3F] hover:text-[#C6A664] transition-colors bg-[#C6A664]/10 px-3 py-1.5 rounded-lg border border-[#C6A664]/20">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Refine with AI
                                </button>
                            </div>
                            <textarea name="description" id="description" rows="6"
                                class="w-full px-5 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-300 placeholder-gray-400 resize-none outline-none shadow-sm"
                                placeholder="Describe the property..." required>{{ old('description', $property->description) }}</textarea>

                            <!-- AI Modal -->
                            <div x-show="aiModalOpen" 
                                 class="fixed inset-0 z-[60] overflow-y-auto" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 style="display: none;">
                                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" @click="aiModalOpen = false"></div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                    
                                    <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-[40px] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                                        <div class="px-8 pt-8 pb-6 bg-[#001F3F]">
                                            <div class="flex items-center space-x-4">
                                                <div class="p-3 bg-[#C6A664] rounded-2xl">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-xl font-bold text-white">AI Assistant</h3>
                                                    <p class="text-gray-300 text-xs">Instantly generate a premium property description</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-8 space-y-6">
                                            <div>
                                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Key Features (comma separated)</label>
                                                <input type="text" x-model="keywords" placeholder="e.g. pool, modern kitchen, marble floors, sea view"
                                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all text-sm">
                                            </div>

                                            <div class="flex flex-col gap-3">
                                                <button type="button" 
                                                        @click="
                                                            loading = true;
                                                            fetch('{{ route('agent.ai.generate') }}', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                                },
                                                                body: JSON.stringify({
                                                                    keywords: keywords,
                                                                    category: category,
                                                                    location: city.value + ', ' + state.value
                                                                })
                                                            })
                                                            .then(res => res.json())
                                                            .then(data => {
                                                                if(data.success) {
                                                                    document.getElementById('description').value = data.description;
                                                                    aiModalOpen = false;
                                                                }
                                                            })
                                                            .finally(() => loading = false);
                                                        "
                                                        :disabled="loading || !keywords"
                                                        class="w-full py-4 bg-[#001F3F] text-white font-bold rounded-2xl hover:bg-[#C6A664] transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center">
                                                    <template x-if="!loading">
                                                        <span>Generate Description</span>
                                                    </template>
                                                    <template x-if="loading">
                                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </template>
                                                </button>
                                                <button type="button" @click="aiModalOpen = false" class="w-full py-4 text-gray-400 font-bold text-sm hover:text-gray-600 transition-colors">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Virtual Tours & Video Section -->
                        <div class="pt-6 space-y-6">
                            <h4 class="text-sm font-bold text-[#001F3F] uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-2 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                Virtual Tours & Video
                            </h4>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Video Walkthrough URL (YouTube/Vimeo)</label>
                                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $property->video_url) }}"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-300 placeholder-gray-400 outline-none shadow-sm"
                                        placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">360° Virtual Tour URL</label>
                                    <input type="url" name="virtual_tour_url" id="virtual_tour_url" value="{{ old('virtual_tour_url', $property->virtual_tour_url) }}"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-300 placeholder-gray-400 outline-none shadow-sm"
                                        placeholder="https://my.matterport.com/show/?m=...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Media Management -->
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-5">
                                <span class="flex items-center tracking-wide uppercase text-xs text-gray-400 mb-1">
                                    Existing Media
                                </span>
                                Manage Images
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
                                @foreach($property->images as $image)
                                    <div class="relative group aspect-square rounded-2xl overflow-hidden border-2 border-gray-100">
                                        <img src="{{ $image->image_url }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center space-x-2">
                                            <form action="{{ route('agent.properties.images.delete', [$property->id, $image->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200" title="Delete Image">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Add New Images</label>
                            <div class="group relative border-4 border-dashed border-gray-100 rounded-3xl p-8 text-center hover:border-[#C6A664]/30 hover:bg-gray-50/50 transition-all duration-300 font-bold">
                                <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*">
                                <label for="images" class="cursor-pointer">
                                    <div class="text-center">
                                        <div class="mx-auto w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                            <svg class="h-8 w-8 text-gray-300 group-hover:text-[#C6A664]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <span class="text-[#001F3F]">Click to add more images</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Section -->
                <div class="border-t border-gray-100 pt-10 mb-10">
                    <h3 class="text-xl font-bold text-[#001F3F] mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-[#001F3F]/5 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                        </span>
                        Location Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Country</label>
                            <input type="text" name="country" id="country" value="{{ old('country', $property->country) }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">State <span class="text-red-500">*</span></label>
                            <input type="text" name="state" id="state" value="{{ old('state', $property->state) }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none placeholder-gray-400" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" id="city" value="{{ old('city', $property->city) }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none placeholder-gray-400" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $property->address) }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none placeholder-gray-400">
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="border-t border-gray-100 pt-10 mb-12">
                     <h3 class="text-xl font-bold text-[#001F3F] mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-[#001F3F]/5 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </span>
                        Property Features
                    </h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Bedrooms</label>
                            <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Bathrooms</label>
                            <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Toilets</label>
                            <input type="number" name="toilets" value="{{ old('toilets', $property->toilets) }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Size (sqm)</label>
                            <input type="text" name="size" value="{{ old('size', $property->size) }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none">
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="bg-gray-50/50 rounded-3xl p-8">
                        <label class="block text-sm font-bold text-[#001F3F] mb-6 uppercase tracking-wider">Amenities & Services</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-8">
                            @foreach([
                                'furnished' => 'Furnished',
                                'serviced' => 'Serviced',
                                'parking' => 'Parking Space',
                                'security' => '24/7 Security',
                                'water_supply' => 'Water Supply',
                                'power_supply' => 'Constant Power'
                            ] as $field => $label)
                                <label class="flex items-center space-x-4 cursor-pointer group">
                                    <div class="relative">
                                        <input type="checkbox" name="{{ $field }}" value="1" {{ old($field, $property->$field) ? 'checked' : '' }} 
                                            class="peer h-6 w-6 border-2 border-gray-300 rounded-lg text-[#C6A664] focus:ring-0 transition-colors duration-200">
                                        <div class="absolute inset-0 bg-[#C6A664] scale-0 peer-checked:scale-100 rounded-lg transition-transform duration-200 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-600 group-hover:text-[#001F3F] transition-colors duration-200">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-100 pt-10">
                    <button type="button" onclick="window.history.back()"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-200 text-gray-500 font-bold rounded-2xl hover:bg-gray-50 transition-all duration-200">
                        Discard Changes
                    </button>
                    
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-12 py-4 text-white font-bold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-[#C6A664]/20" style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%); border-bottom: 4px solid #C6A664;">
                        Update Property Listing
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-agent-layout>
