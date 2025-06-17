@if (session('success'))
<script>
    Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: '{{ session('success') }}',
            timer: 5000,
            showConfirmButton: false
        });
</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Lỗi nhập liệu!',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        timer: 7000,
        showConfirmButton: true
    });
</script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Thất bại!',
            text: @json(session('error')),
            timer: 5000,
            showConfirmButton: true
        });
    </script>
@endif