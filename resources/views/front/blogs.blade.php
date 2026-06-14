@extends('layouts.front')
@section('content')
    <section class="as_blog_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="text-left">
                        <div class="row">
                            @foreach ($blogs as $item)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="as_blog_box">
                                        <div class="as_blog_img">
                                            <a href="{{ route('single-blog', $item->slug) }}"><img
                                                    src="{{ asset($item->image_url) }}" alt="{{ $item->title }}"
                                                    class="img-responsive"></a>
                                            <span class="as_btn">{{ $item->created_at->format('F d, Y') }}</span>
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <img src="{{ asset('assets/images/svg/user.svg') }}" alt="admin icon">
                                                    By - {{ $settings->site_name }}
                                                </a>
                                            </li>
                                        </ul>
                                        <h4 class="as_subheading">
                                            <a href="{{ route('single-blog', $item->slug) }}"> {{ $item->title }}
                                            </a>
                                        </h4>
                                        <div class="as_font14 as_margin0">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
