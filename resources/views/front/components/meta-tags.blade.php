 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <meta name="robots" content="index, follow">

 <title> {{ $title ?? $settings->site_name }} </title>

 <meta property="title" content="{{ $meta_title ?? $settings->site_name }}">
 <meta name="description" content="{{ $meta_description ?? '' }}">
 <meta name="keywords" content="{{ $meta_keywords ?? '' }}">
 <meta name="author" content="{{ $settings->site_name ?? '' }}">



 <meta property="og:title" content="{{ $meta_title ?? $settings->site_name }}">
 <meta property="og:description" content="{{ $meta_description ?? '' }}">
 <meta property="og:image" content="{{ asset($settings->light_logo) }}">
 <meta property="og:url" content="{{ url()->current() }}">
 <meta property="og:type" content="website">


 <meta name="twitter:card" content="summary_large_image">
 <meta name="twitter:title" content="{{ $meta_title ?? $settings->site_name }}">
 <meta name="twitter:description" content="{{ $meta_description ?? '' }}">
 <meta name="twitter:image" content="{{ asset($settings->light_logo) }}">

 {!! $meta_tags ?? '' !!}

 @isset($settings->favicon)
     <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($settings->favicon) }}">
 @endisset


 {{-- =========================
    GLOBAL SCHEMA
========================= --}}

 <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "{{ $settings->site_name }}",
    "url": "{{ url('/') }}",
    "logo": "{{ asset($settings->light_logo) }}",
    "image": "{{ asset($settings->light_logo) }}",
    "sameAs": [
        @foreach($settings->social_links as $links)
         "{{ $links['url'] }}"@if(!$loop->last),@endif
        @endforeach
    ]
}
</script>


 {{-- =========================
    LOCAL BUSINESS SCHEMA
========================= --}}

 <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "{{ $settings->site_name }}",
    "image": "{{ asset($settings->light_logo) }}",
    "url": "{{ url('/') }}",
    "telephone": [

    @foreach($settings->contact_phones as $phone)

        "{{ $phone }}"@if(!$loop->last),@endif

    @endforeach

],
"email": [

    @foreach($settings->contact_emails as $email)

        "{{ $email }}"@if(!$loop->last),@endif

    @endforeach

],
    "priceRange": "$$",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "IN"
    }
}
</script>


 {{-- =========================
    WEBPAGE SCHEMA
========================= --}}

 <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "{{ $meta_title ?? $settings->site_name }}",
    "description": "{{ $meta_description ?? '' }}",
    "url": "{{ url()->current() }}"
}
</script>


 {{-- =========================
    Zodiac Sign SCHEMA
========================= --}}

 @if (isset($zodiacSign))
     <script type="application/ld+json">
{
    "@context":"https://schema.org",
    "@type":"Zodiac Sign",
    "serviceType":"{{ $zodiacSign->title }}",
    "name":"{{ $meta_title ?? $zodiacSign->title }}",
    "description":"{{ $meta_description ?? '' }}",
    "provider":{
        "@type":"LocalBusiness",
        "name":"{{ $settings->site_name }}"
    },
    "url":"{{ url()->current() }}"
}
</script>
 @endif





 {{-- =========================
    SERVICE SCHEMA
========================= --}}

 @if (isset($service))
     <script type="application/ld+json">
{
    "@context":"https://schema.org",
    "@type":"Service",
    "serviceType":"{{ $service->title }}",
    "name":"{{ $meta_title ?? $service->title }}",
    "description":"{{ $meta_description ?? '' }}",
    "provider":{
        "@type":"LocalBusiness",
        "name":"{{ $settings->site_name }}"
    },
    "url":"{{ url()->current() }}"
}
</script>
 @endif


 {{-- =========================
    BLOG / ARTICLE SCHEMA
========================= --}}

 @if (isset($blog))
     <script type="application/ld+json">
{
    "@context":"https://schema.org",
    "@type":"Article",
    "headline":"{{ $meta_title ?? $blog->title }}",
    "description":"{{ $meta_description ?? '' }}",
    "image":"{{ asset($settings->light_logo) }}",
    "author":{
        "@type":"Person",
        "name":"{{ $settings->site_name }}"
    },
    "publisher":{
        "@type":"Organization",
        "name":"{{ $settings->site_name }}",
        "logo":{
            "@type":"ImageObject",
            "url":"{{ asset($settings->light_logo) }}"
        }
    },
    "mainEntityOfPage":"{{ url()->current() }}"
}
</script>
 @endif


 {{-- =========================
    BREADCRUMB SCHEMA
========================= --}}

 <script type="application/ld+json">
{
    "@context":"https://schema.org",
    "@type":"BreadcrumbList",
    "itemListElement":[
        {
            "@type":"ListItem",
            "position":1,
            "name":"Home",
            "item":"{{ url('/') }}"
        },
        {
            "@type":"ListItem",
            "position":2,
            "name":"{{ $meta_title ?? $settings->site_name }}",
            "item":"{{ url()->current() }}"
        }
    ]
}
</script>
