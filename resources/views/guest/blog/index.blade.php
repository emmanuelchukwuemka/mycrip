<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Hero Section -->
        <div class="bg-[#001F3F] py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Real Estate Insights & News</h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">Stay updated with the latest trends, guides, and tips for the African real estate market.</p>
            </div>
        </div>

        <!-- Featured Posts -->
        @if($featuredPosts->count() > 0)
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($featuredPosts as $post)
                        <div class="bg-white rounded-3xl shadow-xl overflow-hidden group hover:shadow-2xl transition-all duration-500">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-6 left-6 right-6">
                                    <span class="px-3 py-1 bg-[#C6A664] text-white text-xs font-bold rounded-full uppercase tracking-widest mb-3 inline-block">Featured</span>
                                    <h2 class="text-xl font-bold text-white line-clamp-2 leading-tight">{{ $post->title }}</h2>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between text-xs text-gray-400 mb-4 font-bold uppercase tracking-wider">
                                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                                    <span>{{ $post->author->name }}</span>
                                </div>
                                <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center text-[#001F3F] font-bold hover:text-[#C6A664] transition-colors">
                                    Read Article
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- All Posts -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="flex items-center justify-between mb-12">
                <h3 class="text-3xl font-bold text-[#001F3F]">Latest Articles</h3>
                <div class="h-1 flex-grow bg-gray-100 mx-8 rounded-full hidden md:block"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <article class="flex flex-col">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block mb-6 h-64 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group">
                            <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </a>
                        <div class="flex items-center gap-3 text-xs font-bold text-[#C6A664] uppercase tracking-widest mb-4">
                            <span>{{ $post->published_at->format('M d, Y') }}</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span>{{ $post->author->name }}</span>
                        </div>
                        <h4 class="text-2xl font-bold text-[#001F3F] mb-4 hover:text-[#C6A664] transition-colors line-clamp-2 leading-tight">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h4>
                        <div class="text-gray-600 text-sm line-clamp-3 mb-6 leading-relaxed">
                            {{ Str::limit(strip_tags($post->content), 150) }}
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}" class="mt-auto text-sm font-bold text-[#001F3F] hover:underline flex items-center">
                            Continue Reading
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <p class="text-gray-400 text-lg">Coming soon! We're preparing high-quality content for you.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="bg-gray-50 py-20">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <div class="inline-flex items-center justify-center p-3 bg-white rounded-3xl shadow-xl mb-8">
                    <svg class="w-8 h-8 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-3xl font-bold text-[#001F3F] mb-4">Subscribe to our newsletter</h3>
                <p class="text-gray-600 mb-8">Get the latest property tips and market news delivered to your inbox.</p>
                <form class="flex flex-col md:flex-row gap-4 max-w-lg mx-auto">
                    <input type="email" placeholder="Your email address" class="flex-grow px-6 py-4 rounded-2xl border border-gray-100 focus:ring-4 focus:ring-[#C6A664]/10 focus:border-[#C6A664] outline-none transition-all">
                    <button type="submit" class="px-8 py-4 bg-[#001F3F] text-white font-bold rounded-2xl hover:bg-[#C6A664] transition-all duration-300 shadow-xl">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
