@extends('public.layouts.app')

@section('content')
<form method="POST" action="{{ route('accounts.store') }}">
    @csrf

    <h4>Thông tin khách hàng</h4>
    <div class="mb-3">
        <label>Họ tên</label>
        <input type="text" name="fullname" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Loại tài khoản</label>
        <select name="type" class="form-select">
            @foreach($type as $item)
            <option value="{{ $item['value'] }}">{{ $item['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Số điện thoại</label>
        <input type="text" name="phone" class="form-control">
    </div>

    <h4>Thông tin tài khoản</h4>
    <div class="mb-3">
        <label>Mật khẩu tài khoản</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-success">Tạo tài khoản</button>


</form>
<a href="{{ route('accounts.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
@endsection