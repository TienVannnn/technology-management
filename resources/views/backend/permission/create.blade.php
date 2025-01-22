@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><a href="{{ route('permission.index') }}"><i
                                class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Add new
                        permission</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('permission.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter permission name" value="{{ old('name') }}"
                                        @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="parent" class="form-label">Parent</label>
                                    <select name="parent_id" id="parent" class="form-select">
                                        <option value="0" selected>Main</option>
                                        @if (!empty($permissionParent))
                                            @foreach ($permissionParent as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('parent_id')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
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
