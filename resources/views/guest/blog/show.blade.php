<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Post Header -->
        <div class="relative py-24 bg-[#001F3F] overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <img src="{{ $post->featured_image_url }}" alt="" class="w-full h-full object-cover filter blur-sm">
            </div>
            <div class="relative max-w-4xl mx-auto px-4 text-center">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center text-[#C6A664] font-bold text-sm uppercase tracking-widest mb-8 hover:underline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Blog
                </a>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-8 leading-tight">{{ $post->title }}</h1>
                <div class="flex items-center justify-center gap-6 text-gray-300 font-bold uppercase tracking-widest text-xs">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $post->published_at->format('M d, Y') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        By {{ $post->author->name }}
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 -mt-16 relative z-10">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 mb-12">
                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-[500px] object-cover">
                
                <div class="p-8 md:p-12">
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed space-y-6">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <!-- Share Section -->
                    <div class="mt-16 pt-8 border-t border-gray-100 flex flex-wrap items-center justify-between gap-6">
                        <div class="flex items-center gap-4">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Share this post</span>
                            <div class="flex gap-2">
                                <a href="#" class="p-3 bg-gray-50 text-gray-400 hover:bg-[#001F3F] hover:text-white rounded-2xl transition-all duration-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l0.532 3.47h-2.86v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="#" class="p-3 bg-gray-50 text-gray-400 hover:bg-[#1DA1F2] hover:text-white rounded-2xl transition-all duration-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Author Card -->
            <div class="bg-gray-50 rounded-3xl p-8 mb-20 border border-gray-100 flex flex-col md:flex-row items-center md:items-start gap-8">
                <div class="w-24 h-24 rounded-full overflow-hidden flex-shrink-0 bg-white shadow-lg">
                    <img src="{{ $post->author->agent_image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($post->author->name) }}" alt="{{ $post->author->name }}" class="w-full h-full object-cover">
                </div>
                <div class="text-center md:text-left">
                    <h5 class="text-xl font-bold text-[#001F3F] mb-2">{{ $post->author->name }}</h5>
                    <p class="text-gray-600 leading-relaxed italic">
                        {{ $post->author->bio ?? 'Passionate real estate expert and contributing writer for the MyCrib Africa platform.' }}
                    </p>
                </div>
            </div>

            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
                <div class="mb-20">
                    <h3 class="text-3xl font-bold text-[#001F3F] mb-12">Related Articles</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($relatedPosts as $related)
                            <article class="flex flex-col">
                                <a href="{{ route('blog.show', $related->slug) }}" class="block mb-4 h-48 rounded-2xl overflow-hidden shadow-md group">
                                    <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                </a>
                                <h4 class="text-lg font-bold text-[#001F3F] mb-2 line-clamp-2 hover:text-[#C6A664] transition-colors">
                                    <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                </h4>
                                <p class="text-xs font-bold text-[#C6A664] uppercase tracking-widest">{{ $related->published_at->format('M d, Y') }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
