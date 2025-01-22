@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-4 cfd">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="container shadow">
                    <form action="{{ route('sr.search_history') }}" method="GET">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="from-date" class="form-label">Từ ngày:</label>
                                <input type="date" value="{{ $fromDate ? $fromDate : '' }}" class="form-control"
                                    id="from-date" name="from_date">
                            </div>
                            <div class="col-md-4">
                                <label for="to-date" class="form-label">Đến ngày:</label>
                                <input type="date" value="{{ $toDate ? $toDate : '' }}" class="form-control"
                                    id="to-date" name="to_date">
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
                    {{ $changes->count() }} changes
                </div>
                @can('list supportrequest')
                    <a href="{{ route('support-request.index') }}" class="btn btn-warning btn-sm me-2"><i
                            class="fas fa-eye"></i>Xem danh sách yêu cầu</a>
                @endcan
            </div>
            <div class="card">
                <div class="card-body">
                    @if ($changes->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Change by</th>
                                        <th scope="col">Field is changed</th>
                                        <th scope="col">Time change</th>
                                        @can(['list requestchange', 'delete requestchange'])
                                            <th scope="col">Handle</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($changes as $key => $requestchange)
                                        <tr>
                                            <th scope="row">{{ $changes->firstItem() + $key }}</th>
                                            <td>{{ $requestchange->changedby->name }}</td>
                                            <td>{{ $requestchange->field_name }}</td>
                                            <td>{{ $requestchange->created_at }}</td>
                                            <td class="d-flex align-items-center">
                                                @can('list requestchange')
                                                    <a href="{{ route('sr.history_detail', $requestchange->id) }}"
                                                        class="btn btn-outline-primary btn-sm me-2" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('delete requestchange')
                                                    <form action="{{ route('sr.history_delete', $requestchange->id) }}"
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
                        <p class="alert alert-danger">No request change found</p>
                    @endif
                </div>
                <div class="d-flex justify-content-center ">
                    {{ $changes->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
