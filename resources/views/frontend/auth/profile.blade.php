@extends('frontend.layout.main')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- Avatar Section -->
            <div class="col-md-4 text-center">
                <div class="card shadow">
                    <div class="card-body position-relative">
                        <!-- Avatar -->
                        <img src="{{ Auth::guard('customers')->user()->avatar ? Auth::guard('customers')->user()->avatar : '/frontend/assets/img/author1.jpg' }}"
                            alt="User Avatar" class="rounded-circle img-fluid mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <!-- Camera Icon -->
                        <div class="position-absolute" style="bottom:30%; right: 35%; cursor: pointer;">
                            <i class="fa fa-camera text-primary" style="font-size: 20px;" data-bs-toggle="tooltip"
                                title="Thay đổi ảnh" onclick="document.getElementById('avatar-input').click();"></i>
                        </div>
                        <!-- Hidden Input for Avatar -->
                        <form action="{{ route('customer.logout') }}" method="POST" enctype="multipart/form-data"
                            id="avatar-form">
                            @csrf
                            <input type="file" name="avatar" id="avatar-input" class="d-none" accept="image/*"
                                onchange="document.getElementById('avatar-form').submit();">
                        </form>
                        <!-- User Name -->
                        <h5 class="card-title mt-2">{{ Auth::guard('customers')->user()->name }}</h5>
                    </div>
                </div>
                <!-- Account Settings Link -->
                <a href="{{ route('customer.overview') }}" class="btn mt-3"
                    style="color:white!important; background-color: #dc3545;
                                        border-color: #dc3545;">Thiết
                    lập tài khoản</a>
            </div>
            <!-- Info Section -->
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="mb-4">Thông tin cá nhân</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Email: </strong> {{ Auth::guard('customers')->user()->email }}
                            </li>
                            <li class="list-group-item">
                                <strong>Ngày tham gia: </strong>
                                {{ Auth::guard('customers')->user()->created_at->format('d-m-Y') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Số điện thoại: </strong>
                                {{ Auth::guard('customers')->user()->phone ?? 'Chưa cập nhật' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Địa chỉ: </strong>
                                {{ Auth::guard('customers')->user()->address ?? 'Chưa cập nhật' }}
                            </li>
                        </ul>
                        <div class="text-end mt-4">
                            <a onclick="return confirm('Bạn có chắc chắn muốn thoát không?')"
                                href="{{ route('customer.logout') }}" class="btn btn-sm"
                                style="color:white!important; background-color: #dc3545;
                                        border-color: #dc3545;">
                                Đăng xuất
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
