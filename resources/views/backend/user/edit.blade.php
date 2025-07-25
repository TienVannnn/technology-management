@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><a href="{{ route('user.index') }}"><i
                                class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Edit user
                        {{ $user->name }}</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" value="{{ $user->name }}" class="form-control" id="name"
                                        aria-describedby="emailHelp" name="name" @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" value="{{ $user->email }}" class="form-control" id="email"
                                        aria-describedby="emailHelp" name="email" @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control tag-select" multiple="multiple" id="role"
                                        name="role[]">
                                        @if (!empty($roles))
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ in_array($role->id, $rolesChecked) ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-secondary" id="changePasswordBtn">
                                        <i class="fas fa-plus me-2"></i>Change password
                                    </button>

                                    <div id="passwordFields" style="display: none;">
                                        <div class="mb-3 mt-3">
                                            <input type="password" placeholder="Enter new password" class="form-control"
                                                name="password" value="{{ old('password') }}"
                                                @error('password') is-invalid @enderror">
                                            @error('password')
                                                <div class="message-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <input type="password" placeholder="Confirm password" class="form-control"
                                                name="password_confirmation">
                                        </div>
                                    </div>
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
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $('.tag-select').select2({
                placeholder: "Choose role"
            })
        })
    </script>
@endsection
