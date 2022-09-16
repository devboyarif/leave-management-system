@extends('website.layout.app')

@section('content')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-banner-content">
                        <h1>{{ __('Pricing Page') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Pricing Start ====== -->
    <section id="pricing" class="ud-pricing">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-section-title mx-auto text-center">
                        <h2>{{ $cms->pricing_plan_title }}</h2>
                        <p>
                            {{ $cms->pricing_plan_description }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach ($plans as $plan)
                    <div class="col-lg-3 col-md-7 col-sm-9">
                        <div class="pricing-style-one">
                            <div class="pricing-header text-center">
                                <h5 class="sub-title">{{ $plan->name }}</h5>
                                <span class="price">{{ currencyPosition($plan->price) }}</span>
                                @if ($plan->interval == 'custom_days')
                                    <small>/{{ $plan->custom_interval_days }} {{ __('Days') }}</small>
                                @else
                                    <small>/{{ $plan->interval }}</small>
                                @endif
                                @if ($plan->recommended)
                                    <br>
                                    <span class="badge bg-primary mt-2">{{ __('Recommended') }}</span>
                                @endif
                            </div>
                            <div class="pricing-list">

                                <ul>
                                    <li>
                                        <i
                                            class="lni {{ !$plan->planFeatures->is_limited_employee ? 'lni-checkmark-circle text-success' : 'lni-cross-circle text-danger' }}"></i>
                                        {{ __('Unlimited Employees') }}

                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle text-success"></i>
                                        {{ __('Max Employees') }} -
                                        <b>{{ $plan->planFeatures->is_limited_employee ? $plan->planFeatures->max_employees : '∞' }}</b>
                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle text-success"></i>
                                        {{ __('Max Teams') }} - <b>{{ $plan->planFeatures->max_teams }}</b>
                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle text-success"></i>
                                        {{ __('Max Leave Types') }} - <b>{{ $plan->planFeatures->max_leave_types }}</b>
                                    </li>
                                    <li>
                                        <i
                                            class="lni {{ $plan->planFeatures->custom_theme_look ? 'lni-checkmark-circle text-success' : 'lni-cross-circle text-danger' }}"></i>
                                        {{ __('Custom Theme Look') }}
                                    </li>
                                </ul>
                            </div>
                            <div class="pricing-btn rounded-buttons text-center">
                                @if (auth()->check() && auth()->user()->role == 'owner')
                                    <a class="btn primary-btn rounded-full price-btn"
                                        href="{{ route('website.plan.details', $plan->slug) }}">
                                        @if ($plan->id == session('current_subscription')->plan_id)
                                            {{ __('Current Plan') }}
                                        @else
                                            {{ __('Select Plan') }}
                                        @endif
                                    </a>
                                @else
                                    <a class="btn primary-btn rounded-full price-btn {{ !auth()->check() ? 'login_required' : '' }} {{ auth()->check() && auth()->user()->role == 'admin' ? 'not_acceptable' : '' }}"
                                        href="javascript:void(0)">
                                        {{ __('Get Started') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ====== Pricing End ====== -->

    <!-- ====== FAQ Start ====== -->
    <x-website.faq-section :faqs="$faqs" />
    <!-- ====== FAQ End ====== -->
@endsection


@section('custom-links')
    @php
    $website_theme = getAdminTheme();
    @endphp

    <style>
        .price-btn {
            font-weight: bold;
            font-size: 16px;
            line-height: 20px;
            text-align: center;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 12px 24px;
            border-radius: 4px;
            border: 1px solid transparent;
        }

        .btn.rounded-full {
            border-radius: 50px;
        }

        .pricing-style-one .primary-btn {
            background: {{ $website_theme->website_primary_color }};
            color: #fff;
            box-shadow: 0px 0px 1px rgba(40, 41, 61, 0.04),
                0px 2px 4px rgba(96, 97, 112, 0.16);
        }

        .pricing-style-one .active.primary-btn,
        .pricing-style-one .primary-btn:hover,
        .pricing-style-one .primary-btn:focus {
            background: {{ $website_theme->website_primary_color }};
            color: #fff;
            box-shadow: 0px 2px 4px rgba(40, 41, 61, 0.04), ;
        }

        .pricing-style-one .deactive.primary-btn {
            background: #e0e0e0;
            color: #6d6d6d;
            pointer-events: none;
        }

        /*===== PRICING STYLE ONE =====*/
        .pricing-one {
            padding: 100px 0;
        }

        .pricing-style-one {
            box-shadow: 0px 8px 16px rgba(96, 97, 112, 0.16);
            padding: 45px 30px;
            border-radius: 8px;
            position: relative;
            z-index: 1;
            overflow: hidden;
            background-color: #fff;
            margin-top: 50px;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .pricing-style-one {
                padding: 35px 30px;
            }
        }

        .pricing-style-one .sub-title {
            font-size: 16px;
            color: #1d1d1d;
            position: relative;
            padding: 6px 20px;
            display: inline-block;
            border: 2px solid {{ $website_theme->website_primary_color }};
            border-radius: 30px;
        }

        .pricing-style-one .price {
            display: block;
            font-size: 55px;
            font-weight: 600;
            line-height: 80px;
            margin-top: 25px;
            color: #1d1d1d;
        }

        @media (max-width: 767px) {
            .pricing-style-one .price {
                font-size: 45px;
                margin-top: 16px;
            }
        }

        @media only screen and (min-width: 576px) and (max-width: 767px) {
            .pricing-style-one .price {
                font-size: 50px;
                margin-top: 20px;
            }
        }

        .pricing-style-one .year {
            color: #6d6d6d;
            margin-top: 3px;
        }

        .pricing-style-one .pricing-list {
            margin-top: 40px;
        }

        .pricing-style-one .pricing-list li {
            color: #6d6d6d;
            margin-top: 16px;
        }

        .pricing-style-one .pricing-list li i {
            color: {{ $website_theme->website_primary_color }};
            margin-right: 8px;
        }

        .pricing-style-one .pricing-btn {
            margin-top: 42px;
        }

        .pricing-style-one .bottom-shape {
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 101%;
            z-index: -1;
        }
    </style>
@endsection
