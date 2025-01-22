@extends('frontend.layout.main')
@section('content')
    <div class="container">
        <form class="col-md-7 col-lg-5 mx-auto my-4 form-register" action="{{ route('customer.login') }}" method="POST">
            @csrf
            <div style="margin: 0 auto">
                <h3 class="text-center text-uppercase">Login</h3>
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

                <!-- Checkbox -->
                <div class="form-check d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <input class="me-2" type="checkbox" value="" id="form2Example33" checked />
                        <label class="mb-0 ml-2" for="form2Example33">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    <div><a href="">Quên mật khẩu?</a></div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Login</button>
                <p class="my-2 text-center">Bạn chưa có tài khoản? <a class="text-danger"
                        href="{{ route('customer.register') }}">Đăng ký</a></p>
                <!-- Register buttons -->
                <div class="text-center">
                    <p>or login with:</p>
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
