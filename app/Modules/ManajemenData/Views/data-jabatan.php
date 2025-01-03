<!DOCTYPE html>
<html lang="en">

<head>

    <?= $title_meta ?>
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?= $this->include('partials/head-css') ?>

</head>

<body data-layout-size="fluid" data-sidebar-size="lg">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->include('partials/menu') ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?= $page_title ?>

                    <div class="card">

                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#data" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Data</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#update" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Update</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="data" role="tabpanel">
                                    <table id="datatable" class="table table-striped dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Jabatan</th>
                                                <th>Label Jabatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($jabatanData)) : ?>
                                                <?php foreach ($jabatanData as $index => $jabatan) : ?>
                                                    <tr>
                                                        <th><?= $index + 1 ?></th>
                                                        <td><?= esc($jabatan['nama']) ?></td>
                                                        <td><?= esc($jabatan['label']) ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary edit" title="Edit"
                                                                data-id="<?= esc($jabatan['id']) ?>"
                                                                data-nama="<?= esc($jabatan['nama']) ?>"
                                                                data-label="<?= esc($jabatan['label']) ?>"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-sm btn-outline-danger delete" data-id="<?= esc($jabatan['id']) ?>" title="Delete"><i class="bx bx-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>Tidak ada data jabatan.</tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="update" role="tabpanel">
                                    <form class="needs-validation" validate action="/data-jabatan/tambah" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="mb-3">
                                            <label class="form-label" for="nama">Nama Jabatan</label>
                                            <input type="text" class="form-control" id="nama" placeholder="Tentukan nama jabatan" name="nama" required>
                                            <div class="valid-feedback">
                                                Nama jabatan dapat digunakan.
                                            </div>
                                            <div class="invalid-feedback" id="nama-error">
                                                Nama jabatan tidak valid!
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="label">Label Jabatan</label>
                                            <input type="text" class="form-control" id="label" placeholder="Tentukan label jabatan" name="label" required>
                                            <div class="valid-feedback">
                                                Label jabatan dapat digunakan
                                            </div>
                                            <div class="invalid-feedback" id="label-error">
                                                Label jabatan tidak valid!
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" id="btn-simpan" disabled>Simpan</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?= $this->include('partials/footer') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?= $this->include('partials/right-sidebar') ?>

    <?= $this->include('partials/vendor-scripts') ?>

    <!-- javascript untuk menampilkan data untuk dikirim ke update -->
    <script>
        $(document).ready(function() {
            $('.edit').click(function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var label = $(this).data('label');

                $('#nama').val(nama);
                $('#label').val(label);

                $('a[href="#update"]').tab('show');
            })
        })
    </script>

    <!-- javascript untuk validasi input -->
    <script>
        $(document).ready(function() {
            function cekValidasi() {
                if ($('.is-invalid').length > 0) {
                    $('#btn-simpan').attr('disabled', true);
                } else {
                    $('#btn-simpan').attr('disabled', false);
                }
            }
            // validasi nama ketika keyboard ditekan
            $('#nama').keyup(function() {
                var inputNama = $(this).val();
                var regex = /\d/; // pattern angka

                // cek angka
                if (regex.test(inputNama)) {
                    $('#nama-error').text('Nama jabatan tidak boleh mengandung angka').show();
                    $('#nama').addClass('is-invalid');
                } else {
                    // kalo lolos lanjut cek unique
                    $.ajax({
                        url: '/data-jabatan/ceknama',
                        type: 'GET',
                        data: {
                            nama: inputNama
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#nama-error').text('Nama jabatan sudah ada').show();
                                $('#nama').addClass('is-invalid');
                            } else {
                                $('#nama-error').hide();
                                $('#nama').removeClass('is-invalid');
                            }
                        },
                        error: function() {
                            $('#nama-error').text('Terjadi kesalahan, coba lagi').show();
                            $('#nama').addClass('is-invalid');
                        },
                        complete: cekValidasi
                    });
                }
            });

            // validasi Label
            $('#label').keyup(function() {
                var inputLabel = $(this).val();
                var regex = /\d/; // 

                if (regex.test(inputLabel)) {
                    $('#label-error').text('Label jabatan tidak boleh mengandung angka').show();
                    $('#label').addClass('is-invalid');
                } else {
                    $.ajax({
                        url: '/data-jabatan/ceklabel',
                        type: 'GET',
                        data: {
                            label: inputLabel
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#label-error').text('Label jabatan sudah ada').show();
                                $('#label').addClass('is-invalid');
                            } else {
                                $('#label-error').hide();
                                $('#label').removeClass('is-invalid');
                            }
                        },
                        error: function() {
                            $('#label-error').text('Terjadi kesalahan, coba lagi').show();
                            $('#label').addClass('is-invalid');
                        },
                        complete: cekValidasi
                    });
                }
            });
            cekValidasi();
        });
    </script>

    <!-- <script>
        function reloadTable() {
            $.ajax({
                url: '/data-jabatan/getAll', // Endpoint untuk mengambil semua data jabatan
                type: 'GET',
                success: function(response) {
                    // Memperbarui tabel dengan data baru
                    var tableBody = $('#datatable tbody');
                    tableBody.empty(); // Hapus tabel lama
                    $.each(response.jabatanData, function(index, jabatan) {
                        var row = '<tr>' +
                            '<th>' + (index + 1) + '</th>' +
                            '<td>' + jabatan.nama + '</td>' +
                            '<td>' + jabatan.label + '</td>' +
                            '<td>' +
                            '<button class="btn btn-sm btn-outline-primary edit" title="Edit" data-id="' + jabatan.id + '" data-nama="' + jabatan.nama + '" data-label="' + jabatan.label + '"><i class="fa fa-edit"></i></button>' +
                            '<button class="btn btn-sm btn-outline-danger delete" data-id="' + jabatan.id + '" title="Delete"><i class="bx bx-trash-alt"></i></button>' +
                            '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });
                }
            });
        }
    </script> -->

    <!-- javascript untuk swal ketika delete karyawan -->
    <script>
        $(document).ready(function() {
            $('.delete').click(function(e) {
                e.preventDefault();

                const id = $(this).data('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "Data jabatan akan hilang!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url('data-jabatan/delete') ?>',
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Data jabatan berhasil dihapus.",
                                        icon: "success"
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: response.message || "Gagal menghapus data jabatan.",
                                        icon: "error"
                                    })
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Error!",
                                    text: "An error occured while deleting the data.",
                                    icon: "error"
                                });
                            }
                        });

                    }
                });
            });
        });
    </script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Plugins js-->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    <!-- dashboard init -->
    <script src="assets/js/pages/dashboard.init.js"></script>

    <!-- form validation -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>