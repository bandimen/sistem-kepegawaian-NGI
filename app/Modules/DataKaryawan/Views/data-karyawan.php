<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <style>
        .tab-button {
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            background: none;
            font-weight: bold;
            color: #6c757d;
        }

        .tab-button.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>

<body data-layout-size="fluid" data-sidebar-size="lg">

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?= $this->include('partials/menu') ?>

        <!-- Start right Content here -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Start page title -->
                    <?= $page_title ?>
                    <!-- End page title -->

                    <!-- Tabs Navigation -->
                    <div class="d-flex mb-4">
                        <button class="tab-button active" data-tab="form-tab">Form</button>
                        <button class="tab-button" data-tab="data-tab">Data</button>
                    </div>

                    <!-- Tabs Content -->
                    <div>
                        <!-- Form Tab -->
                        <div id="form-tab" class="tab-content active">
                            <h4>Form</h4>
                            <p>Isi form untuk data karyawan di sini:</p>

                            <div class="card">
                                <div class="card-body p-4">
                                    <form class="needs-validation formtambahkaryawan" novalidate action="/data-karyawan/tambah" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="nama">Nama</label>
                                                    <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap Karyawan" name="nama" autofocus>
                                                    <div class="invalid-feedback errorNama">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="nip">NIP</label>
                                                    <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip">
                                                    <div class="invalid-feedback">
                                                        Maksimal 10 digit.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="npwp">NPWP</label>
                                                    <input type="text" class="form-control" id="npwp" placeholder="NPWP" name="npwp">
                                                    <div class="invalid-feedback">
                                                        Maksimal 15 digit.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Username</label>
                                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                                                    <div class="invalid-feedback">
                                                        Masukkan username.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="nik">NIK</label>
                                                    <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik">
                                                    <div class="invalid-feedback">
                                                        Maksimal 16 digit.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_bpjs">KJP (NOMOR BPJS)</label>
                                                    <input type="text" class="form-control" id="no_bpjs" placeholder="KJP (Nomor BPJS)" name="no_bpjs">
                                                    <div class="invalid-feedback">
                                                        Maksimal 11 digit.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ini harusnya pake input select2 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">TEMPAT LAHIR</label>
                                                <input type="number" class="form-control" id="validationCustom03" placeholder="Tempat Lahir">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="tanggal_lahir">TANGGAL LAHIR</label>
                                                <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" name="tanggal_lahir">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="jenis_kelamin">JENIS KELAMIN</label>
                                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_ktp">ALAMAT SESUAI KTP</label>
                                                <textarea class="form-control" id="alamat_ktp" placeholder="Alamat Sesuai KTP" name="alamat_ktp"></textarea>
                                                <div class="invalid-feedback">Minimal 15 karakter.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_domisili">ALAMAT DOMISILI</label>
                                                <textarea class="form-control" id="alamat_domisili" placeholder="Alamat Domisili" name="alamat_domisili"></textarea>
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_korespondensi">ALAMAT KORESPONDENSI</label>
                                                <textarea class="form-control" id="alamat_korespondensi" placeholder="Alamat Korespondensi" name="alamat_korespondensi"></textarea>
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>

                                            <!-- ini pake select2 -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="provinsi">Pilih Provinsi</label>
                                                    <select class="form-select" id="provinsi" name="provinsi" required>
                                                        <option value=""></option>
                                                        <?php foreach ($provinsiData as $provinsi) : ?>
                                                            <option value="<?= $provinsi['kode']; ?>"><?= $provinsi['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih provinsi.</div>
                                                </div>
                                            </div>
                                            <!-- ini pake select2 -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="kota">KAB/KOTA DOMISILI</label>
                                                    <select name="kota" id="kota" class="form-control"></select>
                                                    <div class="invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ini pake select2 -->

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">UNIT KERJA</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Unit Kerja">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <!-- ini pake select2 -->

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">DIVISI</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Divisi">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <!-- ini pake select2 -->

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">JABATAN</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Jabatan">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <!-- ini pake select2 -->

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">GRADE</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Grade">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">STATUS KONTRAK</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Unit Kerja">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="tanggal_masuk">TANGGAL MASUK</label>
                                                <input type="date" class="form-control" id="tanggal_masuk" placeholder="Tanggal Masuk" name="tanggal_masuk">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom03">STATUS PERNIKAHAN</label>
                                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Status Pernikahan">
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="jml_tanggungan">JUMLAH TANGGUNGAN</label>
                                                    <input type="text" class="form-control" id="jml_tanggungan" placeholder="Jumlah Tanggungan" name="jml_tanggungan">
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email_kantor">EMAIL KANTOR</label>
                                                    <input type="text" class="form-control" id="email_kantor" placeholder="Email Kantor" name="email_kantor">
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email_pribadi">EMAIL PRIBADI</label>
                                                    <input type="text" class="form-control" id="email_pribadi" placeholder="Email Pribadi" name="email_pribadi">
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_telp">NOMOR TELEPON</label>
                                                    <input type="text" class="form-control" id="no_telp" placeholder="Nomor Telepon" name="no_telp">
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_rek">NOMOR REKENING</label>
                                                    <input type="text" class="form-control" id="no_rek" placeholder="Nomor Rekening" name="no_rek">
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_ktp">KTP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="file_ktp" name="file_ktp">
                                                    <div class="invalid-feedback">File KTP diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_kjp">KJP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="file_kjp" name="file_kjp">
                                                    <div class="invalid-feedback">File KJP diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_npwp">NPWP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="file_npwp" name="file_npwp">
                                                    <div class="invalid-feedback">File NPWP diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_kk">KARTU KELUARGA</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="file_kk" name="file_kk">
                                                    <div class="invalid-feedback">File Kartu Keluarga diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_pendidikan">PENDIDIKAN TERAKHIR</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="file_pendidikan" name="file_pendidikan">
                                                    <div class="invalid-feedback">File Pendidikan Terakhir diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btnsubmit">Submit</button>
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Tab -->
                    <div id="data-tab" class="tab-content">
                        <h4>Data</h4>
                        <p>Berikut adalah data yang tersedia:</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Jenis User</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>John Doe</td>
                                    <td>628123456789</td>
                                    <td>johndoe@example.com</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" title="Edit">
                                            <i class="mdi mdi-file-document-edit-outline"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="mdi mdi-delete-forever-outline"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jane Smith</td>
                                    <td>628987654321</td>
                                    <td>janesmith@example.com</td>
                                    <td>Operator</td>
                                    <td>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-trash"></i></button>
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa dripicons-preview"></i></button>
                                            <!-- <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button> -->
                                            <!-- <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button> -->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?= $this->include('partials/footer') ?>
        </div>
    </div>
    <?= $this->include('partials/right-sidebar') ?>

    <?= $this->include('partials/vendor-scripts') ?>
    <!-- JavaScript untuk Navigasi Tab -->
    <script>
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Reset all active states
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Activate the clicked tab and corresponding content
                button.classList.add('active');
                document.getElementById(button.dataset.tab).classList.add('active');
            });
        });
    </script>

    <!-- select2 -->
    <script>
        $('#provinsi').select2({
            placeholder: "Pilih Provinsi"
        });
    </script>

    <!-- ajax ketika tombol submit ditekan maka akan melakukan validasi input -->
    <!-- <script>
        $(document).ready(function() {
            $('.formtambahkaryawan').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btnsubmit').attr('disabled', true);
                        $('.btnsubmit').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btnsubmit').removeAttr('disabled');
                        $('.btnsubmit').html('Submit');
                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.nama) {
                                $('#nama').addClass('is-invalid');
                                $('.errorNama').html(response.error.nama);
                            } else {
                                $('#nama').removeClass('is-invalid');
                                $('.errorNama').html('');
                            }
                        } else if (response.success) {
                            alert(response.success);
                            location.reload(); // Reload halaman jika berhasil
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });
        });
    </script> -->

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Plugins js-->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    <!-- dashboard init -->
    <script src="assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!-- form validation -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>