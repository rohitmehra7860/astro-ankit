@extends('layouts.front')

@section('head_preloads')
    <!-- Preload LCP banner background image -->
    <link rel="preload" href="{{ asset('assets/images/bg1.webp') }}" as="image" fetchpriority="high">
    
    <!-- Preload first banner slider image dynamically -->
    @if(!empty($banners) && count($banners) > 0)
        <link rel="preload" href="{{ asset($banners[0]->image_url) }}" as="image" fetchpriority="high">
    @endif
@endsection

@section('content')
    <section class="as_banner_wrapper">
        <div class="container-fluid">
            <div class="as_banner_slider">
                @foreach ($banners as $item)
                    <div class="item">
                        <div class="row as_verticle_center">
                            <div class="col-lg-7 order-lg-1 col-md-6 order-md-1 col-sm-12 order-sm-1 col-12 order-2">
                                <div class="as_banner_detail">
                                    <h5 class="as_orange">{{ $settings->site_name }}</h5>
                                    <h1>{!! $item->title !!}</h1>
                                    <div>
                                        {!! $item->content !!}
                                    </div>
                                    <a href="{{ route('contact') }}#contact-form" class="as_btn"  aria-label="Book Appointment">Book Appointment</a>
                                </div>
                            </div>
                            <div class="col-lg-5 order-lg-2 col-md-6 order-md-2 col-sm-12 order-sm-2 col-12 order-1">
                                <div class="as_banner_img text-center">
                                    <img src="{{ asset($item->image_url) }}" alt="Banner Image" class="img-responsive" width="570" height="570" loading="eager" fetchpriority="high">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
     @include('front.components.contact-component')
    @include('front.components.about-component')

    @include('front.components.services-component')

    @include('front.components.why-choose-us-component')

    @include('front.components.zodiac-signs-component')

    @include('front.components.testimonials-component')

    @include('front.components.blogs-component')

   
@endsection
