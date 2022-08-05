@props(['faqs'])

<section id="faq" class="ud-faq">
    <div class="shape">
        <img src="{{ asset('website') }}/images/faq/shape.svg" alt="shape" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ud-section-title text-center mx-auto">
                    <span>{{ $cms->faq_title }}</span>
                    <h2>{{ $cms->faq_subtitle }}</h2>
                    <p>
                        {{ $cms->faq_description }}
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ($faqs as $faq)
                        <div class="col-lg-6">
                            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
                                <div class="accordion">
                                    <button class="ud-faq-btn collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $faq->id }}">
                                        <span class="icon flex-shrink-0">
                                            <i class="lni lni-chevron-down"></i>
                                        </span>
                                        <span>{{ $faq->question }}</span>
                                    </button>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse">
                                        <div class="ud-faq-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
