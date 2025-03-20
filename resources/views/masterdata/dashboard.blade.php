@extends('content-partials.main')

@section('contents')
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak!',
            text: '{{ session("error") }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif
@if(session('success'))
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif
<div class="container">

</div>
@endsection