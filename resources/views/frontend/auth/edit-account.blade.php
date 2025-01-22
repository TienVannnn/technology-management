@extends('frontend.auth.layout_profile')
@section('content_profile')
    <form action="{{ route('customer.edit-account') }}" method="POST">
        @csrf
        <div style="margin: 0 auto">
            <div class="form-outline mb-3"">
                <label class="form-label" for="form3Example3">Tên</label>
                <input type="text" id="form3Example3" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ $customer->name }}" />
                @error('name')
                    <div class="message-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-outline mb-3"">
                <label class="form-label" for="form3Example3">Điện thoại</label>
                <input type="number" id="form3Example3" class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ $customer->phone ? $customer->phone : old('phone') }}" />
                @error('phone')
                    <div class="message-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-outline mb-3"">
                <label class="form-label" for="form3Example3">Email</label>
                <input type="email" id="form3Example3" class="form-control" disabled name="email"
                    value="{{ $customer->email }}" />
            </div>
            <button type="submit" class="btn btn-primary mb-3">Cập nhật</button>
        </div>
    </form>
@endsection
