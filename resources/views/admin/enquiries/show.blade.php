@extends('layouts.app')
@section('title', 'Enquiry Details')
@section('content')
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.enquires.index') }}">Enquires</a></li>
                <li class="breadcrumb-item active">Enquiry Details</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0 float-start">{{ __('View Enquiry') }}</h2>
                        <a href="{{ route('admin.enquires.index') }}" class="btn btn-secondary float-end">
                            <i class="fa-solid fa-backward"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Name:</strong> {{ $enquiry->name }}</p>
                                <p><strong>Email:</strong> {{ $enquiry->email }}</p>
                                <p><strong>Phone:</strong> {{ $enquiry->phone }}</p>
                                <p><strong>Message:</strong><br>{{ $enquiry->message }}</p>
                                <p><strong>Date & Time:</strong> {{ $enquiry->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
