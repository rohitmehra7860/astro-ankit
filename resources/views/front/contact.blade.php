@extends('layouts.front')
@section('content')
    @include('front.components.contact-component')
    <section class="as_map_section">
        {!! $settings->map_iframe !!}
    </section>
@endsection
