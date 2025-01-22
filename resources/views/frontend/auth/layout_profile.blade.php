@extends('frontend.layout.main')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('customer.overview') }}"
                            class="list-group-item list-group-item-action {{ request()->routeIs('customer.overview') ? 'active' : '' }}">
                            Tổng quan
                        </a>
                        <a href="{{ route('customer.page_edit-account') }}"
                            class="list-group-item list-group-item-action {{ request()->routeIs('customer.page_edit-account') ? 'active' : '' }}">
                            Thay đổi hồ sơ
                        </a>
                        <a href="{{ route('customer.page_change-password') }}"
                            class="list-group-item list-group-item-action {{ request()->routeIs('customer.page_change-password') ? 'active' : '' }}">
                            Đổi mật khẩu
                        </a>
                        <a onclick="return confirm('Bạn có chắc chắn muốn thoát không?')"
                            href="{{ route('customer.logout') }}"
                            class="list-group-item list-group-item-action text-danger">
                            Thoát
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-body">
                        @yield('content_profile')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @yield('js_profile')
@endsection
