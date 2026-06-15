@extends('layouts.front')
@section('content')
    <section class="as_servicedetail_wrapper as_padderBottom80 as_padderTop80">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12">
                    <div class="as_service_detail_inner">
                        <div class="as_blog_img">
                            <img src="{{ asset($blog->image_url) }}" alt="" class="img-responsive"
                                alt="{{ $blog->title }}">
                            <span class="as_btn">{{ $blog->created_at->format('F d, Y') }}</span>
                        </div>
                        <ul class="list-unstyled">
                            <li>
                                <a href="javascript:;"><img src="{{ asset('assets/images/svg/user.svg') }}" alt="">
                                    By -
                                    {{ $settings->site_name }}
                                </a>
                            </li>
                        </ul>

                        <h1 class="as_heading">{{ $blog->title }}</h1>

                        <div class="as_font14">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                    <div class="as_service_sidebar">
                        <div class="as_contact_form mb-0 py-4 px-4 ">
                            <h4 class="as_subheading">Have A Question?</h4>
                            <form action="{{ route('enquiry') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" id="" class="form-control py-0 px-2"
                                        placeholder="Your full name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="text" name="email" id="" class="form-control py-0 px-2"
                                        placeholder="your@email.com" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone No.</label>
                                    <input type="text" name="phone" id="" class="form-control py-0 px-2"
                                        placeholder="+91 XXXXX XXXXX" required>
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" id="" class="form-control py-0 px-2"
                                        placeholder="Briefly describe what guidance you're seeking..." required></textarea>
                                </div>
                                <button type="submit" class="as_btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('front.components.why-choose-us-component')

    @include('front.components.zodiac-signs-component')

    @include('front.components.testimonials-component')

    @include('front.components.blogs-component')
@endsection
