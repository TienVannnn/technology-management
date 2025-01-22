@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4 cfd">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <input type="search" class="form-control" placeholder="Permission" style="margin-right: 2px;">
                            <button type="submit"
                                class="btn btn-secondary btn-sm d-flex justify-content-center align-items-center"
                                style="border-radius: 10px"><i class="fas fa-search"></i>Search</button>
                        </div>
                        @can('add permission')
                            <a href="{{ route('permission.create') }}" class="btn btn-secondary"><i
                                    class="fas fa-plus me-1"></i> Add
                                permission</a>
                        @endcan
                    </div>
                    <div class="card ">
                        <div class="card-body">
                            @if ($permissions->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="table-primary">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Parent</th>
                                                @can(['edit permission', 'delete permission'])
                                                    <th scope="col">Handle</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {!! \App\Helpers\Helper::permission($permissions, 0, '', $permissions->firstItem()) !!}
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="alert alert-danger">No permission found</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center ">
                            {{ $permissions->links() }}
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
