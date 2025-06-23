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
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                            type="button" role="tab">
                            <i class="fas fa-user me-2"></i>Thông tin tài khoản
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history"
                            type="button" role="tab">
                            <i class="fas fa-history me-2"></i>Lịch sử giao dịch
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="report-tab" data-bs-toggle="tab" data-bs-target="#report"
                            type="button" role="tab">
                            <i class="fas fa-chart-line me-2"></i>Báo cáo giao dịch
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="tabMenuContent">
                    <!-- Tab 1: Thông tin tài khoản -->
                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                        <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Thông tin cá nhân</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Cột bên trái -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="fw-medium text-muted">Họ tên</label>
                                                    <input type="text" name="fullname" class="form-control"
                                                        value="{{ $customer->fullname }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="fw-medium text-muted">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $customer->email }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="fw-medium text-muted">Số điện thoại</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="{{ $customer->phone }}">
                                                </div>
                                            </div>

                                            <!-- Cột bên phải -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="fw-medium text-muted">Địa chỉ</label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ $customer->address }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="fw-medium text-muted">Ngày sinh</label>
                                                    <input type="date" name="birth_day" class="form-control"
                                                        value="{{ $customer->birth_day?->format('Y-m-d') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-medium">Giới tính</label>
                                                    <select name="gender" class="form-control">
                                                        @foreach ($gender as $key => $label)
                                                            <option value="{{ $key }}"
                                                                {{ $customer->gender === $key ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>

                                        </div>

                                        <!-- Nút cập nhật -->
                                        <div class="text-end mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Cập nhật
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

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
                                            @forelse ($history as $item)
                                                <tr>
                                                    <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                                                    <td>
                                                        @if ($item->type->value === 10)
                                                            <span class="badge bg-success">
                                                                <i
                                                                    class="fas fa-arrow-up me-1"></i>{{ $item->type->label() }}
                                                            </span>
                                                        @elseif($item->type->value === 20)
                                                            <span class="badge bg-danger">
                                                                <i
                                                                    class="fas fa-arrow-down me-1"></i>{{ $item->type->label() }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-secondary">
                                                                <i
                                                                    class="fas fa-exchange-alt me-1"></i>{{ $item->type->label() }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end fw-medium">
                                                        @if ($item->type->value === 10)
                                                            <span class="text-success">+{{ number_format($item->amount) }}
                                                                VNĐ</span>
                                                        @elseif($item->type->value === 20)
                                                            <span class="text-danger">-{{ number_format($item->amount) }}
                                                                VNĐ</span>
                                                        @else
                                                            <span class="text-muted">{{ number_format($item->amount) }}
                                                                VNĐ</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->description ?? ($item->note ?? 'Không có ghi chú') }}
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-success">{{ $item->status->label() }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">
                                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                        Chưa có giao dịch nào
                                                    </td>
                                                </tr>
                                            @endforelse
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
                                <form action="{{ route('customer.index', $customer->id) }}" method="post"
                                    class="row g-3 mb-4">
                                    @csrf

                                    <div class="col-md-4">
                                        <label class="form-label fw-medium">Từ ngày</label>
                                        <input type="date" name="from" class="form-control"
                                            value="{{ old('from') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-medium">Đến ngày</label>
                                        <input type="date" name="to" class="form-control"
                                            value="{{ old('to') }}">
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
                                                {{-- Blade view --}}
                                                @if (isset($balance))
                                                    {{ number_format($balance, 0, ',', '.') }} đ
                                                @else
                                                    0 đ
                                                @endif

                                                </h4>

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
                                                <h4 class="text-danger mb-0">{{ number_format($withdraw, 0, ',', '.') }} đ
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
                                                <h4 class="text-primary mb-0">{{ number_format($balance, 0, ',', '.') }}
                                                </h4>
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
