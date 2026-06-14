@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="mb-0">Import the Excel file (xlsx, xls, csv)</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data"
                    class="d-flex gap-2 align-items-end flex-wrap">
                    @csrf
                    <input type="file" name="excel_file" class="form-control mb-3" required>
                    <div class="d-flex gap-2 flex-wrap">
                        <div class=" mb-2">
                            <button type="submit" class="btn btn-primary mb-3">
                                <i class="fa-solid fa-file-import"></i> Import Excel
                            </button>
                        </div>
                        <div class=" mb-2">
                            <a href="{{ asset('import-file-sample/sample_products_import.xlsx') }}"
                                class="btn btn-outline-secondary mb-3" download>
                                <i class="fa-solid fa-download"></i> Download Sample File
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form action="{{ route('admin.products.multipleDelete') }}" method="POST" id="multiple-delete">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0 float-start">{{ __('Products') }}</h2>
                            <button type="submit" class="btn btn-danger float-end ms-2">
                                <i class="fa-solid fa-trash"></i> Delete Selected
                            </button>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-success float-end">
                                <i class="fa-solid fa-plus"></i>
                            </a>
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
                                            <th scopre="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Category</th>
                                            <th scope="col-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable">
                                        @foreach ($products as $index => $item)
                                            <tr data-id="{{ $item->id }}">
                                                <th scope="row">
                                                    <input type="checkbox" class="item-checkbox form-check-input me-2"
                                                        name="ids[]" value="{{ $item->id }}">
                                                    {{ $index + 1 }}
                                                </th>
                                                <td><img
                                                        src="{{ asset(isset($item->images[0]) ? $item->images[0]['image_url'] : '') }}">
                                                </td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td>{{ $item->category->title ?? 'NULL' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.products.edit', $item->slug) }}"
                                                        class="btn btn-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a class="btn btn-danger delete-confirm"
                                                        data-url="{{ route('admin.products.delete', $item->slug) }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(function() {
            $('#sortable').sortable({
                update: function(event, ui) {
                    var order = [];
                    $('#sortable tr').each(function(index, element) {
                        order.push({
                            id: $(element).attr('data-id'),
                            position: index + 1
                        });
                    });

                    $.ajax({
                        url: '{{ route('admin.products.reorder') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            order: order
                        },
                        success: function(response) {
                            console.log(response.message);
                        }
                    });
                }
            });
        });
    </script>
@endsection
