@extends('public.layouts.app')

@section('content')
<h3>Chủ tài khoản: {{ $account->customer->fullname ?? 'No name' }}</h3>
<p>Số dư hiện tại: <strong>{{ number_format($account->balance, 2) }}</strong></p>
<p>@lang('Loại tài khoản'): <strong>{{ $account->type->label() }}</strong></p>

@if (session('status'))
<div class="alert alert-info">{{ session('status') }}</div>
@endif

<!-- Tabs Navigation -->
<ul class="nav nav-tabs mb-3" id="accountTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="deposit-tab" data-bs-toggle="tab" data-bs-target="#deposit" type="button"
            role="tab">Nạp tiền</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="withdraw-tab" data-bs-toggle="tab" data-bs-target="#withdraw" type="button"
            role="tab">Rút tiền</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="transfer-tab" data-bs-toggle="tab" data-bs-target="#transfer" type="button"
            role="tab">Chuyển tiền</button>
    </li>
</ul>

<!-- Tabs Content -->
<div class="tab-content" id="accountTabContent">

    <!-- Nạp tiền -->
    <div class="tab-pane fade show active" id="deposit" role="tabpanel">
        <form method="POST" action="{{ route('accounts.deposit', $account) }}" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="number" name="amount" step="0.01" class="form-control" placeholder="Số tiền nạp" required>
                <button class="btn btn-primary">Nạp tiền</button>
            </div>
        </form>
    </div>

    <!-- Rút tiền -->
    <div class="tab-pane fade" id="withdraw" role="tabpanel">
        <form method="POST" action="{{ route('accounts.withdraw', $account) }}">
            @csrf
            <div class="input-group">
                <input type="number" name="amount" step="0.01" class="form-control" placeholder="Số tiền rút" required>
                <button class="btn btn-danger">Rút tiền</button>
            </div>
        </form>
    </div>

    <!-- Chuyển tiền -->
    <div class="tab-pane fade" id="transfer" role="tabpanel">
        <form id="transferForm" method="POST" action="{{ route('accounts.transfer',$remiterInfo) }}">
            @csrf
            <div class="mb-3">
                <label for="to_account" class="form-label">Tài khoản nhận</label>
                <input type="text" name="to_account_id" id="to_account_id" class="form-control"
                    placeholder="Số tài khoản người nhận" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Số tiền</label>
                <input type="number" name="amount" id="amount" step="0.01" class="form-control"
                    placeholder="Nhập số tiền cần chuyển" required>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Ghi chú</label>
                <textarea name="notes" id="notes" class="form-control" rows="2"
                    placeholder="Nội dung chuyển tiền (tuỳ chọn)"></textarea>
            </div>

            <div class="text-end">
                <button type="button" class="btn btn-success" onclick="openPasswordModal()">Chuyển tiền</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal nhập mật khẩu -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận chuyển khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Số tiền:</strong> <span id="showAmount"></span></p>
                <p><strong>Tài khoản nhận:</strong> <span id="showAccount"></span></p>

                <div class="mb-3">
                    <label for="password" class="form-label">Nhập mật khẩu giao dịch:</label>
                    <input type="password" class="form-control" id="password" placeholder="Mật khẩu">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-success" onclick="submitTransfer()">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('accounts.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>

<script>
    // Mở popup nhập mật khẩu
function openPasswordModal() {
    // Lấy thông tin từ form
    var amount = document.getElementById('amount').value;
    var toAccount = document.getElementById('to_account_id').value;
    
    // Kiểm tra có điền đủ thông tin chưa
    if (!amount || !toAccount) {
        alert('Vui lòng điền đầy đủ thông tin!');
        return;
    }
    
    // Hiển thị thông tin trong popup
    document.getElementById('showAmount').textContent = Number(amount).toLocaleString('vi-VN') + ' VNĐ';
    document.getElementById('showAccount').textContent = toAccount;
    
    // Mở popup
    var modal = new bootstrap.Modal(document.getElementById('passwordModal'));
    modal.show();
}

// Xác nhận và gửi form
function submitTransfer() {
    var password = document.getElementById('password').value;
    
    // Kiểm tra có nhập mật khẩu chưa
    if (!password) {
        alert('Vui lòng nhập mật khẩu!');
        return;
    }
    
    // Thêm mật khẩu vào form
    var form = document.getElementById('transferForm');
    var passwordInput = document.createElement('input');
    passwordInput.type = 'hidden';
    passwordInput.name = 'transaction_password';
    passwordInput.value = password;
    form.appendChild(passwordInput);
    
    // Gửi form
    form.submit();
}
</script>

@endsection