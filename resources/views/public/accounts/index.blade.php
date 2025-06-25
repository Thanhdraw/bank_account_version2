@extends('public.layouts.app')

@section('content')
<a href="#" class="btn btn-primary mb-3" onclick="checkAuth('{{ route('accounts.create') }}')">Tạo tài khoản</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Chủ tài khoản</th>
        <th>Tên tài khoản</th>
        <th>Loại tài khoản</th>
        <th>Số dư</th>
        <th>Hành động</th>
    </tr>
    @foreach ($accounts as $account)
    <tr>
        <td>{{ $account->id }}</td>
        <td>{{ $account->account_number }}</td>
        <td>{{ $account->customer->fullname }}</td>
        <td>{{ $account->type->label() }}</td>
        <td>{{ number_format($account->balance, 2) }}</td>
        <td>
            <a href="#" class="btn btn-info btn-sm" onclick="checkAuth('{{ route('accounts.show', $account) }}')">Nạp /
                Rút</a>
            <a href="#" class="btn btn-warning btn-sm"
                onclick="checkAuth('{{ route('customer.index', $account->customer_id) }}')">Thông tin</a>
        </td>
    </tr>
    @endforeach
</table>

<!-- Modal đơn giản -->
<div class="modal fade" id="authModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nhập mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="password" class="form-control" id="password" placeholder="Mật khẩu...">
                <div class="text-danger mt-2 d-none" id="error">Mật khẩu sai!</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="login()">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    let targetUrl = '';

function checkAuth(url) {
    targetUrl = url;
    document.getElementById('password').value = '';
    document.getElementById('error').classList.add('d-none');
    new bootstrap.Modal(document.getElementById('authModal')).show();
}

function login() {
    const password = document.getElementById('password').value;
    
    if (password === '123456') { 
        window.location.href = targetUrl;
    } else {
        document.getElementById('error').classList.remove('d-none');
    }
}

// Enter để login
document.getElementById('password').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') login();
});
</script>

@endsection