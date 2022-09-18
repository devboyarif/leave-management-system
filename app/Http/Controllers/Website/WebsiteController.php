<?php

namespace App\Http\Controllers\Website;

use App\Models\Faq;
use App\Models\Seo;
use App\Models\Plan;
use App\Models\Post;
use AmrShawky\Currency;
use App\Models\Feature;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Traits\PaymentAble;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class WebsiteController extends Controller
{
    use SEOToolsTrait, PaymentAble;

    public function home()
    {
        $content = metaContent('home');
        $this->seo()->setTitle($content->title);
        $this->seo()->setDescription($content->description);
        SEOMeta::setKeywords($content->keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        $faqs = Faq::all();
        $features = Feature::all();
        $testimonials = Testimonial::all();
        $plans = Plan::with('planFeatures')->whereStatus(1)->get();

        return view('website.home', compact('faqs', 'features', 'testimonials', 'plans'));
    }

    public function about()
    {
        $content = metaContent('about');
        $this->seo()->setTitle($content->title);
        $this->seo()->setDescription($content->description);
        SEOMeta::setKeywords($content->keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        $testimonials = Testimonial::all();

        return view('website.about', compact('testimonials'));
    }

    public function pricing()
    {
        $content = metaContent('pricing');
        $this->seo()->setTitle($content->title);
        $this->seo()->setDescription($content->description);
        SEOMeta::setKeywords($content->keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        $faqs = Faq::all();
        $plans = Plan::with('planFeatures')->whereStatus(1)->get();

        return view('website.pricing', compact('faqs', 'plans'));
    }

    public function blog()
    {
        $content = metaContent('blog');
        $this->seo()->setTitle($content->title);
        $this->seo()->setDescription($content->description);
        SEOMeta::setKeywords($content->keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        $posts = Post::select('id', 'title', 'slug', 'thumbnail', 'short_description')
            ->latest()
            ->paginate(12);

        return view('website.blog', compact('posts'));
    }

    public function blogDetails(Post $post)
    {
        $this->seo()->setTitle($post->title);
        $this->seo()->setDescription($post->short_description);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        $post->increment('total_views');
        $post->load('user');
        $popular_posts = Post::select('id', 'title', 'slug', 'thumbnail')
            ->latest('total_views')
            ->limit(4)
            ->get();
        $latest_posts = Post::select('id', 'title', 'slug', 'thumbnail')
            ->where('id', '!=', $post->id)
            ->latest()
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
        $content = metaContent('contact');
        $this->seo()->setTitle($content->title);
        $this->seo()->setDescription($content->description);
        SEOMeta::setKeywords($content->keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        return view('website.contact');
    }

    public function planDetails(Plan $plan)
    {
        if ($plan->type == 'free') {
            return $this->switchToFreePlan($plan);
        }

        $content = metaContent('pricing');
        $this->seo()->setTitle($content->title);
        $this->seo()->setDescription($content->description);
        SEOMeta::setKeywords($content->keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        // session data storing
        session(['plan' => $plan]);
        session(['stripe_amount' => currencyConversion($plan->price) * 100]);
        session(['razor_amount' => currencyConversion(50, null, 'INR', 1) * 100]);

        // midtrans snap token
        if (config('kodebazar.midtrans_active') && config('kodebazar.midtrans_id') && config('kodebazar.midtrans_key') && config('kodebazar.midtrans_secret')) {
            $midtrans_amount = round(currencyConversion($plan->price, null, 'IDR', 1));
            $order_id = uniqid();

            session(['midtrans_amount' => $midtrans_amount]);
            session(['midtrans_order_id' => $order_id]);

            $order['order_no'] = $order_id;
            $order['total_price'] = $midtrans_amount;

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
        }

        return view('website.plan_details', [
            'plan' => $plan,
            'mid_token' => $snapToken ?? null,
        ]);
    }

    public function privacyPolicy()
    {
        $content = metaContent('privacy-policy');
        $this->seo()->setTitle($content->title);
        $this->seo()->setDescription($content->description);
        SEOMeta::setKeywords($content->keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        return view('website.privacy_policy');
    }

    public function termsCondition()
    {
        $content = metaContent('terms-conditions');
        $this->seo()->setTitle($content->title);
        $this->seo()->setDescription($content->description);
        SEOMeta::setKeywords($content->keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(url()->current());
        $this->seo()->jsonLd()->setType('Website');

        return view('website.terms_condition');
    }
}
