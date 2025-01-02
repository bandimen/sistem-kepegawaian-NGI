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
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <p>Isi form untuk data karyawan baru di sini:</p>

                            <div class="card">
                                <div class="card-body p-4">
                                    <form class="needs-validation form-lembur" novalidate action="/form-lembur/tambah" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label" for="divisi">DIVISI</label>
                                                <input type="text" class="form-control" id="divisi" name="divisi" value="<?= esc($userData['divisi']) ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="nama">NAMA</label>
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($userData['nama']) ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="nip">NIP</label>
                                                <input type="text" class="form-control" id="nip" name="nip" value="<?= esc($userData['nip']) ?>" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Tab -->
                    <div id="data-tab" class="tab-content">
                        <h4>Data</h4>
                        <p>Berikut adalah data karyawan PT. Nusantara Global Inovasi:</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Divisi</th>
                                    <th scope="col">Pekerjaan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users) && is_array($users)) : ?>
                                    <?php foreach ($users as $index => $user) : ?>
                                        <tr>
                                            <th scope="row"><?= $index + 1 ?></th>
                                            <td><?= esc($user['nama']) ?></td>
                                            <td><?= esc($user['email']) ?></td>
                                            <td><?= esc($user['divisi']) ?></td>
                                            <td><?= esc($user['jabatan']) ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" title="Edit">
                                                    <i class="mdi mdi-file-document-edit-outline"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="mdi mdi-delete-forever-outline"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
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