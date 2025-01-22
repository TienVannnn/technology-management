@extends('frontend.layout.main')
@section('content')
    <div class="container">
        <form class="col-md-8 col-lg-6 mx-auto my-4 form-register" action="{{ route('user.register') }}" method="POST">
            @csrf
            <div style="margin: 0 auto">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Họ tên</label>
                            <input type="text" id="form3Example1"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" />
                            @error('name')
                                <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example2">Số điện thoại</label>
                            <input type="number" id="form3Example2"
                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" />
                            @error('phone')
                                <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-3"">
                    <label class="form-label" for="form3Example3">Email</label>
                    <input type="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" />
                    @error('email')
                        <div class="message-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3"">
                    <label class="form-label" for="form3Example4">Mật khẩu</label>
                    <input type="password" id="form3Example4" class="form-control @error('password') is-invalid @enderror"
                        name="password" value="{{ old('password') }}" />
                    @error('password')
                        <div class="message-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-outline mb-3"">
                    <label class="form-label" for="confirm">Xác nhận mật khẩu</label>
                    <input type="password" id="confirm" class="form-control" name="password_confirmation" />
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex align-items-center justify-content-start mb-3">
                    <input class="me-2" type="checkbox" value="" id="form2Example33" checked />
                    <label class="mb-0 ml-2" for="form2Example33">
                        Subscribe to our newsletter
                    </label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>or sign up with:</p>
                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="icofont-facebook"></i>
                    </button>

                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="icofont-google-plus"></i>
                    </button>

                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="icofont-twitter"></i>
                    </button>

                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="icofont-github"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
