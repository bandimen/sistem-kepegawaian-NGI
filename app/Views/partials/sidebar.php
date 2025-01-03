<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"><?= 'Menu' ?></li>

                <li>
                    <a href="/">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?= 'Dashboard' ?></span>
                    </a>
                </li>


                <li>
                    <a href="<?= base_url('data-karyawan') ?>">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication"><?= 'Data Karyawan' ?></span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables"><?= 'Administrator' ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manajemen-user" data-key="t-manajemen-user"><?= 'Manajemen User' ?></a></li>
                        <li><a href="manajemen-jenisuser" data-key="t-manajemen-jenisuser"><?= 'Manajemen Jenis User' ?></a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span class="badge rounded-pill bg-soft-danger text-danger float-end"></span>
                        <span data-key="t-forms"><?= lang('Form Pengajuan') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= base_url('form-lembur') ?>" data-key="t-form-lembur"><?= lang('Form Lembur') ?></a></li>
                        <li><a href="<?= base_url('form-cuti') ?>" data-key="t-form-cuti"><?= lang('Form Cuti') ?></a></li>
                        <li><a href="<?= base_url('form-dinas-luar') ?>" data-key="t-form-dinas-luar"><?= lang('Form Dinas Luar') ?></a></li>
                        <li><a href="<?= base_url('form-peminjaman-karyawan') ?>" data-key="t-form-peminjaman-karyawan"><?= lang('Form Peminjaman Karyawan') ?></a></li>
                        <li><a href="<?= base_url('form-slip-gaji') ?>" data-key="t-form-slip-gaji"><?= lang('Form Slip Gaji') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables"><?= 'Manajemen Data' ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manajemen-provinsi" data-key="t-manajemen-provinsi"><?= 'Manajemen Provinsi' ?></a></li>
                        <li><a href="manajemen-kota" data-key="t-manajemen-kota"><?= 'Manajemen Kota' ?></a></li>
                        <li><a href="data-jabatan" data-key="t-data-jabatan"><?= 'Data Jabatan' ?></a></li>
                    </ul>
                </li>


            </ul>

            <!-- <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="assets/images/giftbox.png" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16"><?= lang('Files.Unlimited_Access') ?></h5>
                        <p class="font-size-13"><?= lang("Files.Upgrade_your_plan_from_a_Free_trial,_to_select_‘Business_Plan’") ?>.</p>
                        <a href="#!" class="btn btn-primary mt-2"><?= lang('Files.Upgrade_Now') ?></a>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->