<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home()
    {
        return view('website.home');
    }

    public function about()
    {
        return view('website.about');
    }

    public function pricing()
    {
        return view('website.pricing');
    }

    public function blog()
    {
        $posts = Post::select('id', 'title', 'slug', 'thumbnail', 'short_description')
            ->latest()
            ->where('status', 1)
            ->paginate(12);

        return view('website.blog', compact('posts'));
    }

    public function blogDetails(Post $post)
    {
        $post->increment('total_views');
        $post->load('user');
        $popular_posts = Post::select('id', 'title', 'slug', 'thumbnail')
            ->latest('total_views')
            ->where('status', 1)
            ->limit(4)
            ->get();
        $latest_posts = Post::select('id', 'title', 'slug', 'thumbnail')
            ->latest()
            ->where('status', 1)
            ->limit(3)
            ->get();

        return view('website.blog-details', compact(
            'post',
            'popular_posts',
            'latest_posts'
        ));
    }

    public function contact()
    {
        return view('website.contact');
    }
}
