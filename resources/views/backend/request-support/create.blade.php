@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><a href="{{ route('support-request.index') }}"><i
                        class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Add new
                support request</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('support-request.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select tag-select" id="department" name="department_id">
                                <option value="" disabled selected>Choose a department</option>
                                @if (!empty($departments))
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('department_id')
                                <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="customer" class="form-label">Customer</label>
                            <select class="form-control tag-select" id="customer" name="customer_id">
                                <option value="" disabled selected>Choose a customer</option>
                                @if (!empty($customers))
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('customer_id')
                                <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="support_request" class="form-label">Request</label>
                            <textarea class="form-control @error('support_request') is-invalid @enderror" id="support_request"
                                name="support_request"></textarea>
                            @error('support_request')
                                <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="reception_time" class="form-label">
                                Reception time</label>
                            <input type="datetime-local" class="form-control @error('reception_time') is-invalid @enderror"
                                name="reception_time" id="reception_time" />
                            @error('reception_time')
                                <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="1" selected>Xác nhận</option>
                                <option value="0">Chưa xác nhận</option>
                                <option value="-1">Hủy</option>
                            </select>
                            @error('status')
                                <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $('.tag-select').select2({
                placeholder: "Choose a option",
                allowClear: true
            })
        })
    </script>
@endsection
