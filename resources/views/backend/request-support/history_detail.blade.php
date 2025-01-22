@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><a href="{{ route('sr.history') }}"><i
                                class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Chi tiết
                        lịch sử thay đổi
                    </h5>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                Người thay đổi: {{ $requestchange->changedby->name }}
                            </div>
                            <div class="col-md-6 mb-3">
                                Thời gian thay đổi: {{ $requestchange->created_at }}
                            </div>
                            <div class="col-md-6 mb-3">
                                Nội dung yêu cầu: {{ $requestchange->request->support_request }}
                            </div>

                            <div class="col-md-6 mb-3">
                                Khách hàng: {{ $requestchange->request->customer->name }}
                            </div>
                            <div class="col-md-6 mb-3">
                                Phòng ban: {{ $requestchange->request->department->name }}
                            </div>
                            <div class="col-md-6 mb-3">
                                Trạng thái: {{ $requestchange->request->status }}
                            </div>
                            <div class="col-md-6 mb-3">
                                Thời gian tiếp nhận yêu cầu: {{ $requestchange->request->reception_time }}
                            </div>
                            <div class="col-md-6 mb-3">
                                Trường được thay đổi: {{ $requestchange->field_name }}
                            </div>
                            <div class="col-md-6 mb-3">
                                Giá trị cũ: {{ $requestchange->old_value }}
                            </div>
                            <div class="col-md-6 mb-3">
                                Giá trị mới: {{ $requestchange->new_value }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
