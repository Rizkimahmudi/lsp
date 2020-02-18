<?php
use Illuminate\Database\Capsule\Manager as Capsule;
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranController extends MY_HomeController {
	private $limit = 25;
	private $page = 1;
	private $search = [];
	
	
	function __construct(){
		parent::__construct();
		$this->load->model([
			'lsp_mahasiswa',
			'lsp_mitra',
			'lsp_pendaftaran',
			'lsp_skema',
			'lsp_jns_daftar'
		]);
		$this->load->library(['tables','form_validation']);
		$this->checkLogin(['admin']);
	}
	
	function index(){
		$pendaftar = false;
		
		// jika diklik tombol daftar, 
		if (isPost()){
			// melakukan validasi terhadap inputan yang dimasukkan
			$this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required');
			$this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'required');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('almt_rmh', 'Alamat Rumah', 'required');
			$this->form_validation->set_rules('kd_pos', 'Kode Pos', 'required');
			$this->form_validation->set_rules('telp_rumah', 'Telp Rumah', 'required');
			$this->form_validation->set_rules('telp_hp', 'No Handphone', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			
			// khusus penambahan tipe validasi jika yang diinputkan adalah tipe mitra
			if (post('type') == 'mitra'){
				$this->form_validation->set_rules('kebangsaan', 'Kebangsaan', 'required');
				$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'required');
			}
			
			// 6. menjalankan validasi
			if ($this->form_validation->run() != false){
				// update table master mahasiswa/mitra
				// proses jika tipenya mahasiswa
				if (post('type') == 'mahasiswa'){
					$_mhs = lsp_mahasiswa::where('NRP', $this->input->post('id_detail_pendaftar', TRUE))->first();
					$_mhs->nm_mahasiswa = $this->input->post('nm_lengkap', TRUE);
					$_mhs->alamat_mhs = $this->input->post('almt_rmh', TRUE);
					$_mhs->tempat_lahir = $this->input->post('tmpt_lahir', TRUE);
					$_mhs->tgl_lahir = $this->input->post('tgl_lahir', TRUE);
					$_mhs->jk_mhs = $this->input->post('jk', TRUE);
					$_mhs->telp_hp = $this->input->post('telp_hp', TRUE);
					$_mhs->email = $this->input->post('email', TRUE);
					$_mhs->kodepos = $this->input->post('kd_pos', TRUE);
					$_mhs->telp_rumah = $this->input->post('telp_rumah', TRUE);
					$_mhs->save();
					$id_detail_pendaftar = $_mhs->NRP;
				} else {
				// proses penambahan jika tipenya adalah mitra	
					if (post('id_detail_pendaftar') != '')
						$_mitra = lsp_mitra::where('id_mitra', $this->input->post('id_detail_pendaftar', TRUE))->first();
					else 
						$_mitra = new lsp_mitra();
					$_mitra->nm_mitra = $this->input->post('nm_lengkap', TRUE);
					$_mitra->alamat_mitra = $this->input->post('almt_rmh', TRUE);
					$_mitra->telp_mitra = $this->input->post('telp_rumah', TRUE);
					$_mitra->tmpt_lahir = $this->input->post('tmpt_lahir', TRUE);
					$_mitra->tgl_lahir = $this->input->post('tgl_lahir', TRUE);
					$_mitra->jk_mitra = $this->input->post('jk', TRUE);
					$_mitra->kebangsaan = $this->input->post('kebangsaan', TRUE);
					$_mitra->kd_pos = $this->input->post('kd_pos', TRUE);
					$_mitra->telp_hp = $this->input->post('telp_hp', TRUE);
					$_mitra->email = $this->input->post('email', TRUE);
					$_mitra->pendidikan_terakhir = $this->input->post('pendidikan_terakhir', TRUE);
					$_mitra->work_nm_lembaga = $this->input->post('work_nm_lembaga', TRUE);
					$_mitra->work_jabatan = $this->input->post('work_jabatan', TRUE);
					$_mitra->work_alamat = $this->input->post('work_alamat', TRUE);
					$_mitra->work_kd_pos = $this->input->post('work_kd_pos', TRUE);
					$_mitra->work_telp = $this->input->post('work_telp', TRUE);
					$_mitra->work_fax = $this->input->post('work_fax', TRUE);
					$_mitra->work_email = $this->input->post('work_email', TRUE);
					$_mitra->save();
					$id_detail_pendaftar = $_mitra->id_mitra;
				}
				
				// insert kedalam table pendaftaran
				$_pendaftar = new lsp_pendaftaran();
				$_pendaftar->id_pendaftaran = $this->input->post('kode_next');
				$_pendaftar->id_detail_pendaftar = $id_detail_pendaftar; //$_mitra->id_mitra
				$_pendaftar->tgl_daftar 	= date('Y-m-d');
				$_pendaftar->id_skema 		= $this->input->post('id_skema', TRUE);
				$_pendaftar->id_jns_daftar 	= $this->input->post('id_jns_daftar', TRUE);
				$_pendaftar->tipe 			= $this->input->post('type', TRUE);
				$_pendaftar->save();
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>ADD NEW</strong> pendaftaran dengan nama <strong>"' . post('nm_lengkap') . '"</strong>');
				redirect(url('pendaftaran'));	
			} else {
				$pendaftar = post();
				$pendaftar['id'] = post('id_detail_pendaftar');
				$pendaftar['tipe'] = post('type');
			}
		}
		
		if (isPost()){
			// mengampil pilihan pendaftaran, dan histori dari pendaftarn, jika dia sudah mengikuti pendaftaran awal, maka nantinya pilihn pendaftaran awal tidak bisa dipilih
			$jenis_daftar_option = lsp_jns_daftar::orderBy('id_jns_daftar', 'ASC')->get()->toArray();
			// $skema_option = lsp_skema::orderBy('nm_skema', 'ASC')->get()->toArray();
			// $history = $this->_historyPendaftaran($this->input->post('id'), 'mahasiswa');
			$history = $this->_historyPendaftaran($this->input->post('id'), $this->input->post('type', TRUE));
		} else {
			$jenis_daftar_option = [];
			// $skema_option = [];
			$history = false;
		}
		
		$skema_option = lsp_skema::orderBy('nm_skema', 'ASC')->get()->toArray();
		
		// menyiapkan data untuk ditampilkan pada view
		$data = [
			'title'				=> 'Pendaftaran',
			'header_title'		=> 'Pendaftaran',
			'header_sub'		=> 'Register here',
			'active_menu'		=> ['pendaftaran'],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'js/custom/pendaftaran.js'
			],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'pendaftaran', 'text'	=> 'Pendaftaran', 'class'	=> 'fa fa-list-alt'], 
			],
			'form'			=> $this->load->view($this->config->item('layout'). '/pendaftaran/_form_pendaftaran', ['pendaftar' => $pendaftar, 'jenis_daftar_option'=>$jenis_daftar_option, 'history'=>$history], TRUE),
			'skema_option'  => $skema_option,
            'flash_message' => $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
		];
		
		// meampilkan view, beserta data2 yang sudah diset sebelumnya,
		$this->render('pendaftaran/index', $data);		
	}
	
	function remote(){
		if (isAjax() && isPost()){
			switch (post('action')) { 
				case 'get-nrp' :
					$mhs = lsp_mahasiswa::select(Capsule::raw('NRP as id, NRP as name'))
								->whereRaw("CAST(NRP as CHAR) LIKE '".post('query')."%'")
								//->take(10)
								->take(1)
								->get();
					if ($mhs)
						$mhs = $mhs->toArray();
					else 
						$mhs = [];
					
					foreach ($mhs as $k=>$v)
						$mhs[$k]['name'] = (String)$v['name'];
					echo json_encode($mhs);
				break;
				case 'get-mitra-suggest' :
					$mitra = lsp_mitra::select(Capsule::raw('id_mitra as id, nm_mitra as name'))
							->where("nm_mitra",'LIKE', "%".post('query')."%")
							//->take(10)
							->take(10)
							->get();
					if ($mitra)
						$mitra = $mitra->toArray();
					else 
						$mitra = [];
					
					foreach ($mitra as $k=>$v)
						$mitra[$k]['name'] = (String)$v['name'];	
					echo json_encode($mitra);
				break;
				case 'get-mhs' :
					$mhs = lsp_mahasiswa::where('NRP', $this->input->post('id', TRUE))
									->first()->toArray();
					
					$jenis_daftar_option = lsp_jns_daftar::orderBy('id_jns_daftar', 'ASC')->get()->toArray();
					
					$kode_next = str_replace('[ID]',(lsp_pendaftaran::count() + 1), $this->kode_pendaftaran);
					$history = $this->_historyPendaftaran($this->input->post('id'), 'mahasiswa');
					// echoPre($history);
					//inisialisasi
					$mhs = [
						'id'                  => $mhs['NRP'],
						'kode_next'           => $kode_next,
						'id_detail_pendaftar' => $mhs['NRP'],
						'tipe'                => 'mahasiswa',
						'nm_lengkap'          => $mhs['nm_mahasiswa'],
						'tmpt_lahir'          => $mhs['tempat_lahir'],
						'tgl_lahir'           => $mhs['tgl_lahir'],
						'jk'                  => $mhs['jk_mhs'],
						'almt_rmh'            => $mhs['alamat_mhs'],
						'kd_pos'              => $mhs['kodepos'],
						'telp_rumah'          => $mhs['telp_rumah'],
						'telp_hp'             => $mhs['telp_hp'],
						'email'               => $mhs['email'],
					];
									
					$ret = [
						'status'      => 'success',
						'html'        => $this->load->view($this->config->item('layout').'/pendaftaran/_form_pendaftaran', 
								[
									'pendaftar'           => $mhs, 
									'jenis_daftar_option' => $jenis_daftar_option, 
									'kode_next'           => $kode_next, 
									'history'             => $history,
									'id_skema'            => post('id_skema')
								]
								, TRUE)
					];
					echo json_encode($ret);
				break;
				case 'get-mitra' :
					if (post('id') != 'false' && post('id'))
						$mitra = lsp_mitra::where('id_mitra', $this->input->post('id',TRUE))->first()->toArray();
					else
						$mitra = [];					
					
					$jenis_daftar_option = lsp_jns_daftar::orderBy('id_jns_daftar', 'ASC')->get()->toArray();
					
					$kode_next = str_replace('[ID]',(lsp_pendaftaran::count() + 1), $this->kode_pendaftaran);
					$history = $this->_historyPendaftaran($this->input->post('id'), 'mitra');
					
					$mitra = [
						'id'                  => @$mitra['id_mitra'],
						'kode_next'           => $kode_next,
						'id_detail_pendaftar' => @$mitra['id_mitra'],
						'tipe'                => 'mitra',
						'nm_lengkap'          => @$mitra['nm_mitra'],
						'tmpt_lahir'          => @$mitra['tmpt_lahir'],
						'tgl_lahir'           => @$mitra['tgl_lahir'],
						'jk'                  => @$mitra['jk_mitra'],
						'almt_rmh'            => @$mitra['alamat_mitra'],
						'kd_pos'              => @$mitra['kd_pos'],
						'telp_rumah'          => @$mitra['telp_mitra'],
						'telp_hp'             => @$mitra['telp_hp'],
						'email'	              => @$mitra['email'],
						'pendidikan_terakhir' => @$mitra['pendidikan_terakhir'],
						'kebangsaan'          => @$mitra['kebangsaan'],
						'work_nm_lembaga'     => @$mitra['work_nm_lembaga'],
						'work_jabatan'        => @$mitra['work_jabatan'],
						'work_alamat'         => @$mitra['work_alamat'],
						'work_kd_pos'         => @$mitra['work_kd_pos'],
						'work_telp'           => @$mitra['work_telp'],
						'work_fax'            => @$mitra['work_fax'],
						'work_email'          => @$mitra['work_email'],
					];
					$ret = [
						'status'	=> 'success',
						'html'	=> $this->load->view($this->config->item('layout').'/pendaftaran/_form_pendaftaran', ['pendaftar' => $mitra, 'jenis_daftar_option'=>$jenis_daftar_option,'kode_next'=>$kode_next, 'history'=>$history, 'id_skema' => post('id_skema')], TRUE)
					];
					echo json_encode($ret);
				break;
			}
		}
	}	
}
?>