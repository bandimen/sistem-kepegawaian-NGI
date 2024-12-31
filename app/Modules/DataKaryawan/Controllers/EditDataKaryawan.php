<?php

namespace Modules\DataKaryawan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Kota\Models\KotaModel;
use Modules\Karyawan\Models\KaryawanModel;

class EditDataKaryawan extends BaseController
{
  protected $folder_directory = "Modules\\DataKaryawan\\Views\\";

  protected $userModel;
  protected $kotaModel;
  protected $karyawanModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->kotaModel = new KotaModel();
    $this->karyawanModel = new KaryawanModel();
  }

  public function ajaxKotaDropdown()
  {
    $kode_prov = $this->request->getVar('kode_prov');
    // ambil semua kota berdasarkan provinsi yg udah dipilih
    $listKota = $this->kotaModel->where('kode_provinsi', $kode_prov)
      ->where('is_deleted', 0);
    // jika diketikkan sesuatu di pencariannya
    if ($this->request->getVar('searchTerm')) {
      $searchTerm = $this->request->getVar('searchTerm');
      $listKota = $listKota->like('nama', $searchTerm);
    }
    $listKota = $listKota->orderBy('nama')->findAll();
    $data = [];
    foreach ($listKota as $kota) {
      $data[] = [
        'id' => $kota['id'],
        'text' => $kota['nama'],
      ];
    }
    $response['data'] = $data;
    return $this->response->setJSON($response);
  }

  public function edit()
  {
    // entitas yang login
    $sesi = session()->get();
    $userData = $this->userModel->where('id', $sesi['user_id'])->first();

    // Validasi input
    if (!$this->validate([
      'nama' => [
        'rules' => 'required|alpha_space|max_length[255]',
        'errors' => [
          'required' => 'Nama tidak boleh kosong.',
          'alpha_space' => 'Nama hanya boleh mengandung huruf dan spasi.',
          'max_length' => 'Nama tidak boleh lebih dari 255 karakter.',
        ],
      ],
      'nip' => [
        'rules' => 'required|numeric|max_length[18]|is_unique[karyawan.nip]',
        'errors' => [
          'required' => 'NIP tidak boleh kosong.',
          'numeric' => 'NIP hanya boleh berupa angka.',
          'max_length' => 'NIP tidak boleh lebih dari 18 digit.',
          'is_unique' => 'NIP sudah terdaftar.',
        ],
      ],
      'npwp' => [
        'rules' => 'required|numeric|max_length[16]|is_unique[karyawan.npwp]',
        'errors' => [
          'required' => 'NPWP tidak boleh kosong.',
          'numeric' => 'NPWP hanya boleh berupa angka.',
          'max_length' => 'NPWP tidak boleh lebih dari 16 digit.',
          'is_unique' => 'NPWP sudah terdaftar.',
        ],
      ],
      'username' => [
        'rules' => 'required|alpha_numeric|max_length[30]|is_unique[user.username]',
        'errors' => [
          'required' => 'Username tidak boleh kosong.',
          'alpha_numeric' => 'Username hanya boleh berupa huruf dan angka.',
          'max_length' => 'Username tidak boleh lebih dari 30 karakter.',
          'is_unique' => 'Username sudah terdaftar.',
        ],
      ],
      'nik' => [
        'rules' => 'required|numeric|max_length[16]|is_unique[karyawan.nik]',
        'errors' => [
          'required' => 'NIK tidak boleh kosong.',
          'numeric' => 'NIK hanya boleh berupa angka.',
          'max_length' => 'NIK tidak boleh lebih dari 16 digit.',
          'is_unique' => 'NIK sudah terdaftar.',
        ],
      ],
      'no_bpjs' => [
        'rules' => 'required|numeric|max_length[13]|is_unique[karyawan.no_bpjs]',
        'errors' => [
          'required' => 'Nomor BPJS tidak boleh kosong.',
          'numeric' => 'Nomor BPJS hanya boleh berupa angka.',
          'max_length' => 'Nomor BPJS tidak boleh lebih dari 13 digit.',
          'is_unique' => 'Nomor BPJS sudah terdaftar.',
        ],
      ],
      'tempat_lahir' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Tempat lahir tidak boleh kosong.',
        ],
      ],
      'tanggal_lahir' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Tanggal lahir tidak boleh kosong.',
        ],
      ],
      'jenis_kelamin' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Jenis kelamin tidak boleh kosong.',
        ],
      ],
      'alamat_ktp' => [
        'rules' => 'required|max_length[255]',
        'errors' => [
          'required' => 'Alamat KTP tidak boleh kosong.',
          'max_length' => 'Alamat KTP tidak boleh lebih dari 255 karakter.',
        ],
      ],
      'alamat_domisili' => [
        'rules' => 'required|max_length[255]',
        'errors' => [
          'required' => 'Alamat domisili tidak boleh kosong.',
          'max_length' => 'Alamat domisili tidak boleh lebih dari 255 karakter.',
        ],
      ],
      'alamat_korespondensi' => [
        'rules' => 'required|max_length[255]',
        'errors' => [
          'required' => 'Alamat korespondensi tidak boleh kosong.',
          'max_length' => 'Alamat korespondensi tidak boleh lebih dari 255 karakter.',
        ],
      ],
      'provinsi' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Provinsi tidak boleh kosong.',
        ],
      ],
      'kota' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Kota tidak boleh kosong.',
        ],
      ],
      'unit_kerja' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Unit kerja tidak boleh kosong.',
        ],
      ],
      'jabatan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Jabatan tidak boleh kosong.',
        ],
      ],
      'grade' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Grade tidak boleh kosong.',
        ],
      ],
      'status_kontrak' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Status kontrak tidak boleh kosong.',
        ],
      ],
      'tanggal_masuk' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Tanggal masuk tidak boleh kosong.',
        ],
      ],
      'status_pernikahan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Status pernikahan tidak boleh kosong.',
        ],
      ],
      'jml_tanggungan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Jumlah tanggungan tidak boleh kosong.',
        ],
      ],
      'email_kantor' => [
        'rules' => 'required|valid_email|is_unique[karyawan.email_kantor]',
        'errors' => [
          'required' => 'Email kantor tidak boleh kosong.',
          'valid_email' => 'Email kantor harus berupa alamat email yang valid.',
          'is_unique' => 'Emai kantor sudah terdaftar.',
        ],
      ],
      'email_pribadi' => [
        'rules' => 'required|valid_email|is_unique[karyawan.email_pribadi]',
        'errors' => [
          'required' => 'Email pribadi tidak boleh kosong.',
          'valid_email' => 'Email pribadi harus berupa alamat email yang valid.',
          'is_unique' => 'Emai kantor sudah terdaftar.',
        ],
      ],
      'no_telp' => [
        'rules' => 'required|numeric|max_length[15]|is_unique[karyawan.no_telp]',
        'errors' => [
          'required' => 'Nomor telepon tidak boleh kosong.',
          'numeric' => 'Nomor telepon hanya boleh berupa angka.',
          'max_length' => 'Nomor telepon tidak boleh lebih dari 15 digit.',
          'is_unique' => 'Nomor telepon sudah terdaftar.',
        ],
      ],
      'no_rek' => [
        'rules' => 'required|numeric|max_length[15]|is_unique[karyawan.no_rek]',
        'errors' => [
          'required' => 'Nomor rekening tidak boleh kosong.',
          'numeric' => 'Nomor rekening hanya boleh berupa angka.',
          'max_length' => 'Nomor rekening tidak boleh lebih dari 15 digit.',
          'is_unique' => 'Nomor rekening sudah terdaftar.',
        ],
      ],
      'pas_foto' => [
        'rules' => 'uploaded[pas_foto]|max_size[pas_foto,2048]|mime_in[pas_foto,application/pdf]|ext_in[pas_foto,pdf]',
        'errors' => [
          'uploaded' => 'File pas foto wajib diunggah',
          'max_size' => 'Ukuran file pas foto tidak boleh lebih dari 2MB',
          'mime_in' => 'Hanya file dengan format PDF yang diizinkan',
          'ext_in' => 'Ekstensi file pas foto harus berupa .pdf',
        ],
      ],
      'file_ktp' => [
        'rules' => 'uploaded[file_ktp]|max_size[file_ktp,2048]|mime_in[file_ktp,application/pdf]|ext_in[file_ktp,pdf]',
        'errors' => [
          'uploaded' => 'File KTP wajib diunggah',
          'max_size' => 'Ukuran file KTP tidak boleh lebih dari 2MB',
          'mime_in' => 'Hanya file dengan format PDF yang diizinkan',
          'ext_in' => 'Ekstensi file KTP harus berupa .pdf',
        ],
      ],
      'file_kjp' => [
        'rules' => 'uploaded[file_kjp]|max_size[file_kjp,2048]|mime_in[file_kjp,application/pdf]|ext_in[file_kjp,pdf]',
        'errors' => [
          'uploaded' => 'File KJP wajib diunggah',
          'max_size' => 'Ukuran file KJP tidak boleh lebih dari 2MB',
          'mime_in' => 'Hanya file dengan format PDF yang diizinkan',
          'ext_in' => 'Ekstensi file KJP harus berupa .pdf',
        ],
      ],
      'file_npwp' => [
        'rules' => 'uploaded[file_npwp]|max_size[file_npwp,2048]|mime_in[file_npwp,application/pdf]|ext_in[file_npwp,pdf]',
        'errors' => [
          'uploaded' => 'File NPWP wajib diunggah',
          'max_size' => 'Ukuran file NPWP tidak boleh lebih dari 2MB',
          'mime_in' => 'Hanya file dengan format PDF yang diizinkan',
          'ext_in' => 'Ekstensi file NPWP harus berupa .pdf',
        ],
      ],
      'file_kk' => [
        'rules' => 'uploaded[file_kk]|max_size[file_kk,2048]|mime_in[file_kk,application/pdf]|ext_in[file_kk,pdf]',
        'errors' => [
          'uploaded' => 'File KK wajib diunggah',
          'max_size' => 'Ukuran file KK tidak boleh lebih dari 2MB',
          'mime_in' => 'Hanya file dengan format PDF yang diizinkan',
          'ext_in' => 'Ekstensi file KK harus berupa .pdf',
        ],
      ],
      'file_pendidikan' => [
        'rules' => 'uploaded[file_pendidikan]|max_size[file_pendidikan,2048]|mime_in[file_pendidikan,application/pdf]|ext_in[file_pendidikan,pdf]',
        'errors' => [
          'uploaded' => 'File ijazah pendidikan terakhir wajib diunggah',
          'max_size' => 'Ukuran file ijazah pendidikan terakhir tidak boleh lebih dari 2MB',
          'mime_in' => 'Hanya file dengan format PDF yang diizinkan',
          'ext_in' => 'Ekstensi file ijazah pendidikan terakhir harus berupa .pdf',
        ],
      ],
    ])) {
      return redirect()->to('/edit-data-karyawan')->withInput()->with('validation', $this->validator);
    }

    $nama = $this->request->getVar('nama');
    $nip = $this->request->getVar('nip');
    $npwp = $this->request->getVar('npwp');
    $username = $this->request->getVar('username');
    $nik = $this->request->getVar('nik');
    $no_bpjs = $this->request->getVar('no_bpjs');
    $tempat_lahir = $this->request->getVar('tempat_lahir');
    $tanggal_lahir = $this->request->getVar('tanggal_lahir');
    $jenis_kelamin = $this->request->getVar('jenis_kelamin');
    $alamat_ktp = $this->request->getVar('alamat_ktp');
    $alamat_domisili = $this->request->getVar('alamat_domisili');
    $alamat_korespondensi = $this->request->getVar('alamat_korespondensi');
    $kota = $this->request->getVar('kota');
    $unit_kerja = $this->request->getVar('unit_kerja');
    $divisi = $this->request->getVar('divisi');
    $jabatan = $this->request->getVar('jabatan');
    $grade = $this->request->getVar('grade');
    $status_kontrak = $this->request->getVar('status_kontrak');
    $tanggal_masuk = $this->request->getVar('tanggal_masuk');
    $status_pernikahan = $this->request->getVar('status_pernikahan');
    $jml_tanggungan = $this->request->getVar('jml_tanggungan');
    $email_kantor = $this->request->getVar('email_kantor');
    $email_pribadi = $this->request->getVar('email_pribadi');
    $no_telp = $this->request->getVar('no_telp');
    $no_rek = $this->request->getVar('no_rek');

    $pas_foto = $this->request->getFile('pas_foto');
    $nama_pas_foto = $pas_foto->getRandomName();
    $pas_foto->move(WRITEPATH . '../public/uploads/', $nama_pas_foto);

    $file_ktp = $this->request->getFile('file_ktp');
    $nama_file_ktp = $file_ktp->getRandomName();
    $file_ktp->move(WRITEPATH . '../public/uploads/', $nama_file_ktp);

    $file_bpjs = $this->request->getFile('file_kjp');
    $nama_file_bpjs = $file_bpjs->getRandomName();
    $file_bpjs->move(WRITEPATH . '../public/uploads/', $nama_file_bpjs);

    $file_npwp = $this->request->getFile('file_npwp');
    $nama_file_npwp = $file_npwp->getRandomName();
    $file_npwp->move(WRITEPATH . '../public/uploads/', $nama_file_npwp);

    $file_kk = $this->request->getFile('file_kk');
    $nama_file_kk = $file_kk->getRandomName();
    $file_kk->move(WRITEPATH . '../public/uploads/', $nama_file_kk);

    $file_pendidikan = $this->request->getFile('file_pendidikan');
    $nama_file_pendidikan = $file_pendidikan->getRandomName();
    $file_pendidikan->move(WRITEPATH . '../public/uploads/', $nama_file_pendidikan);

    $this->userModel->update([
      'nama' => $nama,
      'username' => $username,
      'email' => $email_kantor,
      'password' => sha1('ngi123'),
      'divisi_id' => $divisi,
      'created_by' => $userData['nama'],
      'updated_by' => $userData['nama'],
    ]);

    $userId = $this->userModel->updateID();

    $this->karyawanModel->save([
      'nama' => $nama,
      'nip' => $nip,
      'nik' => $nik,
      'npwp' => $npwp,
      'no_bpjs' => $no_bpjs,
      'jenis_kelamin' => $jenis_kelamin,
      'tempat_lahir' => $tempat_lahir,
      'tanggal_lahir' => $tanggal_lahir,
      'email_kantor' => $email_kantor,
      'email_pribadi' => $email_pribadi,
      'alamat_ktp' => $alamat_ktp,
      'alamat_domisili' => $alamat_domisili,
      'alamat_korespondensi' => $alamat_korespondensi,
      'no_telp' => $no_telp,
      'grade_id' => $grade,
      'status_kontrak_id' => $status_kontrak,
      'status_pernikahan_id' => $status_pernikahan,
      'jml_tanggungan' => $jml_tanggungan,
      'no_rek' => $no_rek,
      'kota_id' => $kota,
      'user_id' => $userId,
      'unit_kerja_id' => $unit_kerja,
      'divisi_id' => $divisi,
      'jabatan_id' => $jabatan,
      'tanggal_masuk' => $tanggal_masuk,
      'pas_foto' => $nama_pas_foto,
      'file_ktp' => $nama_file_ktp,
      'file_bpjs' => $nama_file_bpjs,
      'file_npwp' => $nama_file_npwp,
      'file_kk' => $nama_file_kk,
      'file_pendidikan' => $nama_file_pendidikan,
      'created_by' => $userData['nama'],
      'updated_by' => $userData['nama'],
    ]);

          if ($this->karyawanModel->update($userData['id'])) {
               session()->setFlashdata('success', 'Data karyawan berhasil diperbarui!');
               return redirect()->to('/edit-data-karyawan');
          } else {
               session()->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data karyawan.');
               return redirect()->to('/edit-data-karyawan')->withInput();
          }
     }
} 