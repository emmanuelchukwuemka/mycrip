<x-app-layout>
    <div class="bg-white min-h-screen py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-[#001F3F] mb-4">Post to the Buyer Wall</h1>
                <p class="text-gray-500 italic">Tell our agents exactly what you need, and they'll bring the options to you.</p>
            </div>

            <div class="bg-white rounded-[40px] shadow-2xl border border-gray-50 p-8 md:p-12">
                <form action="{{ route('requests.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">Category *</label>
                            <select name="category" required class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all appearance-none cursor-pointer bg-gray-50">
                                <option value="apartment">Apartment</option>
                                <option value="house">House</option>
                                <option value="land">Land</option>
                                <option value="commercial">Commercial</option>
                            </select>
                            @error('category') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">Location *</label>
                            <input type="text" name="location" value="{{ old('location') }}" required placeholder="e.g. Lekki Phase 1, Lagos"
                                   class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all bg-gray-50">
                            @error('location') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">Minimum Price (₦)</label>
                            <input type="number" name="min_price" value="{{ old('min_price') }}" placeholder="Optional"
                                   class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all bg-gray-50">
                            @error('min_price') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">Maximum Price (₦)</label>
                            <input type="number" name="max_price" value="{{ old('max_price') }}" placeholder="Optional"
                                   class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all bg-gray-50">
                            @error('max_price') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">Bedrooms</label>
                            <input type="number" name="bedrooms" value="{{ old('bedrooms') }}" placeholder="e.g. 3"
                                   class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all bg-gray-50">
                            @error('bedrooms') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">Bathrooms</label>
                            <input type="number" name="bathrooms" value="{{ old('bathrooms') }}" placeholder="e.g. 2"
                                   class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all bg-gray-50">
                            @error('bathrooms') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#001F3F] uppercase tracking-widest mb-3">What are you looking for? *</label>
                        <textarea name="description" rows="6" required placeholder="Describe your dream property here (minimum 20 characters)... e.g. I need a serene pent-house with a view of the Atlantic, must have 24/7 power and a clean drainage system."
                                  class="w-full px-6 py-4 rounded-2xl border border-gray-100 focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all bg-gray-50">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full py-5 bg-[#001F3F] text-white font-bold rounded-2xl hover:bg-[#C6A664] transition-all duration-300 shadow-xl shadow-gray-100 text-lg">
                            Publish to Buyer Wall
                        </button>
                        <a href="{{ route('requests.index') }}" class="block text-center mt-6 text-sm font-bold text-gray-400 hover:text-[#001F3F] transition-colors">
                            Cancel and Go Back
                        </a>
                    </div>
                </form>
            </div>
            
            <div class="mt-12 p-8 bg-amber-50 rounded-3xl border border-amber-100 flex items-start">
                <div class="bg-amber-100 p-3 rounded-xl mr-5 shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h5 class="font-bold text-amber-900 mb-2">Privacy & Quality Note</h5>
                    <p class="text-sm text-amber-800/80 leading-relaxed">Your contact information is NOT displayed publicly. Agents can only reach you through our secure messaging system. Please be specific to get the best matches!</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
