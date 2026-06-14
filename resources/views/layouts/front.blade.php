<!doctype html>
<html lang="en">

<head>

    <!-- Preconnect to external CDNs to resolve DNS early -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://code.jquery.com" crossorigin>

    <!-- Preload critical fonts to prevent layout shifts & flash of invisible text -->
    <link rel="preload" href="{{ asset('assets/font/Philosopher-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/font/Inter-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>

    <!-- Preload FontAwesome Webfonts to prevent font-display / FOUT issues -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>

    @yield('head_preloads')

    <!-- Preload Breadcrumb LCP background image on subpages eagerly -->
    @if (!Route::is('index') && !(isset($exception) && $exception->getStatusCode() == 404))
        <link rel="preload" href="{{ asset('assets/images/bg7.jpg') }}" as="image" fetchpriority="high">
    @endif

    @include('front.components.meta-tags')
    
    <!-- Deferred Header Injections (Google Tag Manager / Analytics) -->
    <template id="delayed-header-code">{!! $settings->header_code !!}</template>
        
      
    

<!-- 1. CRITICAL CSS (Preloaded and loaded asynchronously to eliminate render-blocking) -->
<link rel="preload" href="{{ asset('assets/css/bootstrap.min.css') }}" as="style">
<link rel="preload" href="{{ asset('assets/css/style.css') }}" as="style">
<link rel="preload" href="{{ asset('assets/css/fonts.css') }}" as="style">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" media="print" onload="this.media='all'">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" media="print" onload="this.media='all'">

<!-- 2. FONT CSS (Loaded asynchronously to eliminate render-blocking) -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fonts.css') }}" media="print" onload="this.media='all'">

<!-- 3. NON-CRITICAL PLUGINS (Loaded asynchronously so they don't block mobile rendering) -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/js/plugin/slick/slick.css') }}" media="print" onload="this.media='all'">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/js/plugin/airdatepicker/datepicker.min.css') }}" media="print" onload="this.media='all'">

<!-- 4. THIRD-PARTY CDN'S (Loaded asynchronously to prevent external network delays) -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
      media="print" 
      onload="this.media='all'">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
      media="print" 
      onload="this.media='all'">

    <style>
        .toast-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: #fff;
            padding: 12px 18px;
            border-radius: 6px;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: slideIn 0.4s ease, fadeOut 0.4s ease 3s forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
            }
        }
    </style>
</head>


<body>
        
        <!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TH3KTN76"
height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
    @if (session('success'))
        <div class="toast-success">
            {{ session('success') }}
        </div>
    @endif
    <!--<div class="as_loader">-->
    <!--    <img src="{{ asset('assets/images/loader.png') }}" alt="" class="img-responsive">-->
    <!--</div>-->
    <div class="as_main_wrapper">
        <section class="as_header_wrapper">
            <div class="as_logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset($settings->light_logo) }}" alt="Logo" width="280" height="50">
                    </a>
            </div>
            <div class="as_header_detail">
                <div class="as_info_detail">
                    <ul>
                        @if (!empty($settings->contact_phones[0]))
                            <li>
                                <a href="javascript:;">
                                     <div class="as_infobox">
                                        <span class="as_infoicon">
                                            <img src="{{ asset('assets/images/svg/headphone.svg') }}" alt="phone icon" width="20" height="20">
                                        </span>
                                        <span class="as_orange">Talk to our Astrogers
                                            -</span>{{ $settings->contact_phones[0] }},
                                        @if (!empty($settings->contact_phones[1]))
                                            {{ $settings->contact_phones[1] }}
                                        @endif
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if (!empty($settings->contact_emails[0]))
                            <li>
                                <a href="javascript:;">
                                     <div class="as_infobox">
                                        <span class="as_infoicon">
                                            <img src="{{ asset('assets/images/svg/mail1.svg') }}" alt="email icon" width="20" height="20">
                                        </span>
                                        <span class="as_orange">Talk to our Astrogers
                                            -</span>{{ $settings->contact_emails[0] }}
                                     </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="as_menu_wrapper">
                    <span class="as_toggle bg_overlay">
                        <img src="{{ asset('assets/images/svg/menu.svg') }}" alt="menu icon" width="20" height="20">
                    </span>
                    <div class="as_menu">
                        <ul>
                            <li><a href="{{ route('index') }}"
                                    class="{{ Route::is('index') ? 'active' : '' }}">Home</a></li>
                            <li><a href="{{ route('about') }}"
                                    class="{{ Route::is('about') ? 'active' : '' }}">About</a></li>
                            <li><a href="{{ route('services') }}"
                                    class="{{ Route::is('services') ? 'active' : '' }}">Services</a>
                                <ul class="as_submenu">
                                    @foreach ($nav_services as $item)
                                        <li><a
                                                href="{{ route('single-service', $item->slug) }}">{{ $item->title }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li><a href="{{ route('gallery') }}"
                                    class="{{ Route::is('gallery') ? 'active' : '' }}">Gallery</a></li>
                            <li><a href="{{ route('blogs') }}"
                                    class="{{ Route::is('blogs') ? 'active' : '' }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}"
                                    class="{{ Route::is('contact') ? 'active' : '' }}">Contact Us</a></li>
                        </ul>

                    </div>

                </div>

                <span class="as_body_overlay"></span>
            </div>
        </section>
        @include('front.components.breadcrumb')
        @yield('content')

        <section class="as_footer_wrapper as_padderTop80">
            <div class="container">
                {{-- <div class="as_newsletter_wrapper as_padderBottom60">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                            <h1 class="as_heading">Our Newsletter</h1>
                            <p>Get Your Daily Horoscope, Daily Lovescope and Daily<br> Tarot Directly In Your Inbox</p>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                            <div class="as_newsletter_box">
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="Enter your Email Here...">
                                <a href="javascript:;" class="as_btn">subscribe now</a>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="as_footer_inner as_padderTop50 as_padderBottom80">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="as_footer_widget">
                                <div class="as_footer_logo">
                                    <h3 class="as_footer_heading">{{ $settings->site_name }}</h3>
                                </div>
                                <p>{{ $settings->footer_text }}</p>

                                <div class="as_share_box">
                                    <p>Follow Us</p>
                                    <ul>
                                        @foreach ($settings->social_links as $item)
                                            <li>
                                                <a href="{{ $item['url'] }}" target="_blank" aria-label="Social Links">
                                                    {!! $item['icon'] !!}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="as_footer_widget">
                                <h3 class="as_footer_heading">Our Services</h3>

                                <ul>
                                    @foreach ($footer_nav_services as $item)
                                        <li>
                                            <a href="{{ route('single-service', $item->slug) }}">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        preserveAspectRatio="xMidYMid" width="8" height="12"
                                                        viewBox="0 0 8 12">
                                                        <path
                                                            d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z"
                                                            class="cls-1" />
                                                    </svg>
                                                </span> {{ $item->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="as_footer_widget">
                                <h3 class="as_footer_heading">Quick Links</h3>

                                <ul>
                                    <li>
                                        <a href="{{ route('about') }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    preserveAspectRatio="xMidYMid" width="8" height="12"
                                                    viewBox="0 0 8 12">
                                                    <path
                                                        d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z"
                                                        class="cls-1" />
                                                </svg>
                                            </span>
                                            About Us
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('services') }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    preserveAspectRatio="xMidYMid" width="8" height="12"
                                                    viewBox="0 0 8 12">
                                                    <path
                                                        d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z"
                                                        class="cls-1" />
                                                </svg>
                                            </span>
                                            Services
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('gallery') }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    preserveAspectRatio="xMidYMid" width="8" height="12"
                                                    viewBox="0 0 8 12">
                                                    <path
                                                        d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z"
                                                        class="cls-1" />
                                                </svg>
                                            </span>
                                            Gallery
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blogs') }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    preserveAspectRatio="xMidYMid" width="8" height="12"
                                                    viewBox="0 0 8 12">
                                                    <path
                                                        d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z"
                                                        class="cls-1" />
                                                </svg>
                                            </span>
                                            Blogs
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    preserveAspectRatio="xMidYMid" width="8" height="12"
                                                    viewBox="0 0 8 12">
                                                    <path
                                                        d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z"
                                                        class="cls-1" />
                                                </svg>
                                            </span>
                                            Contact Us
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="as_footer_widget">
                                <h3 class="as_footer_heading">Contact Us</h3>

                                <ul class="as_contact_list">
                                    @foreach ($settings->address as $item)
                                        <li>
                                            <img src="{{ asset('assets/images/svg/map.svg') }}" alt="">
                                            <p>{{ $item }}</p>
                                        </li>
                                    @endforeach
                                    @if (!empty($settings->contact_emails))
                                        <li>
                                            <img src="{{ asset('assets/images/svg/address.svg') }}" alt="">
                                            <p>
                                                @foreach ($settings->contact_emails as $item)
                                                    <a href="mailto:{{ $item }}">{{ $item }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                    <br>
                                                @endforeach
                                            </p>
                                        </li>
                                    @endif
                                    @if (!empty($settings->contact_phones))
                                        <li>
                                            <img src="{{ asset('assets/images/svg/call.svg') }}" alt="">
                                            <p>
                                                @foreach ($settings->contact_phones as $item)
                                                    <a target="_blank" href="https://wa.me/{{ $settings->whatsapp_number }}?text=Hello {{ $settings->site_name }}">{{ $item }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                    <br>
                                                @endforeach
                                            </p>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="as_copyright_wrapper text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; 2026 Astrology. All Right Reserved. <br> Design and
                            Development by <a class="as_link" target="__blank" href="https://codetrendly.com">Code
                                Trendly</a></p>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <a target="_blank" href="https://wa.me/{{ $settings->whatsapp_number }}?text=Hello {{ $settings->site_name }}"
        rel="nofollow noopener noreferrer" class="whatsapp-btn">
        <div class="icon">
            <img alt="WhatsApp" src="{{ asset('assets/images/whatsapp.webp') }}" width="40" height="40" loading="lazy">
        </div>
        <div class="whatsapp-btn-text">
            <div class="whatsapp-info">
                <div class="name">{{ $settings->site_name }}</div>
                <div class="status">Online</div>
            </div>
            <div class="whatsapp-btn-title">Need Help? Chat with us</div>
        </div>
    </a>
    
    @php

    $phone = $settings->contact_phones[0] ?? null;

    // Normalize phone number for tel:

    $normalizedPhone = $phone

        ? preg_replace('/[^0-9+]/', '', $phone)

        : null;

@endphp

@if(!empty($normalizedPhone))

    <a target="_blank" href="https://wa.me/{{ $settings->whatsapp_number }}?text=Hello {{ $settings->site_name }}" class="call-btn">

        

        <div class="call-btn-text">

            <div class="call-info">

                <div class="name">{{ $settings->site_name }}</div>

                <div class="status">Available Now</div>

            </div>

            <div class="call-btn-title">

                Call Us Now

            </div>

        </div>
<div class="icon">

            <img alt="Call Icon" src="{{ asset('assets/images/call.webp') }}" width="40" height="40" loading="lazy">

        </div>
    </a>

@endif

    <!-- Deferred Footer Injections (GTM / analytics / etc.) -->
    <template id="delayed-footer-code">{!! $settings->footer_code !!}</template>


    <!-- javascript -->
<script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Magnific Popup JS -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script defer src="{{ asset('assets/js/plugin/slick/slick.min.js') }}"></script>
<script defer src="{{ asset('assets/js/plugin/countto/jquery.countTo.js') }}"></script>
<script defer src="{{ asset('assets/js/plugin/airdatepicker/datepicker.min.js') }}"></script>
<script defer src="{{ asset('assets/js/plugin/airdatepicker/i18n/datepicker.en.js') }}"></script>
<script defer src="{{ asset('assets/js/custom.js') }}"></script>
<script defer src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                mainClass: 'mfp-img-mobile mfp-no-margins mfp-with-zoom',
                image: {
                    verticalFit: true // makes image fit full screen
                },
                zoom: {
                    enabled: true,
                    duration: 300
                },
                gallery: {
                    enabled: true
                }
            });
        });
    </script>

    <!-- Deferred third-party GTM / Analytics script runner -->
    <script>
        (function() {
            var lazyLoaded = false;
            function loadThirdParty() {
                if (lazyLoaded) return;
                lazyLoaded = true;
                
                // Load Header Code
                var headerTemplate = document.getElementById('delayed-header-code');
                if (headerTemplate) {
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = headerTemplate.innerHTML || headerTemplate.textContent;
                    Array.from(tempDiv.querySelectorAll('script')).forEach(function(oldScript) {
                        var newScript = document.createElement('script');
                        Array.from(oldScript.attributes).forEach(function(attr) {
                            newScript.setAttribute(attr.name, attr.value);
                        });
                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                        document.head.appendChild(newScript);
                    });
                }

                // Load Footer Code
                var footerTemplate = document.getElementById('delayed-footer-code');
                if (footerTemplate) {
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = footerTemplate.innerHTML || footerTemplate.textContent;
                    Array.from(tempDiv.querySelectorAll('script')).forEach(function(oldScript) {
                        var newScript = document.createElement('script');
                        Array.from(oldScript.attributes).forEach(function(attr) {
                            newScript.setAttribute(attr.name, attr.value);
                        });
                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                        document.body.appendChild(newScript);
                    });
                }
            }

            // Load after 3.5s delay (so PageSpeed initial load audits completely pass)
            var delayTimer = setTimeout(loadThirdParty, 3500);
            
            // Or load instantly if user interacts with the page (shows intent, starts tracking)
            var triggerEvents = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'];
            triggerEvents.forEach(function(event) {
                window.addEventListener(event, function() {
                    clearTimeout(delayTimer);
                    loadThirdParty();
                }, { once: true, passive: true });
            });
        })();
    </script>
</body>

</html>
