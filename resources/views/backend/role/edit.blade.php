@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><a href="{{ route('role.index') }}"><i
                                class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Edit role
                        {{ $role->name }}</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('role.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" value="{{ $role->name }}" class="form-control" id="name"
                                        aria-describedby="emailHelp" name="name" @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input checkbox-childrent check-all"type="checkbox"
                                            id="checkall">
                                        <label class="form-check-label" for="checkall">Check all</label>
                                    </div>
                                </div>
                                @foreach ($permissionParent as $va)
                                    <div class="mb-3 module-parent">
                                        <div class="form-check bg-success-gradient form-custom">
                                            <input id="module{{ $va->id }}" type="checkbox" value=""
                                                class="form-check-input checkbox-parent">
                                            <label class="form-check-label" for="module{{ $va->id }}"
                                                id="lable-module">{{ $va->name }}</label>
                                        </div>
                                        <div class="text-center">
                                            @if ($va->permissionChildrent->isNotEmpty())
                                                @foreach ($va->permissionChildrent as $item)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input checkbox-childrent"
                                                            {{ $permissionChecked->contains('id', $item->id) ? 'checked' : '' }}
                                                            name="permission_id[]" type="checkbox"
                                                            id="module{{ $va->id }}-{{ $item->id }}"
                                                            value="{{ $item->id }}">
                                                        <label class="form-check-label"
                                                            for="module{{ $va->id }}-{{ $item->id }}">{{ $item->name }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/role/roles.css') }}">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/js/role/role.js') }}"></script>
@endsection
