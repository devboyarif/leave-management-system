@extends('website.layout.app')

@section('content')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-banner-content">
                        <h1>{{ __('Blog Page') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Blog Start ====== -->
    <section class="ud-blog-grids">
        <div class="container">

            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="ud-single-blog">
                            <div class="ud-blog-image">
                                <a href="{{ route('website.blog.details', $post->slug) }}">
                                    <img src="{{ $post->thumbnail }}" alt="blog" />
                                </a>
                            </div>
                            <div class="ud-blog-content">
                                <span class="ud-blog-date">{{ formatTime($post->created_at, 'M d Y') }}</span>
                                <h3 class="ud-blog-title">
                                    <a href="{{ route('website.blog.details', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="ud-blog-desc">
                                    {{ $post->short_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <h3 class="text-center">{{ __('No Data Found') }}</h3>
                @endforelse
            </div>
            {{ $posts->links() }}
        </div>
    </section>
    <!-- ====== Blog End ====== -->
@endsection

@section('custom-links')
    <style>
        .lni-spin {
            width: 30px;
            height: 30px;
            background: cyan;
            border-radius: 50%;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            overflow: hidden;
            margin: auto;
            animation: circle 6s linear infinite;
        }

        @keyframes circle {
            0% {
                transform: rotate(0deg) translate(-165px) rotate(0deg);

            }

            100% {
                transform: rotate(360deg) translate(-165px) rotate(-360deg);
            }
        }
    </style>
@endsection
