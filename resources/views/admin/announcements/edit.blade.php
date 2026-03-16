<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.announcements.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-[#001F3F] transition-colors mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to List
        </a>
        <h2 class="text-3xl font-bold" style="color: #001F3F;">Edit Announcement</h2>
        <p class="mt-1 text-gray-500">Update the announcement details.</p>
    </div>

    <div class="max-w-3xl">
        <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="space-y-6">
                    <div>
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Announcement Content <span class="text-red-500">*</span></label>
                        <input type="text" name="content" id="content" value="{{ old('content', $announcement->content) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#001F3F] focus:border-transparent transition-all"
                               placeholder="Enter announcement text...">
                        @error('content') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="link" class="block text-sm font-bold text-gray-700 mb-2">Action Link (Optional)</label>
                        <input type="url" name="link" id="link" value="{{ old('link', $announcement->link) }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#001F3F] focus:border-transparent transition-all"
                               placeholder="https://example.com/promo">
                        @error('link') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="bg_color" class="block text-sm font-bold text-gray-700 mb-2">Background Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" name="bg_color" id="bg_color" value="{{ old('bg_color', $announcement->bg_color) }}"
                                       class="h-10 w-20 p-1 rounded-lg border border-gray-200 bg-white cursor-pointer">
                                <span class="text-xs text-gray-500">Choose a background color</span>
                            </div>
                        </div>

                        <div>
                            <label for="text_color" class="block text-sm font-bold text-gray-700 mb-2">Text Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" name="text_color" id="text_color" value="{{ old('text_color', $announcement->text_color) }}"
                                       class="h-10 w-20 p-1 rounded-lg border border-gray-200 bg-white cursor-pointer">
                                <span class="text-xs text-gray-500">Choose a text color</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ $announcement->is_active ? 'checked' : '' }}
                               class="w-5 h-5 rounded border-gray-300 text-[#001F3F] focus:ring-[#001F3F]">
                        <label for="is_active" class="text-sm font-bold text-gray-700">Display this announcement</label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-8 py-3 bg-[#001F3F] text-white rounded-xl font-bold hover:bg-[#00152B] transition-all transform hover:scale-105 shadow-lg">
                    Update Announcement
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
