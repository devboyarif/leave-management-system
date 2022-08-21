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

    <!-- ====== Blog Details Start ====== -->
    <section class="ud-blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-blog-details-image">
                        <img src="{{ $post->thumbnail }}" alt="blog details" />
                        <div class="ud-blog-overlay">
                            <div class="ud-blog-overlay-content">
                                <div class="ud-blog-author">
                                    <img src="{{ $post->user->avatar }}" alt="author" />
                                    <span>
                                        {{ __('By') }} <a href="javascript:void(0)">{{ $post->user->name }}</a>
                                    </span>
                                </div>

                                <div class="ud-blog-meta">
                                    <p class="date">
                                        <i class="lni lni-calendar"></i>
                                        <span>{{ formatTime($post->created_at, 'd M Y') }}</span>
                                    </p>
                                    <p class="view">
                                        <i class="lni lni-eye"></i> <span>{{ $post->total_views }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-{{ count($popular_posts) ? '8' : '12' }}">
                    <div class="ud-blog-details-content">
                        {!! $post->long_description !!}
                    </div>
                </div>
                @if ($popular_posts && count($popular_posts))
                    <div class="col-lg-4">
                        <div class="ud-blog-sidebar">
                            <div class="ud-articles-box">
                                <h3 class="ud-articles-box-title">{{ __('Popular Articles') }}</h3>
                                <ul class="ud-articles-list">
                                    @foreach ($popular_posts as $post)
                                        <li>
                                            <div class="ud-article-image">
                                                <img src="{{ $post->thumbnail }}" alt="author" />
                                            </div>
                                            <div class="ud-article-content">
                                                <h5 class="ud-article-title">
                                                    <a href="{{ route('website.blog.details', $post->slug) }}">
                                                        {{ $post->title }}
                                                    </a>
                                                </h5>
                                                <p class="ud-article-author">
                                                    {{ formatTime($post->created_at, 'M d, Y') }}
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- ====== Blog Details End ====== -->

    <!-- ====== Blog Start ====== -->
    @if ($latest_posts && count($latest_posts))
        <section class="ud-blog-grids ud-related-articles">
            <div class="container">
                <div class="row col-lg-12">
                    <div class="ud-related-title">
                        <h2 class="ud-related-articles-title">{{ __('Latest Articles') }}</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($latest_posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="ud-single-blog">
                                <div class="ud-blog-image">
                                    <a href="{{ route('website.blog.details', $post->slug) }}">
                                        <img src="{{ $post->thumbnail }}" alt="blog" />
                                    </a>
                                </div>
                                <div class="ud-blog-content">
                                    <span class="ud-blog-date">{{ formatTime($post->created_at, 'M d, Y') }}</span>
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
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- ====== Blog End ====== -->
@endsection
