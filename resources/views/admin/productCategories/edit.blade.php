@extends('layouts.app')
@section('title', 'Edit Product Category')
@section('content')
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.productCategories.index') }}">Product Categories</a>
                </li>
                <li class="breadcrumb-item active">Edit {{ $productCategory->title }}</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0 float-start">{{ __('Edit Product Category') }}</h2>
                        <a href="{{ route('admin.productCategories.index') }}" class="btn btn-secondary float-end">
                            <i class="fa-solid fa-backward"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.productCategories.update', $productCategory->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            @include('admin.productCategories.form')
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
