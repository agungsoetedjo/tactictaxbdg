@extends('content-partials.main')

@section('contents')

<section id="starter-section" class="starter-section section">

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
        <h3>Data Kategori</h3>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#kategoriModal">Tambah Data</button>
    
        <table class="datatable table table-bordered table-striped">
            <thead>
                <tr class="table-primary">
                    {{-- <th>#</th> --}}
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $key => $item)
                <tr>
                    {{-- <td>{{ $key + 1 }}</td> --}}
                    <td>{{ $item->nama }}</td>
                    <td>{!! Str::limit($item->deskripsi,100) !!}</td>
                    <td>
                        <button class="btn btn-warning btn-edit" 
                            data-id="{{ $item->id }}" 
                            data-nama="{{ $item->nama }}" 
                            data-deskripsi="{{ $item->deskripsi }}" 
                            data-bs-toggle="modal" data-bs-target="#kategoriModal">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</section><!-- /Starter Section Section -->

<!-- Modal -->
<div class="modal fade" id="kategoriModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="kategoriForm" method="POST" action="{{ route('kategori.store') }}">
            @csrf
            <input type="hidden" id="kategoriId" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
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
<script>
        let editor;

        ClassicEditor.create(document.querySelector('#deskripsi'), {
            toolbar: [ 'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', '|', 'bulletedList', 'numberedList']
        })  
        .then(newEditor => { editor = newEditor; })
        .catch(error => console.error(error));

        document.addEventListener("DOMContentLoaded", function() {

            let kategoriModal = document.getElementById("kategoriModal");
        kategoriModal.addEventListener("hidden.bs.modal", function() {
            document.getElementById("kategoriForm").reset();
            document.getElementById("kategoriId").value = "";
            document.getElementById("kategoriForm").action = "{{ route('kategori.store') }}";
            document.querySelector(".modal-title").innerText = "Tambah Kategori";
            editor.setData('');
            document.querySelector("input[name='_method']")?.remove(); // Hapus input _method jika ada
        });
    
        document.querySelectorAll(".btn-edit").forEach(btn => {
            btn.addEventListener("click", function() {
                let id = this.getAttribute('data-id');
                let nama = this.getAttribute('data-nama');
                let deskripsi = this.getAttribute('data-deskripsi');
                document.getElementById("kategoriId").value = id;
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
                document.querySelector(".modal-title").innerText = "Edit Kategori";
                document.getElementById("kategoriForm").action = "/kategori/" + id;
                document.getElementById("kategoriForm").insertAdjacentHTML("beforeend", '<input type="hidden" name="_method" value="PUT">');
            });
        });
    
        document.querySelector(".btn-success").addEventListener("click", function() {
            document.getElementById("kategoriForm").reset();
            document.getElementById("kategoriId").value = "";
            document.getElementById("kategoriForm").action = "{{ route('kategori.store') }}";
            document.querySelector(".modal-title").innerText = "Tambah Kategori";
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
                        fetch("/kategori/" + this.dataset.id, {
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