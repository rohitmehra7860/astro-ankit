<section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="as_heading as_heading_center">What Our Customers Say</h1>
                <p class="as_font14 as_margin0 as_padderBottom50">Real stories, real results — see what our satisfied
                    clients say about Ankit Shastri Ji's guidance.</p>
            </div>

            <div class="row as_customer_slider">
                @foreach ($testimonials as $item)
                    <div class="col-lg-6 col-md-6">
                        <div class="as_customer_box text-center">
                            <span class="as_customer_img">
                                <img src="{{ asset($item->image_url) }}" alt="testimonial image" width="100" height="100" loading="lazy" style="object-fit: cover;
    width: 100px;
    height: 100px;
    object-position: top;">
                                <span>
                                    <img src="{{ asset('assets/images/svg/quote1.svg') }}" alt="Testimonial icon" width="30" height="30" loading="lazy"></span>
                            </span>
                            <div class="as_margin0">{!! $item->content !!}</div>
                            <h3>{{ $item->name }}</h3>
                            {{-- <p class="as_margin0">Astrologer</p> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    </div>
</section>
