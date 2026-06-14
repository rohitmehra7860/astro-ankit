@if (!Route::is('index') && !(isset($exception) && $exception->getStatusCode() == 404))
    <section class="as_breadcrum_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>

                        @if (isset($exception) && $exception->getStatusCode() == 404)
                            404 - Page Not Found
                        @elseif(isset($title))
                            {{ $title }}
                        @else
                            {{ $settings->site_name }}
                        @endif
                    </h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ route('index') }}" aria-label="Home Page">Home</a></li>

                        @if (isset($product))
                            <li><a href="{{ route('products') }}" aria-label="Product Page">Products</a></li>
                        @elseif (isset($productCategory))
                            <li><a href="{{ route('product-categories') }}" aria-label="Product Categories Page">Product Categories</a></li>
                        @elseif (isset($blog))
                            <li><a href="{{ route('blogs') }}" aria-label="Blogs Page">Blogs</a></li>
                        @elseif(isset($service))
                            <li><a href="{{ route('services') }}" aria-label="Services Page">Services</a></li>
                        @endif

                        <li>
                            @if (isset($exception) && $exception->getStatusCode() == 404)
                                404 - Page Not Found
                            @elseif(isset($title))
                                {{ $title }}
                            @else
                                {{ $settings->site_name }}
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif
