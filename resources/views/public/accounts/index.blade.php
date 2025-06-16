@extends('public.layouts.app')

@section('content')
<a href="{{ route('accounts.create') }}" class="btn btn-primary mb-3">Tạo tài khoản</a>

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
        <td><a href="{{ route('accounts.show', $account) }}" class="btn btn-info btn-sm">@lang('Nạp / Rút tiền')</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection