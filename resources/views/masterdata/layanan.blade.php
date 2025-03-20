@extends('content-partials.main')

@section('contents')

<section id="starter-section" class="starter-section section">
<div class="container">
    @if(session('success'))
        <script>
            Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 2000,
            showConfirmButton: false
            });
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    @endif
    
    <h3>Data Layanan</h3>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#layananModal">Tambah Data</button>

    <table class="datatable table table-bordered table-striped">
        <thead>
            <tr class="table-primary">
                {{-- <th>#</th> --}}
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Kategori</th>
                <th style="width: 10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($layanan as $key => $item)
            <tr>
                {{-- <td>{{ $key + 1 }}</td> --}}
                <td>{{ $item->nama }}</td>
                <td>{!! Str::limit($item->deskripsi,70) !!}</td>
                <td>
                    {{-- @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" width="100">
                    @endif --}}
                    @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                    alt="Gambar Layanan" 
                    class="img-thumbnail preview-img" 
                    data-image="{{ asset('storage/' . $item->gambar) }}"
                    style="width: 70px; height: 100px; object-fit: cover; cursor: pointer;">
                    @else
                        <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </td>
                <td>{{ $item->kategori->nama }}</td>
                <td>
                    <button class="btn btn-warning btn-edit" 
                        data-id="{{ $item->id }}" 
                        data-nama="{{ $item->nama }}" 
                        data-deskripsi="{{ $item->deskripsi }}" 
                        data-gambar="{{ $item->gambar }}" 
                        data-kategori="{{ $item->kategori_id }}"
                        data-bs-toggle="modal" data-bs-target="#layananModal">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</section>
<!-- Modal -->
<div class="modal fade" id="layananModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="layananForm" method="POST" action="{{ route('layanan.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="layananId" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                        <div class="mt-2">
                            <img id="previewGambar" src="" alt="Preview" style="max-width: 100px; display: none;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori_id" id="kategori_id" required>
                            <option value="">--Pilih--</option>
                            @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/allourcodes.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
// Preview gambar saat ingin upload
document.getElementById('gambar').addEventListener('change', function(event) {
    let file = event.target.files[0]; // Ambil file yang dipilih
    if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('previewGambar');
            preview.src = e.target.result;
            preview.style.display = "block"; // Tampilkan gambar
        };
        reader.readAsDataURL(file); // Baca file sebagai URL
    }
});

$(document).ready(function () {
    $(".preview-img").on("click", function () {
        let imageUrl = $(this).data("image"); // Ambil URL gambar

        // Hapus elemen sebelumnya jika ada
        $("#ajax-lightbox").remove();

        // Tambahkan elemen Lightbox baru dengan gambar di tengah
        $("body").append(`
            <div id="ajax-lightbox" style="
                display: flex; justify-content: center; align-items: center;
                position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
                background: rgba(0,0,0,0.8); z-index: 9999; opacity: 0;
                transition: opacity 0.3s ease-in-out;">
                
                <img src="${imageUrl}" style="
                    max-width: 90%; max-height: 90%; border-radius: 8px;
                    opacity: 0; transform: scale(0.8);
                    transition: opacity 0.5s ease, transform 0.5s ease;">
                
                <span id="close-lightbox" style="
                    position: absolute; top: 20px; right: 30px; color: white;
                    font-size: 30px; cursor: pointer;">&times;</span>
            </div>
        `);

        // Efek fade-in dan gambar muncul dengan transisi
        setTimeout(() => {
            $("#ajax-lightbox").css("opacity", "1");
            $("#ajax-lightbox img").css({"opacity": "1", "transform": "scale(1)"});
        }, 10);

        // Tutup Lightbox saat tombol close diklik
        $("#close-lightbox").on("click", function () {
            closeLightbox();
        });

        // Tutup Lightbox saat area luar gambar diklik
        $("#ajax-lightbox").on("click", function (e) {
            if (e.target.id === "ajax-lightbox") {
                closeLightbox();
            }
        });

        function closeLightbox() {
            $("#ajax-lightbox img").css({"opacity": "0", "transform": "scale(0.8)"});
            $("#ajax-lightbox").css("opacity", "0");
            setTimeout(() => { $("#ajax-lightbox").remove(); }, 300);
        }
    });
});

    let editor;

        ClassicEditor.create(document.querySelector('#deskripsi'), {
            toolbar: [ 'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', '|', 'bulletedList', 'numberedList']
        })
        .then(newEditor => { editor = newEditor; })
        .catch(error => console.error(error));

    document.addEventListener("DOMContentLoaded", function() {
        let layananModal = document.getElementById("layananModal");
    
        layananModal.addEventListener("hidden.bs.modal", function() {
            document.getElementById("layananForm").reset();
            document.getElementById("layananId").value = "";
            document.getElementById("layananForm").action = "{{ route('layanan.store') }}";
            document.querySelector(".modal-title").innerText = "Tambah Layanan";
            editor.setData('');
            document.getElementById('gambar').value = ""; // Reset input file
            let preview = document.getElementById('previewGambar');
            preview.src = "";
            preview.style.display = "none"; // Sembunyikan gambar preview
            document.querySelector("input[name='_method']")?.remove();
        });

        document.querySelectorAll(".btn-edit").forEach(btn => {
            btn.addEventListener("click", function() {

                let id = this.getAttribute('data-id');
                let nama = this.getAttribute('data-nama');
                let deskripsi = this.getAttribute('data-deskripsi');
                let gambar = this.getAttribute('data-gambar');
                document.getElementById("layananId").value = id;
                document.getElementById("nama").value = nama;

                if (editor) {
                editor.setData(deskripsi);
                } else {
                    ClassicEditor.create(document.querySelector('#deskripsi'))
                        .then(newEditor => {
                            editor = newEditor;
                            editor.setData(deskripsi);
                        })
                        .catch(error => console.error(error));
                }
                let previewGambar = document.getElementById("previewGambar");
                if (gambar) {
                    previewGambar.src = "/storage/" + gambar;
                    previewGambar.style.display = "block";
                } else {
                    previewGambar.style.display = "none";
                }
                document.getElementById("kategori_id").value = this.dataset.kategori;
                document.querySelector(".modal-title").innerText = "Edit Layanan";
                document.getElementById("layananForm").action = "/layanan/" + id;
                document.getElementById("layananForm").insertAdjacentHTML("beforeend", '<input type="hidden" name="_method" value="PUT">');
            });
        });
    
        document.querySelector(".btn-success").addEventListener("click", function() {
            document.getElementById("layananForm").reset();
            document.getElementById("layananId").value = "";
            document.getElementById("layananForm").action = "{{ route('layanan.store') }}";
            document.querySelector(".modal-title").innerText = "Tambah Layanan";
            document.querySelector("input[name='_method']")?.remove();
        });
    
        document.querySelectorAll(".btn-delete").forEach(btn => {
            btn.addEventListener("click", function() {
                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch("/layanan/" + this.dataset.id, {
                            method: "DELETE",
                            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
                        }).then(() => location.reload());
                    }
                });
            });
        });
    });
    </script>
    
@endsection
