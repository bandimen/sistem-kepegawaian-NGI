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
                                    <form class="needs-validation formtambahkaryawan" novalidate action="/data-karyawan/tambah" method="post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="nama">NAMA</label>
                                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nama') ? 'is-invalid' : '' ?> " id="nama" placeholder="Nama Lengkap Karyawan" name="nama" value="<?= old('nama') ?>" required pattern="[A-Za-z\s]+" maxlength="255">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('nama') ? $validation->getError('nama') : 'Masukkan nama lengkap dengan benar.' ?>
                                                    </div>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="nip">NIP</label>
                                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nip') ? 'is-invalid' : '' ?>" id="nip" placeholder="NIP" name="nip" value="<?= old('nip') ?>" required minlength="9" maxlength="18" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('nip') ? $validation->getError('nip') : 'Masukkan NIP dengan benar.' ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="npwp">NPWP</label>
                                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('npwp') ? 'is-invalid' : '' ?>" id="npwp" placeholder="NPWP" name="npwp" value="<?= old('npwp') ?>" required minlength="15" maxlength="16" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('npwp') ? $validation->getError('npwp') : 'Masukkan NPWP dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">USERNAME</label>
                                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" placeholder="Username" value="<?= old('username') ?>" name="username" required maxlength="30" pattern="[a-zA-Z0-9]+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('username') ? $validation->getError('username') : 'Masukkan username dengan benar.' ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="nik">NIK</label>
                                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nik') ? 'is-invalid' : '' ?>" id="nik" placeholder="NIK" name="nik" value="<?= old('nik') ?>" required minlength="16" maxlength="16" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('nik') ? $validation->getError('nik') : 'Masukkan NIK dengan benar.' ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_bpjs">KJP (NOMOR BPJS)</label>
                                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('no_bpjs') ? 'is-invalid' : '' ?>" id="no_bpjs" placeholder="KJP (Nomor BPJS)" value="<?= old('no_bpjs') ?>" name="no_bpjs" required minlength="12" maxlength="13" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('no_bpjs') ? $validation->getError('no_bpjs') : 'Masukkan nomor BPJS dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ini harusnya pake input select2 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="tempat_lahir">TEMPAT LAHIR</label>
                                                <select class="form-select" id="tempat_lahir" name="tempat_lahir" required>
                                                    <option value=""></option>
                                                    <?php foreach ($kotaData as $kota) : ?>
                                                        <option value="<?= $kota['nama']; ?>"><?= $kota['nama']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">Silakan pilih tempat lahir.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="tanggal_lahir">TANGGAL LAHIR</label>
                                                <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                                                <div class="invalid-feedback">Silakan pilih tanggal lahir.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="jenis_kelamin">JENIS KELAMIN</label>
                                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                </select>
                                                <div class="invalid-feedback">Silakan pilih jenis kelamin.</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_ktp">ALAMAT SESUAI KTP</label>
                                                <textarea class="form-control <?= isset($validation) && $validation->hasError('alamat_ktp') ? 'is-invalid' : '' ?>" id="alamat_ktp" placeholder="Alamat Sesuai KTP" name="alamat_ktp" value="<?= old('alamat_ktp') ?>" required maxlength="255"></textarea>
                                                <div class="invalid-feedback">
                                                    <?= isset($validation) && $validation->hasError('alamat_ktp') ? $validation->getError('alamat_ktp') : 'Masukkan alamat dengan benar.' ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_domisili">ALAMAT DOMISILI</label>
                                                <textarea class="form-control <?= isset($validation) && $validation->hasError('alamat_domisili') ? 'is-invalid' : '' ?>" id="alamat_domisili" placeholder="Alamat Domisili" value="<?= old('alamat_domisili') ?>" name="alamat_domisili" required></textarea>
                                                <div class="invalid-feedback">
                                                    <?= isset($validation) && $validation->hasError('alamat_domisili') ? $validation->getError('alamat_domisili') : 'Masukkan alamat dengan benar.' ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_korespondensi">ALAMAT KORESPONDENSI</label>
                                                <textarea class="form-control <?= isset($validation) && $validation->hasError('alamat_korespondensi') ? 'is-invalid' : '' ?>" id="alamat_korespondensi" placeholder="Alamat Korespondensi" value="<?= old('alamat_korespondensi') ?>" name="alamat_korespondensi" required></textarea>
                                                <div class="invalid-feedback">
                                                    <?= isset($validation) && $validation->hasError('alamat_korespondensi') ? $validation->getError('alamat_korespondensi') : 'Masukkan alamat dengan benar.' ?>
                                                </div>
                                            </div>

                                            <!-- ini pake select2 -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="provinsi">PILIH PROVINSI DOMISILI</label>
                                                    <select class="form-select" id="provinsi" name="provinsi" required>
                                                        <option value=""></option>
                                                        <?php foreach ($provinsiData as $provinsi) : ?>
                                                            <option value="<?= $provinsi['kode']; ?>"><?= $provinsi['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih provinsi domisili.</div>
                                                </div>
                                            </div>
                                            <!-- ini pake select2 -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="kota">PILIH KAB/KOTA DOMISILI</label>
                                                    <select class="form-select" id="kota" name="kota" required>
                                                        <option value=""></option>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih kab/kota domisili.</div>
                                                </div>
                                            </div>
                                            <!-- ini pake select2 -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="unit_kerja">PILIH UNIT KERJA</label>
                                                    <select class="form-select" id="unit_kerja" name="unit_kerja" required>
                                                        <option value=""></option>
                                                        <?php foreach ($unitKerjaData as $unitKerja) : ?>
                                                            <option value="<?= $unitKerja['id']; ?>"><?= $unitKerja['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih unit kerja.</div>
                                                </div>
                                            </div>
                                            <!-- ini pake select2 -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="divisi">PILIH DIVISI</label>
                                                    <select class="form-select" id="divisi" name="divisi" required>
                                                        <option value=""></option>
                                                        <?php foreach ($divisiData as $divisi) : ?>
                                                            <option value="<?= $divisi['id']; ?>"><?= $divisi['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih divisi.</div>
                                                </div>
                                            </div>
                                            <!-- ini pake select2 -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="jabatan">PILIH JABATAN</label>
                                                    <select class="form-select" id="jabatan" name="jabatan" required>
                                                        <option value=""></option>
                                                        <?php foreach ($jabatanData as $jabatan) : ?>
                                                            <option value="<?= $jabatan['id']; ?>"><?= $jabatan['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih jabatan.</div>
                                                </div>
                                            </div>
                                            <!-- ini pake select2 -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="grade">PILIH GRADE</label>
                                                    <select class="form-select" id="grade" name="grade" required>
                                                        <option value=""></option>
                                                        <?php foreach ($gradeData as $grade) : ?>
                                                            <option value="<?= $grade['id']; ?>"><?= $grade['kategori']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih grade.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status_kontrak">PILIH STATUS KONTRAK</label>
                                                    <select class="form-select" id="status_kontrak" name="status_kontrak" required>
                                                        <option value=""></option>
                                                        <?php foreach ($statusKontrakData as $statusKontrak) : ?>
                                                            <option value="<?= $statusKontrak['id']; ?>"><?= $statusKontrak['status']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih status kontrak.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="tanggal_masuk">TANGGAL MASUK</label>
                                                <input type="date" class="form-control" id="tanggal_masuk" placeholder="Tanggal Masuk" name="tanggal_masuk" required>
                                                <div class="invalid-feedback">Silakan pilih tanggal masuk.</div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status_pernikahan">PILIH STATUS PERNIKAHAN</label>
                                                    <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                                                        <option value=""></option>
                                                        <?php foreach ($statusPernikahanData as $statusPernikahan) : ?>
                                                            <option value="<?= $statusPernikahan['id']; ?>"><?= $statusPernikahan['status']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih status pernikahan.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="jml_tanggungan">JUMLAH TANGGUNGAN</label>
                                                    <input type="number" class="form-control <?= isset($validation) && $validation->hasError('jml_tanggungan') ? 'is-invalid' : '' ?>" id="jml_tanggungan" placeholder="Jumlah Tanggungan" value="<?= old('jml_tanggungan') ?>" name="jml_tanggungan" required min="0">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('jml_tanggungan') ? $validation->getError('jml_tanggungan') : 'Masukkan jumlah tanggungan yang dimiliki.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email_kantor">EMAIL KANTOR</label>
                                                    <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email_kantor') ? 'is-invalid' : '' ?>" id="email_kantor" placeholder="Email Kantor" value="<?= old('email_kantor') ?>" name="email_kantor" required>
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('email_kantor') ? $validation->getError('email_kantor') : 'Masukkan email kantor dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email_pribadi">EMAIL PRIBADI</label>
                                                    <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email_pribadi') ? 'is-invalid' : '' ?>" id="email_pribadi" placeholder="Email Pribadi" value="<?= old('email_pribadi') ?>" name="email_pribadi" required>
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('email_pribadi') ? $validation->getError('email_pribadi') : 'Masukkan email pribadi dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_telp">NOMOR TELEPON</label>
                                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('no_telp') ? 'is-invalid' : '' ?>" id="no_telp" placeholder="Nomor Telepon" value="<?= old('no_telp') ?>" name="no_telp" required maxlength="15" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('no_telp') ? $validation->getError('no_telp') : 'Masukkan nomor telepon dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_rek">NOMOR REKENING</label>
                                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('no_rek') ? 'is-invalid' : '' ?>" id="no_rek" placeholder="Nomor Rekening" value="<?= old('no_rek') ?>" name="no_rek" required maxlength="15" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('no_rek') ? $validation->getError('no_rek') : 'Masukkan nomor rekening dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="pas_foto">PAS FOTO</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control  <?= isset($validation) && $validation->hasError('pas_foto') ? 'is-invalid' : '' ?>" id="pas_foto" name="pas_foto" required>
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation) && $validation->hasError('pas_foto') ? $validation->getError('pas_foto') : 'Pas Foto diperlukan.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="file_ktp">KTP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation) && $validation->hasError('file_ktp') ? 'is-invalid' : '' ?>" id="file_ktp" name="file_ktp" required>
                                                    <div class="invalid-feedback"><?= isset($validation) && $validation->hasError('file_ktp') ? $validation->getError('file_ktp') : 'File KTP diperlukan.' ?></div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_kjp">KJP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation) && $validation->hasError('file_kjp') ? 'is-invalid' : '' ?>" id="file_kjp" name="file_kjp" required>
                                                    <div class="invalid-feedback"><?= isset($validation) && $validation->hasError('file_kjp') ? $validation->getError('file_kjp') : 'File KJP diperlukan.' ?></div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_npwp">NPWP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation) && $validation->hasError('file_npwp') ? 'is-invalid' : '' ?>" id="file_npwp" name="file_npwp" required>
                                                    <div class="invalid-feedback"><?= isset($validation) && $validation->hasError('file_npwp') ? $validation->getError('file_npwp') : 'File NPWP diperlukan.' ?></div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_kk">KARTU KELUARGA</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation) && $validation->hasError('file_kk') ? 'is-invalid' : '' ?>" id="file_kk" name="file_kk" required>
                                                    <div class="invalid-feedback"><?= isset($validation) && $validation->hasError('file_kk') ? $validation->getError('file_kk') : 'File KK diperlukan.' ?></div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_pendidikan">PENDIDIKAN TERAKHIR</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation) && $validation->hasError('file_pendidikan') ? 'is-invalid' : '' ?>" id="file_pendidikan" name="file_pendidikan" required>
                                                    <div class="invalid-feedback"><?= isset($validation) && $validation->hasError('file_pendidikan') ? $validation->getError('file_pendidikan') : 'File ijazah pendidikan terakhir diperlukan.' ?></div>
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
                        <p>Berikut adalah data karyawan PT. Nusantara Global Inovasi:</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Divisi</th>
                                    <th scope="col">Jabatan</th>
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
        $('#provinsi').select2({
            placeholder: "Pilih Provinsi",
            theme: "bootstrap-5",
        });
        $('#kota').select2({
            placeholder: "Pilih Kab/Kota",
            theme: "bootstrap-5",
            ajax: {
                url: "<?= site_url('data-karyawan/ajaxKota') ?>",
                type: "POST",
                dataType: 'json',
                delay: 250,
                data: function(data) {
                    return {
                        kode_prov: $('#provinsi').val(),
                        searchTerm: data.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.data, // Sesuai dengan "data" yang dikembalikan.
                    };
                },
                cache: true
            }
        });
        $('#unit_kerja').select2({
            placeholder: "Pilih Unit Kerja",
            theme: "bootstrap-5",
        });
        $('#divisi').select2({
            placeholder: "Pilih Divisi",
            theme: "bootstrap-5",
        });
        $('#jenis_kelamin').select2({
            placeholder: "Pilih Jenis Kelamin",
            theme: "bootstrap-5",
        });
        $('#jabatan').select2({
            placeholder: "Pilih Jabatan",
            theme: "bootstrap-5",
        });
        $('#grade').select2({
            placeholder: "Pilih Grade",
            theme: "bootstrap-5",
        });
        $('#status_kontrak').select2({
            placeholder: "Pilih Status Kontrak",
            theme: "bootstrap-5",
        });
        $('#status_pernikahan').select2({
            placeholder: "Pilih Status Pernikahan",
            theme: "bootstrap-5",
        });
        $('#tempat_lahir').select2({
            placeholder: "Pilih Tempat Lahir",
            theme: "bootstrap-5",
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

</body>

</html>