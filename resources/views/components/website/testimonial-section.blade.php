@props(['testimonials'])

<section id="testimonials" class="ud-testimonials">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ud-section-title mx-auto text-center">
                    <span> {{ $cms->testimonial_title }}</span>
                    <h2> {{ $cms->testimonial_subtitle }}</h2>
                    <p>
                         {{ $cms->testimonial_description }}
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($testimonials as $testimonial)
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-testimonial wow fadeInUp" data-wow-delay=".1s">
                        <div class="ud-testimonial-content">
                            <p>
                                {{ $testimonial->description }}
                            </p>
                        </div>
                        <div class="ud-testimonial-info">
                            <div class="ud-testimonial-image">
                                <img src="{{ $testimonial->avatar }}" alt="author" />
                            </div>
                            <div class="ud-testimonial-meta">
                                <h4>{{ $testimonial->name }}</h4>
                                <p>{{ $testimonial->position }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
