<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.3-dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome-free-6.6.0-web/css/all.min.css') ?>">
    <script src="<?= base_url('assets/jquery-3.7.1.min.js') ?>"></script>
</head>

<body class="container p-5">
    <h1 class="text-center">Daftar Produk</h1>
    <div class="row">
        <div class="col-12">
            <button class="btn btn-success mt-5 float-end" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-solid fa-cart-plus me-1"></i>tambah</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="container mt-5">
                <table class="table table-bordered table-striped" id="produkTable">
                    <thead>
                        <tr>
                            <th class="col-2">NO</th>
                            <th class="col-4">Nama Produk</th>
                            <th class="col-2">Harga</th>
                            <th class="col-2">Stok</th>
                            <th class="col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalTambah" tabindex="-10" aria-labelledby="#modalTambah">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="NamaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="HargaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="StokProduk">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-end" id="simpanProduk">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-10" aria-labelledby="#modalEdit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEdit">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="NamaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="HargaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="StokProdukEdit">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-end" id="EditProduk">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script src="<?= base_url('assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/fontawesome-free-6.6.0-web/js/all.min.js') ?>"></script>
    <script>
        function tampil() {
            $.ajax({
                url: '<?= base_url('produk/tampil') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(hasil) {
                    if (hasil.status == 'success') {
                        console.log(hasil);
                        var produkTabel = $('#produkTable tbody')
                        produkTabel.empty()
                        var produk = hasil.produk
                        var no = 1
                        produk.forEach(function(item) {
                            var row = '<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + item.nama_produk + '</td>' +
                                '<td>' + item.harga + '</td>' +
                                '<td>' + item.stok + '</td>' +
                                '<td>' +
                                '<button class="btn btn-warning btn-sm editProduk" data-id="' + item.produk_id + '" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="fa-solid fa-pencil"></i> Edit</button>' +
                                '<button class="btn btn-danger btn-sm hapusProduk ms-2" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash"></i> Hapus</button>' +
                                '</td>' +
                                '</td>'
                            produkTabel.append(row)
                            no++
                        })
                    } else {
                        alert(alert('Gagal mengambil data')) 
                    }
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            })
        }

        $(document).ready(function() {
            tampil()
            $('#simpanProduk').on('click', function() {
                $.ajax({
                    url: '<?= base_url('produk/tambah') ?>',
                    type: "POST",
                    data: {
                        nama_produk: $('#NamaProduk').val(),
                        harga: $('#HargaProduk').val(),
                        stok: $('#StokProduk').val(),
                    },
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambah').modal('hide');
                            $('#formTambah')[0].reset()
                            tampil()
                        } else {
                            alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors))
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan:' + error)
                    }

                })
            })

            $('#produkTable').on('click', '.hapusProduk', function() {
                var nomor = $(this).closest('tr').find('td:first').text()
                var id = $(this).attr('data-id')
                console.log(id);
                if (confirm(`Hapus data nomor ${nomor} ?`)) {

                    $.ajax({
                        url: '<?= base_url('produk/hapus') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'id': id
                        },
                        success: function(hasil) {
                            tampil()
                            alert(hasil.message)
                        },
                        error: function(xhr, status, error) {
                            console.log('pessan error ' + error);

                        }

                    })
                }
            })

            $('#produkTable').on('click', '.editProduk', function() {
                document.getElementById('NamaProdukEdit').value = $(this).closest('tr').find('td:eq(1)').text()
                document.getElementById('HargaProdukEdit').value = $(this).closest('tr').find('td:eq(2)').text()
                document.getElementById('StokProdukEdit').value = $(this).closest('tr').find('td:eq(3)').text()
                var id = $(this).attr('data-id')
                $('#EditProduk').off('click').on('click', function() {
                    if (confirm('Simpan perubahan data?')) {
                        $.ajax({
                            url: '<?= base_url('produk/edit') ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'produk_id': id,
                                'nama_produk': document.getElementById('NamaProdukEdit').value,
                                'harga': document.getElementById('HargaProdukEdit').value,
                                'stok': document.getElementById('StokProdukEdit').value
                            },
                            success: function(hasil) {
                                $('#modalEdit').modal('hide')
                                tampil()
                            },
                            error: function(xhr, status, error) {
                                console.log('Error: ' + error);
                            }
                        })
                    }
                })
            })

        })
    </script>
</body>

</html>