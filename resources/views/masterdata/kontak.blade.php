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
        <h3>Kontak</h3>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>PIC</th>
                    <th>Alamat</th>
                    <th>Whatsapp</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Facebook</th>
                    <th>Instagram</th>
                    @auth
                    @if (Auth::user()?->role === 'admin')
                    <th>Aksi</th>
                    @endif
                    @endauth                    
                </tr>
            </thead>
            <tbody>
                @foreach ($kontak as $item)
                <tr>
                    <td>{{ $item->pic }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->whatsapp }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->facebook }}</td>
                    <td>{{ $item->instagram }}</td>
                    @auth
                        @if (Auth::user()?->role === 'admin')
                        <td>
                            <button class="btn btn-warning btn-edit" 
                                data-id="{{ $item->id }}" 
                                data-pic="{{ $item->pic }}" 
                                data-address="{{ $item->address }}" 
                                data-whatsapp="{{ $item->whatsapp }}"                             
                                data-phone="{{ $item->phone }}" 
                                data-email="{{ $item->email }}" 
                                data-facebook="{{ $item->facebook }}" 
                                data-instagram="{{ $item->instagram }}" 
                                data-bs-toggle="modal" data-bs-target="#contactModal">
                                Edit
                            </button>
                        </td>
                        @endif
                    @endauth
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</section><!-- /Starter Section Section -->

<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="contactForm" method="POST" action="">
            @csrf
            <input type="hidden" id="contactId" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>PIC</label>
                        <input type="text" class="form-control" name="pic" id="pic" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea class="form-control" name="address" id="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>WhatsApp</label>
                        <input type="text" class="form-control" name="whatsapp" id="whatsapp">
                    </div>
                    <div class="mb-3">
                        <label>No. Telepon</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="facebook" id="facebook">
                    </div>
                    <div class="mb-3">
                        <label>Instagram</label>
                        <input type="text" class="form-control" name="instagram" id="instagram">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    let contactModal = document.getElementById("contactModal");
    let contactForm = document.getElementById("contactForm");

    // Reset Form Saat Modal Ditutup
    contactModal.addEventListener("hidden.bs.modal", function() {
        contactForm.reset();
        document.getElementById("contactId").value = "";
        contactForm.action = "/kontak"; // Reset ke default action
        document.querySelector("input[name='_method']")?.remove();
        document.querySelector(".modal-title").innerText = "Tambah Kontak";
    });

    // Tombol Edit
    document.querySelectorAll(".btn-edit").forEach(btn => {
        btn.addEventListener("click", function() {
            document.getElementById("contactId").value = this.dataset.id;
            document.getElementById("pic").value = this.dataset.pic;
            document.getElementById("address").value = this.dataset.address;
            document.getElementById("whatsapp").value = this.dataset.whatsapp;
            document.getElementById("phone").value = this.dataset.phone;
            document.getElementById("email").value = this.dataset.email;
            document.getElementById("facebook").value = this.dataset.facebook;
            document.getElementById("instagram").value = this.dataset.instagram;
            document.querySelector(".modal-title").innerText = "Edit Kontak";
            
            // Ubah form action ke edit mode
            contactForm.action = "/kontak/" + this.dataset.id;
            contactForm.insertAdjacentHTML("beforeend", '<input type="hidden" name="_method" value="PUT">');
        });
    });
});
</script>
    
@endsection
