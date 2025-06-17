@extends('public.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0 text-center">Tạo tài khoản mới</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('accounts.store') }}">
                        @csrf

                        <!-- Thông tin khách hàng -->
                        <div class="mb-4">
                            <h5 class="text-muted mb-3">
                                <i class="fas fa-user me-2"></i>Thông tin khách hàng
                            </h5>
                            <hr class="mt-0 mb-3">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                                    <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="example@email.com">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Loại tài khoản</label>
                                    <select name="type" class="form-select">
                                        @foreach ($type as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" placeholder="0123456789">
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin tài khoản -->
                        <div class="mb-4">
                            <h5 class="text-muted mb-3">
                                <i class="fas fa-key me-2"></i>Thông tin tài khoản
                            </h5>
                            <hr class="mt-0 mb-3">
                            
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                                <div class="form-text">Mật khẩu tối thiểu 8 ký tự</div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Tạo tài khoản
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection