@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <input type="search" class="form-control" placeholder="User" style="margin-right: 2px;">
                            <button type="submit"
                                class="btn btn-secondary btn-sm d-flex justify-content-center align-items-center"
                                style="border-radius: 10px"><i class="fas fa-search"></i>Search</button>
                        </div>
                        @can('add user')
                            <a href="{{ route('user.create') }}" class="btn btn-secondary"><i class="fas fa-plus me-1"></i> Add
                                user</a>
                        @endcan
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if ($users->count() > 0)
                                <table class="table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            @can(['edit user', 'delete user'])
                                                <th scope="col">Handle</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <th scope="row">{{ $users->firstItem() + $key }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td class="d-flex align-items-center">
                                                    @can('edit user')
                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-outline-primary btn-sm me-2" title="Edit"><i
                                                                class="fas fa-pen-to-square"></i></a>
                                                    @endcan
                                                    @can('delete user')
                                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
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
                            @else
                                <p class="alert alert-danger">No user found</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center ">
                            {{ $users->links() }}
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
