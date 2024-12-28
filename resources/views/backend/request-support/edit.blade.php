@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><a href="{{ route('support-request.index') }}"><i
                                class="fas fa-arrow-left me-2 p-2 rounded-circle btn btn-outline-secondary"></i></a>Edit
                        support request
                    </h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('support-request.update', $sr->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="request" class="form-label">Request</label>
                                    <textarea class="form-control" id="request" name="support_request"
                                        class="@error('support_request') is-invalid @enderror">{{ $sr->support_request }}</textarea>
                                    @error('support_request')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-control tag-select" id="department" name="department_id">
                                        @if (!empty($departments))
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $sr->department_id === $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}</option>
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
                                        @if (!empty($customers))
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    {{ $sr->customer_id === $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('customer_id')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="reception_time" class="form-label">
                                        Reception time</label>
                                    <input type="datetime-local" value="{{ $sr->reception_time }}"
                                        class="form-control @error('reception_time') is-invalid @enderror"
                                        name="reception_time" id="reception_time" />
                                    @error('reception_time')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="1" {{ $sr->status === 1 ? 'selected' : '' }}>Xác nhận
                                        </option>
                                        <option value="0" {{ $sr->status === 0 ? 'selected' : '' }}>Chưa xác nhận
                                        </option>
                                        <option value="-1" {{ $sr->status === -1 ? 'selected' : '' }}>Hủy</option>
                                    </select>
                                    @error('status')
                                        <div class="message-error">{{ $message }}</div>
                                    @enderror
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
