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
                        <button class="tab-button active w-50" data-tab="form-tab">Form</button>
                        <button class="tab-button w-50" data-tab="data-tab">Data</button>
                    </div>

                    <!-- Tabs Content -->
                    <div>
                        <!-- Form Tab -->
                        <div id="form-tab" class="tab-content active">
                            <?php if (isset($pesanSukses)) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $pesanSukses; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($pesanError)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $pesanError; ?>
                                </div>
                            <?php endif; ?>
                            <h4>Form</h4>
                            <p>Isi form untuk data karyawan baru di sini:</p>

                            <div class="card">
                                <div class="card-body p-4">
                                    <form class="needs-validation formtambahkaryawan" novalidate action="/data-karyawan/tambah" method="post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="nama">NAMA</label>
                                                    <input type="text" class="form-control <?= isset($validation['nama']) ? 'is-invalid' : '' ?> " id="nama" placeholder="Nama Lengkap Karyawan" name="nama" value="<?= old('nama') ?>" required pattern="[A-Za-z\s]+" maxlength="255">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['nama']) ? $validation['nama'] : 'Masukkan nama lengkap dengan benar.' ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="nip">NIP</label>
                                                    <input type="text" class="form-control <?= isset($validation['nip']) ? 'is-invalid' : '' ?>" id="nip" placeholder="NIP" name="nip" value="<?= old('nip') ?>" required minlength="9" maxlength="18" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['nip']) ? $validation['nip'] : 'Masukkan NIP dengan benar.' ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="npwp">NPWP</label>
                                                    <input type="text" class="form-control <?= isset($validation['npwp']) ? 'is-invalid' : '' ?>" id="npwp" placeholder="NPWP" name="npwp" value="<?= old('npwp') ?>" required minlength="15" maxlength="16" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['npwp']) ? $validation['npwp'] : 'Masukkan NPWP dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">USERNAME</label>
                                                    <input type="text" class="form-control <?= isset($validation['username']) ? 'is-invalid' : '' ?>" id="username" placeholder="Username" value="<?= old('username') ?>" name="username" required maxlength="30" pattern="[a-zA-Z0-9]+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['username']) ? $validation['username'] : 'Masukkan username dengan benar.' ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="nik">NIK</label>
                                                    <input type="text" class="form-control <?= isset($validation['nik'])  ? 'is-invalid' : '' ?>" id="nik" placeholder="NIK" name="nik" value="<?= old('nik') ?>" required minlength="16" maxlength="16" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['nik']) ? $validation['nik'] : 'Masukkan NIK dengan benar.' ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_bpjs">KJP (NOMOR BPJS)</label>
                                                    <input type="text" class="form-control <?= isset($validation['no_bpjs']) ? 'is-invalid' : '' ?>" id="no_bpjs" placeholder="KJP (Nomor BPJS)" value="<?= old('no_bpjs') ?>" name="no_bpjs" required minlength="12" maxlength="13" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['no_bpjs']) ? $validation['no_bpjs'] : 'Masukkan nomor BPJS dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="tempat_lahir">TEMPAT LAHIR</label>
                                                <select class="form-select select2" id="tempat_lahir" value="<?= old('kota') ?>" name="tempat_lahir" required>
                                                    <option value=""></option>
                                                    <?php foreach ($kotaData as $kota) : ?>
                                                        <option value="<?= $kota['nama']; ?>"><?= $kota['nama']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">Silakan pilih tempat lahir.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="tanggal_lahir">TANGGAL LAHIR</label>
                                                <input type="date" class="form-control" id="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                                                <div class="invalid-feedback">Silakan pilih tanggal lahir.</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="jenis_kelamin">JENIS KELAMIN</label>
                                                <select class="form-select select2" name="jenis_kelamin" id="jenis_kelamin" value="<?= old('jenis_kelamin') ?>" required>
                                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                </select>
                                                <div class="invalid-feedback">Silakan pilih jenis kelamin.</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_ktp">ALAMAT SESUAI KTP</label>
                                                <textarea class="form-control <?= isset($validation['alamat_ktp']) ? 'is-invalid' : '' ?>" id="alamat_ktp" placeholder="Alamat Sesuai KTP" name="alamat_ktp" required maxlength="255"><?= old('alamat_ktp') ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= isset($validation['alamat_ktp']) ? $validation['alamat_ktp'] : 'Masukkan alamat dengan benar.' ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_domisili">ALAMAT DOMISILI</label>
                                                <textarea class="form-control <?= isset($validation['alamat_domisili']) ? 'is-invalid' : '' ?>" id="alamat_domisili" placeholder="Alamat Domisili" name="alamat_domisili" required><?= old('alamat_domisili') ?></textarea>
                                                <input type="checkbox" id="alamat_domisili_checkbox" name="alamat_domisili_checkbox" value="" <?= old('alamat_domisili_checkbox') ? 'checked' : '' ?>>
                                                <label for="alamat_domisili_checkbox">Sama seperti alamat KTP</label><br>
                                                <div class="invalid-feedback">
                                                    <?= isset($validation['alamat_domisili']) ? $validation['alamat_domisili']  : 'Masukkan alamat dengan benar.' ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="alamat_korespondensi">ALAMAT KORESPONDENSI</label>
                                                <textarea class="form-control <?= isset($validation['alamat_korespondensi']) ? 'is-invalid' : '' ?>" id="alamat_korespondensi" placeholder="Alamat Korespondensi" name="alamat_korespondensi" required><?= old('alamat_korespondensi') ?></textarea>
                                                <input type="checkbox" id="alamat_korespondensi_checkbox" name="alamat_korespondensi_checkbox" value="" <?= old('alamat_korespondensi_checkbox') ? 'checked' : '' ?>>
                                                <label for="alamat_korespondensi_checkbox">Sama seperti alamat domisili</label><br>
                                                <div class="invalid-feedback">
                                                    <?= isset($validation['alamat_korespondensi']) ? $validation['alamat_korespondensi']  : 'Masukkan alamat dengan benar.' ?>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="provinsi">PILIH PROVINSI DOMISILI</label>
                                                    <select class="form-select select2" id="provinsi" name="provinsi" required>
                                                        <option value=""></option>
                                                        <?php foreach ($provinsiData as $provinsi) : ?>
                                                            <option value="<?= $provinsi['kode']; ?>" <?= old('provinsi') == $provinsi['kode'] ? 'selected' : '' ?>><?= $provinsi['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih provinsi domisili.</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="kota">PILIH KAB/KOTA DOMISILI</label>
                                                    <select class="form-select select2" id="kota" name="kota" required>
                                                        <option value=""></option>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih kab/kota domisili.</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="unit_kerja">PILIH UNIT KERJA</label>
                                                    <select class="form-select select2" id="unit_kerja" name="unit_kerja" value="<?= old('unit_kerja') ?>" required>
                                                        <option value=""></option>
                                                        <?php foreach ($unitKerjaData as $unitKerja) : ?>
                                                            <option value="<?= $unitKerja['id']; ?>" <?= old('unit_kerja') == $unitKerja['id'] ? 'selected' : '' ?>><?= $unitKerja['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih unit kerja.</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="divisi">PILIH DIVISI</label>
                                                    <select class="form-select select2" id="divisi" name="divisi" value="<?= old('divisi') ?>" required>
                                                        <option value=""></option>
                                                        <?php foreach ($divisiData as $divisi) : ?>
                                                            <option value="<?= $divisi['id']; ?>" <?= old('divisi') == $divisi['id'] ? 'selected' : '' ?>><?= $divisi['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih divisi.</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="jabatan">PILIH JABATAN</label>
                                                    <select class="form-select select2" id="jabatan" name="jabatan" value="<?= old('jabatan') ?>" required>
                                                        <option value=""></option>
                                                        <?php foreach ($jabatanData as $jabatan) : ?>
                                                            <option value="<?= $jabatan['id']; ?>" <?= old('jabatan') == $jabatan['id'] ? 'selected' : '' ?>><?= $jabatan['nama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih jabatan.</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="grade">PILIH GRADE</label>
                                                    <select class="form-select select2" id="grade" name="grade" value="<?= old('grade') ?>" required>
                                                        <option value=""></option>
                                                        <?php foreach ($gradeData as $grade) : ?>
                                                            <option value="<?= $grade['id']; ?>" <?= old('grade') == $grade['id'] ? 'selected' : '' ?>><?= $grade['kategori']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih grade.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status_kontrak">PILIH STATUS KONTRAK</label>
                                                    <select class="form-select select2" id="status_kontrak" name="status_kontrak" value="<?= old('status_kontrak') ?>" required>
                                                        <option value=""></option>
                                                        <?php foreach ($statusKontrakData as $statusKontrak) : ?>
                                                            <option value="<?= $statusKontrak['id']; ?>" <?= old('status_kontrak') == $statusKontrak['id'] ? 'selected' : '' ?>><?= $statusKontrak['status']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih status kontrak.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="tanggal_masuk">TANGGAL MASUK</label>
                                                <input type="date" class="form-control" id="tanggal_masuk" placeholder="Tanggal Masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk') ?>" required>
                                                <div class="invalid-feedback">Silakan pilih tanggal masuk.</div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status_pernikahan">PILIH STATUS PERNIKAHAN</label>
                                                    <select class="form-select select2" id="status_pernikahan" name="status_pernikahan" value="<?= old('status_pernikahan') ?>" required>
                                                        <option value=""></option>
                                                        <?php foreach ($statusPernikahanData as $statusPernikahan) : ?>
                                                            <option value="<?= $statusPernikahan['id']; ?>" <?= old('status_pernikahan') == $statusPernikahan['id'] ? 'selected' : '' ?>><?= $statusPernikahan['status']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Silakan pilih status pernikahan.</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="jml_tanggungan">JUMLAH TANGGUNGAN</label>
                                                    <input type="number" class="form-control <?= isset($validation['jml_tanggungan']) ? 'is-invalid' : '' ?>" id="jml_tanggungan" placeholder="Jumlah Tanggungan" value="<?= old('jml_tanggungan') ?>" name="jml_tanggungan" required min="0">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['jml_tanggungan']) ? $validation['jml_tanggungan'] : 'Masukkan jumlah tanggungan yang dimiliki.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email_kantor">EMAIL KANTOR</label>
                                                    <input type="email" class="form-control <?= isset($validation['email_kantor']) ? 'is-invalid' : '' ?>" id="email_kantor" placeholder="Email Kantor" value="<?= old('email_kantor') ?>" name="email_kantor" required>
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['email_kantor']) ? $validation['email_kantor'] : 'Masukkan email kantor dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email_pribadi">EMAIL PRIBADI</label>
                                                    <input type="email" class="form-control <?= isset($validation['email_pribadi']) ? 'is-invalid' : '' ?>" id="email_pribadi" placeholder="Email Pribadi" value="<?= old('email_pribadi') ?>" name="email_pribadi" required>
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['email_pribadi']) ? $validation['email_pribadi'] : 'Masukkan email pribadi dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_telp">NOMOR TELEPON</label>
                                                    <input type="text" class="form-control <?= isset($validation['no_telp']) ? 'is-invalid' : '' ?>" id="no_telp" placeholder="Nomor Telepon" value="<?= old('no_telp') ?>" name="no_telp" required maxlength="15" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['no_telp']) ? $validation['no_telp']  : 'Masukkan nomor telepon dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_rek">NOMOR REKENING</label>
                                                    <input type="text" class="form-control <?= isset($validation['no_rek'])  ? 'is-invalid' : '' ?>" id="no_rek" placeholder="Nomor Rekening" value="<?= old('no_rek') ?>" name="no_rek" required maxlength="15" pattern="\d+">
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['no_rek']) ? $validation['no_rek'] : 'Masukkan nomor rekening dengan benar.' ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="pas_foto">PAS FOTO</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control  <?= isset($validation['pas_foto']) ? 'is-invalid' : '' ?>" id="pas_foto" name="pas_foto" required>
                                                    <div class="invalid-feedback">
                                                        <?= isset($validation['pas_foto']) ? $validation['pas_foto']  : 'Pas Foto diperlukan.' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="file_ktp">KTP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation['file_ktp']) ? 'is-invalid' : '' ?>" id="file_ktp" name="file_ktp" required>
                                                    <div class="invalid-feedback"><?= isset($validation['file_ktp']) ? $validation['file_ktp']  : 'File KTP diperlukan.' ?></div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_kjp">KJP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation['file_kjp']) ? 'is-invalid' : '' ?>" id="file_kjp" name="file_kjp" required>
                                                    <div class="invalid-feedback"><?= isset($validation['file_kjp']) ? $validation['file_kjp'] : 'File KJP diperlukan.' ?></div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_npwp">NPWP</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation['file_npwp']) ? 'is-invalid' : '' ?>" id="file_npwp" name="file_npwp" required>
                                                    <div class="invalid-feedback"><?= isset($validation['file_npwp']) ? $validation['file_npwp'] : 'File NPWP diperlukan.' ?></div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_kk">KARTU KELUARGA</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation['file_kk']) ? 'is-invalid' : '' ?>" id="file_kk" name="file_kk" required>
                                                    <div class="invalid-feedback"><?= isset($validation['file_kk']) ? $validation['file_kk']  : 'File KK diperlukan.' ?></div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="file_pendidikan">PENDIDIKAN TERAKHIR</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control <?= isset($validation['file_pendidikan']) ? 'is-invalid' : '' ?>" id="file_pendidikan" name="file_pendidikan" required>
                                                    <div class="invalid-feedback"><?= isset($validation['file_pendidikan']) ? $validation['file_pendidikan'] : 'File ijazah pendidikan terakhir diperlukan.' ?></div>
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
                        <table class="table table-striped" id="datatable">
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
                                <?php if (!empty($karyawans) && is_array($karyawans)) : ?>
                                    <?php foreach ($karyawans as $index => $karyawan) : ?>
                                        <tr>
                                            <th scope="row"><?= $index + 1 ?></th>
                                            <td><?= esc($karyawan['nama']) ?></td>
                                            <td><?= esc($karyawan['user_email']) ?></td>
                                            <td><?= esc($karyawan['divisi']) ?></td>
                                            <td><?= esc($karyawan['jabatan']) ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" title="Edit" onclick="window.location.href='/edit-data-karyawan'">
                                                    <i class="mdi mdi-file-document-edit-outline"></i> Edit
                                                </button>
                                                <button
                                                    class="btn btn-danger btn-sm delete-karyawan"
                                                    data-id="<?= esc($karyawan['id']) ?>"
                                                    title="Hapus">
                                                    <i class="mdi mdi-delete-forever-outline"></i> Hapus
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm btn-details-karyawan" data-id-karyawan="1" data-bs-toggle="modal" data-bs-target="#karyawanModal">
                                                    <i class="dripicons-preview"></i> Detail
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade bs-example-modal-center" id="karyawanModal" tabindex="-1" role="dialog" aria-labelledby="karyawanModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="karyawanModalLabel">Detail Karyawan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="nama">NAMA</label>
                                                                            <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap Karyawan" name="nama" value="<?= isset($karyawans['nama']) ? $karyawans['nama'] : ''; ?>" readonly>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="nip">NIP</label>
                                                                            <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" value="<?= isset($karyawans['nip']) ? $karyawans['nip'] : ''; ?>" readonly>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="npwp">NPWP</label>
                                                                            <input type="text" class="form-control" id="npwp" placeholder="NPWP" name="npwp" value="<?= isset($karyawans['npwp']) ? $karyawans['npwp'] : ''; ?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="username">USERNAME</label>
                                                                            <input type="text" class="form-control" id="username" placeholder="Username" value="<?= isset($karyawans['username']) ? $karyawans['username'] : ''; ?>" name="username" readonly maxlength="30" pattern="[a-zA-Z0-9]+">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="nik">NIK</label>
                                                                            <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik" value="<?= isset($karyawans['nik']) ? $karyawans['nik'] : ''; ?>" readonly minlength="16" maxlength="16" pattern="\d+">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="no_bpjs">KJP (NOMOR BPJS)</label>
                                                                            <input type="text" class="form-control" id="no_bpjs" placeholder="KJP (Nomor BPJS)" value="<?= isset($karyawans['no_bpjs']) ? $karyawans['no_bpjs'] : ''; ?>" name="no_bpjs" readonly minlength="12" maxlength="13" pattern="\d+">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4 mb-3">
                                                                        <label class="form-label" for="tempat_lahir">TEMPAT LAHIR</label>
                                                                        <select class="form-select select2" id="tempat_lahir" name="tempat_lahir" disabled>
                                                                            <option value="<?= isset($karyawans['tempat_lahir']) ? $karyawans['tempat_lahir'] : ''; ?>" selected>
                                                                                <?= isset($karyawans['tempat_lahir']) ? $karyawans['tempat_lahir'] : ''; ?>
                                                                            </option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-4 mb-3">
                                                                        <label class="form-label" for="tanggal_lahir">TANGGAL LAHIR</label>
                                                                        <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" name="tanggal_lahir" value="<?= isset($karyawans['tanggal_lahir']) ? $karyawans['tanggal_lahir'] : ''; ?>" readonly>
                                                                    </div>

                                                                    <div class="col-md-4 mb-3">
                                                                        <label class="form-label" for="jenis_kelamin">JENIS KELAMIN</label>
                                                                        <select class="form-select select2" name="jenis_kelamin" id="jenis_kelamin" disabled>
                                                                            <option value="<?= isset($karyawans['jenis_kelamin']) ? $karyawans['jenis_kelamin'] : ''; ?>" selected>
                                                                                <?= isset($karyawans['jenis_kelamin']) ? $karyawans['jenis_kelamin'] : ''; ?>
                                                                            </option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-4 mb-3">
                                                                        <label class="form-label" for="alamat_ktp">ALAMAT SESUAI KTP</label>
                                                                        <textarea class="form-control" id="alamat_ktp" placeholder="Alamat Sesuai KTP" name="alamat_ktp" readonly>
                                                                            <?= isset($karyawans['alamat_ktp']) ? $karyawans['alamat_ktp'] : ''; ?>
                                                                        </textarea>
                                                                    </div>

                                                                    <div class="col-md-4 mb-3">
                                                                        <label class="form-label" for="alamat_domisili">ALAMAT DOMISILI</label>
                                                                        <textarea class="form-control" id="alamat_domisili" placeholder="Alamat Domisili" name="alamat_domisili" readonly>
                                                                            <?= isset($karyawans['alamat_domisili']) ? $karyawans['alamat_domisili'] : ''; ?>
                                                                        </textarea>
                                                                    </div>

                                                                    <div class="col-md-4 mb-3">
                                                                        <label class="form-label" for="alamat_korespondensi">ALAMAT KORESPONDENSI</label>
                                                                        <textarea class="form-control" id="alamat_korespondensi" placeholder="Alamat Korespondensi" name="alamat_korespondensi" readonly>
                                                                            <?= isset($karyawans['alamat_korespondensi']) ? $karyawans['alamat_korespondensi'] : ''; ?>
                                                                        </textarea>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="provinsi">PILIH PROVINSI DOMISILI</label>
                                                                            <select class="form-select select2" id="provinsi" name="provinsi" disabled>
                                                                                <option value="<?= isset($karyawans['provinsi']) ? $karyawans['provinsi'] : ''; ?>" selected>
                                                                                    <?= isset($karyawans['provinsi']) ? $karyawans['provinsi'] : ''; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="kota">PILIH KAB/KOTA DOMISILI</label>
                                                                            <select class="form-select select2" id="kota" name="kota" disabled>
                                                                                <option value="<?= isset($karyawans['kota']) ? $karyawans['kota'] : ''; ?>" selected>
                                                                                    <?= isset($karyawans['kota']) ? $karyawans['kota'] : ''; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="unit_kerja">PILIH UNIT KERJA</label>
                                                                            <select class="form-select select2" id="unit_kerja" name="unit_kerja" disabled>
                                                                                <option value="<?= isset($karyawans['unit_kerja']) ? $karyawans['unit_kerja'] : ''; ?>" selected>
                                                                                    <?= isset($karyawans['unit_kerja']) ? $karyawans['unit_kerja'] : ''; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="divisi">PILIH DIVISI</label>
                                                                            <select class="form-select select2" id="divisi" name="divisi" disabled>
                                                                                <option value="<?= isset($karyawans['divisi']) ? $karyawans['divisi'] : ''; ?>" selected>
                                                                                    <?= isset($karyawans['divisi']) ? $karyawans['divisi'] : ''; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="jabatan">PILIH JABATAN</label>
                                                                            <select class="form-select select2" id="jabatan" name="jabatan" disabled>
                                                                                <option value="<?= isset($karyawans['jabatan']) ? $karyawans['jabatan'] : ''; ?>" selected>
                                                                                    <?= isset($karyawans['jabatan']) ? $karyawans['jabatan'] : ''; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="grade">PILIH GRADE</label>
                                                                            <select class="form-select select2" id="grade" name="grade" disabled>
                                                                                <option value="<?= isset($karyawans['grade']) ? $karyawans['grade'] : ''; ?>" selected>
                                                                                    <?= isset($karyawans['grade']) ? $karyawans['grade'] : ''; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="status_kontrak">PILIH STATUS KONTRAK</label>
                                                                            <select class="form-select select2" id="status_kontrak" name="status_kontrak" disabled>
                                                                                <option value="<?= isset($karyawans['status_kontrak']) ? $karyawans['status_kontrak'] : ''; ?>" selected>
                                                                                    <?= isset($karyawans['status_kontrak']) ? $karyawans['status_kontrak'] : ''; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4 mb-3">
                                                                        <label class="form-label" for="tanggal_masuk">TANGGAL MASUK</label>
                                                                        <input type="date" class="form-control" id="tanggal_masuk" placeholder="Tanggal Masuk" name="tanggal_masuk" value="<?= isset($karyawans['tanggal_masuk']) ? $karyawans['tanggal_masuk'] : ''; ?>" readonly>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="status_pernikahan">PILIH STATUS PERNIKAHAN</label>
                                                                            <select class="form-select select2" id="status_pernikahan" name="status_pernikahan" disabled>
                                                                                <option value="<?= isset($karyawans['status_pernikahan']) ? $karyawans['status_pernikahan'] : ''; ?>" selected>
                                                                                    <?= isset($karyawans['status_pernikahan']) ? $karyawans['status_pernikahan'] : ''; ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="jml_tanggungan">JUMLAH TANGGUNGAN</label>
                                                                            <input type="number" class="form-control" id="jml_tanggungan" placeholder="Jumlah Tanggungan" value="<?= isset($karyawans['jml_tanggungan']) ? $karyawans['jml_tanggungan'] : ''; ?>" name="jml_tanggungan" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="email_kantor">EMAIL KANTOR</label>
                                                                            <input type="email" class="form-control" id="email_kantor" placeholder="Email Kantor" value="<?= isset($karyawans['email_kantor']) ? $karyawans['email_kantor'] : ''; ?>" name="email_kantor" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="email_pribadi">EMAIL PRIBADI</label>
                                                                            <input type="email" class="form-control" id="email_pribadi" placeholder="Email Pribadi" value="<?= isset($karyawans['email_pribadi']) ? $karyawans['email_pribadi'] : ''; ?>" name="email_pribadi" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="no_telp">NOMOR TELEPON</label>
                                                                            <input type="text" class="form-control" id="no_telp" placeholder="Nomor Telepon" value="<?= isset($karyawans['no_telp']) ? $karyawans['no_telp'] : ''; ?>" name="no_telp" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="no_rek">NOMOR REKENING</label>
                                                                            <input type="text" class="form-control" id="no_rek" placeholder="Nomor Rekening" value="<?= isset($karyawans['no_rek']) ? $karyawans['no_rek'] : ''; ?>" name="no_rek" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="pas_foto">PAS FOTO</label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control" id="pas_foto" name="pas_foto" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="file_ktp">KTP</label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control" id="file_ktp" name="file_ktp" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="file_kjp">KJP</label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control" id="file_kjp" name="file_kjp" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="file_npwp">NPWP</label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control" id="file_npwp" name="file_npwp" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="file_kk">KARTU KELUARGA</label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control" id="file_kk" name="file_kk" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="file_pendidikan">PENDIDIKAN TERAKHIR</label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control" id="file_pendidikan" name="file_pendidikan" readonly>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
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
    <script>
        new DataTable('#data-karyawan');
    </script>


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
        $('button[type="reset"]').click(function() {
            // Reset semua Select2
            $('.select2').val(null).trigger('change');
        });
    </script>

    <!-- javascript untuk swal ketika delete karyawan -->
    <script>
        $(document).ready(function() {
            $('.delete-karyawan').click(function(e) {
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
    </script>

    <!-- javascript untuk menampilkan detail karyawan -->
    <script>
        $('.btn-details-karyawan').on('click', function() {
            const idKaryawan = $(this).data('id-karyawan');

            $.ajax({
                url: `/data-karyawan/details/${idKaryawan}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const data = response.data;
                        $('#nama').val(data.nama);
                        $('#nip').val(data.nip);
                        $('#npwp').val(data.npwp);
                        $('#tempatLahir').val(data.tempat_lahir);
                        $('#tanggalLahir').val(data.tanggal_lahir);
                        $('#divisi').val(data.divisi_id).trigger('change'); // Memicu ulang select2
                        $('#jabatan').val(data.jabatan_id).trigger('change');
                        $('#status_kontrak').val(data.status_kontrak_id).trigger('change');
                        $('#status_pernikahan').val(data.status_pernikahan_id).trigger('change');
                        $('#jml_tanggungan').val(data.jml_tanggungan);
                        $('#email_kantor').val(data.email_kantor);
                        $('#email_pribadi').val(data.email_pribadi);
                        $('#no_telp').val(data.no_telp);
                        $('#no_rek').val(data.no_rek);
                        $('#pas_foto').val(data.pas_foto);
                        $('#file_ktp').val(data.file_ktp);
                        $('#file_kjp').val(data.file_kjp);
                        $('#file_npwp').val(data.file_npwp);
                        $('#file_kk').val(data.file_kk);
                        $('#file_pendidikan').val(data.file_pendidikan);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data.');
                }
            });
        });
    </script>

    <!-- javascript untuk mengatur checkbox alamat -->
    <script>
        $(document).ready(function() {
            $('#alamat_domisili_checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#alamat_domisili').val($('#alamat_ktp').val());
                    $('#alamat_domisili').prop('readonly', true);
                } else {
                    $('#alamat_domisili').val('');
                    $('#alamat_domisili').prop('readonly', false);
                }
            });
            $('#alamat_korespondensi_checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#alamat_korespondensi').val($('#alamat_domisili').val());
                    $('#alamat_korespondensi').prop('readonly', true);
                } else {
                    $('#alamat_korespondensi').val('');
                    $('#alamat_korespondensi').prop('readonly', false);
                }
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

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <!-- form validation -->
    <script src="assets/js/pages/form-validation.init.js"></script>

</body>

</html>