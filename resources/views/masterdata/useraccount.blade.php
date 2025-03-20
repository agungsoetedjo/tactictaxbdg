@extends('content-partials.main')

@section('contents')

<section id="starter-section" class="starter-section section">

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                icon: 'success',
                showConfirmButton: false, // Hilangkan tombol OK
                timer: 2000 // Alert otomatis hilang dalam 2 detik
            });
        </script>
    @endif
    
    <div class="container">
        <h3>User Account</h3>
    
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password (Setelah di-<i>Hashing</i>)</th>
                    @if (Auth::user()->role === 'admin')
                    <th>Role</th>
                    @endif
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($useraccount as $item)
                <tr>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->password }}</td>
                    @if (Auth::user()->role === 'admin')
                    <td>{{ $item->role }}</td>
                    @endif
                    <td>
                        <button class="btn btn-warning btn-edit" 
                            data-id="{{ $item->id }}" 
                            data-username="{{ $item->username }}" 
                            data-password="{{ $item->password }}" 
                            data-bs-toggle="modal" data-bs-target="#userAccountModal">
                            Update Password
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</section><!-- /Starter Section Section -->

<!-- Modal -->
<div class="modal fade" id="userAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="userAccountForm" method="POST" action="">
            @csrf
            <input type="hidden" id="userAccountId" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="username" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // Reset Form Saat Modal Ditutup
        let contactModal = document.getElementById("userAccountModal");
        let passwordInput = document.getElementById("password"); // Input password
        if (contactModal) {
            contactModal.addEventListener("hidden.bs.modal", function() {
                let form = document.getElementById("userAccountForm");
                form.reset();
                document.getElementById("userAccountId").value = "";
                
                // Hapus input _method jika ada
                let methodInput = form.querySelector("input[name='_method']");
                if (methodInput) {
                    methodInput.remove();
                }
            });
        }

        if (passwordInput) {
            passwordInput.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Mencegah form terkirim saat Enter ditekan di input password
                }
            });
        }

        // Tombol Edit
        document.querySelectorAll(".btn-edit").forEach(btn => {
            btn.addEventListener("click", function() {
                let form = document.getElementById("userAccountForm");

                document.getElementById("userAccountId").value = this.dataset.id;
                document.getElementById("username").value = this.dataset.username;
                document.getElementById("password").value = this.dataset.password;
                document.querySelector(".modal-title").innerText = "Update Password";
                form.action = "/useraccount/" + this.dataset.id;

                // Hapus input _method jika sudah ada untuk mencegah duplikasi
                let existingMethodInput = form.querySelector("input[name='_method']");
                if (!existingMethodInput) {
                    form.insertAdjacentHTML("beforeend", '<input type="hidden" name="_method" value="PUT">');
                }
            });
        });

        // Tombol Submit dengan Konfirmasi SweetAlert
        document.querySelectorAll(".btn-primary").forEach(btn => {
            btn.addEventListener("click", function(event) {
                event.preventDefault();
                
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Update!",
                    cancelButtonText: "Batal"
                }).then(result => {
                    if (result.isConfirmed) {
                        document.getElementById("userAccountForm").submit();
                    }
                });
            });
        });

    });
</script>

    
@endsection
