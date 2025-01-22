@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><a href="{{ route('department.index') }}"><i
                                class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Add new
                        department</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('department.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter department name" value="{{ old('name') }}"
                                        @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="1" selected>Hoạt động</option>
                                        <option value="0">Không hoạt động</option>
                                    </select>
                                    @error('status')
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
