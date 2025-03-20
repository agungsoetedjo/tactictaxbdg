$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    var table = $('#siswaTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/siswa/list",
        columns: [
            // { data: 'id' },
            { data: 'nama' },
            { data: 'email' },
            { data: 'alamat' },
            {
                data: 'id',
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning edit" data-id="${data}">Edit</button>
                        <button class="btn btn-sm btn-danger delete" data-id="${data}">Delete</button>
                    `;
                },
                orderable: false,
                searchable: false
            }
            // { data: 'action', orderable: false, searchable: false }
        ]
    });

    $('#btnTambah').click(function() {
        $('#siswaForm')[0].reset();
        $('#siswaModal').modal('show');
    });

    $('#siswaTable').on('click', '.edit', function() {
        var id = $(this).data('id');
        $.get("/siswa/edit/" + id, function(data) {
            $('#siswa_id').val(data.id);
            $('#nama').val(data.nama);
            $('#email').val(data.email);
            $('#alamat').val(data.alamat);
            $('#btnSubmit').text("Update");
            $('#siswaModal').modal('show');
        });
    });

    //Simpan & Edit Data
    $('#siswaForm').submit(function(e) {
        e.preventDefault();
        var id = $('#siswa_id').val();
        var data = {
            nama: $('#nama').val(),
            email: $('#email').val(),
            alamat: $('#alamat').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        let url = id ? "/siswa/update/" + id : "/siswa/store";
        let type = id ? "PUT" : "POST";

        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(data) {
                Swal.fire("Sukses!", data.message, "success");
                $('#siswaModal').modal('hide');
                let newUrl = window.location.origin + "/siswa";
                window.history.pushState({ path: newUrl }, '', newUrl);
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                Swal.fire("Error!", xhr.responseJSON.message, "error");
                let newUrl = window.location.origin + "/siswa";
                window.history.pushState({ path: newUrl }, '', newUrl);
            }
        });
    });

    // Hapus Data
    $('#siswaTable').on('click', '.delete', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/siswa/destroy/" + id,
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire("Sukses!", data.message, "success");
                        let newUrl = window.location.origin + "/siswa";
                        window.history.pushState({ path: newUrl }, '', newUrl);
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "Terjadi kesalahan saat menghapus data!", "error");
                        let newUrl = window.location.origin + "/siswa";
                        window.history.pushState({ path: newUrl }, '', newUrl);
                    }
                });
            }
        });
    });

});