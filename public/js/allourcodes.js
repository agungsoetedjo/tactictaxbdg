document.addEventListener("DOMContentLoaded", function() {
    let previewImg = document.getElementById("preview-img");

    // Event listener untuk setiap tab layanan
    document.querySelectorAll(".nav-link").forEach(function(navLink) {
        navLink.addEventListener("shown.bs.tab", function(event) {
            let newImage = event.target.getAttribute("data-image");

            if (newImage) {
                previewImg.src = newImage;
                previewImg.setAttribute("data-image", newImage); // Simpan untuk lightbox
            }
        });
    });
});

function initDataTable(selector) {
    $(selector).DataTable({
        "lengthMenu": [5, 10, 25, 50],
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(disaring dari _MAX_ total data)",
            "search": "Cari:",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "→",
                "previous": "←"
            }
        }
    });
}

// Panggil DataTable untuk tabel yang memiliki class "datatable"
$(document).ready(function() {
    $('.datatable').each(function() {
        initDataTable(this);
    });
});