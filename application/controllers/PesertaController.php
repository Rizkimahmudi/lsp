<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesertaController extends MY_HomeController {	
	function __construct(){
		parent::__construct();
		$this->load->model([
			'lsp_admin',
			'lsp_mahasiswa',
			'lsp_mitra',
			'lsp_pendaftaran',
			'lsp_skema',
			'lsp_jns_daftar'
		]);
		$this->load->library(['tables','form_validation']);
		$this->checkLogin(['peserta']);
	}
	
	function index($edit=false){
		$login = $this->login;
		$tipe = explode('-', $login['id_detail'])[0];
		$id = explode('-', $login['id_detail'])[1];
		
		$tipe = $tipe=='mhs' ? 'mahasiswa' : $tipe;
		if ($tipe == 'mahasiswa'){
			$peserta = lsp_mahasiswa::where('NRP', $id)->first();
		} else {
			$peserta = lsp_mitra::where('id_mitra', $id)->first();
		}
		$form = $this->_buildForm($peserta, $tipe, $edit);
		
		$rows = lsp_pendaftaran::where('tipe', '=', $tipe)
					->where('id_detail_pendaftar', '=', $id)
					->where('status', '<>', '9')
					->with('skema')
					->with('jenis_daftar')
					//nambah 2
					// ->where('id_detail_pendaftar', '=', $peserta['NRP'] ['id_mitra'])
					// ->where('id_detail_pendaftar', '=', $peserta['id_mitra'])
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$_label = [
			1 => 'label-default',
			2 => 'label-info',
			3 => 'label-primary',
			4 => 'label-success',
			5 => 'label-danger',
		];
		
		$i = 1;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i;
			$rows[$k]['tanggal'] = date('j F Y', strtotime($v['tgl_daftar']));
			$rows[$k]['nm_skema'] = $v['skema']['nm_skema'];
			$rows[$k]['nm_jns_daftar'] = $v['jenis_daftar']['nm_jns_daftar'];
			$rows[$k]['status'] = '<label class="label '. $_label[$v['status']] .'">'. $this->config->item('status_pendaftaran')[$v['status']] .'</label>';
			$rows[$k]['formulir'] = '<a href="'. url('formulir/'. $v['id_pendaftaran']) .'" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-save"></i></a>';
			$i++;
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Tanggal Daftar', 'data' => 'tanggal', 'width' => '150px'),
            array('header' => 'Skema', 'data' => 'nm_skema', 'width' => '250px'),
            array('header' => 'Jenis Daftar', 'data' => 'nm_jns_daftar', 'width' => '150px'),
            array('header' => 'Status', 'data' => 'status', 'width' => '150px'),
			array('header' => 'Save', 'data' => 'formulir', 'width' => '100px')
		);
		
        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$data = [
			'title'				=> 'Profile - '. $this->login['nm_admin'] .' - LSP STIKI',
			'header_title'		=> 'Profile',
			'header_sub'		=> 'Manage Profil peserta !',
			'active_menu'		=> ['profile'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'profile', 'text'	=> 'Profile', 'class'	=> 'fa fa-user'], 
			],
			'peserta'			=> $peserta,
			'table'				=> $table,
			'form'              => $form,
			'id'                => $id,
			'tipe'              => $tipe,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
		];
		
		$this->render('profile/index', $data);
	}
	
	function _buildForm($peserta, $tipe, $edit){
		
		if (isPost()){
			if ($tipe == 'mahasiswa'){
				$this->form_validation->set_rules('alamat_mhs', 'Alamat', 'required');
				$this->form_validation->set_rules('kodepos', 'Kodepos', 'required|numeric|trim');
				$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
				$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
				$this->form_validation->set_rules('jk_mhs', 'Jenis Kelamin', 'required');
				$this->form_validation->set_rules('telp_hp', 'No Handphone', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('telp_rumah', 'Telepon Rumah', 'required');
				// $this->form_validation->set_rules('kantor', 'Telepon Kantor', 'required');
				
				if ($this->form_validation->run() != FALSE){
					$savePassword = post('password') ? TRUE : FALSE;
					
					$peserta->alamat_mhs 		= $this->input->post('alamat_mhs');
					$peserta->kodepos 			= $this->input->post('kodepos');
					$peserta->tempat_lahir 		= $this->input->post('tempat_lahir');
					$peserta->tgl_lahir 		= $this->input->post('tgl_lahir');
					$peserta->jk_mhs 			= $this->input->post('jk_mhs');
					$peserta->telp_hp 			= $this->input->post('telp_hp');
					$peserta->email 			= $this->input->post('email');
					$peserta->telp_rumah 		= $this->input->post('telp_rumah');
					$peserta->agama 		    = $this->input->post('agama');
					// $peserta->kantor 			= $this->input->post('kantor');
					$peserta->save();
					
					//save password
					if ($savePassword){
						$admin = lsp_admin::firstOrNew(['id_detail' => 'mhs-'. $peserta['NRP']]);
						$admin->nm_admin = $peserta['nm_mahasiswa'];
						$admin->password = md5(post('password'));
						$admin->id_admin = $peserta['NRP'];
						$admin->status = 'peserta';
						$admin->save();
					}
					
					$this->session->set_flashdata('status', 'success');	
					$this->session->set_flashdata('text', 'Success <strong>UPDATE</strong> profile');
					redirect(url('profile'));				
				} else 
					$peserta = post();
			} 
			
			if ($tipe == 'mitra'){
				$this->form_validation->set_rules('nm_mitra', 'Nama', 'required');
				$this->form_validation->set_rules('alamat_mitra', 'Alamat', 'required');
				$this->form_validation->set_rules('kd_pos', 'Kodepos', 'required|numeric|trim');
				$this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'required');
				$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
				$this->form_validation->set_rules('jk_mitra', 'Jenis Kelamin', 'required');
				$this->form_validation->set_rules('telp_hp', 'No Handphone', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('telp_mitra', 'Telepon Rumah', 'required');
				$this->form_validation->set_rules('kebangsaan', 'Kebangsaan', 'required');
				
				$this->form_validation->set_rules('work_nm_lembaga', 'Nama Lembaga', 'required');
				$this->form_validation->set_rules('work_jabatan', 'Jabatan', 'required');
				$this->form_validation->set_rules('work_alamat', 'Alamat', 'required');
				$this->form_validation->set_rules('work_kd_pos', 'Kode Pos', 'required|numeric|trim');
				$this->form_validation->set_rules('work_telp', 'Telp', 'required');
				$this->form_validation->set_rules('work_fax', 'Fax', 'required');
				$this->form_validation->set_rules('work_email', 'Email', 'valid_email');
				
				if ($this->form_validation->run()){
					$savePassword = post('password') ? TRUE : FALSE;
					
					$peserta->nm_mitra = post('nm_mitra');
					$peserta->alamat_mitra = post('alamat_mitra');
					$peserta->telp_mitra = post('telp_mitra');
					$peserta->tmpt_lahir = post('tmpt_lahir');
					$peserta->tgl_lahir = post('tgl_lahir');
					$peserta->jk_mitra = post('jk_mitra');
					$peserta->kebangsaan = post('kebangsaan');
					$peserta->kd_pos = post('kd_pos');
					$peserta->telp_hp = post('telp_hp');
					$peserta->email = post('email');
					$peserta->pendidikan_terakhir = post('pendidikan_terakhir');
					$peserta->work_nm_lembaga = post('work_nm_lembaga');
					$peserta->work_jabatan = post('work_jabatan');
					$peserta->work_alamat = post('work_alamat');
					$peserta->work_kd_pos = post('work_kd_pos');
					$peserta->work_telp = post('work_telp');
					$peserta->work_fax = post('work_fax');
					$peserta->work_email = post('work_email');
					
					$peserta->save();
					
					//save password
					if ($savePassword){
						$admin = lsp_admin::firstOrNew(['id_detail' => 'mitra-'. $peserta['id_mitra']]);
						$admin->nm_admin = $peserta['nm_mitra'];
						$admin->password = md5(post('password'));
						$admin->status = 'peserta';
						$admin->save();
					}
					
					$this->session->set_flashdata('status', 'success');	
					$this->session->set_flashdata('text', 'Success <strong>UPDATE</strong> profile');
					redirect(url('profile'));	
				} else {
					$mitra = post();
				}
			}
		}
		
		$data = [
			'peserta'       => $peserta,
			'edit'          => $edit,
		];
		
		return $this->load->view($this->config->item('layout').'/profile/_form_'.$tipe, $data, TRUE);
	}
	
	function daftar(){
		$tipe = explode('-', $this->login['id_detail']);
		$id   = $tipe[1];
		$tipe = $tipe[0] == 'mhs' ? 'mahasiswa' : 'mitra';
		
		$skema_option = lsp_skema::orderBy('nm_skema', 'ASC')->get()->toArray();
		
		if (isPost()){
			// 4. melakukan validasi terhadap inputan yang dimasukkan
			$this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required');
			$this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'required');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('almt_rmh', 'Alamat Rumah', 'required');
			$this->form_validation->set_rules('kd_pos', 'Kode Pos', 'required');
			$this->form_validation->set_rules('telp_rumah', 'Telp Rumah', 'required');
			$this->form_validation->set_rules('telp_hp', 'No Handphone', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			
			// 5. khusus penambahan tipe validasi jika yang diinputkan adalah tipe mitra
			if (post('type') == 'mitra'){
				$this->form_validation->set_rules('kebangsaan', 'Kebangsaan', 'required');
				$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'required');
			}
			
			// 6. menjalankan validasi
			if ($this->form_validation->run() != false){
				// update table master mahasiswa/mitra
				// proses jika tipenya mahasiswa
				if ($tipe == 'mahasiswa'){
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
				$_pendaftar->tipe 			= $tipe;
				$_pendaftar->save();
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>ADD NEW</strong> pendaftaran dengan nama <strong>"' . post('nm_lengkap') . '"</strong>');
				redirect(url('profile'));	
			} else {
				$pendaftar = post();
				$pendaftar['id'] = post('id_detail_pendaftar');
				$pendaftar['tipe'] = post('type');
			}
		}
		
		if ($tipe == 'mahasiswa'){
			$mhs = lsp_mahasiswa::where('NRP', $id)->first();
			$jenis_daftar_option = lsp_jns_daftar::orderBy('id_jns_daftar', 'ASC')->get()->toArray();
			
			$kode_next = str_replace('[ID]',(lsp_pendaftaran::count() + 1), $this->kode_pendaftaran);
			$history = $this->_historyPendaftaran($id, 'mahasiswa');
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
			
			$_data = [
				'pendaftar'           => $mhs, 
				'jenis_daftar_option' => $jenis_daftar_option, 
				'kode_next'           => $kode_next, 
				'history'             => $history,
				'id_skema'            => get('id_skema', $skema_option[0]['id_skema'])
			];
							
			$form = $this->load->view($this->config->item('layout').'/daftar/_form_pendaftaran',$_data, TRUE);
		} else {
			$mitra = lsp_mitra::where('id_mitra', $id)->first()->toArray();				
			
			$jenis_daftar_option = lsp_jns_daftar::orderBy('id_jns_daftar', 'ASC')->get()->toArray();
			
			$kode_next = str_replace('[ID]',(lsp_pendaftaran::count() + 1), $this->kode_pendaftaran);
			$history = $this->_historyPendaftaran($id, 'mitra');
			
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
			
			$_data = [
				'pendaftar'          => $mitra, 
				'jenis_daftar_option'=> $jenis_daftar_option,
				'kode_next'          => $kode_next, 
				'history'            => $history, 
				'id_skema'           => get('id_skema', $skema_option[0]['id_skema'])
			];
			
			$form = $this->load->view($this->config->item('layout').'/daftar/_form_pendaftaran',$_data, TRUE);
		}
				
		// 1. menyiapkan data untuk ditampilkan pada view
		$data = [
			'title'				=> 'Pendaftaran',
			'header_title'		=> 'Pendaftaran',
			'header_sub'		=> 'Register here',
			'active_menu'		=> ['daftar'],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'js/custom/daftar.js',
			],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'daftar', 'text'	=> 'Pendaftaran', 'class'	=> 'fa fa-list-alt'], 
			],
			'form'			=> $form,
			'skema_option'  => $skema_option,
			'id_skema'      => get('id_skema'),
            'flash_message' => $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
		];
		
		// 2. meampilkan view, beserta data2 yang sudah diset sebelumnya,
		$this->render('daftar/index', $data);		
	}
	
}
	