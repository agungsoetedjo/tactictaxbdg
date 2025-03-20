@extends('content-partials.main')

@section('contents')

@if(session('error'))
    <script>
        Swal.fire({
            title: "Login Gagal!",
            text: "{{ session('error') }}",
            icon: "error",
            confirmButtonText: "Coba Lagi",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

<div class="d-flex align-items-center justify-content-center" style="margin-top: 10%;">
    <div class="card p-4" style="width: 350px;">
        <h3 class="text-center">Login</h3>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>
    </div>
</div>
@endsection
