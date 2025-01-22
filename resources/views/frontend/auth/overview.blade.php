@extends('frontend.auth.layout_profile')
@section('content_profile')
    <div class="row">
        <div class="col-md-3 text-center">
            <div class="position-relative d-inline-block">
                <!-- Avatar -->
                <img id="user-avatar"
                    src="{{ Auth::guard('customers')->user()->avatar ? Auth::guard('customers')->user()->avatar : '/frontend/assets/img/default.jpg' }}"
                    alt="User Avatar" class="rounded-circle img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                <!-- Camera Icon -->
                <div class="camera-icon">
                    <i class="fa fa-camera text-primary" style="cursor: pointer;" data-bs-toggle="tooltip"
                        title="Thay đổi ảnh" onclick="document.getElementById('avatar-input').click();"></i>
                </div>
            </div>
            <form id="avatar-form" enctype="multipart/form-data">
                @csrf
                <input type="file" name="avatar" id="avatar-input" class="d-none" accept="image/*">
            </form>
        </div>
        <div class="col-md-9">
            Xin chào <span class="font-weight-bold">{{ Auth::guard('customers')->user()->name }}</span>
            <p>Từ trang tổng quan tài khoản của mình, bạn có thể xem các đơn đặt hàng gần đây, quản lý vận chuyển của mình
                và địa chỉ thanh toán, đồng thời chỉnh sửa chi tiết mật khẩu và tài khoản của bạn.</p>
        </div>
    </div>
@endsection

@section('js_profile')
    <script src="{{ asset('frontend/assets/js/change-avatar.js') }}"></script>
@endsection
