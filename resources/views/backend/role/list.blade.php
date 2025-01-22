@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4 cfd">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <input type="search" class="form-control" placeholder="Enter role name" style="margin-right: 2px;">
                            <button type="submit"
                                class="btn btn-secondary btn-sm d-flex justify-content-center align-items-center"
                                style="border-radius: 10px"><i class="fas fa-search"></i>Search</button>
                        </div>
                        @can('add role')
                            <a href="{{ route('role.create') }}" class="btn btn-secondary"><i class="fas fa-plus me-1"></i> Add
                                role</a>
                        @endcan
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if ($roles->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="table-primary">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                @can(['edit role', 'delete role'])
                                                    <th scope="col">Handle</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $key => $role)
                                                <tr>
                                                    <th scope="row">{{ $roles->firstItem() + $key }}</th>
                                                    <td>{{ $role->name }}</td>
                                                    <td class="d-flex align-items-center">
                                                        @can('edit role')
                                                            <a href="{{ route('role.edit', $role->id) }}"
                                                                class="btn btn-outline-primary btn-sm me-2" title="Edit"><i
                                                                    class="fas fa-pen-to-square"></i></a>
                                                        @endcan
                                                        @can('delete role')
                                                            <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                                                class="delete-form">
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
                                </div>
                            @else
                                <p class="alert alert-danger">No role found</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center ">
                            {{ $roles->links() }}
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
@endsection
