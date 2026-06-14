@extends('layouts.app')
@section('title', 'Coupons')
@section('content')
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Coupons</li>
            </ol>
        </nav>
        <form action="{{ route('admin.coupons.multipleDelete') }}" method="POST" id="multiple-delete">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0 float-start">{{ __('Coupons') }}</h2>
                            <button type="submit" class="btn btn-danger float-end ms-2">
                                <i class="fa-solid fa-trash"></i> Delete Selected
                            </button>
                            <a href="{{ route('admin.coupons.create') }}" class="btn btn-success float-end">
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
                                            <th scope="col">Code</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Discount Value</th>
                                            <th scope="col">Minimum Order Amount</th>
                                            <th scope="col">usage Limit</th>
                                            <th scope="col">Expires at</th>
                                            <th scope="col-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $item)
                                            <tr>
                                                <th scope="row">
                                                    <input type="checkbox" class="item-checkbox form-check-input me-2"
                                                        name="ids[]" value="{{ $item->id }}">
                                                    {{ $loop->iteration + ($coupons->firstItem() - 1) }}
                                                </th>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ ucfirst($item->type) }}</td>
                                                <td>{{ $item->discount_value }}
                                                    {{ $item->type == 'percentage' ? '%' : '₹' }}</td>
                                                <td>{{ $item->minimum_order_amount ?? 'None' }}</td>
                                                <td>{{ $item->used }}/{{ $item->usage_limit ?? '∞' }}</td>
                                                <td>{{ $item->expires_at ?? 'No Expiry' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.coupons.edit', $item->id) }}"
                                                        class="btn btn-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a class="btn btn-danger delete-confirm"
                                                        data-url="{{ route('admin.coupons.delete', $item->id) }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $coupons->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
