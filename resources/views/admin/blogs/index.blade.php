@extends('layouts.app')
@section('title', 'blogs')
@section('content')
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Blogs</li>
            </ol>
        </nav>
        <form action="{{ route('admin.blogs.multipleDelete') }}" method="POST" id="multiple-delete">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0 float-start">{{ __('Blogs') }}</h2>
                            <button type="submit" class="btn btn-danger float-end ms-2">
                                <i class="fa-solid fa-trash"></i> Delete Selected
                            </button>
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-success float-end">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"> <input type="checkbox" id="select-all"
                                                    class="form-check-input me-2"> Select
                                                All</th>
                                            <th scopre="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $item)
                                            <tr>
                                                <th scope="row">
                                                    <input type="checkbox" class="item-checkbox form-check-input me-2"
                                                        name="ids[]" value="{{ $item->id }}">
                                                    {{ $loop->iteration + ($blogs->firstItem() - 1) }}
                                                </th>
                                                <td><img src="{{ asset($item->image_url) }}"></td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td>
                                                    <a href="{{ route('admin.blogs.edit', $item->slug) }}"
                                                        class="btn btn-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a class="btn btn-danger delete-confirm"
                                                        data-url="{{ route('admin.blogs.delete', $item->slug) }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $blogs->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
