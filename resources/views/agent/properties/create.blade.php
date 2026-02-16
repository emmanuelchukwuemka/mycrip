<x-agent-layout>
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Upload New Property</h1>
            <p class="text-gray-600 mt-2">Add your property listing with all the essential details</p>
        </div>

        <!-- Error/Success Messages -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                <h2 class="text-white text-xl font-semibold">Property Details</h2>
                <p class="text-indigo-100 text-sm mt-1">Fill in all the information to create a compelling listing</p>
            </div>

            <form action="{{ route('agent.properties.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <!-- Basic Information Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Property Title
                                </span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="e.g. Modern 3 Bedroom Flat with Balcony" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                <select name="category" id="category" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" required>
                                    <option value="">Select Category</option>
                                    <option value="house_rental" {{ old('category') == 'house_rental' ? 'selected' : '' }}>House Rental</option>
                                    <option value="house_purchase" {{ old('category') == 'house_purchase' ? 'selected' : '' }}>House Purchase</option>
                                    <option value="land_purchase" {{ old('category') == 'land_purchase' ? 'selected' : '' }}>Land Purchase</option>
                                    <option value="shop_rental" {{ old('category') == 'shop_rental' ? 'selected' : '' }}>Shop Rental (Commercial)</option>
                                    <option value="student_lodge" {{ old('category') == 'student_lodge' ? 'selected' : '' }}>Student Lodge</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price Type</label>
                                <select name="price_type" id="price_type" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" required>
                                    <option value="fixed" {{ old('price_type') == 'fixed' ? 'selected' : '' }}>Fixed Price</option>
                                    <option value="monthly" {{ old('price_type') == 'monthly' ? 'selected' : '' }}>Per Month</option>
                                    <option value="yearly" {{ old('price_type') == 'yearly' ? 'selected' : '' }}>Per Year</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Price (₦)
                                </span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">₦</span>
                                </div>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                    placeholder="0.00" min="0" step="0.01" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 resize-none"
                                placeholder="Describe the property, its features, neighborhood, and any other important details..." required>{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Property Images -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Property Images <span class="text-red-500">*</span>
                        </label>
                        <p class="text-sm text-gray-500 mb-4">Upload at least one image. Maximum 10 images. Duplicate images will be rejected.</p>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition-colors duration-200">
                            <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*" data-max-files="10">
                            <label for="images" class="cursor-pointer">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <div class="mt-4 text-sm text-gray-600">
                                        <span class="font-medium text-indigo-600 hover:text-indigo-500">Click to upload</span> or drag and drop
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG, WEBP up to 5MB each</p>
                                    <p class="text-xs text-gray-500 mt-1" id="file-count">No files selected</p>
                                </div>
                            </label>
                        </div>
                        <div id="image-preview" class="mt-4 grid grid-cols-4 gap-2"></div>
                    </div>
                </div>

                <!-- Location Section -->
                <div class="border-t border-gray-200 pt-8 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Location Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <input type="text" name="country" id="country" value="{{ old('country', 'Nigeria') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="Nigeria" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">State <span class="text-red-500">*</span></label>
                            <input type="text" name="state" id="state" value="{{ old('state') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="e.g. Lagos, Abuja, Rivers" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="e.g. Lekki, Victoria Island" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="Full street address">
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="border-t border-gray-200 pt-8 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Features</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bedrooms</label>
                            <input type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms') }}" min="0" max="20"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="0">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bathrooms</label>
                            <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') }}" min="0" max="20"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="0">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Toilets</label>
                            <input type="number" name="toilets" id="toilets" value="{{ old('toilets') }}" min="0" max="20"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="0">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Size</label>
                            <input type="text" name="size" id="size" value="{{ old('size') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                placeholder="e.g. 120 sqm">
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-4">Amenities</label>
                        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="furnished" value="1" {{ old('furnished') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <span class="text-sm text-gray-700">Furnished</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="serviced" value="1" {{ old('serviced') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <span class="text-sm text-gray-700">Serviced</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="parking" value="1" {{ old('parking') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <span class="text-sm text-gray-700">Parking</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="security" value="1" {{ old('security') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <span class="text-sm text-gray-700">Security</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="water_supply" value="1" {{ old('water_supply') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <span class="text-sm text-gray-700">Water Supply</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="power_supply" value="1" {{ old('power_supply') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <span class="text-sm text-gray-700">Power Supply</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('agent.properties.index') }}" 
                        class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Cancel
                    </a>
                    
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Submit Property
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview and count
        document.getElementById('images').addEventListener('change', function(e) {
            const files = e.target.files;
            const countSpan = document.getElementById('file-count');
            const previewDiv = document.getElementById('image-preview');
            
            if (files.length > 0) {
                countSpan.textContent = files.length + ' file(s) selected';
                
                // Show preview
                previewDiv.innerHTML = '';
                for (let i = 0; i < Math.min(files.length, 8); i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-16 object-cover rounded';
                        previewDiv.appendChild(img);
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
