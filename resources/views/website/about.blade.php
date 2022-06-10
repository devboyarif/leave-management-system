@extends('website.layout.app')

@section('content')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-banner-content">
                        <h1>About Page</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== About Start ====== -->
    <section id="about" class="ud-about">
        <div class="container">
            <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
                <div class="ud-about-content-wrapper">
                    <div class="ud-about-content">
                        <span class="tag">About Us</span>
                        <h2>Brilliant Toolkit to Build Nextgen Website Faster.</h2>
                        <p>
                            The main ‘thrust’ is to focus on educating attendees on how to
                            best protect highly vulnerable business applications with
                            interactive panel discussions and roundtables led by subject
                            matter experts.
                        </p>

                        <p>
                            The main ‘thrust’ is to focus on educating attendees on how to
                            best protect highly vulnerable business applications with
                            interactive panel.
                        </p>
                        <a href="javascript:void(0)" class="ud-main-btn">Learn More</a>
                    </div>
                </div>
                <div class="ud-about-image">
                    <img src="{{ asset('website') }}/images/about/about-image.svg" alt="about-image" />
                </div>
            </div>
        </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== Team Start ====== -->
    <section id="team" class="ud-team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-section-title mx-auto text-center">
                        <span>Our Team</span>
                        <h2>Meet The Team</h2>
                        <p>
                            There are many variations of passages of Lorem Ipsum available
                            but the majority have suffered alteration in some form.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="ud-single-team wow fadeInUp" data-wow-delay=".1s">
                        <div class="ud-team-image-wrapper">
                            <div class="ud-team-image">
                                <img src="{{ asset('website') }}/images/team/team-01.png" alt="team" />
                            </div>

                            <img src="{{ asset('website') }}/images/team/dotted-shape.svg" alt="shape"
                                class="shape shape-1" />
                            <img src="{{ asset('website') }}/images/team/shape-2.svg" alt="shape"
                                class="shape shape-2" />
                        </div>
                        <div class="ud-team-info">
                            <h5>Adveen Desuza</h5>
                            <h6>UI Designer</h6>
                        </div>
                        <ul class="ud-team-socials">
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-facebook-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-twitter-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-instagram-filled"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="ud-single-team wow fadeInUp" data-wow-delay=".15s">
                        <div class="ud-team-image-wrapper">
                            <div class="ud-team-image">
                                <img src="{{ asset('website') }}/images/team/team-02.png" alt="team" />
                            </div>

                            <img src="{{ asset('website') }}/images/team/dotted-shape.svg" alt="shape"
                                class="shape shape-1" />
                            <img src="{{ asset('website') }}/images/team/shape-2.svg" alt="shape"
                                class="shape shape-2" />
                        </div>
                        <div class="ud-team-info">
                            <h5>Jezmin uniya</h5>
                            <h6>Product Designer</h6>
                        </div>
                        <ul class="ud-team-socials">
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-facebook-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-twitter-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-instagram-filled"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="ud-single-team wow fadeInUp" data-wow-delay=".2s">
                        <div class="ud-team-image-wrapper">
                            <div class="ud-team-image">
                                <img src="{{ asset('website') }}/images/team/team-03.png" alt="team" />
                            </div>

                            <img src="{{ asset('website') }}/images/team/dotted-shape.svg" alt="shape"
                                class="shape shape-1" />
                            <img src="{{ asset('website') }}/images/team/shape-2.svg" alt="shape"
                                class="shape shape-2" />
                        </div>
                        <div class="ud-team-info">
                            <h5>Andrieo Gloree</h5>
                            <h6>App Developer</h6>
                        </div>
                        <ul class="ud-team-socials">
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-facebook-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-twitter-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-instagram-filled"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="ud-single-team wow fadeInUp" data-wow-delay=".25s">
                        <div class="ud-team-image-wrapper">
                            <div class="ud-team-image">
                                <img src="{{ asset('website') }}/images/team/team-04.png" alt="team" />
                            </div>

                            <img src="{{ asset('website') }}/images/team/dotted-shape.svg" alt="shape"
                                class="shape shape-1" />
                            <img src="{{ asset('website') }}/images/team/shape-2.svg" alt="shape"
                                class="shape shape-2" />
                        </div>
                        <div class="ud-team-info">
                            <h5>Jackie Sanders</h5>
                            <h6>Content Writer</h6>
                        </div>
                        <ul class="ud-team-socials">
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-facebook-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-twitter-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/MusharofChy">
                                    <i class="lni lni-instagram-filled"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Team End ====== -->
@endsection
