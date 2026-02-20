<x-agent-layout>
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Upload New Property</h1>
            <p class="text-gray-600 mt-2">Add your property listing with all the essential details</p>
        </div>

        <!-- Error/Success Messages -->
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white text-2xl font-bold tracking-tight">Property Details</h2>
                        <p class="text-gray-300 text-sm mt-1">Fill in all the information to create a compelling listing</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('agent.properties.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <!-- Basic Information Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-12" x-data="{ 
                    category: '{{ old('category', '') }}',
                    priceType: '{{ old('price_type', 'fixed') }}'
                }">
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <span class="flex items-center tracking-wide uppercase text-xs text-gray-400 mb-1">
                                    General Info
                                </span>
                                Property Title
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
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
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="w-full pl-14 pr-5 py-5 border-2 border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-300 placeholder-gray-400 outline-none font-bold text-2xl text-[#001F3F] bg-gray-50/30"
                                    placeholder="0" min="0" step="0.01" required>
                                <div class="absolute right-5 inset-y-0 flex items-center">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest bg-white px-3 py-1 rounded-lg border border-gray-100" x-text="priceType === 'fixed' ? 'Total' : (priceType === 'monthly' ? '/ Month' : '/ Year')"></span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Description</label>
                            <textarea name="description" id="description" rows="6"
                                class="w-full px-5 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-300 placeholder-gray-400 resize-none outline-none shadow-sm"
                                placeholder="Describe the property, its features, neighborhood, and any other important details..." required>{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Property Images -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center tracking-wide uppercase text-xs text-gray-400 mb-1">
                                Media Selection
                            </span>
                            Property Images <span class="text-red-500">*</span>
                        </label>
                        
                        <div class="group relative border-4 border-dashed border-gray-100 rounded-3xl p-8 text-center hover:border-[#C6A664]/30 hover:bg-gray-50/50 transition-all duration-300">
                            <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*" data-max-files="10">
                            <label for="images" class="cursor-pointer">
                                <div class="text-center">
                                    <div class="mx-auto w-20 h-20 bg-gray-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="h-10 w-10 text-gray-300 group-hover:text-[#C6A664]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <span class="font-bold text-[#001F3F] hover:text-[#C6A664]">Click to upload</span> or drag and drop
                                    </div>
                                    <p class="text-xs text-gray-400 mt-2 font-medium">PNG, JPG, JPEG, WEBP up to 5MB each</p>
                                    <p class="text-xs text-[#C6A664] mt-2 font-bold bg-[#C6A664]/10 inline-block px-3 py-1 rounded-full" id="file-count">No files selected</p>
                                </div>
                            </label>
                        </div>
                        <div id="image-preview" class="mt-6 grid grid-cols-4 gap-4"></div>
                    </div>
                </div>

                <!-- Location Section -->
                <div class="border-t border-gray-100 pt-10 mb-10">
                    <h3 class="text-xl font-bold text-[#001F3F] mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-[#001F3F]/5 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        Location Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Country</label>
                            <input type="text" name="country" id="country" value="{{ old('country', 'Nigeria') }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">State <span class="text-red-500">*</span></label>
                            <input type="text" name="state" id="state" value="{{ old('state') }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none placeholder-gray-400"
                                placeholder="e.g. Lagos" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none placeholder-gray-400"
                                placeholder="e.g. Lekki" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none placeholder-gray-400"
                                placeholder="Street name and number">
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
                            <input type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms') }}" min="0" max="20"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none"
                                placeholder="0">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Bathrooms</label>
                            <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') }}" min="0" max="20"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none"
                                placeholder="0">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Toilets</label>
                            <input type="number" name="toilets" id="toilets" value="{{ old('toilets') }}" min="0" max="20"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none"
                                placeholder="0">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Size (sqm)</label>
                            <input type="text" name="size" id="size" value="{{ old('size') }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#C6A664]/20 focus:border-[#C6A664] transition-all duration-200 outline-none"
                                placeholder="e.g. 120">
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
                                        <input type="checkbox" name="{{ $field }}" value="1" {{ old($field) ? 'checked' : '' }} 
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
                    <a href="{{ route('agent.properties.index') }}" 
                        class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-200 text-gray-600 font-bold rounded-2xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Discard Changes
                    </a>
                    
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-12 py-4 text-white font-bold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-[#C6A664]/20" style="background: linear-gradient(135deg, #001F3F 0%, #00152B 100%); border-bottom: 4px solid #C6A664;">
                        <svg class="w-5 h-5 mr-2 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Post Listing Now
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview and count enhancement
        document.getElementById('images').addEventListener('change', function(e) {
            const files = e.target.files;
            const countSpan = document.getElementById('file-count');
            const previewDiv = document.getElementById('image-preview');
            
            if (files.length > 0) {
                countSpan.textContent = files.length + ' file(s) selected';
                
                // Show preview with animation
                previewDiv.innerHTML = '';
                for (let i = 0; i < Math.min(files.length, 12); i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const container = document.createElement('div');
                        container.className = 'relative group aspect-square rounded-2xl overflow-hidden shadow-md border-2 border-white transform hover:scale-105 transition-all duration-300';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-full object-cover';
                        
                        const overlay = document.createElement('div');
                        overlay.className = 'absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors duration-300';
                        
                        container.appendChild(img);
                        container.appendChild(overlay);
                        previewDiv.appendChild(container);
                    };
                    reader.readAsDataURL(files[i]);
                }
            } else {
                countSpan.textContent = 'No files selected';
                previewDiv.innerHTML = '';
            }
        });
    </script>
</x-agent-layout>

