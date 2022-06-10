@extends('website.layout.app')

@section('content')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-banner-content">
                        <h1>Blog Page</h1>
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
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-01.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    Meet AutoManage, the best AI management tools
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-02.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    How to earn more money as a wellness coach
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-03.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    The no-fuss guide to upselling and cross selling
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-02.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    How to earn more money as a wellness coach
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-03.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    The no-fuss guide to upselling and cross selling
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-01.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    Meet AutoManage, the best AI management tools
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-01.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    Meet AutoManage, the best AI management tools
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-02.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    How to earn more money as a wellness coach
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                            <a href="{{ route('website.blog.details', 'aaa') }}">
                                <img src="{{ asset('website') }}/images/blog/blog-03.jpg" alt="blog" />
                            </a>
                        </div>
                        <div class="ud-blog-content">
                            <span class="ud-blog-date">Dec 22, 2023</span>
                            <h3 class="ud-blog-title">
                                <a href="{{ route('website.blog.details', 'aaa') }}">
                                    The no-fuss guide to upselling and cross selling
                                </a>
                            </h3>
                            <p class="ud-blog-desc">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Blog End ====== -->
@endsection
