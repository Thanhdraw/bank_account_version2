@extends('public.layouts.app')

@section('content')
    <h3>Chuyển khoản giữa các tài khoản</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="#">
        @csrf

        <div class="mb-3">
            <label for="from_account">Tài khoản nguồn</label>
            <select class="form-select" name="from_account" required>
                <option value="">-- Chọn tài khoản nguồn --</option>
                <option value="1">Nguyễn Văn A (STK: 12345678)</option>
                <option value="2">Trần Thị B (STK: 87654321)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="to_account">Tài khoản đích</label>
            <select class="form-select" name="to_account" required>
                <option value="">-- Chọn tài khoản đích --</option>
                <option value="3">Lê Văn C (STK: 99999999)</option>
                <option value="4">Phạm Thị D (STK: 88888888)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="amount">Số tiền cần chuyển</label>
            <input type="number" name="amount" class="form-control" min="1000" step="1000"
                placeholder="Nhập số tiền" required>
        </div>

        <div class="mb-3">
            <label for="note">Ghi chú (tuỳ chọn)</label>
            <input type="text" name="note" class="form-control" placeholder="Nội dung chuyển khoản">
        </div>

        <button class="btn btn-primary">Thực hiện chuyển khoản</button>
        <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Huỷ</a>
    </form>
@endsection
