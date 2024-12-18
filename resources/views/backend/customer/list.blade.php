@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <input type="search" class="form-control" placeholder="Customer" style="margin-right: 2px;">
                            <button type="submit"
                                class="btn btn-secondary btn-sm d-flex justify-content-center align-items-center"
                                style="border-radius: 10px"><i class="fas fa-search"></i>Search</button>
                        </div>
                        @can('add customer')
                            <a href="{{ route('customer.create') }}" class="btn btn-secondary"><i class="fas fa-plus me-1"></i>
                                Add
                                customer</a>
                        @endcan
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if ($customers->count() > 0)
                                <table class="table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            @can(['edit customer', 'delete customer'])
                                                <th scope="col">Handle</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $key => $customer)
                                            <tr>
                                                <th scope="row">{{ $customers->firstItem() + $key }}</th>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->phone ?? 'Chưa có' }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{!! \App\Helpers\Helper::active($customer->status, $customer->id, 'customer') !!}</td>
                                                <td class="d-flex align-items-center">
                                                    @can('edit customer')
                                                        <a href="{{ route('customer.edit', $customer->id) }}"
                                                            class="btn btn-outline-primary btn-sm me-2" title="Edit"><i
                                                                class="fas fa-pen-to-square"></i></a>
                                                    @endcan
                                                    @can('delete customer')
                                                        <form action="{{ route('customer.destroy', $customer->id) }}"
                                                            method="POST" class="delete-form">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" title="Delete"
                                                                class="btn btn-outline-danger btn-sm delete-btn"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="alert alert-danger">No customer found</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center ">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    <script src="{{ asset('backend/assets/js/changeStatus.js') }}"></script>
@endsection
