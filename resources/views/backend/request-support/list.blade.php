@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4 cfd">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="container shadow">
                    <form action="{{ route('sr.search') }}" method="GET">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="keyword" class="form-label">Từ khóa:</label>
                                <input type="text" class="form-control" id="keyword" name="keyword"
                                    placeholder="Nhập từ khóa" value="{{ $keyword }}">
                            </div>
                            <div class="col-md-4">
                                <label for="department" class="form-label">Phòng ban:</label>
                                <select class="form-select tag-select" id="department" name="department_id">
                                    <option value="" disabled selected>Choose a department</option>
                                    @if (!empty($departments))
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ $department->id == $departmentId ? 'selected' : '' }}>
                                                {{ $department->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Loại trạng thái:</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="" selected>Chọn trạng thái</option>
                                    <option value="0" {{ isset($status) && $status == 0 ? 'selected' : '' }}>Đang chờ
                                    </option>
                                    <option value="1" {{ isset($status) && $status == 1 ? 'selected' : '' }}>Đã duyệt
                                    </option>
                                    <option value="-1" {{ isset($status) && $status == -1 ? 'selected' : '' }}>Bị từ
                                        chối</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="from-date" class="form-label">Từ ngày:</label>
                                <input type="date" class="form-control" id="from-date" name="from_date"
                                    value="{{ $fromDate }}">
                            </div>
                            <div class="col-md-4">
                                <label for="to-date" class="form-label">Đến ngày:</label>
                                <input type="date" class="form-control" id="to-date" name="to_date"
                                    value="{{ $toDate }}">
                            </div>
                            <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="d-flex mt-3 justify-content-between">
                <div>
                    {{ $requests->count() }} requests
                </div>
                <div>
                    @can('list requestchange')
                        <a href="{{ route('sr.history') }}" class="btn btn-warning btn-sm me-2"><i class="fas fa-eye"></i>Xem
                            lịch
                            sử thay đổi</a>
                    @endcan
                    @can('add supportrequest')
                        <a href="{{ route('support-request.create') }}" class="btn btn-secondary btn-sm "><i
                                class="fas fa-plus"></i>Add support request</a>
                    @endcan
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if ($requests->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Request</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Status</th>
                                        @can(['edit supportrequest', 'delete supportrequest'])
                                            <th scope="col">Handle</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $key => $request)
                                        <tr>
                                            <th scope="row">{{ $requests->firstItem() + $key }}</th>
                                            <td class="truncate">{{ $request->support_request }}</td>
                                            <td>{{ $request->customer->name }}</td>
                                            <td>{{ $request->department->name }}</td>
                                            <td>
                                                @if ($request->status == 1)
                                                    <button class="btn btn-success btn-sm">Đã xác nhận</button>
                                                @elseif ($request->status == 0)
                                                    <button class="btn btn-warning btn-sm">Đang chờ</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm">Đã hủy</button>
                                                @endif
                                            </td>
                                            <td class="d-flex align-items-center">
                                                @can('edit supportrequest')
                                                    <a href="{{ route('support-request.edit', $request->id) }}"
                                                        class="btn btn-outline-primary btn-sm me-2" title="Edit">
                                                        <i class="fas fa-pen-to-square"></i>
                                                    </a>
                                                @endcan
                                                @can('delete supportrequest')
                                                    <form action="{{ route('support-request.destroy', $request->id) }}"
                                                        method="POST" class="delete-form">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" title="Delete"
                                                            class="btn btn-outline-danger btn-sm delete-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="alert alert-danger">No support request found</p>
                    @endif
                </div>
                <div class="d-flex justify-content-center ">
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    <script>
        $(function() {
            $('.tag-select').select2({
                placeholder: "Choose a option",
                allowClear: true
            })
        })
    </script>
@endsection
