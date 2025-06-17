@extends('public.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Thông tin tài khoản</h3>
                <div class="badge bg-success fs-6 px-3 py-2">
                    <i class="fas fa-wallet me-2"></i>
                    Số dư: <strong>100,000 VNĐ</strong>
                </div>
            </div>

            <!-- Tabs -->
            <ul class="nav nav-pills mb-4" id="tabMenu" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                        <i class="fas fa-user me-2"></i>Thông tin tài khoản
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                        <i class="fas fa-history me-2"></i>Lịch sử giao dịch
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="report-tab" data-bs-toggle="tab" data-bs-target="#report" type="button" role="tab">
                        <i class="fas fa-chart-line me-2"></i>Báo cáo giao dịch
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="tabMenuContent">
                <!-- Tab 1: Thông tin tài khoản -->
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Thông tin cá nhân</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-medium text-muted" style="width: 120px;">Họ tên:</td>
                                            <td>Nguyễn Văn A</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Email:</td>
                                            <td>nguyenvana@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Số điện thoại:</td>
                                            <td>0901234567</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-medium text-muted" style="width: 120px;">Loại tài khoản:</td>
                                            <td><span class="badge bg-info">Tiết kiệm</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Trạng thái:</td>
                                            <td><span class="badge bg-success">Hoạt động</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium text-muted">Ngày tạo:</td>
                                            <td>15/06/2025</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Lịch sử giao dịch -->
                <div class="tab-pane fade" id="history" role="tabpanel">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Lịch sử giao dịch</h5>
                            <small class="text-muted">10 giao dịch gần nhất</small>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Ngày</th>
                                            <th>Loại giao dịch</th>
                                            <th class="text-end">Số tiền</th>
                                            <th>Ghi chú</th>
                                            <th class="text-center">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>17/06/2025</td>
                                            <td>
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-arrow-down me-1"></i>Rút tiền
                                                </span>
                                            </td>
                                            <td class="text-end text-danger fw-medium">-2,000 VNĐ</td>
                                            <td>Chi tiêu cá nhân</td>
                                            <td class="text-center">
                                                <span class="badge bg-success">Thành công</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>16/06/2025</td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-arrow-up me-1"></i>Nạp tiền
                                                </span>
                                            </td>
                                            <td class="text-end text-success fw-medium">+5,000 VNĐ</td>
                                            <td>Nạp từ ATM</td>
                                            <td class="text-center">
                                                <span class="badge bg-success">Thành công</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Báo cáo giao dịch -->
                <div class="tab-pane fade" id="report" role="tabpanel">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Báo cáo giao dịch</h5>
                        </div>
                        <div class="card-body">
                            <!-- Form lọc -->
                            <form class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-medium">Từ ngày</label>
                                    <input type="date" class="form-control" value="2025-06-01">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-medium">Đến ngày</label>
                                    <input type="date" class="form-control" value="2025-06-17">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i>Xem báo cáo
                                    </button>
                                </div>
                            </form>

                            <!-- Kết quả báo cáo -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <div class="text-success mb-2">
                                                <i class="fas fa-arrow-up fa-2x"></i>
                                            </div>
                                            <h6 class="card-title">Tổng nạp</h6>
                                            <h4 class="text-success mb-0">5,000 VNĐ</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <div class="text-danger mb-2">
                                                <i class="fas fa-arrow-down fa-2x"></i>
                                            </div>
                                            <h6 class="card-title">Tổng rút</h6>
                                            <h4 class="text-danger mb-0">2,000 VNĐ</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-wallet fa-2x"></i>
                                            </div>
                                            <h6 class="card-title">Số dư cuối kỳ</h6>
                                            <h4 class="text-primary mb-0">103,000 VNĐ</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <a href="{{ route('accounts.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
</div>

@endsection