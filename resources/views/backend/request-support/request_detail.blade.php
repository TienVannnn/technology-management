@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-3 cfd">
        <i class="fas fa-question-circle"></i> {{ $sr->title }}
        <div class="table-responsive">
            <table class="table table-bordered ">
                <tr>
                    <td style="width: 20%; white-space: nowrap;">Thông tin khách hàng</td>
                    <td>{{ $sr->customer->name }} < {{ $sr->customer->email }}> <br> Phone: {{ $sr->customer->phone }}
                            <br> Địa chỉ: {{ $sr->customer->address }}<br> {{ $sr->customer->created_at }}

                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; white-space: nowrap;">Phòng ban</td>
                    <td colspan="3"> {{ $sr->department->name }} </td>
                </tr>
                <tr>
                    <td style="width: 20%; white-space: nowrap;">Tình trạng</td>
                    <td class="status-element" data-id="{{ $sr->id }}">
                        @if ($sr->status == 0)
                            Đang chờ
                        @elseif ($sr->status == 1)
                            Đã xác nhận
                        @else
                            Đã hủy
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; white-space: nowrap;">Chủ đề</td>
                    <td> {{ $sr->title }} </td>
                </tr>
                <tr>
                    <td colspan="2">Nội dung: {{ $sr->support_request }} </td>
                </tr>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <tr class="text-center">
                    <td><a href="{{ route('sr.reply', $sr->id) }}" class="btn btn-primary"><i
                                class="far fa-paper-plane me-1"></i>Gửi
                            phản hồi</a>
                        &nbsp;
                        <a href="javascript:void(0);" class="btn btn-success confirm-btn" data-id="{{ $sr->id }}">
                            <i class="far fa-check-circle me-1"></i>Xác nhận
                        </a> &nbsp;
                        <a href="javascript:void(0);" class="btn btn-danger cancel-btn" data-id="{{ $sr->id }}">
                            <i class="icon-close me-1"></i>Hủy
                        </a>
                        &nbsp;<a href="javascript:void(0);" class="btn btn-info" onclick="window.history.back()">Quay
                            lại</a>
                        &nbsp;
                        @can('delete supportrequest')
                            <form action="{{ route('support-request.destroy', $sr->id) }}" method="POST" class="delete-form"
                                style="display: inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="button" title="Delete" class="btn btn-outline-danger delete-btn">
                                    Xóa
                                </button>
                            </form>
                        @endcan

                    </td>
                </tr>
            </table>
        </div>

        @if ($sr->reply_requests->count() > 0)
            <i class="fas fa-reply"></i> Phản hồi
            @foreach ($sr->reply_requests as $reply)
                <div class="table-responsive" style="margin-bottom: 100px">
                    <table class="table table-bordered ">
                        <tr>
                            <td style="width: 20%; white-space: nowrap;">Thông tin người gửi</td>
                            <td>{{ $reply->user->name }} < {{ $reply->user->email }}>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%; white-space: nowrap;">Thời gian</td>
                            <td colspan="3"> {{ $reply->created_at }} </td>
                        </tr>
                        <tr>
                            <td colspan="2">{!! $reply->content !!} </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        @else
            <p class="text-muted">Chưa có phản hồi nào.</p>
        @endif
    </div>
@endsection
@section('js')
    <script src="{{ asset('backend/assets/js/confirmStatus.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
@endsection
