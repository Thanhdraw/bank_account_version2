@extends('public.layouts.app')

@section('content')

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Chuyển tiền</h4>
                    </div>
                    <div class="card-body">

                        <form>
                            <!-- Tài khoản nguồn -->
                            <div class="mb-3">
                                <label for="from_account" class="form-label">Từ tài khoản</label>
                                <select id="from_account" class="form-select" required>
                                    <option selected disabled>Chọn tài khoản nguồn</option>
                                    <option value="1">1234567890 - 10,000,000 VND</option>
                                    <option value="2">0987654321 - 5,000,000 VND</option>
                                </select>
                            </div>

                            <!-- Tài khoản đích -->
                            <div class="mb-3">
                                <label for="to_account" class="form-label">Đến tài khoản</label>
                                <input type="text" class="form-control" id="to_account"
                                    placeholder="Nhập số tài khoản người nhận" required>
                            </div>

                            <!-- Số tiền -->
                            <div class="mb-3">
                                <label for="amount" class="form-label">Số tiền</label>
                                <input type="number" class="form-control" id="amount"
                                    placeholder="Nhập số tiền cần chuyển" required>
                            </div>

                            <!-- Ghi chú -->
                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note" rows="2"
                                    placeholder="Nội dung chuyển tiền (tuỳ chọn)"></textarea>
                            </div>

                            <!-- Nút submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Thực hiện chuyển tiền</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


@endsection