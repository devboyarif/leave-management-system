<?php

namespace App\Http\Controllers\Website;

use App\Models\Faq;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Feature;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function home()
    {
        $faqs = Faq::all();
        $features = Feature::all();
        $testimonials = Testimonial::all();
        $plans = Plan::with('planFeatures')->whereStatus(1)->get();

        return view('website.home', compact('faqs', 'features', 'testimonials', 'plans'));
    }

    public function about()
    {
        $testimonials = Testimonial::all();

        return view('website.about', compact('testimonials'));
    }

    public function pricing()
    {
        $faqs = Faq::all();
        return view('website.pricing', compact('faqs'));
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

    public function planDetails(Plan $plan)
    {
        // session data storing
        session(['stripe_razor_amount' => currencyConversion($plan->price) * 100]);
        session(['razor_amount' => currencyConversion(50, null, 'INR', 1) * 100]);

        return view('website.plan_details', compact('plan'));
    }
}
