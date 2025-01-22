@extends('backend.layout_admin.main')
@section('content')
    <div class="container-fluid mt-3 cfd">
        <form action="{{ route('sr.handle_reply') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $sr->id }}">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 20%; white-space: nowrap;">Tiêu đề gửi</td>
                        <td><input type="text" name="title" value="Re:{{ $sr->title }}" readonly
                                class="readonly form-control w-auto">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; white-space: nowrap;">Gửi tới email</td>
                        <td><input type="email" name="email" value="{{ $sr->customer->email }} "
                                class="readonly form-control w-auto" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea class="form-control" name="content" id="content">
                            <div class="email-content">
                                <p>From: {{ $sr->customer->email }}</p>
                                <p>To: {{ $sr->department->name }}</p>
                                <p>Sent: {{ $sr->created_at }}</p>
                                <p>Subject: Re: {{ $sr->title }}</p> <br>

                                Gửi {{ $sr->customer->name }}, <br>

                                Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi đánh giá cao sự kiên nhẫn của bạn và sẽ sớm liên hệ lại với bạn. <br> <br>
                                ------------------------------------ <br>
                                Trân trọng, <br>
                                {{ Auth()->guard()->user()->name }} <br>
                                {{ Auth()->guard()->user()->email }}
                            </div>
                        </textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <table class="table table-striped table-bordered table-hover" style="margin-bottom: 100px">
                <tr class="text-center">
                    <td>
                        <button type="submit" class="btn btn-primary"><i class="far fa-paper-plane me-1"></i>Gửi
                            phản hồi</button>

                    </td>
                </tr>
            </table>
        </form>
    </div>
@endsection

@section('css')
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <style>
        .email-content p {
            margin: 0;
            line-height: 1.5;
        }
    </style>
@endsection
@section('js')
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
    </script>
    <script>
        var editor = new FroalaEditor('#content', {
            height: 300,
            heightMax: 500
        });
    </script>
@endsection
