@extends('frontend.auth.layout_profile')
@section('content_profile')
    <form action="{{ route('customer.change-password') }}" method="POST">
        @csrf
        <div style="margin: 0 auto">
            <div class="form-outline mb-3"">
                <label class="form-label" for="now-pass">Mật khẩu hiện tại</label>
                <input type="password" id="now-pass" class="form-control @error('now-pass') is-invalid @enderror"
                    name="now-pass" value="{{ old('now-pass') }}" placeholder="Nhập mật khẩu hiện tại" />
                @error('now-pass')
                    <div class="message-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-outline mb-3"">
                <label class="form-label" for="new-pass">Mật khẩu mới</label>
                <input type="password" id="new-pass" class="form-control @error('password') is-invalid @enderror"
                    name="password" value="{{ old('password') }}" placeholder="Nhập mật khẩu mới" />
                @error('password')
                    <div class="message-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-outline mb-3"">
                <label class="form-label" for="confirm">Xác nhận mật khẩu</label>
                <input type="password" id="confirm" class="form-control" name="password_confirmation"
                    placeholder="Xác nhận mật khẩu mới" />
            </div>
            <button type="submit" class="btn btn-primary mb-3">Cập nhật</button>
        </div>
    </form>
@endsection
