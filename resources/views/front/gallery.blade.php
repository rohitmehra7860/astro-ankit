@extends('layouts.front')
@section('content')
    <section class="py-5">
        <div class="container">


            <div class="row gallery">
                @foreach ($gallery as $image)
                    <div class="col-md-3 mb-3">
                        <a href="{{ asset($image->image_url) }}" class="gallery-item">
                            <img src="{{ asset($image->image_url) }}" alt="Image" class="img-fluid rounded" style="width: 100%;
    height: 300px;
    object-fit: cover;"/>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('front.components.contact-component')
@endsection
