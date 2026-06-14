@extends('layouts.front')
@section('content')
    <section class="as_blog_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="text-left">
                        <div class="row">
                            @foreach ($services as $item)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="as_blog_box">
                                        <div class="as_blog_img mb-0">
                                            <a href="{{ route('single-service', $item->slug) }}">
                                                <img src="{{ asset($item->image_url) }}" alt="{{ $item->title }}"
                                                    class="img-responsive">
                                            </a>
                                        </div>
                                        <h4 class="as_subheading">
                                            <a href="{{ route('single-service', $item->slug) }}">
                                                {{ $item->title }}
                                            </a>
                                        </h4>
                                        <div class="as_font14 as_margin0 mb-2">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}
                                        </div>
                                        <a href="{{ route('single-service', $item->slug) }}" class="as_link  ">
                                            read more
                                        </a>
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
