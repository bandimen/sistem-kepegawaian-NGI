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
    <div id="layout-wrapper">
        <?= $this->include('partials/menu') ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?= $page_title ?>

                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#data" role="tab">
                                        <span class="d-none d-sm-block">Data</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#update" role="tab">
                                        <span class="d-none d-sm-block">Update</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="data" role="tabpanel">
                                    <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama User</th>
                                                <th>Email User</th>
                                                <th>Username</th>
                                                <th>Divisi / Jenis User</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($users)) : ?>
                                                <?php foreach ($users as $index => $user) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $index + 1 ?></th>
                                                        <td><?= esc($user['nama']) ?></td>
                                                        <td><?= esc($user['email']) ?></td>
                                                        <td><?= esc($user['username']) ?></td>
                                                        <td><?= esc($user['divisi']) ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary edit-user"
                                                                data-id="<?= esc($user['id']) ?>"
                                                                data-nama="<?= esc($user['nama']) ?>"
                                                                data-email="<?= esc($user['email']) ?>"
                                                                data-username="<?= esc($user['username']) ?>"
                                                                data-divisi="<?= esc($user['divisi_id']) ?>"
                                                                title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger delete-user"
                                                                data-id="<?= esc($user['id']) ?>"
                                                                title="Delete">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr><td colspan="6">Tidak ada data pengguna.</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="update" role="tabpanel">
                                    <?php if (session()->getFlashdata('pesan')) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= session()->getFlashdata('pesan'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="needs-validation formedituser" novalidate action="" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label" for="nama">NAMA USER</label>
                                                <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap User" name="nama" value="<?= old('nama') ?>" required pattern="[A-Za-z\s]+" maxlength="255">
                                                <div class="invalid-feedback">Masukkan nama lengkap dengan benar.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="email">EMAIL USER</label>
                                                <input type="email" class="form-control" id="email" placeholder="Email Kantor" name="email" value="<?= old('email') ?>" required>
                                                <div class="invalid-feedback">Masukkan email kantor dengan benar.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="username">USERNAME</label>
                                                <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= old('username') ?>" required maxlength="30" pattern="[a-zA-Z0-9]+">
                                                <div class="invalid-feedback">Masukkan username dengan benar.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">PASSWORD</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                                                    <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="divisi">DIVISI / JENIS USER</label>
                                                <select class="form-select select2" id="divisi" name="divisi" required>
                                                    <option value=""></option>
                                                    <?php foreach ($divisiData as $divisi) : ?>
                                                        <option value="<?= $divisi['id']; ?>"><?= $divisi['nama']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">Silakan pilih divisi.</div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btnsubmit">Submit</button>
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?= $this->include('partials/footer') ?>
        </div>
    </div>

    <?= $this->include('partials/right-sidebar') ?>
    <?= $this->include('partials/vendor-scripts') ?>

    <!-- javascript untuk menampilkan data untuk dikirim ke update -->
    <script>
    $(document).ready(function() {
      $('.edit-user').click(function() {
        // Ambil data dari tombol
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var email = $(this).data('email');
        var username = $(this).data('username');
        var divisi = $(this).data('divisi');

        // Masukkan nilai ke form
        $('#id').val(id);
        $('#nama').val(nama);
        $('#email').val(email);
        $('#username').val(username);
        $('#divisi').val(divisi).trigger('change');

        // Buat email readonly
        $('#email').attr('readonly', true);

        // Pindah ke tab update
        $('a[href="#update"]').tab('show');
      });
    });
    </script>

    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>
