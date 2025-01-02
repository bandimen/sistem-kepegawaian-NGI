<!DOCTYPE html>
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

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

      <div class="page-content">
        <div class="container-fluid">

          <?= $page_title ?>
          <!-- Tabs Navigation -->
          <div class="d-flex mb-4">
            <button class="tab-button active" data-tab="data-tab">Data</button>
            <button class="tab-button" data-tab="update-tab">Update</button>
          </div>

          <!-- Tabs Content -->
          <div>
            <!-- Data Tab -->
            <div id="data-tab" class="tab-content active">
              <h4>Data</h4>
              <p>Berikut adalah data user PT. Nusantara Global Inovasi:</p>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Divisi / Jenis User</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($users) && is_array($users)) : ?>
                    <?php foreach ($users as $index => $user) : ?>
                      <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= esc($user['nama']) ?></td>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['divisi']) ?></td>
                        <td>
                          <button class="btn btn-primary btn-sm edit-user"
                            data-id="<?= esc($user['id']) ?>"
                            data-nama="<?= esc($user['nama']) ?>"
                            data-username="<?= esc($user['username']) ?>"
                            data-email="<?= esc($user['email']) ?>"
                            data-divisi="<?= esc($user['divisi_id']) ?>"
                            title="Edit">
                            <i class="mdi mdi-file-document-edit-outline"></i> Edit
                          </button>
                          <button
                            class="btn btn-danger btn-sm delete-user"
                            data-id="<?= esc($user['id']) ?>"
                            title="Hapus">
                            <i class="mdi mdi-delete-forever-outline"></i> Hapus
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="6" class="text-center">Tidak ada data karyawan.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>

              </table>
            </div>
          </div>

          <!-- Update Tab -->
          <div id="update-tab" class="tab-content">
            <h4>Update</h4>
            <?php if (session()->getFlashdata('pesan')) : ?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
              </div>
            <?php endif; ?>
            <p>Update untuk data user di sini:</p>

            <div class="card">
              <div class="card-body p-4">
                <form class="needs-validation formedituser" novalidate action="" method="post">
                  <?= csrf_field(); ?>
                  <div class="row">
                    <div class="mb-3">
                      <label class="form-label" for="nama">NAMA</label>
                      <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nama') ? 'is-invalid' : '' ?> " id="nama" placeholder="Nama Lengkap User" name="nama" value="<?= old('nama') ?>" required pattern="[A-Za-z\s]+" maxlength="255">
                      <div class="invalid-feedback">
                        <?= isset($validation) && $validation->hasError('nama') ? $validation->getError('nama') : 'Masukkan nama lengkap dengan benar.' ?>
                      </div>
                    </div>


                    <div class="mb-3">
                      <label class="form-label" for="email">EMAIL</label>
                      <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" id="email" placeholder="Email Kantor" value="<?= old('email') ?>" name="email" required>
                      <div class="invalid-feedback">
                        <?= isset($validation) && $validation->hasError('email') ? $validation->getError('email') : 'Masukkan email kantor dengan benar.' ?>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label" for="username">USERNAME</label>
                      <input type="text" class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" placeholder="Username" value="<?= old('username') ?>" name="username" required maxlength="30" pattern="[a-zA-Z0-9]+">
                      <div class="invalid-feedback">
                        <?= isset($validation) && $validation->hasError('username') ? $validation->getError('username') : 'Masukkan username dengan benar.' ?>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">PASSWORD</label>
                      <div class="input-group auth-pass-inputgroup">
                        <input type="password" name="password" class="form-control" id="password" value="<?= session()->getFlashdata('password') ?>" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                        <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                      </div>
                      <div class="invalid-feedback">
                        <?= isset($validation) && $validation->hasError('username') ? $validation->getError('username') : 'Masukkan username dengan benar.' ?>
                      </div>
                    </div>

                    <!-- ini pake select2 -->
                    <div class="mb-3">
                      <label class="form-label" for="divisi">DIVISI</label>
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
              </div>
            </div>
          </div>


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

  <script>
    $('#divisi').select2({
      placeholder: "Pilih Divisi",
      theme: "bootstrap-5",
    });
    $('button[type="reset"]').click(function() {
      // Reset semua Select2
      $('.select2').val(null).trigger('change');
    });
  </script>
  <!-- javascript untuk menampilkan data untuk dikirim ke update -->
  <script>
    $(document).ready(function() {
      $('.edit-user').click(function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var username = $(this).data('username');
        var email = $(this).data('email');
        var divisi = $(this).data('divisi');

        $('#id').val(id);
        $('#nama').val(nama);
        $('#username').val(username);
        $('#email').val(email);
        $('#divisi').val(divisi).trigger('change');

        $('#email').attr('readonly', true);

        $('.tab-button').removeClass('active');
        $('.tab-content').removeClass('active');

        $('button[data-tab="update-tab"]').addClass('active');
        $('#update-tab').addClass('active');
      });
    });
  </script>

  <!-- javascript untuk swal ketika delete karyawan -->
  <!-- <script>
    $(document).ready(function() {
      $('.delete-user').click(function(e) {
        e.preventDefault();

        const id = $(this).data('id');

        Swal.fire({
          title: "Are you sure?",
          text: "Data beserta akun karyawan akan hilang!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '<?= base_url('data-karyawan/delete') ?>',
              type: "POST",
              data: {
                id: id
              },
              success: function(response) {
                if (response.success) {
                  Swal.fire({
                    title: "Deleted!",
                    text: "Data beserta akun karyawan berhasil dihapus.",
                    icon: "success"
                  }).then(() => {
                    location.reload();
                  });
                } else {
                  Swal.fire({
                    title: "Error!",
                    text: response.message || "Gagal menghapus data karyawan.",
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

</body>

</html>