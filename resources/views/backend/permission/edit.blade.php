@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><a href="{{ route('permission.index') }}"><i
                                class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Edit
                        permission
                        {{ $permission->name }}</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" value="{{ $permission->name }}" class="form-control"
                                        id="name" aria-describedby="emailHelp" name="name"
                                        @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="parent" class="form-label">Parent</label>
                                    <select name="parent_id" id="parent" class="form-select">
                                        <option value="0">Main</option>
                                        @if (!empty($permissionParent))
                                            @foreach ($permissionParent as $per)
                                                <option value="{{ $per->id }}"
                                                    {{ $permission->parent_id === $per->id ? 'selected' : '' }}>
                                                    {{ $per->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('parent_id')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
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
@section('js')
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
@endsection
