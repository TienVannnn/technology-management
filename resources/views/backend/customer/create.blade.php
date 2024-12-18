@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><a href="{{ route('customer.index') }}"><i
                                class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Add new
                        customer</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-6 col-md-6 col-12">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name">
                                        @error('name')
                                            <div class="message-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-lg-6 col-md-6 col-12">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone">
                                        @error('phone')
                                            <div class="message-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-lg-6 col-md-6 col-12">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" aria-describedby="emailHelp" name="email">
                                        @error('email')
                                            <div class="message-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-lg-6 col-md-6 col-12">
                                        <label for="status" class="form-label">Status <span
                                                class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="1" selected>Hoạt động</option>
                                            <option value="0">Không hoạt động</option>
                                        </select>
                                        @error('status')
                                            <div class="message-error">{{ $message }}</div>
                                        @enderror
                                    </div>
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
