@extends('layouts.app')
@section('title', 'Enquiries')
@section('content')
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Enquiries</li>
            </ol>
        </nav>
        <form action="{{ route('admin.enquires.multipleDelete') }}" method="POST" id="multiple-delete">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0 float-start">{{ __('Enquiries') }}</h2>
                            <button type="submit" class="btn btn-danger float-end ms-2">
                                <i class="fa-solid fa-trash"></i> Delete Selected
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <input type="checkbox" id="select-all" class="form-check-input me-2"> Select
                                                All
                                            </th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col-2">Phone No.</th>
                                            <th scope="col-2">Message</th>
                                            <th scope="col-2">Date & Time</th>
                                            <th scope="col-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($enquiries as $item)
                                            <tr>
                                                <th scope="row">
                                                    <input type="checkbox" class="item-checkbox form-check-input me-2"
                                                        name="ids[]" value="{{ $item->id }}">
                                                    {{ $loop->iteration + ($enquiries->firstItem() - 1) }}
                                                </th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ Str::words($item->message, 15, '...') }}</td>
                                                <td>{{ $item->created_at->format('d M Y, h:i A') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.enquires.show', $item->id) }}"
                                                        class="btn btn-secondary">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-danger delete-confirm"
                                                        data-url="{{ route('admin.enquires.delete', $item->id) }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                                {{ $enquiries->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
