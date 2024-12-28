<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Thông tin xác nhận đăng ký yêu cầu hỗ trợ kỹ thuật</p>
    <p>Tên khách hàng: {{ $sr->customer->name }}</p>
    <p>Phòng ban nhận yêu cầu hỗ trợ: {{ $sr->department->name }}</p>
    <p>Thời gian tiếp nhận: {{ $sr->reception_time }}</p>
    <p>Nội dung: {{ $sr->support_request }}</p>
</body>

</html>
