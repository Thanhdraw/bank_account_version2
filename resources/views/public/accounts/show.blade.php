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
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="accountTabContent">
        <!-- Nạp tiền -->
        <div class="tab-pane fade show active" id="deposit" role="tabpanel">
            <form method="POST" action="{{ route('accounts.deposit', $account) }}" class="mb-3">
                @csrf
                <div class="input-group">
                    <input type="number" name="amount" step="0.01" class="form-control" placeholder="Số tiền nạp"
                        required>
                    <button class="btn btn-primary">Nạp tiền</button>
                </div>
            </form>
        </div>

        <!-- Rút tiền -->
        <div class="tab-pane fade" id="withdraw" role="tabpanel">
            <form method="POST" action="{{ route('accounts.withdraw', $account) }}">
                @csrf
                <div class="input-group">
                    <input type="number" name="amount" step="0.01" class="form-control" placeholder="Số tiền rút"
                        required>
                    <button class="btn btn-danger">Rút tiền</button>
                </div>
            </form>
        </div>
    </div>

    <a href="{{ route('accounts.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
@endsection
