@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title fw-semibold mb-4">User List</h5>
                        <a href="{{ route('user.create') }}" class="btn btn-secondary"><i class="fas fa-plus me-1"></i> Add
                            user</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($users))
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td class="d-flex align-items-center">
                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="btn btn-outline-primary btn-sm me-2" title="Edit"><i
                                                            class="fas fa-pen-to-square"></i></a>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" title="Delete"
                                                            class="btn btn-outline-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p class="alert alert-danger">No user found</p>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
