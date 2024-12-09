@extends('backend.layout_admin.main')
@section('content')
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="/uploads/avatars/{{ $user->avatar ?? 'avatar.jpg' }}" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 100px; height: 100px;">
                            <h5 class="my-3">{{ $user->name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->phone ?? 'Chưa cập nhật số điện thoại' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Change infomation
                                    </button>
                                </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Infomation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.changeInfo') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ $user->email }}" name="email" disabled
                                                            @error('email') is-invalid @enderror">
                                                        @error('email')
                                                            <div class="message-error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            value="{{ $user->name }}" name="name"
                                                            @error('name') is-invalid @enderror">
                                                        @error('name')
                                                            <div class="message-error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            value="{{ $user->phone }}" name="phone"
                                                            @error('phone') is-invalid @enderror">
                                                        @error('phone')
                                                            <div class="message-error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="avatar" class="form-label">Avatar</label>
                                                        <input type="file" class="form-control" id="avatar"
                                                            name="avatar" @error('avatar') is-invalid @enderror">
                                                        @error('avatar')
                                                            <div class="message-error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-secondary"
                                                            id="changePasswordBtn">
                                                            <i class="fas fa-plus me-2"></i>Change password
                                                        </button>

                                                        <div id="passwordFields" style="display: none;">
                                                            <div class="mb-3 mt-3">
                                                                <input type="password" placeholder="Enter old password"
                                                                    class="form-control" name="old_password"
                                                                    value="{{ old('old_password') }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="password" placeholder="Enter new password"
                                                                    class="form-control" name="password"
                                                                    value="{{ old('password') }}"
                                                                    @error('password') is-invalid @enderror">
                                                                @error('password')
                                                                    <div class="message-error">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div>
                                                                <input type="password" placeholder="Confirm password"
                                                                    class="form-control" name="password_confirmation">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
@endsection
