$(function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        "language": {
            "lengthMenu"    : "_MENU_ data per halaman",
            "zeroRecords"   : "Data tidak ditemukan",
            "info"          : "Halaman ke-_PAGE_ dari _PAGES_",
            "infoEmpty"     : "Data kosong",
            "infoFiltered"  : "(disaring dari _MAX_ total data)",
            "search"        : "Cari : ",
            "paginate": {
                "previous": "<<",
                "next"    : ">>"
            }
        }
    });
});