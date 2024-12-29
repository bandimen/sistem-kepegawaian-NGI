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
                                    <form class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom01">Nama</label>
                                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Nama Lengkap Karyawan" required>
                                                    <div class="invalid-feedback">
                                                        Masukkan nama lengkap.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom02">NIP</label>
                                                    <input type="number" class="form-control" id="validationCustom03" placeholder="NIP" required min="10">
                                                    <div class="invalid-feedback">
                                                        Maksimal 10 digit.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom03">NPWP</label>
                                                    <input type="number" class="form-control" id="validationCustom03" placeholder="NPWP" required min="15">
                                                    <div class="invalid-feedback">
                                                        Maksimal 15 digit.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom03">Username</label>
                                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Username" required>
                                                    <div class="invalid-feedback">
                                                        Masukkan username.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom03">NIK</label>
                                                    <input type="number" class="form-control" id="validationCustom03" placeholder="NIK" required min="16">
                                                    <div class="invalid-feedback">
                                                        Maksimal 16 digit.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom03">KJP (NOMOR BPJS)</label>
                                                    <input type="number" class="form-control" id="validationCustom03" placeholder="KJP (Nomor BPJS)" maxlength="11" required>
                                                    <div class="invalid-feedback">
                                                        Maksimal 11 digit.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">KOTA LAHIR</label>
                                                <input type="number" class="form-control" id="validationCustom03" placeholder="Kota Lahir" required min="15">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">TANGGAL LAHIR</label>
                                                <input type="date" class="form-control" id="validationCustom03" placeholder="Tanggal Lahir" required min="15">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">JENIS KELAMIN</label>
                                                <select class="form-select">
                                                    <option>Pilih Jenis Kelamin</option>
                                                    <option>Perempuan</option>
                                                    <option>Laki-Laki</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">ALAMAT SESUAI KTP</label>
                                                <textarea class="form-control" id="validationCustom03" placeholder="Alamat Sesuai KTP" required minlength="15"></textarea>
                                                <div class="invalid-feedback">Minimal 15 karakter.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">ALAMAT DOMISILI</label>
                                                <textarea class="form-control" id="validationCustom03" placeholder="Alamat Domisili" required min="15"></textarea>
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">ALAMAT KORESPONDENSI</label>
                                                <textarea class="form-control" id="validationCustom03" placeholder="Alamat Korespondensi" required min="15"></textarea>
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom01">PROVINSI DOMISILI</label>
                                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Provinsi Domisili" required>
                                                    <div class="invalid-feedback">
                                                        Masukkan nama lengkap.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom01">KOTA DOMISILI</label>
                                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Kota Domisili" required>
                                                    <div class="invalid-feedback">
                                                        Masukkan nama lengkap.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">UNIT KERJA</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Unit Kerja" required min="15">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">DIVISI</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Divisi" required min="15">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">JABATAN</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Jabatan" required min="15">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">GRADE</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Grade" required min="15">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">STATUS KONTRAK</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Unit Kerja" required min="15">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="validationCustom03">TANGGAL MASUK</label>
                                                <input type="date" class="form-control" id="validationCustom03" placeholder="Tanggal Masuk" required min="15">
                                                <div class="invalid-feedback">Maksimal 15 digit.</div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom03">STATUS PERNIKAHAN</label>
                                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Status Pernikahan" required>
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom04">JUMLAH TANGGUNGAN</label>
                                                    <input type="text" class="form-control" id="validationCustom04" placeholder="Jumlah Tanggungan" required>
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom03">EMAIL KANTOR</label>
                                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Email Kantor" required>
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom04">EMAIL PRIBADI</label>
                                                    <input type="text" class="form-control" id="validationCustom04" placeholder="Email Pribadi" required>
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom03">NOMOR TELEPON</label>
                                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Nomor Telepon" required>
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom04">NOMOR REKENING</label>
                                                    <input type="text" class="form-control" id="validationCustom04" placeholder="Nomor Rekening" required>
                                                    <div class="invalid-feedback">-.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="fileKTP">KTP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="fileKTP" required>
                                                    <div class="invalid-feedback">File KTP diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="fileKJP">KJP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="fileKJP" required>
                                                    <div class="invalid-feedback">File KJP diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="fileNPWP">NPWP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="fileNPWP" required>
                                                    <div class="invalid-feedback">File NPWP diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="fileKK">KARTU KELUARGA</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="fileKK" required>
                                                    <div class="invalid-feedback">File Kartu Keluarga diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="filePendidikan">PENDIDIKAN TERAKHIR</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="filePendidikan" required>
                                                    <div class="invalid-feedback">File Pendidikan Terakhir diperlukan.</div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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