<?php

namespace App\Core;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Core\BaseModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['extension', 'apires'];

	protected $session;

	protected $baseModel;

	protected $db;

	protected $token;


	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->baseModel = new BaseModel(\Config\Services::request());
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();
		$this->db2 = \Config\Database::connect('hubdat');
		//include_once APPPATH.'/../rethink/rdb/rdb.php';
	}

	protected function _authView($data = array())
	{
		$url = uri_segment(1);
		$module = uri_segment(0);
		$menu = $this->session->get('menu');

		$authentication = array_filter($menu, function ($arr) use ($url, $module) {
			return strtolower($arr->menu_url) == strtolower($url) && strtolower($arr->module_url) == strtolower($module);
		});

		if (count($authentication) == 1) {
			if (array_values($authentication)[0]->v != "1") {
				// $this->baseModel->log_action("view", "Akses Ditolak");

				$data['load_view'] = 'App\Modules\Main\Views\error';
				return view('App\Modules\Main\Views\layout', $data);
			} else {
				// $this->baseModel->log_action("view", "Akses Diberikan");

				$data['page_title'] = array_values($authentication)[0]->menu_name;
				$data['load_view'] = 'App\Modules\\' . ucfirst(array_values($authentication)[0]->module_url) . '\Views\\' . array_values($authentication)[0]->menu_url;
				$data['rules'] = array_values($authentication)[0];
				return view('App\Modules\Main\Views\layout', $data);
			}
		} else {
			// $this->baseModel->log_action("view", "Akses Ditolak");

			$data['load_view'] = 'App\Modules\Main\Views\error';
			return view('App\Modules\Main\Views\layout', $data);
		}
	}

	protected function _authViewPage($data = array())
	{
		$url = uri_segment(1);
		$module = uri_segment(0);
		$menu = $this->session->get('menu');

		$authentication = array_filter($menu, function ($arr) use ($url, $module) {
			return strtolower($arr->menu_url) == strtolower($url) && strtolower($arr->module_url) == strtolower($module);
		});

		if (count($authentication) == 1) {
			if (array_values($authentication)[0]->v != "1") {
				// $this->baseModel->log_action("view", "Akses Ditolak");

				$data['load_view'] = 'App\Modules\Main\Views\error';
				return view('App\Modules\Main\Views\layoutpage', $data);
			} else {
				// $this->baseModel->log_action("view", "Akses Diberikan");

				$data['page_title'] = array_values($authentication)[0]->menu_name;
				$data['load_view'] = 'App\Modules\\' . ucfirst(array_values($authentication)[0]->module_url) . '\Views\\' . array_values($authentication)[0]->menu_url;
				$data['rules'] = array_values($authentication)[0];
				return view('App\Modules\Main\Views\layoutpage', $data);
			}
		} else {
			// $this->baseModel->log_action("view", "Akses Ditolak");

			$data['load_view'] = 'App\Modules\Main\Views\error';
			return view('App\Modules\Main\Views\layoutpage', $data);
		}
	}

	// protected function _authViewmodal($data = array())
	// {
	// 	$url = uri_segment(1);
	// 	$module = uri_segment(0);
	// 	$menu = $this->session->get('menu');

	// 	$authentication = array_filter($menu, function ($arr) use ($url, $module) {
	// 		return strtolower($arr->menu_url) == strtolower($url) && strtolower($arr->module_url) == strtolower($module);
	// 	});

	// 	if (count($authentication) == 1) {
	// 		if (array_values($authentication)[0]->v != "1") {
	// 			// $this->baseModel->log_action("view", "Akses Ditolak");

	// 			$data['load_view'] = 'App\Modules\Main\Views\error';
	// 			return view('App\Modules\Main\Views\layoutmodal', $data);
	// 		} else {
	// 			// $this->baseModel->log_action("view", "Akses Diberikan");

	// 			$data['page_title'] = array_values($authentication)[0]->menu_name;
	// 			$data['load_view'] = 'App\Modules\\' . ucfirst(array_values($authentication)[0]->module_url) . '\Views\\' . array_values($authentication)[0]->menu_url;
	// 			$data['rules'] = array_values($authentication)[0];
	// 			return view('App\Modules\Main\Views\layoutmodal', $data);
	// 		}
	// 	} else {
	// 		// $this->baseModel->log_action("view", "Akses Ditolak");

	// 		$data['load_view'] = 'App\Modules\Main\Views\error';
	// 		return view('App\Modules\Main\Views\layoutmodal', $data);
	// 	}
	// }

	protected function _auth($action, $var_action, callable $authenticated)
	{
		$referers = explode("/", $_SERVER['HTTP_CUSTOMREF'] ?? $_SERVER['HTTP_REFERER']);
		$referer = end($referers);
		$module = $referers[count($referers) - 2];
		$menu = $this->session->get('menu');

		$authentication = array_filter($menu, function ($arr) use ($referer, $module) {
			return strtolower($arr->menu_url) == strtolower($referer) && strtolower($arr->module_url) == strtolower($module);
		});
		if (count($authentication) == 1 && $referer != "" && array_values($authentication)[0]->$var_action == "1") {
			$this->baseModel->log_action($action, "Akses Diberikan");

			if ($action == "detail") {
				return $authenticated();
			} else {
				$authenticated();
			}
		} else {
			$this->baseModel->log_action($action, "Akses Ditolak");

			if ($action == "load") {
				die(json_encode(array("data" => [], "recordsTotal" => 0, "recordsFiltered" => 0)));
			} else if ($action == "detail") {
				die(view('App\Modules\Main\Views\error'));
			} else {
				die(json_encode(array('success' => false, 'message' => 'Anda tidak mempunyai hak akses untuk ini', 'debug' => array_values($authentication)[0])));
			}
		}
	}

	protected function _authInsert(callable $authenticated)
	{
		$this->_auth("insert", "i", $authenticated);
	}

	protected function _authEdit(callable $authenticated)
	{
		$this->_auth("edit", "e", $authenticated);
	}

	protected function _authDelete(callable $authenticated)
	{
		$this->_auth("delete", "d", $authenticated);
	}

	protected function _authVerif(callable $authenticated)
	{
		$this->_auth("verif", "o", $authenticated);
	}

	protected function _authLoad(callable $authenticated)
	{
		$this->_auth("load", "v", $authenticated);
	}

	protected function _authUpload(callable $authenticated)
	{
		$this->_auth("upload", "i", $authenticated);
	}

	protected function _authDownload(callable $authenticated)
	{
		$this->_auth("download", "v", $authenticated);
	}

	protected function _authDetail(callable $authenticated)
	{
		return $this->_auth("detail", "v", $authenticated);
	}

	protected function _loadDatatable($query, $where, $data, $groupby = NULL)
	{
		$start = $_POST["start"];
		$length = $_POST["length"];
		$search = $_POST["search"];
		$order = $_POST["order"][0];
		$columns = $_POST["columns"];
		$key = $search["value"];
		$orderColumn = $columns[$order["column"]]["data"];
		$orderDirection = $order["dir"];

		$result = $this->baseModel->base_load_datatable($query, $where, $key, $start, $length, $orderColumn, $orderDirection, $groupby);

		echo json_encode(array("data" => $result["data"], "recordsTotal" => $result["allData"], "recordsFiltered" => $result["filteredData"]));
	}

	protected function _loadDatatableOrderBy($query, $where, $data, $groupby = NULL, $orderby)
	{
		$start = $_POST["start"];
		$length = $_POST["length"];
		$search = $_POST["search"];
		$order = $_POST["order"][0];
		$columns = $_POST["columns"];
		$key = $search["value"];
		$orderColumn = $columns[$order["column"]]["data"];
		$orderDirection = $order["dir"];

		$result = $this->baseModel->base_load_datatable_orderby($query, $where, $key, $start, $length, $orderColumn, $orderDirection, $groupby, $orderby);
		echo json_encode(array("data" => $result["data"], "recordsTotal" => $result["allData"], "recordsFiltered" => $result["filteredData"]));
	}

	protected function _insert($tableName, $data, callable $callback = NULL)
	{
		if ($data['id'] == "") {
			$data['created_by'] = $this->session->get('id');

			if ($this->baseModel->base_insert($data, $tableName)) {
				if ($callback != NULL) {
					$data['id'] = $this->db->insertID();
					$callback($data);
				}

				echo json_encode(array('success' => true, 'message' => $data));
			} else {
				$err = $this->baseModel->db->error();
				if ($err['code'] == '1062') {
					echo json_encode(array('success' => false, 'message' => 'Data sudah ada'));
				} else {
					echo json_encode(array('success' => false, 'message' => $err['message']));
				}
			}
		} else {
			$id = $data['id'];
			$data['last_edited_at'] = date('Y-m-d H:i:s');
			$data['last_edited_by'] = $this->session->get('id');
			unset($data['id']);

			if ($this->baseModel->base_update($data, $tableName, array('id' => $id))) {
				if ($callback != NULL) {
					$data['id'] = $id;
					$callback($data);
				}

				echo json_encode(array('success' => true, 'message' => $data));
			} else {
				echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
			}
		}
	}

	protected function _insertNotification($tableName, $data, callable $callback = NULL)
	{
		if ($data['id'] == "") {
			$data['created_by'] = $this->session->get('id');

			$operatorId = $data['account_id'];
			$aspekName = $data['aspek_name'];
			$palanggaranName = $data['pelanggaran_name'];
			$sanksiPoint = $data['sanksi_point'];
			$tindakLanjut = $data['tindak_lanjut'];
			$resolveTime = $data['resolve_time'];
			$responseTime = $data['response_time'];

			unset($data['account_id']);
			unset($data['aspek']);
			unset($data['kriteria_spm']);
			unset($data['kategori_pelanggaran']);
			unset($data['tindak_lanjut']);
			unset($data['nilai_sanksi']);
			unset($data['time_response']);
			unset($data['time_resolve']);
			unset($data['klasifikasi_penanganan']);

			unset($data['aspek_name']);
			unset($data['pelanggaran_name']);
			unset($data['tindak_lanjut']);
			unset($data['resolve_time']);
			unset($data['response_time']);

			if ($this->baseModel->base_insert($data, $tableName)) {
				if ($tableName == 'bts_sla') {
					$insertId = $this->db->insertID();

					$fcmArray = [];

					$query = $this->db->query("SELECT * from m_user_web where user_web_role_id=12 and tbs_operator_id='" . $operatorId . "' and user_mobile_fcm is not null")->getResult();
					$dataSla = $this->db->query("SELECT * from bts_sla where id=" . $insertId . "")->getRow();
					$dataBus = $this->db->query("SELECT vehicle_no as noken,vehicle_code as lambung from bts_bus_routes where id=" . $data['bus_route_id'] . "")->getRow();
					$dataDriver = $this->db->query("SELECT name from tbs_drivers where id='" . $data['driver_id'] . "'")->getRow();

					$header = '⚠️ Laporan Mengenai Aspek ' . $aspekName . '';

					if ($resolveTime == 0) {
						$deskripsi = 'Nomor laporan ' . $dataSla->kode_sla . '
									mendapatkan sanksi atas pelanggaran ' . $palanggaranName . '.
									• BUS ' . $dataBus->noken . '•' . $dataBus->lambung . ',
									• Pengemudi ' . $dataDriver->name . '
									• Tindak lanjut : ' . $tindakLanjut . ' 
									• Terkena sanksi ' . $sanksiPoint . '';
					} else {
						$deskripsi = 'Nomor laporan ' . $dataSla->kode_sla . '
									Menuggu Respon atas pelanggaran ' . $palanggaranName . '.
									• BUS ' . $dataBus->noken . '•' . $dataBus->lambung . ',
									• Pengemudi ' . $dataDriver->name . '
									• Tindak lanjut : ' . $tindakLanjut . ' 
									• Waktu respon yang diberikan : ' . $responseTime . ' Menit
									• potensi terkena sanksi ' . $sanksiPoint . '';
					}

					foreach ($query as $r) {
						array_push($fcmArray, $r->user_mobile_fcm);
					}

					$this->sendBroadcastNotification($fcmArray, $header, $deskripsi);

					if ($callback != NULL) {
						$data['id'] = $this->db->insertID();
						$callback($data);
					}

					echo json_encode(array('success' => true, 'message' => $data));
				} else {
					if ($callback != NULL) {
						$data['id'] = $this->db->insertID();
						$callback($data);
					}

					echo json_encode(array('success' => true, 'message' => $data));
				}
			} else {
				$err = $this->baseModel->db->error();
				if ($err['code'] == '1062') {
					echo json_encode(array('success' => false, 'message' => 'Data sudah ada'));
				} else {
					echo json_encode(array('success' => false, 'message' => $err['message']));
				}
			}
		} else {
			$id = $data['id'];
			$data['last_edited_at'] = date('Y-m-d H:i:s');
			$data['last_edited_by'] = $this->session->get('id');
			unset($data['id']);

			if ($this->baseModel->base_update($data, $tableName, array('id' => $id))) {
				if ($callback != NULL) {
					$data['id'] = $id;
					$callback($data);
				}

				echo json_encode(array('success' => true, 'message' => $data));
			} else {
				echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
			}
		}
	}

	protected function _insertbatch($tableName, $data, callable $callback = NULL)
	{
		// if($data['id'] == ""){
		// $data['created_by'] = $this->session->get('id');

		if ($this->baseModel->base_insertbatch($data, $tableName)) {
			if ($callback != NULL) {
				$callback();
			}

			echo json_encode(array('success' => true, 'message' => 'data berhasil terinput'));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
		}
		// }else{
		// $id = $data['id'];
		// $data['last_edited_at'] = date('Y-m-d H:i:s');
		// $data['last_edited_by'] = $this->session->get('id');
		// unset($data['id']);

		// if($this->baseModel->base_update($data, $tableName, array('id' => $id))){
		// if($callback!=NULL) { $callback(); }

		// echo json_encode(array('success' => true, 'message' => $data));
		// }else{
		// echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
		// }
		// }
	}

	protected function _edit($tableName, $data, $keys = NULL, $query = NULL)
	{
		$key = $keys == NULL ? 'id' : $keys;
		$rs = $query == NULL ? $this->baseModel->base_get($tableName, [$key => $data[$key]])->getRow() : $this->baseModel->db->query($query)->getRow();

		if (!is_null($rs)) {
			echo json_encode(array('success' => true, 'data' => $rs));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()['message']));
		}
	}

	protected function _otorisasi($tableName, $data, callable $callback = NULL)
	{
		$id = $data['id'];
		$data['last_edited_at'] = date('Y-m-d H:i:s');
		$data['last_edited_by'] = $this->session->get('id');
		unset($data['id']);

		if ($this->baseModel->base_update($data, $tableName, array('id' => $id))) {
			if ($callback != NULL) {
				$callback();
			}

			echo json_encode(array('success' => true, 'message' => $data));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
		}
	}

	protected function _editbatch($tableName, $data, $keys = NULL, $query = NULL)
	{
		$key = $keys == NULL ? 'id' : $keys;
		$rs = $query == NULL ? $this->baseModel->base_get($tableName, [$key => $data[$key]])->getResult() : $this->baseModel->db->query($query)->getResult();

		if (!is_null($rs)) {
			echo json_encode(array('success' => true, 'data' => $rs));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()['message']));
		}
	}

	protected function _mobile_insert($tableName, $data, callable $callback = NULL)
	{
		if ($data['id'] == "") {
			$data['created_by'] = $data['user_id'];
			unset($data['user_id']);
			if ($this->baseModel->base_insert($data, $tableName)) {
				if ($callback != NULL) {
					$callback();
				}

				echo json_encode(array('success' => true, 'message' => 'success'));
			} else {
				echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
			}
		} else {
			$id = $data['id'];
			$data['last_edited_at'] = date('Y-m-d H:i:s');
			$data['last_edited_by'] = $data['user_id'];
			unset($data['id']);
			unset($data['user_id']);

			if ($this->baseModel->base_update($data, $tableName, array('id' => $id))) {
				if ($callback != NULL) {
					$callback();
				}

				echo json_encode(array('success' => true, 'message' => $data));
			} else {
				echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
			}
		}
	}



	// fetch api blue lite no union
	// protected function _editOnlyBlueLite($tableName, $data, $keys = NULL, $query = NULL)
	// {
	//     $key = $keys == NULL ? 'id' : $keys;
	//     $rs = $query == NULL ? $this->baseModel->base_get($tableName, ['no_registrasi_kendaraan' => $data[$key]])->getRow() : $this->baseModel->db->query($query)->getRow();

	// 	$data = "<table class='table table-striped table-hover'>
	//                 <tbody>
	//                     " . $this->_APIDetailBlueTRTAG('Nama Pemilik', $rs->nama_pemilik) . "
	//                     " . $this->_APIDetailBlueTRTAG('Alamat Pemilik', $rs->alamat_pemilik) . "
	//                     " . $this->_APIDetailBlueTRTAG('No Registrasi Kendaraan', $rs->no_registrasi_kendaraan) . "
	//                     " . $this->_APIDetailBlueTRTAG('No Rangka', $rs->no_rangka) . "
	//                     " . $this->_APIDetailBlueTRTAG('No Mesin', $rs->no_mesin) . "
	//                     " . $this->_APIDetailBlueTRTAG('Jenis Kendaraan', $rs->jenis_kendaraan) . "
	//                     " . $this->_APIDetailBlueTRTAG('Merk', $rs->merk) . "
	//                     " . $this->_APIDetailBlueTRTAG('Tipe', $rs->tipe) . "
	//                     " . $this->_APIDetailBlueTRTAG('Tahun Rakit', $rs->tahun_rakit) . "
	//                     " . $this->_APIDetailBlueTRTAG('Bahan Bakar', $rs->bahan_bakar) . "
	//                     " . $this->_APIDetailBlueTRTAG('Isi Silinder', $rs->isi_silinder) . "
	//                     " . $this->_APIDetailBlueTRTAG('Daya Motor', $rs->daya_motor) . "
	//                     " . $this->_APIDetailBlueTRTAG('Ukuran Ban', $rs->ukuran_ban) . "
	//                     " . $this->_APIDetailBlueTRTAG('Sumbu', $rs->sumbu) . "
	//                     " . $this->_APIDetailBlueTRTAG('Berat Kosong', $rs->berat_kosong) . "
	//                     " . $this->_APIDetailBlueTRTAG('Panjang Kendaraan', $rs->panjang_kendaraan) . "
	//                     " . $this->_APIDetailBlueTRTAG('Lebar Kendaraan', $rs->lebar_kendaraan) . "
	//                     " . $this->_APIDetailBlueTRTAG('Tinggi Kendaraan', $rs->tinggi_kendaraan) . "
	//                     " . $this->_APIDetailBlueTRTAG('Julur Depan', $rs->julur_depan) . "
	//                     " . $this->_APIDetailBlueTRTAG('Julur Belakang', $rs->julur_belakang) . "
	//                     " . $this->_APIDetailBlueTRTAG('Jarak Sumbu 1 2', $rs->jarak_sumbu_1_2) . "
	//                     " . $this->_APIDetailBlueTRTAG('Jarak Sumbu 2 3', $rs->jarak_sumbu_2_3) . "
	//                     " . $this->_APIDetailBlueTRTAG('Jarak Sumbu 3 4', $rs->jarak_sumbu_3_4) . "
	//                     " . $this->_APIDetailBlueTRTAG('Dimensi Bak Tangki', $rs->dimensi_bak_tangki) . "
	//                     " . $this->_APIDetailBlueTRTAG('JBB', $rs->jbb) . "
	//                     " . $this->_APIDetailBlueTRTAG('JBKB', $rs->jbkb) . "
	//                     " . $this->_APIDetailBlueTRTAG('JBI', $rs->jbi) . "
	//                     " . $this->_APIDetailBlueTRTAG('JBKI', $rs->jbki) . "
	//                     " . $this->_APIDetailBlueTRTAG('Daya Angkut Orang', $rs->daya_angkut_orang) . "
	//                     " . $this->_APIDetailBlueTRTAG('Daya Angkut KG', $rs->daya_angkut_kg) . "
	//                     " . $this->_APIDetailBlueTRTAG('Kelas Jalan', $rs->kelas_jalan) . "
	//                     " . $this->_APIDetailBlueTRTAG('Keterangan hasil Uji Coba', $rs->keterangan_hasil_uji) . "
	//                     " . $this->_APIDetailBlueTRTAG('Petugas Penguji', $rs->petugas_penguji) . "
	//                     " . $this->_APIDetailBlueTRTAG('NRP Petugas Penguji', $rs->nrp_petugas_penguji) . "
	//                     " . $this->_APIDetailBlueTRTAG('Kepala Dinas', $rs->kepala_dinas) . "
	//                     " . $this->_APIDetailBlueTRTAG('Pangkat Kepala Dinas', $rs->pangkat_kepala_dinas) . "
	//                     " . $this->_APIDetailBlueTRTAG('NIP Kepala Dinas', $rs->nip_kepala_dinas) . "
	//                     " . $this->_APIDetailBlueTRTAG('Unit Pelaksana Teknis', $rs->unit_pelaksana_teknis) . "
	//                     " . $this->_APIDetailBlueTRTAG('Direktur', $rs->direktur) . "
	//                     " . $this->_APIDetailBlueTRTAG('Perangkat Direktur', $rs->pangkat_direktur) . "
	//                     " . $this->_APIDetailBlueTRTAG('NIP Direktur', $rs->nip_direktur) . "
	//                     " . $this->_APIDetailBlueTRTAG('No Uji Kendaraan', $rs->no_uji_kendaraan) . "
	//                 </tbody>
	//             </table>";

	//     if (!is_null($rs)) {
	//         echo json_encode(array('success' => true, 'data' => $data, "atr" => ["modal" => "modal_blue", "modal_body" => "modal_body_blue"]));
	//     } else {
	//         echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()['message']));
	//     }
	// }

	// fetch api blue test period no union
	// protected function _editOnlyBlueTestPeriod($tableName, $data, $keys = NULL, $query = NULL)
	// {
	//     $key = $keys == NULL ? 'id' : $keys;
	//     $rs = $query == NULL ? $this->baseModel->base_get($tableName, ['no_registrasi_kendaraan' => $data[$key]])->getRow() : $this->baseModel->db->query($query)->getRow();

	// 	// comment because response not same list blue
	// 	// $statusUjiBerkala = $rs->status_uji_berkala ? "true" : "false";
	// 	// " . $this->_APIDetailBlueTRTAG('No Registrasi Kendaraan', $statusUjiBerkala) . "
	// 	// " . $this->_APIDetailBlueTRTAG('Tempat Uji Terakhir', $rs->tempat_uji_terakhir) . "
	// 	// " . $this->_APIDetailBlueTRTAG('Hasil Uji Terakhir', $rs->hasil_uji_terakhir) . "

	// 	$data = "<table class='table table-striped table-hover'>
	//                 <tbody>
	//                     " . $this->_APIDetailBlueTRTAG('Status Uji Berkala', $rs->no_registrasi_kendaraan) . "
	//                     " . $this->_APIDetailBlueTRTAG('Date', date("Y-m-d", strtotime($rs->date ))) . "
	//                 </tbody>
	//             </table>";

	//     if (!is_null($rs)) {
	//         echo json_encode(array('success' => true, 'data' => $data, "atr" => ["modal" => "modal_blue", "modal_body" => "modal_body_blue"]));
	//     } else {
	//         echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()['message']));
	//     }
	// }

	// fetch data blue union
	protected function _editOnlyBlue($tableName, $data, $keys = NULL, $query = NULL, $svc = "last")
	{
		$key = $keys == NULL ? 'id' : $keys;
		$rs = $query == NULL ? $this->baseModel->base_get($tableName, ['no_registrasi_kendaraan' => $data[$key]])->getRow() : $this->baseModel->db->query($query[0] . " and a.no_registrasi_kendaraan = " . "'" . $data[$key] . "'" . " UNION " . $query[1] . " and b.no_registrasi_kendaraan = " . "'" . $data[$key] . "'")->getRow();

		$data = "";
		switch ($svc) {
			case 'lite':
				$data = "<table class='table table-striped table-hover'>
                    <tbody>
						" . $this->_APIDetailBlueTRTAG('Date', $rs->date) . "
                        " . $this->_APIDetailBlueTRTAG('Nama Pemilik', $rs->nama_pemilik) . "
                        " . $this->_APIDetailBlueTRTAG('Alamat Pemilik', $rs->alamat_pemilik) . "
						" . $this->_APIDetailBlueTRTAG('No Srut', $rs->no_srut) . "
						" . $this->_APIDetailBlueTRTAG('Tgl Srut', $rs->tgl_srut) . "
                        " . $this->_APIDetailBlueTRTAG('No Registrasi Kendaraan', $rs->no_registrasi_kendaraan) . "
                        " . $this->_APIDetailBlueTRTAG('No Rangka', $rs->no_rangka) . "
                        " . $this->_APIDetailBlueTRTAG('No Mesin', $rs->no_mesin) . "
                        " . $this->_APIDetailBlueTRTAG('Jenis Kendaraan', $rs->jenis_kendaraan) . "
                        " . $this->_APIDetailBlueTRTAG('Merk', $rs->merk) . "
                        " . $this->_APIDetailBlueTRTAG('Tipe', $rs->tipe) . "
                        " . $this->_APIDetailBlueTRTAG('Tahun Rakit', $rs->tahun_rakit) . "
                        " . $this->_APIDetailBlueTRTAG('Bahan Bakar', $rs->bahan_bakar) . "
                        " . $this->_APIDetailBlueTRTAG('Isi Silinder', $rs->isi_silinder) . "
                        " . $this->_APIDetailBlueTRTAG('Daya Motor', $rs->daya_motor) . "
                        " . $this->_APIDetailBlueTRTAG('Berat Kosong', $rs->berat_kosong) . "
                        " . $this->_APIDetailBlueTRTAG('Panjang Kendaraan', $rs->panjang_kendaraan) . "
                        " . $this->_APIDetailBlueTRTAG('Lebar Kendaraan', $rs->lebar_kendaraan) . "
                        " . $this->_APIDetailBlueTRTAG('Tinggi Kendaraan', $rs->tinggi_kendaraan) . "
                        " . $this->_APIDetailBlueTRTAG('Julur Depan', $rs->julur_depan) . "
                        " . $this->_APIDetailBlueTRTAG('Julur Belakang', $rs->julur_belakang) . "
                        " . $this->_APIDetailBlueTRTAG('JBB', $rs->jbb) . "
                        " . $this->_APIDetailBlueTRTAG('JBKB', $rs->jbkb) . "
                        " . $this->_APIDetailBlueTRTAG('JBI', $rs->jbi) . "
                        " . $this->_APIDetailBlueTRTAG('JBKI', $rs->jbki) . "
                        " . $this->_APIDetailBlueTRTAG('Daya Angkut Orang', $rs->daya_angkut_orang) . "
                        " . $this->_APIDetailBlueTRTAG('Daya Angkut KG', $rs->daya_angkut_kg) . "
                        " . $this->_APIDetailBlueTRTAG('Kelas Jalan', $rs->kelas_jalan) . "
                        " . $this->_APIDetailBlueTRTAG('Keterangan hasil Uji Coba', $rs->keterangan_hasil_uji) . "
                        " . $this->_APIDetailBlueTRTAG('Petugas Penguji', $rs->petugas_penguji) . "
                        " . $this->_APIDetailBlueTRTAG('NRP Petugas Penguji', $rs->nrp_petugas_penguji) . "
                        " . $this->_APIDetailBlueTRTAG('Kepala Dinas', $rs->kepala_dinas) . "
                        " . $this->_APIDetailBlueTRTAG('Pangkat Kepala Dinas', $rs->pangkat_kepala_dinas) . "
                        " . $this->_APIDetailBlueTRTAG('NIP Kepala Dinas', $rs->nip_kepala_dinas) . "
                        " . $this->_APIDetailBlueTRTAG('Unit Pelaksana Teknis', $rs->unit_pelaksana_teknis) . "
                        " . $this->_APIDetailBlueTRTAG('Direktur', $rs->direktur) . "
                        " . $this->_APIDetailBlueTRTAG('Perangkat Direktur', $rs->pangkat_direktur) . "
                        " . $this->_APIDetailBlueTRTAG('NIP Direktur', $rs->nip_direktur) . "
                    </tbody>
                </table>";
				break;
			case 'test-period':
				// comment because response not same list blue test period
				// $statusUjiBerkala = $rs->status_uji_berkala ? "true" : "false";
				// " . $this->_APIDetailBlueTRTAG('No Registrasi Kendaraan', $statusUjiBerkala) . "
				// " . $this->_APIDetailBlueTRTAG('Tempat Uji Terakhir', $rs->tempat_uji_terakhir) . "
				// " . $this->_APIDetailBlueTRTAG('Hasil Uji Terakhir', $rs->hasil_uji_terakhir) . "
				$data = "<table class='table table-striped table-hover'>
                    <tbody>
                        " . $this->_APIDetailBlueTRTAG('Status Uji Berkala', $rs->no_registrasi_kendaraan) . "
                        " . $this->_APIDetailBlueTRTAG('Date', date("Y-m-d", strtotime($rs->date))) . "
                    </tbody>
                </table>";
				break;
			case 'last':
				// comment because response not same list blue last
				// $uji = json_decode($rs->uji, JSON_UNESCAPED_SLASHES);

				$data = "<table class='table table-striped table-hover'>
						<tbody>
							" . $this->_APIDetailBlueTRTAG('No Registrasi Kendaraan', $rs->no_registrasi_kendaraan) . "
							" . $this->_APIDetailBlueTRTAG('Date', date("Y-m-d", strtotime($rs->date))) . "
						";

				// foreach($uji as $key => $value) {
				// 	$data .= "
				// 		" . $this->_APIDetailBlueTRTAG('Item Uji ' . ($key + 1), $value["item_uji"]) . "
				// 		" . $this->_APIDetailBlueTRTAG('Ambang Batas ' . ($key + 1), $value["ambang_batas"]) . "
				// 		" . $this->_APIDetailBlueTRTAG('Hasil Uji ' . ($key + 1), $value["hasiluji"]) . "
				// 	";
				// }

				$data .= "
						</tbody>
					</table>";
				break;
		}


		if (!is_null($rs)) {
			echo json_encode(array('success' => true, 'data' => $data, "atr" => ["modal" => "modal_blue", "modal_body" => "modal_body_blue"]));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()['message']));
		}
	}

	// fetch data spionam
	protected function _editOnlySpionam($tableName, $data, $keys = NULL, $query = NULL, $svc = "last")
	{
		$key = $keys == NULL ? 'id' : $keys;
		$rs = $query == NULL ? $this->baseModel->base_get($tableName, ['noken' => $data[$key]])->getRow() : $this->baseModel->db->query($query[0] . " and a.no_registrasi_kendaraan = " . "'" . $data[$key] . "'" . " UNION " . $query[1] . " and b.no_registrasi_kendaraan = " . "'" . $data[$key] . "'")->getRow();

		$data = "";
		switch ($svc) {
			case 'last':
				$data = "<table class='table table-striped table-hover'>
						<tbody>
							" . $this->_APIDetailBlueTRTAG('Jenis Pelayanan', $rs->jenis_pelayanan) . "
							" . $this->_APIDetailBlueTRTAG('Noken', $rs->noken) . "
							" . $this->_APIDetailBlueTRTAG('No Uji', $rs->no_uji) . "
							" . $this->_APIDetailBlueTRTAG('Tgl Exp Uji', date("Y-m-d", strtotime($rs->tgl_exp_uji))) . "
							" . $this->_APIDetailBlueTRTAG('No Kps', $rs->no_kps) . "
							" . $this->_APIDetailBlueTRTAG('Tgl Exp Kps', date("Y-m-d", strtotime($rs->tgl_exp_kps))) . "
							" . $this->_APIDetailBlueTRTAG('No Rangka', $rs->no_rangka) . "
							" . $this->_APIDetailBlueTRTAG('No Mesin', $rs->no_mesin) . "
							" . $this->_APIDetailBlueTRTAG('Merk', $rs->merek) . "
							" . $this->_APIDetailBlueTRTAG('Tahun', $rs->tahun) . "
							" . $this->_APIDetailBlueTRTAG('Seat', $rs->seat) . "
						</tbody>
					</table>";
				break;
		}


		if (!is_null($rs)) {
			echo json_encode(array('success' => true, 'data' => $data, "atr" => ["modal" => "modal_blue", "modal_body" => "modal_body_blue"]));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()['message']));
		}
	}

	protected function _APIDetailBlueTRTAG($label, $value)
	{
		return "<tr>
            <td>" . $label . "</td>
            <td> : </td>
            <td>" . $value . "</td>
        </tr>";
	}

	protected function _delete($tableName, $data)
	{
		if ($this->baseModel->base_delete($tableName, $data)) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
		}
	}

	protected function _loadSelect2($data, $query, $where, $orderBy = NULL, $groupBy = NULL)
	{
		$keyword = $data['keyword'] ?? "";
		$page = $data['page'];
		$perpage = $data['perpage'];

		$result = $this->baseModel->base_load_select2($query, $where, $keyword, $page, $perpage, $orderBy, $groupBy);

		echo json_encode(array("page" => $page, "perpage" => $perpage, "total" => count($result), "rows" => $result));
	}

	protected function _loadSelect2GroupBy($data, $query, $where, $orderBy = NULL, $groupBy = NULL)
	{
		$keyword = $data['keyword'] ?? "";
		$page = $data['page'];
		$perpage = $data['perpage'];

		$result = $this->baseModel->base_load_select2($query, $where, $keyword, $page, $perpage, $orderBy, $groupBy);

		echo json_encode(array("page" => $page, "perpage" => $perpage, "total" => count($result), "rows" => $result));
	}

	protected function _loadSelect2hubdat($data, $query, $where, $orderBy)
	{
		$keyword = $data['keyword'] ?? "";
		$page = $data['page'];
		$perpage = $data['perpage'];

		$result = $this->baseModel->base_load_select2hubdat($query, $where, $keyword, $page, $perpage, $orderBy);

		echo json_encode(array("page" => $page, "perpage" => $perpage, "total" => count($result), "rows" => $result));
	}

	protected function _exportPdf($data)
	{
		$view = uri_segment(2);
		$module = uri_segment(0);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [210, 297],
			'tempDir' => ROOTPATH . 'writable/cache',
			'default_font_size' => 11,
			'default_font' => 'Manrope'
		]);
		$html = view('App\Modules\\' . ucfirst($module) . '\Views\\' . $view, $data);

		$pagecount = $mpdf->SetSourceFile('./assets/templateA4P.pdf', 2);
		$tplId = $mpdf->importPage($pagecount);
		$mpdf->SetPageTemplate($tplId);

		$mpdf->AddPage(
			'P',
			'',
			'',
			'',
			'',
			7, // margin_left
			7, // margin right
			25, // margin top
			10, // margin bottom
			25, // margin header
			10
		); // margin footer

		$mpdf->useTemplate($tplId, 0, 0, 210, 297);

		$html_header = '<div class="row">
							<div class="dirjen">
								DIREKTORAT JENDERAL PERHUBUNGAN DARAT
							</div>
							<div style="text-align: right;font-size: 15px;font-weight: bold;padding-top: 65px;"></div>
						</div>';
		$mpdf->setAutoTopMargin = 'stretch';
		$mpdf->setHTMLHeader($html_header);
		$mpdf->WriteHTML($html);

		$filename = $view . '-' . date('d-m-Y') . '.pdf';
		$this->response->setHeader('Cache-Control', 'private');
		$this->response->setHeader('Content-Type', 'application/pdf');

		ob_clean();
		$rs = $mpdf->Output($filename, 'I'); // INLINE 
		echo $rs;
		die;
	}
	protected function _exportSiPdf($data)
	{
		$view = uri_segment(2);
		$module = uri_segment(0);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [210, 297],
			'tempDir' => ROOTPATH . 'writable/cache',
			'default_font_size' => 11,
			'default_font' => 'Manrope'
		]);

		$html_footer = '
		<hr>
		<table class="border-0">
			<tr class="border-0">
				 <td class="border-0" rowspan="4" style="width:30%; padding:0px !important;  margin:0px !important;"><img src="' . base_url("assets/img/logotype-VTA.png") . '" width="200px"></td>
			</tr class="border-0">
			<tr class="border-0">
				<td class="border-0" style="padding:0px !important; margin:0px !important;">IP Address : ' . $_SERVER["REMOTE_ADDR"] . '</td>
			</tr class="border-0">
			<tr class="border-0">
				<td class="border-0" style="padding:0px !important; margin:0px !important;">Tanggal Cetak : ' . date("d-m-Y H:i:s") . '</td>
			</tr class="border-0">
			<tr class="border-0">
				<td class="border-0" style="padding:0px !important; margin:0px !important;">Dicetak Oleh : ' . $_SESSION["username"] . '</td>
			</tr class="border-0">
		</table>
		';

		$html_header = '
		<br>
		<br>
		<br>
		<br>
		<hr>
		';
		
		$mpdf->SetHTMLHeader($html_header);
		$mpdf->SetHTMLFooter($html_footer);

		$html = view('App\Modules\\' . ucfirst($module) . '\Views\\' . $view, $data);

		// if (in_array($this->session->get('role_code'), ['wsp', 'osp', 'rsp', 'psp'])) {
		// 	$pagecount = $mpdf->SetSourceFile('./assets/PDFTemplate-VTA.pdf', 0);
		// } else {
			$pagecount = $mpdf->SetSourceFile('./assets/PDFTemplate-VTA (1).pdf', 0);
		// }

		$tplId = $mpdf->importPage($pagecount);
		$mpdf->SetPageTemplate($tplId);

		$mpdf->AddPage(
			'P',
			'',
			'',
			'',
			'',
			14, // margin_left
			14, // margin right
			48, // margin top
			30, // margin bottom
			25, // margin header
			10
		); // margin footer

		$mpdf->useTemplate($tplId, 0, 0, 210, 297);

		// $mpdf->setHTMLHeader($html_header);
		$mpdf->WriteHTML($html);
		// Add more pages as needed

		// $mpdf->Output();

		$filename = $data['filename'];
		$this->response->setHeader('Cache-Control', 'private');
		$this->response->setHeader('Content-Type', 'application/pdf');

		ob_clean();
		$rs = $mpdf->Output($filename, 'I'); // INLINE 
		echo $rs;
		die;
	}

	protected function _exportPdfLapHarianSpda($data)
	{
		$view = uri_segment(2);
		$module = uri_segment(0);

		$html = view('App\Modules\\' . ucfirst($module) . '\Views\\' . $view, $data);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [297, 210],
			'tempDir' => ROOTPATH . 'writable/cache'
		]);

		$pagecount = $mpdf->SetSourceFile('./assets/templateA4L.pdf', 2);
		$tplId = $mpdf->importPage($pagecount);
		$mpdf->SetPageTemplate($tplId);
		// $mpdf->SetDisplayMode('default');

		$mpdf->AddPage(
			'P',
			'',
			'',
			'',
			'',
			7, // margin_left
			7, // margin right
			25, // margin top
			10, // margin bottom
			25, // margin header
			10
		); // margin footer

		$mpdf->useTemplate($tplId, 0, 0, 297, 210);

		$header = '<div class="row">
						<div class="dirjen">
							DIREKTORAT JENDERAL PERHUBUNGAN DARAT
						</div>
						<span class="sub-title">Laporan Harian SPDA</span>
					</div>';
		$mpdf->setAutoTopMargin = 'stretch';
		$mpdf->setHTMLHeader($header);
		$mpdf->WriteHTML($html);

		$filename = $view . '-' . date('d-m-Y') . '.pdf';
		$this->response->setHeader('Cache-Control', 'private');
		$this->response->setHeader('Content-Type', 'application/pdf');

		ob_clean();
		$rs = $mpdf->Output($filename, 'I'); // INLINE 
		echo $rs;
		die;
	}

	protected function _sendNotification($fcm, $title, $body, $data = null)
	{
		$json_data = [
			"to" => $fcm,
			"notification" => [
				"title" => $title,
				"body" => $body,
				"icon" => "ic_launcher"
			],
			"data" => $data
		];

		$data = json_encode($json_data);
		//FCM API end-point
		$url = 'https://fcm.googleapis.com/fcm/send';
		//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
		$server_key = '';
		//header with content_type api key
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key=' . $server_key
		);

		//CURL request to route notification to FCM connection server (provided by Google)
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);

		if ($result === FALSE) {
			die('Oops! FCM Send Error: ' . curl_error($ch));
		}

		curl_close($ch);

		return $result;
	}

	protected function _initTokenHubdat()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => getenv('service.hubdat') . '/token',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic ' . getenv('service.hubdat.basic'),
				'Content-Type: application/x-www-form-urlencoded'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		return json_decode($response, true);
	}

	protected function _initTokenTemanBus()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => getenv('service.temanbus') . '/user/login',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{"email" : "bagren@gmail.com", "password" : "temanbus123!"}',
			CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
		));

		$response = json_decode(curl_exec($curl), true);
		$this->token = @$response["data"]["token"];

		curl_close($curl);

		return $response;
	}

	protected function _postTemanBus($url, $data)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => getenv('service.temanbus') . $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
			CURLOPT_HTTPHEADER => array('Authorization: ' . $this->token . ''),
		));

		$response = json_decode(curl_exec($curl), true);

		curl_close($curl);

		if (@$response["error"]["error_code"] == "E000001") {
			$this->_initTokenTemanBus();

			return $this->_postTemanBus($url, $data);
		} else {
			return $response;
		}
	}

	protected function _postEasyGo($url, $data)
	{
		$token = ['tokenSBY' => getenv('service.easygo.tokenSBY'), 'tokenBDG' => getenv('service.easygo.tokenBDG')];
		foreach ($token as $key => $value) {
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => getenv('service.easygo') . $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => $data,
				CURLOPT_HTTPHEADER => array(
					'accept: application/json',
					'token: ' . $value . '',
					'Content-Type: application/json'
				),
			));

			$response = json_decode(curl_exec($curl), true);

			curl_close($curl);

			if (@$response["ResponseCode"] == "0") {
				return $response['ResponseMessage'];
			} else {
				return $response;
			}
		}
		
		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		// 	CURLOPT_URL => getenv('service.easygo') . $url,
		// 	CURLOPT_RETURNTRANSFER => true,
		// 	CURLOPT_ENCODING => '',
		// 	CURLOPT_MAXREDIRS => 10,
		// 	CURLOPT_TIMEOUT => 0,
		// 	CURLOPT_FOLLOWLOCATION => true,
		// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 	CURLOPT_CUSTOMREQUEST => 'POST',
		// 	CURLOPT_POSTFIELDS => $data,
		// 	CURLOPT_HTTPHEADER => array(
		// 		'accept: application/json',
		// 		'token: ' . getenv('service.easygo.tokenSBY') . '',
		// 		'Content-Type: application/json'
		// 	),
		// ));

		// $response = json_decode(curl_exec($curl), true);

		// curl_close($curl);

		// if (@$response["ResponseCode"] == "0") {
		// 	return $response['ResponseMessage'];
		// } else {
		// 	return $response;
		// }
	}

	protected function _getTemanBus($url)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => getenv('service.temanbus') . $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
			CURLOPT_HTTPHEADER => array('Authorization: ' . $this->token . ''),
		));

		$response = json_decode(curl_exec($curl), true);

		curl_close($curl);

		if (@$response["error"]["error_code"] == "E000001") {
			$this->_initTokenTemanBus();

			return $this->_getTemanBus($url);
		} else {
			return $response;
		}
	}

	protected function jsonGetRoutesfromPoints2($points)
	{
		$curl = curl_init();
		$uri = service('uri');
		//echo $uri->getSegment(3);
		// if($uri->getSegment(3)=='' ){
		//     $points = '110.492726,-7.0177303|110.492726,-7.0177303';
		// }
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://gps.brtnusantara.com/dev/api/route?points=' . urlencode($points),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic bmdpOm5naXJheWE='
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}

	protected function _httpPost($url, $data)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
			// CURLOPT_HTTPHEADER => array('Authorization: ' . $this->token . ''),
		));

		$response = json_decode(curl_exec($curl), true);

		curl_close($curl);

		return $response;
	}

	protected function _akapPost($data, $action, $module)
	{
		$curl = curl_init();
		$dataPost = array();
		$dataPost["action"] = $action;
		$dataPost["module"] = $module;
		$dataPost["data"] = $data;

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://webhook.hubdat.dephub.go.id/ingest/QliAae9aOAzl6BOa',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($dataPost),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'secret-key: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOiJ6ODd5cU9HSEtLIiwiZXhwIjoxNzAwMTE5NDY5fQ.AIJmWjDiQP2Wnei7BC7XrJY-VKiCo4cVWFhpW41kpG0'
			),
		));

		$response = json_decode(curl_exec($curl), true);
		curl_close($curl);

		return $response;
	}

	function sendBroadcastNotification($fcmArray, $header, $deskripsi)
	{
		$title = $header;
		$body = "" . $deskripsi . "";

		$datanya = array(
			'header'		=> $header,
			'deskripsi'		=> $deskripsi
		);
		$json_data = [
			"registration_ids" => $fcmArray,
			"notification" => [
				"title" => $title,
				"body" => $body,
				"sound" => "default"
			],
			"data" => $datanya
		];

		$dataSend = json_encode($json_data);
		//FCM API end-point
		$url = 'https://fcm.googleapis.com/fcm/send';
		//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
		$server_key = 'AAAAzdnMDpk:APA91bHGqr46b8DXtkEnV1D_quks7zEImJwlSkDBXpt1NjMmgZgnc0K987tBlX3b8HgAppbCwkZ0RSK2HLEUVJMMcw5PozRy-rFCwuV8pwsrQg-XfCi6OlFxVt27Jr3aHB-23teNYRgl';
		//header with content_type api key
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key=' . $server_key
		);

		//CURL request to route notification to FCM connection server (provided by Google)
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataSend);
		$responsenya = curl_exec($ch);
		//Close request
		if ($responsenya === FALSE) {

			die('FCM Send Error: ' . curl_error($ch));
		}
		if (!curl_errno($ch)) {
			$info = curl_getinfo($ch);
		}
		curl_close($ch);
	}
}
