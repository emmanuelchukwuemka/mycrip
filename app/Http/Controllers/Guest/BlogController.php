<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of published blog posts.
     */
    public function index()
    {
        $posts = BlogPost::published()->with('author')->latest()->paginate(9);
        
        // Featured posts for the top section (most recent 3 published)
        $featuredPosts = BlogPost::published()->with('author')->latest()->take(3)->get();

        return view('guest.blog.index', compact('posts', 'featuredPosts'));
    }

    /**
     * Display the specified blog post.
     */
    public function show(string $slug)
    {
        $post = BlogPost::published()->with('author')->where('slug', $slug)->firstOrFail();
        
        // Related posts (same status, different id, latest 3)
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('guest.blog.show', compact('post', 'relatedPosts'));
    }
}
