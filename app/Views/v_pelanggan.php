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
                <table class="table table-bordered table-striped" id="pelangganTable">
                    <thead>
                        <tr>
                            <th class="col-2">NO</th>
                            <th class="col-4">Nama Pelanggan</th>
                            <th class="col-2">Alamat</th>
                            <th class="col-2">No.tlp</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Pelanggan</h5>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form id="formPelanggan">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="NamaPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Alamat">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">No.telepon</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="tlp">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-end" id="simpanPelanggan">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-10" aria-labelledby="#modalEdit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEdit">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="NamaPelangganEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="AlamatEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">No.telepon</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="tlpEdit">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-end" id="EditPelanggan">Simpan</button>
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
                url: '<?= base_url('pelanggan/tampil') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(hasil) {
                    if (hasil.status == 'success') {
                        console.log(hasil);
                        var pelangganTabel = $('#pelangganTable tbody')
                        pelangganTabel.empty()
                        var pelanggan = hasil.pelanggan
                        var no = 1
                        pelanggan.forEach(function(item) {
                            var row = '<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + item.nama + '</td>' +
                                '<td>' + item.alamat + '</td>' +
                                '<td>' + item.no_tlp + '</td>' +
                                '<td>' +
                                '<button class="btn btn-warning btn-sm EditPelanggan" data-id="' + item.id_pelanggan + '" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="fa-solid fa-pencil"></i> Edit</button>' +
                                '<button class="btn btn-danger btn-sm hapusPelanggan ms-2" data-id="' + item.id_pelanggan + '"><i class="fa-solid fa-trash"></i> Hapus</button>' +
                                '</td>' +
                                '</td>'
                            pelangganTabel.append(row)
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
            $('#simpanPelanggan').on('click', function() {
                $.ajax({
                    url: '<?= base_url('pelanggan/tambah') ?>',
                    type: "POST",
                    data: {
                        nama: $('#NamaPelanggan').val(),
                        alamat: $('#Alamat').val(),
                        no_tlp: $('#tlp').val(),
                    },
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambah').modal('hide');
                            $('#formPelanggan')[0].reset()
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

            $('#pelangganTable').on('click', '.hapusPelanggan', function() {
                var nomor = $(this).closest('tr').find('td:first').text()
                var id = $(this).attr('data-id')
                console.log(id);
                if (confirm(`Hapus data nomor ${nomor} ?`)) {

                    $.ajax({
                        url: '<?= base_url('pelanggan/hapus') ?>',
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

            $('#pelangganTable').on('click', '.editPelanggan', function() {
                document.getElementById('NamaPelangganEdit').value = $(this).closest('tr').find('td:eq(1)').text()
                document.getElementById('AlamatEdit').value = $(this).closest('tr').find('td:eq(2)').text()
                document.getElementById('tlpEdit').value = $(this).closest('tr').find('td:eq(3)').text()
                var id = $(this).attr('data-id')
                $('#EditPelanggan').off('click').on('click', function() {
                    if (confirm('Simpan perubahan data?')) {
                        $.ajax({
                            url: '<?= base_url('pelanggan/edit') ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'id_pelanggan': id,
                                'nama': document.getElementById('NamaPelangganEdit').value,
                                'alamat': document.getElementById('AlamatEdit').value,
                                'no_tlp': document.getElementById('tlpEdit').value
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