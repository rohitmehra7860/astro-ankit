<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $settings->site_name ?? '')</title>

    <link rel="icon" type="image/png" href="{{ asset($settings->favicon ?? '') }}">

    <!-- First: jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Second: jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- jQuery UI Touch Punch (makes jQuery UI sortable work on touch devices) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"
        integrity="sha512-ZZpm1cNsXqA4VtzLa9lMzRfP7gvqewfXsulUmGc6lTRVtnRxzXBgDJoWS1YrpWcWDarOY+HXmFNwlEckpgyf6w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!--My Css-->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <div class="container-fluid p-0">
            <div class="row gx-0 ">
                <div class="col-lg-2 col-md-3  p-0">
                    <div class="d-md-none bg-dark p-2 d-flex align-items-center">
                        <a class="navbar-brand " href="{{ route('admin.index') }}">
                            <h4 class="mb-0 text-light">
                                {{ $settings->site_name ?? '' }}
                            </h4>
                        </a>
                        <button class="btn btn-outline-light ms-auto" type="button" data-bs-toggle="collapse"
                            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <nav class="collapse d-md-block navbar-dark bg-dark shadow-sm flex-column overflow-auto vh-md-100"
                        id="sidebarMenu">

                        <a class="navbar-brand  d-none d-md-block " href="{{ route('admin.index') }}">
                            <h4 class="mb-2 px-2 pt-3">
                                {{ $settings->site_name ?? '' }}
                            </h4>
                        </a>
                        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button> --}}



                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav flex-column">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ Route::is('login') ? 'active' : '' }}"
                                            href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ Route::is('register') ? 'active' : '' }}"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}"
                                        href="{{ route('admin.index') }}">
                                        <i class="fas fa-tachometer-alt"></i>
                                        {{ __('Dashboard') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.enquires.index') ? 'active' : '' }}"
                                        href="{{ route('admin.enquires.index') }}">
                                        <i class="fa-regular fa-bell"></i>
                                        {{ __('Enquires') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.galleries.index') ? 'active' : '' }}"
                                        href="{{ route('admin.galleries.index') }}">
                                        <i class="fas fa-images"></i>
                                        {{ __('Gallery') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.banners.index') ? 'active' : '' }}"
                                        href="{{ route('admin.banners.index') }}">
                                        <i class="fa-solid fa-image"></i>
                                        {{ __('Banners') }}
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.catalogs.index') ? 'active' : '' }}"
                                        href="{{ route('admin.catalogs.index') }}">
                                        <i class="far fa-file-pdf"></i>
                                        {{ __('Catalogs') }}
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.products.index') ? 'active' : '' }}"
                                        href="{{ route('admin.products.index') }}">
                                        <i class="fa-brands fa-product-hunt"></i>
                                        {{ __('Products') }}
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.coupons.index') ? 'active' : '' }}"
                                        href="{{ route('admin.coupons.index') }}">
                                        <i class="fa fa-gift"></i>
                                        {{ __('Coupons') }}
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.productCategories.index') ? 'active' : '' }}"
                                        href="{{ route('admin.productCategories.index') }}">
                                        <i class="fa fa-list-alt"></i>
                                        {{ __('Product Categories') }}
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.colors.index') ? 'active' : '' }}"
                                        href="{{ route('admin.colors.index') }}">
                                        <i class="fa-solid fa-palette"></i>
                                        {{ __('Colors') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.sizes.index') ? 'active' : '' }}"
                                        href="{{ route('admin.sizes.index') }}">
                                        <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                        {{ __('Sizes') }}
                                    </a>
                                </li> --}}

                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.pages.index') ? 'active' : '' }}"
                                        href="{{ route('admin.pages.index') }}">
                                        <i class="fa-regular fa-file"></i>
                                        {{ __('Pages') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.testimonials.index') ? 'active' : '' }}"
                                        href="{{ route('admin.testimonials.index') }}">
                                        <i class="fa-regular fa-comments"></i>
                                        {{ __('Testimonials') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.services.index') ? 'active' : '' }}"
                                        href="{{ route('admin.services.index') }}">
                                        <i class="fa-regular fa-paper-plane"></i>
                                        {{ __('Services') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.zodiac-signs.index') ? 'active' : '' }}"
                                        href="{{ route('admin.zodiac-signs.index') }}">
                                        <i class="fa-regular fa-paper-plane"></i>
                                        {{ __('Zodiac Signs') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.blogs.index') ? 'active' : '' }}"
                                        href="{{ route('admin.blogs.index') }}">
                                        <i class="fa-regular fa-font-awesome"></i>
                                        {{ __('Blogs') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.settings.index') ? 'active' : '' }}"
                                        href="{{ route('admin.settings.index') }}">
                                        <i class="fa-solid fa-gear"></i> {{ __('Settings') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.smtp.edit') ? 'active' : '' }}"
                                        href="{{ route('admin.smtp.edit') }}">
                                        <i class="fa-solid fa-gear"></i> {{ __('SMTP') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.clear-cache') ? 'active' : '' }}"
                                        href="{{ route('admin.clear-cache') }}">
                                        <i class="fa-solid fa-broom"></i> {{ __('Clear Cache') }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>

                            @endguest
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-10 col-md-9  flex-grow-1">
                    <main class="py-4 vh-100 overflow-auto">
                        @include('admin.alerts')
                        @yield('content')
                    </main>
                </div>
            </div> <!-- row -->
        </div> <!-- container-fluid -->

    </div>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- tinymce -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js"
        integrity="sha512-/4EpSbZW47rO/cUIb0AMRs/xWwE8pyOLf8eiDWQ6sQash5RP1Cl8Zi2aqa4QEufjeqnzTK8CLZWX7J5ZjLcc1Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--My Javascript-->
    <script src="{{ asset('admin-assets/js/javascript.js') }}"></script>
    <script>
        // Handle SweetAlert2 session messages dynamically
        let
            messageType =
            "{{ session('success') ? 'success' : (session('warning') ? 'warning' : (session('error') ? 'error' : '')) }}";
        let messageText = "{{ session('success') ?? (session('warning') ?? (session('error') ?? '')) }}";

        if (messageType && messageText) {
            Swal.fire({
                title: messageType.charAt(0).toUpperCase() + messageType.slice(1) + "!",
                text: messageText,
                icon: messageType,
                timer: 3000, // Auto close after 3 seconds
                showConfirmButton: false
            });
        }
    </script>
</body>

</html>
