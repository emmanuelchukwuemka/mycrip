<x-admin-layout>
    <div class="px-6 py-4">
        <h3 class="text-gray-700 text-3xl font-medium">Create New Blog Post</h3>
    </div>

    <div class="mt-8 mx-6">
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Content</label>
                            <textarea name="content" rows="15" required
                                      class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">{{ old('content') }}</textarea>
                            @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">Post Settings</label>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Status</label>
                                    <select name="status" class="w-full rounded-xl border-gray-200 text-sm focus:ring-indigo-500">
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Publish Date</label>
                                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                                           class="w-full rounded-xl border-gray-200 text-sm focus:ring-indigo-500">
                                    @error('published_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">Featured Image</label>
                            <input type="file" name="featured_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-2 text-xs text-gray-400">Max size 2MB (JPEG, PNG, WebP)</p>
                            @error('featured_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col gap-3">
                            <button type="submit" class="w-full py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all">
                                Save Blog Post
                            </button>
                            <a href="{{ route('admin.blog.index') }}" class="w-full py-4 bg-white text-gray-600 font-bold rounded-2xl border border-gray-200 hover:bg-gray-50 text-center transition-all">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
