@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-3 col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Enquires</h5>
                                        <h3>{{ $enquiriesCount }}</h3>
                                        <a href="{{ route('admin.enquires.index') }}"
                                            class="btn btn-sm btn-outline-info">View
                                            Enquires</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Products</h5>
                                        <h3>{{ $productsCount }}</h3>
                                        <a href="{{ route('admin.products.index') }}"
                                            class="btn btn-sm btn-outline-info">View
                                            Products</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Services</h5>
                                        <h3>{{ $servicesCount }}</h3>
                                        <a href="{{ route('admin.services.index') }}"
                                            class="btn btn-sm btn-outline-info">View
                                            Services</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Blogs</h5>
                                        <h3>{{ $blogsCount }}</h3>
                                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-info">View
                                            Blogs</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
