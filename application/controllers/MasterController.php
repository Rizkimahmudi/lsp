<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterController extends MY_HomeController {
	private $limit = 25;
	private $page = 1;
	private $search = [];
	
	function __construct(){
		parent::__construct();
		$this->load->model([
			'lsp_mahasiswa',
			'lsp_asesor',
			'lsp_tuk',
			'lsp_skema',
			'lsp_mitra',
			'lsp_detail_skema',
			'lsp_kompetensi',
			'lsp_dtl_kompetensi',
			'lsp_admin',
			'lsp_jns_daftar',
		]);
		$this->load->library(['tables','form_validation', 'word']);
		$this->checkLogin(['admin']);
	}
	
	public function mahasiswa(){
		// inisialisasi variabel awal, page=halaman, param=parameter untuk link pagination, mahasiswa= untuk data edit mahasiswa
		$this->page = get('page', 1);
		$param = [];		
		$mahasiswa = false;
		
		// echoPre(get());
		//  jika terdapat pencarian pada halaman mahasiswa, setiap parameter get akan dimasukkan kedalam variabel $this->search
		foreach (get() as $k=>$v)
			$this->search[$k] = $v;
		
		if (get('id', false)){
			$mahasiswa = lsp_mahasiswa::where('NRP', $this->input->get('id', TRUE))->first();
			if ($mahasiswa)
				$mahasiswa['id'] = $mahasiswa['NRP'];
		}
		
		if (isPost()){
			$this->form_validation->set_rules('nm_mahasiswa', 'Nama', 'required');
			$this->form_validation->set_rules('alamat_mhs', 'Alamat', 'required');
			$this->form_validation->set_rules('kodepos', 'Kodepos', 'required|numeric|trim');
			$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
			$this->form_validation->set_rules('jk_mhs', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('telp_hp', 'No Handphone', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('telp_rumah', 'Telepon Rumah', 'required');
			// $this->form_validation->set_rules('kantor', 'Telepon Kantor', 'required');
			
			if (!$this->input->post('id'))
				$this->form_validation->set_rules('NRP', 'NRP', 'required|numeric|is_unique[mahasiswa.NRP]');
			
			if ($this->form_validation->run() != FALSE){
				$savePassword = TRUE;
				//edit
				if ($this->input->post('id')){
					$_mhs = lsp_mahasiswa::where('NRP', $this->input->post('NRP', TRUE))->first();
					$savePassword = post('password') != '' ? TRUE : FALSE;
					$password = post('password');
				} else {
					//input
					$_mhs = new lsp_mahasiswa();
					$_mhs->NRP = $this->input->post('NRP');
					
					// $password = post('password', 'password');
					$password = post('password') != '' ? post('password') : 'password';
				}					
				$_mhs->nm_mahasiswa 	= $this->input->post('nm_mahasiswa');
				$_mhs->alamat_mhs 		= $this->input->post('alamat_mhs');
				$_mhs->kodepos 			= $this->input->post('kodepos');
				$_mhs->tempat_lahir 	= $this->input->post('tempat_lahir');
				$_mhs->tgl_lahir 		= $this->input->post('tgl_lahir');
				$_mhs->jk_mhs 			= $this->input->post('jk_mhs');
				$_mhs->telp_hp 			= $this->input->post('telp_hp');
				$_mhs->email 			= $this->input->post('email');
				$_mhs->telp_rumah 		= $this->input->post('telp_rumah');
				$_mhs->agama 		    = $this->input->post('agama');
				// $_mhs->kantor 			= $this->input->post('kantor');
				$_mhs->save();
				
				//save password
				if ($savePassword){
					//ono dipakek update, gak ada di insertkan
					$admin = lsp_admin::firstOrNew(['id_detail' => 'mhs-'. post('NRP')]);
					$admin->nm_admin = post('nm_mahasiswa');
					$admin->password = md5($password);
					$admin->id_admin = post('NRP');
					$admin->status = 'peserta';
					$admin->save();
				}
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>' . (post('id') ? 'UPDATE' : 'ADD NEW') . '</strong> mahasiswa <strong>"' . $_mhs->nm_mahasiswa . '"</strong>');
				redirect(url('setting/mahasiswa'));				
			} else 
				$mahasiswa = post();
		}
		
		// $rows = new lsp_mahasiswa();
		// $rows = lsp_asesor::where('status', 1);
		$rows = lsp_mahasiswa::where('status', 1);
	
		//search
		if (get('k')){
			$rows = $rows->where(get('col'), 'like', '%'.get('k').'%');
			$param['col'] = $this->input->get('col');
			$param['k'] = $this->input->get('k');
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->orderBy('nrp', 'ASC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['nm_mahasiswa'] = strtoupper($v['nm_mahasiswa']);
			//$rows[$k]['jk_mhs']= strtoupper($v['jk_mhs']);
			$rows[$k]['action']	= $this->load->view($this->config->item('layout').'/master/_action', ['action'=>'mahasiswa', 'mahasiswa'=>$v, 'param'=>$param], TRUE);
			$i++;
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'NRP', 'data' => 'NRP', 'width' => '150px'),
            array('header' => 'Nama', 'data' => 'nm_mahasiswa'),
            array('header' => 'Jenis Kelamin', 'data' => 'jk_mhs', 'width' => '150px'),
            array('header' => 'Action', 'data' => 'action', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('setting/mahasiswa/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Mahasiswa - Master Data - LSP STIKI',
			'header_title'		=> 'Master Data',
			'header_sub'		=> 'Manage Mahasiswa data !',
			'active_menu'		=> ['master', 'mahasiswa'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'setting/mahasiswa', 'text'	=> 'Master Mahasiswa', 'class'	=> 'fa fa-users'], 
			],
			'mahasiswa'			=> $rows,
			'total'				=> $total,
			'table'				=> $table,
			'form'				=> $this->load->view($this->config->item('layout'). '/master/_form_mahasiswa', ['mahasiswa'=>$mahasiswa, 'param'=>$param], TRUE),
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('master/mahasiswa', $data);
	}
	
	function asesor(){
		$this->page = get('page', 1);
		$param = [];		
		$asesor = false;
		
		//get 
		foreach (get() as $k=>$v)
			$this->search[$k] = $v;
		
		if (get('id', false)){
			$asesor = lsp_asesor::where('NIP', $this->input->get('id', TRUE))->first();
			if ($asesor)
				$asesor['id'] = $asesor['NIP'];
		}
		
		if (isPost()){
			$this->form_validation->set_rules('nm_asesor', 'Nama', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
			
			if (!$this->input->post('id'))
				$this->form_validation->set_rules('NIP', 'NIP', 'required|numeric|is_unique[asesor.NIP]');
			
			if ($this->form_validation->run() != false){
				if ($this->input->post('id'))
					$_asesor = lsp_asesor::where('NIP', $this->input->post('NIP', TRUE))->first();
				else {
					$_asesor = new lsp_asesor();
					$_asesor->NIP = $this->input->post('NIP');
					$_asesor->status = 1;
				}		
				//post = form , get = url
				$_asesor->nm_asesor 		= $this->input->post('nm_asesor');				
				$_asesor->gelar_depan 		= $this->input->post('gelar_depan');				
				$_asesor->gelar_belakang 	= $this->input->post('gelar_belakang');				
				$_asesor->alamat_asesor 	= $this->input->post('alamat_asesor');				
				$_asesor->telp 				= $this->input->post('telp');				
				$_asesor->email 			= $this->input->post('email');				
				$_asesor->tempat_lhr 		= $this->input->post('tempat_lhr');				
				$_asesor->tgl_lahir 		= $this->input->post('tgl_lahir');				
				$_asesor->agama 			= $this->input->post('agama');				
				$_asesor->jk_asesor 		= $this->input->post('jk_asesor');				
				$_asesor->pend_terakhir 	= $this->input->post('pend_terakhir');				
				$_asesor->no_met 	        = $this->input->post('no_met');				
				$_asesor->save();
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>' . (post('id') ? 'UPDATE' : 'ADD NEW') . '</strong> asesor <strong>"' . $_asesor->nm_asesor . '"</strong>');
				redirect(url('setting/asesor'));				
			} else 
				$asesor = post();
		}
		
		$rows = lsp_asesor::where('status', 1);
		//col = dipilih nrp, nama k=diketik
		if (get('k')){
			$rows = $rows->where(get('col'), 'like', '%'.get('k').'%');
			$param['col'] = $this->input->get('col');
			$param['k'] = $this->input->get('k');
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->orderBy('NIP', 'ASC')
					->get();
		//ada dijadikan array			
		if ($rows)
			$rows = $rows->toArray();
		else 
			//tdk - membut arra bru
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['nama'] = ($v['gelar_depan'] != '' ? $v['gelar_depan'].' ' : '') . $v['nm_asesor'] . ($v['gelar_belakang'] != '' ? ', '. $v['gelar_belakang']: "").'<br/><small class="text-muted"><b>Telp</b>: '.$v['telp'].'</small>';
			$rows[$k]['action']	= $this->load->view($this->config->item('layout').'/master/_action', ['action'=>'asesor', 'asesor'=>$v, 'param'=>$param], TRUE);
			$i++;
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            // array('header' => 'NIP', 'data' => 'NIP', 'width' => '100px'),
            array('header' => 'Nama', 'data' => 'nama'),
            //nmbh nomet	
            array('header' => 'No MET', 'data' => 'no_met'),
            array('header' => 'Jenis Kelamin', 'data' => 'jk_asesor', 'width' => '150px'),
            array('header' => 'Action', 'data' => 'action', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('setting/asesor/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		
		$data = [
			'title'				=> 'Asesor - Master Data - LSP STIKI',
			'header_title'		=> 'Master Data',
			'header_sub'		=> 'Manage Asesor data !',
			'active_menu'		=> ['master', 'asesor'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'setting/asesor', 'text'	=> 'Master Data Asesor', 'class'	=> 'fa fa-users'], 
			],
			'asesor'			=> $rows,
			'total'				=> $total,
			'table'				=> $table,
			'form'				=> $this->load->view($this->config->item('layout'). '/master/_form_asesor', ['asesor'=>$asesor, 'param'=>$param], TRUE),
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		//view tngh	dta seng dikirim k tngh mau
		$this->render('master/asesor', $data);
	}
	
	function tuk(){
		$this->page = get('page', 1);
		$param = [];		
		$tuk = false;
		
		//get 
		foreach (get() as $k=>$v)
			$this->search[$k] = $v;
		
		if (get('id', false)){
			$tuk = lsp_tuk::where('kd_tuk', $this->input->get('id', TRUE))->first();
			if ($tuk)
				$tuk['id'] = $tuk['kd_tuk'];
		}
		
		if (isPost()){
			$this->form_validation->set_rules('nm_tuk', 'Nama', 'required');
			$this->form_validation->set_rules('jns_tuk', 'Jenis', 'required');
			$this->form_validation->set_rules('kapasitas_tuk', 'Kapasitas', 'required|numeric');
			//cek jiks sds id
			if (!$this->input->post('id'))
				//nsmbsh vslidsi ini
				////teko input form is unique
				$this->form_validation->set_rules('kd_tuk', 'Kode', 'required|is_unique[tuk.kd_tuk]');
			
			if ($this->form_validation->run() != false){
				if ($this->input->post('id'))
					$_tuk = lsp_tuk::where('kd_tuk', $this->input->post('id', TRUE))->first();
				else {
					$_tuk = new lsp_tuk();
					$_tuk->kd_tuk = $this->input->post('kd_tuk');
					$_tuk->status = 1;
				}		
				$_tuk->nm_tuk 			= $this->input->post('nm_tuk');					
				$_tuk->jns_tuk 			= $this->input->post('jns_tuk');					
				$_tuk->kapasitas_tuk 	= $this->input->post('kapasitas_tuk');					
				$_tuk->ket_tuk 			= $this->input->post('ket_tuk');					
				$_tuk->save();
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>' . (post('id') ? 'UPDATE' : 'ADD NEW') . '</strong> tempat unjuk kerja <strong>"' . $_tuk->nm_tuk . '"</strong>');
				redirect(url('setting/tuk'));				
			} else 
				$tuk = post();
		}
		
		$rows = lsp_tuk::where('status', 1);
		
		if (get('k')){
			$rows = $rows->where(get('col'), 'like', '%'.get('k').'%');
			$param['col'] = $this->input->get('col');
			$param['k'] = $this->input->get('k');
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->orderBy('nm_tuk', 'ASC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['action']	= $this->load->view($this->config->item('layout').'/master/_action', ['action'=>'tuk', 'tuk'=>$v, 'param'=>$param], TRUE);
			$i++;
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Kode', 'data' => 'kd_tuk', 'width' => '100px'),
            array('header' => 'Nama', 'data' => 'nm_tuk'),
            array('header' => 'Kapasitas', 'data' => 'kapasitas_tuk', 'width' => '100px'),
            array('header' => 'Action', 'data' => 'action', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('setting/tuk/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		
		$data = [
			'title'				=> 'Tempat Unjuk Kerja - Master Data - LSP STIKI',
			'header_title'		=> 'Master Data',
			'header_sub'		=> 'Manage TUK (Tempat Unjuk Kerja) data !',
			'active_menu'		=> ['master', 'tuk'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'setting/tuk', 'text'	=> 'Master Data TUK', 'class'	=> 'fa fa-users'], 
			],
			'tuk'				=> $rows,
			'total'				=> $total,
			'table'				=> $table,
			'form'				=> $this->load->view($this->config->item('layout'). '/master/_form_tuk', ['tuk'=>$tuk, 'param'=>$param], TRUE),
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('master/tuk', $data);
	}
	
	function skema(){
		$this->page = get('page', 1);
		$param = [];		
		$skema = false;
		$detail = false;
		
		//get 
		foreach (get() as $k=>$v)
			$this->search[$k] = $v;
		
		if (get('id', false) && !get('parent')){
			$skema = lsp_skema::where('id_skema', $this->input->get('id', TRUE))->first();
			if ($skema)
				$skema['id'] = $skema['id_skema'];
		}
		
		if (get('id') && get('parent')){
			$detail = lsp_detail_skema::where('id_dt_skema', $this->input->get('id'))
					->where('id_skema', $this->input->get('parent'))
					->first();
			if ($detail)
				//jika terdapat data maka menambahakan array id dari primary yaitu SKELA detail
				$detail['id'] = $detail['id_dt_skema'];
		}
		
		
		if (isPost()){
			if (post('type') == 'detail') {
				$this->form_validation->set_rules('kd_unit', 'Kode Unit', 'required');
				$this->form_validation->set_rules('jdl_kompetensi', 'Judul Kompetensi', 'required');
				$this->form_validation->set_rules('id_skema', 'Skema', 'required');
				$this->form_validation->set_rules('order', 'Order', 'required');
				
				if ($this->form_validation->run() != false){
					if ($this->input->post('id'))
						$_detail = lsp_detail_skema::where('id_dt_skema', $this->input->post('id', TRUE))->first();
					else 
						$_detail = new lsp_detail_skema();

					$_detail->kd_unit 			= $this->input->post('kd_unit', TRUE);
					$_detail->jdl_kompetensi 	= $this->input->post('jdl_kompetensi', TRUE);
					$_detail->id_skema 			= $this->input->post('id_skema', TRUE);
					$_detail->order				= $this->input->post('order', TRUE);
					$_detail->save();
					
					$this->session->set_flashdata('status', 'success');	
					$this->session->set_flashdata('text', 'Success <strong>' . (post('id') ? 'UPDATE' : 'ADD NEW') . '</strong> detail skema dengan nama <strong>"' . $_detail->jdl_kompetensi . '"</strong>');
					redirect(url('setting/skema'));		
				} else 
					$detail = post();
					//GAK DETAIL
			} else {
				$this->form_validation->set_rules('nm_skema', 'Nama', 'required');
			
				if ($this->form_validation->run() != false){
					if ($this->input->post('id'))
						$_skema = lsp_skema::where('id_skema', $this->input->post('id', TRUE))->first();
					else 
						$_skema = new lsp_skema();
					$_skema->nm_skema 			= $this->input->post('nm_skema');						
					$_skema->save();
					
					$this->session->set_flashdata('status', 'success');	
					$this->session->set_flashdata('text', 'Success <strong>' . (post('id') ? 'UPDATE' : 'ADD NEW') . '</strong> skema dengan nama <strong>"' . $_skema->nm_skema . '"</strong>');
					redirect(url('setting/skema'));				
				} else 
					$skema = post();
			}
			
		}		
		
		if (get('k')){
			$rows = lsp_skema::where('nm_skema', 'like', '%'.$this->input->get('k').'%')
						//eloquent lebih dari satu kondisi
						->orWhere(function($query){
							//JOIN tabel  ada di function detail - lspskema
							$query->whereHas('detail', function($q){
								$q->where('jdl_kompetensi', 'like', '%'.$this->input->get('k').'%');
								$q->orwhere('kd_unit', 'like', '%'.$this->input->get('k').'%');
							});
						});
			$param['k'] = $this->input->get('k');
		} else 
			// $rows = new lsp_skema(); fu2
		$rows = lsp_skema::where('status', 1);
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->orderBy('id_skema', 'ASC')
					->with('detail')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('setting/skema/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		if (get('parent') || post('type') == 'detail')
			$skema_option = lsp_skema::get()->toArray();
		
		$data = [
			'title'				=> 'Skema - Master Data - LSP STIKI',
			'header_title'		=> 'Master Data',
			'header_sub'		=> 'Manage Skema data !',
			'active_menu'		=> ['master', 'skema'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'setting/skema', 'text'	=> 'Master Data Skema', 'class'	=> 'fa fa-file'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/skema.js'
			],
			'skema'				=> $rows,
			'total'				=> $total,
			'form'				=> get('parent') || post('type') == 'detail' ? $this->load->view($this->config->item('layout'). '/master/_form_detail_skema', ['detail'=>$detail, 'param'=>$param, 'skema_option'=>$skema_option], TRUE) : $this->load->view($this->config->item('layout'). '/master/_form_skema', ['skema'=>$skema, 'param'=>$param], TRUE),
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('master/skema', $data);
	}
	
	function mitra(){
		$this->page = get('page', 1);
		$param = [];		
		$mitra = false;
		
		if (get('id')){
			$mitra = lsp_mitra::where('id_mitra', '=', get('id'))->first()->toArray();
			$_login = lsp_admin::where('id_detail', '=', 'mitra-'. $mitra['id_mitra'])->first();
			if ($_login)
				foreach ($_login->toArray() as $k=>$v){
					$mitra[$k] = $v;
				}
			$mitra['username'] = @$mitra['id_admin'];
			$mitra['id'] = $mitra['id_mitra'];
			
		}
		
		if (isPost()){
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
			
			if (post('id_admin') == ''){
				$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash|is_unique[admin.id_admin]|trim');
				$this->form_validation->set_rules('password', 'Password', 'required');
			}
			
			if ($this->form_validation->run()){
				
				if (post('id') != ''){
					$_mitra = lsp_mitra::where('id_mitra', '=', post('id'))->first();
					$_user = lsp_admin::firstOrNew(['id_detail' => 'mitra-'. $_mitra['id_mitra']]);
					$_user->id_admin = post('username');
				} else {
					$_mitra = new lsp_mitra();
					$_user = new lsp_admin();
					$_user->id_admin = post('username');
				}
				$_mitra->nm_mitra = post('nm_mitra');
				$_mitra->alamat_mitra = post('alamat_mitra');
				$_mitra->telp_mitra = post('telp_mitra');
				$_mitra->tmpt_lahir = post('tmpt_lahir');
				$_mitra->tgl_lahir = post('tgl_lahir');
				$_mitra->jk_mitra = post('jk_mitra');
				$_mitra->kebangsaan = post('kebangsaan');
				$_mitra->kd_pos = post('kd_pos');
				$_mitra->telp_hp = post('telp_hp');
				$_mitra->email = post('email');
				$_mitra->pendidikan_terakhir = post('pendidikan_terakhir');
				$_mitra->work_nm_lembaga = post('work_nm_lembaga');
				$_mitra->work_jabatan = post('work_jabatan');
				$_mitra->work_alamat = post('work_alamat');
				$_mitra->work_kd_pos = post('work_kd_pos');
				$_mitra->work_telp = post('work_telp');
				$_mitra->work_fax = post('work_fax');
				$_mitra->work_email = post('work_email');
				
				$_mitra->save();
				
				if (post('password') != ''){
					$_user->id_detail = 'mitra-'.$_mitra->id_mitra;
					$_user->nm_admin = post('nm_mitra');
					$_user->password = md5(post('password'));
					$_user->status = 'peserta';
					$_user->save();
				}
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>' . (post('id') ? 'UPDATE' : 'ADD NEW') . '</strong> mitra <strong>"' . $_mitra->nm_mitra . '"</strong>');
				redirect(url('setting/mitra'));	
				
			} else {
				$mitra = post();
			}
		}
		
		//get 
		foreach (get() as $k=>$v)
			$this->search[$k] = $v;
		
		// $rows = new lsp_mitra(); fu1
		$rows = lsp_mitra::where('status', 1);

		if (get('k')){
			$rows = $rows->where('nm_mitra', 'like', '%'.get('k').'%');
			$param['col'] = $this->input->get('col');
			$param['k'] = $this->input->get('k');
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->orderBy('nm_mitra', 'ASC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['action']	= $this->load->view($this->config->item('layout').'/master/_action', ['action'=>'mitra', 'mitra'=>$v, 'param'=>$param], TRUE);
			$i++;
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Nama', 'data' => 'nm_mitra'),
            array('header' => 'Jenis Kelamin', 'data' => 'jk_mitra', 'width' => '150px'),
            //array('header' => 'Telp', 'data' => 'telp_mitra', 'width' => '150px'),
            array('header' => 'No Telp.', 'data' => 'telp_hp', 'width' => '150px'),
            array('header' => 'Action', 'data' => 'action', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('setting/mitra/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Mitra - Master Data - LSP STIKI',
			'header_title'		=> 'Master Data',
			'header_sub'		=> 'Manage Mitra data !',
			'active_menu'		=> ['master', 'mitra'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'setting/mitra', 'text'	=> 'Master Mitra', 'class'	=> 'fa fa-users'], 
			],
			'mitra'			=> $rows,
			'total'				=> $total,
			'table'				=> $table,
			'form'				=> $this->load->view($this->config->item('layout'). '/master/_form_mitra', ['mitra'=>$mitra, 'param'=>$param], TRUE),
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('master/mitra', $data);
	}
	
	function biaya(){
		$row = false;
		$rows = lsp_jns_daftar::get()->toArray();
		
		if (get('id')){
			$row = lsp_jns_daftar::where('id_jns_daftar', '=', get('id'))->first();
			if ($row){
				$row = $row->toArray();
				//dt jenis daftar dilebokno nang id
				$row['id'] = $row['id_jns_daftar'];
			}
		}
		
		if (isPost()){
			$this->form_validation->set_rules('nm_jns_daftar','Nama Jenis Pendaftaran', 'required');
			$this->form_validation->set_rules('ket','keterangan', 'trim');
			$this->form_validation->set_rules('jmlh_bayar_mahasiswa','Jumlah pembayaran untuk Mahasiswa', 'required|numeric');
			$this->form_validation->set_rules('jmlh_bayar_mitra','Jumlah pembayaran untuk Mitra', 'required|numeric');
			
			$biaya['mahasiswa'] = $this->input->post('jmlh_bayar_mahasiswa', TRUE);
			$biaya['mitra'] = $this->input->post('jmlh_bayar_mitra', TRUE);
			
			if ($this->form_validation->run() != FALSE){
				$_biaya = lsp_jns_daftar::where('id_jns_daftar','=', $this->input->post('id', TRUE))->first();
				$_biaya->nm_jns_daftar = $this->input->post('nm_jns_daftar', TRUE);
				$_biaya->ket = $this->input->post('ket', TRUE);
				//dadi text e=arrayto string, d=string to array
				$_biaya->jmlh_bayar = json_encode($biaya);
				$_biaya->save();
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>' . (post('id') ? 'UPDATE' : 'ADD NEW') . '</strong> Biaya Pendaftaran <strong>"' . $_biaya->nm_jns_daftar . '"</strong>');
				redirect(url('setting/biaya-pendaftaran'));	
			} else {
				$row = post();
				$row['jmlh_bayar'] = json_encode($biaya);
			}
		}
		
		$data = [
			'title'				=> 'Jenis Pendaftaran - LSP STIKI',
			'header_title'		=> 'Master Data',
			'header_sub'		=> 'Manage Biaya Pendaftaran !',
			'active_menu'		=> ['master', 'biaya-pendaftaran'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'setting/biaya-pendaftaran', 'text'	=> 'Master Biaya Pendaftaran', 'class'	=> 'fa fa-money'], 
			],
			'biaya'			    => $rows,
			'form'				=> $this->load->view($this->config->item('layout'). '/master/_form_biaya', ['bayar'=>$row], TRUE),
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
		];
		
		$this->render('master/biaya', $data);
	}
	
	function delete($tipe=false){
		if ($tipe)
			switch ($tipe) {
				case 'mahasiswa' :
					$id = get('id');
					$mahasiswa = lsp_mahasiswa::where('NRP', $id)->first();
					if ($mahasiswa){
						// $nama = $mahasiswa->nm_mahasiswa;
						// $mahasiswa->delete();
						$mahasiswa->status = 0;
						$mahasiswa->save();
						
						$this->session->set_flashdata('status', 'success');	
						$this->session->set_flashdata('text', 'Success <strong>DELETE</strong> mahasiswa <strong>"' . $nama . '"</strong>');
					}
					redirect(url('setting/mahasiswa'));
				break;
				case 'asesor' :
					$id = get('id');
					$asesor = lsp_asesor::where('NIP', $id)->first();
					if ($asesor){
						$asesor->status = 0;
						$asesor->save();
						
						$this->session->set_flashdata('status', 'success');	
						$this->session->set_flashdata('text', 'Success <strong>DELETE</strong> asesor <strong>"' . $asesor->nm_asesor . '"</strong>');
					}
					redirect(url('setting/asesor'));
				break;
				case 'tuk' :
					$id = get('id');
					$tuk = lsp_tuk::where('kd_tuk', $id)->first();
					if ($tuk){
						$tuk->status = 0;
						$tuk->save();
						
						$this->session->set_flashdata('status', 'success');	
						$this->session->set_flashdata('text', 'Success <strong>DELETE</strong> asesor <strong>"' . $tuk->nm_tuk . '"</strong>');
					}
					redirect(url('setting/tuk'));
				break;

				case 'mitra' :
					$id = get('id');
					$mitra = lsp_mitra::where('id_mitra', $id)->first();
					
					if ($mitra){
						// $nama = $mitra->nm_mitra;
						// $mitra->delete();
						$mitra->status = 0;
						$mitra->save();
						
						$this->session->set_flashdata('status', 'success');	
						$this->session->set_flashdata('text', 'Success <strong>DELETE</strong> mahasiswa <strong>"' . $nama . '"</strong>');
					}
					redirect(url('setting/mitra'));
				break;

				case 'skema' :
					$id = get('id');
					$parent = get('parent');
					
					if ($id && $parent){
						$detail_skema = lsp_detail_skema::where('id_skema', $parent)->where('id_dt_skema', $id)->first();
						if ($detail_skema){
							// $detail_skema->delete();
							
							$detail_skema->status = 0;
							$detail_skema->save();

							
							$this->session->set_flashdata('status', 'success');	
							$this->session->set_flashdata('text', 'Success <strong>DELETE</strong> detail skema <strong>"' . $detail_skema->kd_unit . '"</strong>');
						}						
					} else {
						$skema = lsp_skema::where('id_skema', $id)->first();
						if ($skema){
							// $skema->delete();
							$skema->status = 0;
							$skema->save();

							$this->session->set_flashdata('status', 'success');	
							$this->session->set_flashdata('text', 'Success <strong>DELETE</strong> skema <strong>"' . $skema->nm_skema . '"</strong>');
						}	
					}
					
					redirect(url('setting/skema'));
				break;
			}
		else 
			redirect(url());
	}
	
	function search($tipe=false){
		if ($tipe && isPost())
			switch ($tipe) {
				case 'mahasiswa' :
					$param     = [];
					$paramable = ['k', 'col'];
					foreach ($paramable as $key => $value) {
						$post = post($value);
						if ($post)
							$param[$value] = $post;
					}
					redirect(url('setting/mahasiswa', $param));
				break;
				case 'asesor' :
					$param     = [];
					$paramable = ['k', 'col'];
					foreach ($paramable as $key => $value) {
						$post = post($value);
						if ($post)
							$param[$value] = $post;
					}
					redirect(url('setting/asesor', $param));
				break;
				case 'tuk' :
					$param     = [];
					$paramable = ['k', 'col'];
					foreach ($paramable as $key => $value) {
						$post = post($value);
						if ($post)
							$param[$value] = $post;
					}
					redirect(url('setting/tuk', $param));
				break;
				case 'skema' :
					$param     = [];
					$paramable = ['k'];
					foreach ($paramable as $key => $value) {
						$post = post($value);
						if ($post)
							$param[$value] = $post;
					}
					redirect(url('setting/skema', $param));
				break;
				case 'mitra' :
					$param     = [];
					$paramable = ['k'];
					foreach ($paramable as $key => $value) {
						$post = post($value);
						if ($post)
							$param[$value] = $post;
					}
					redirect(url('setting/mitra', $param));
				break;
			}
		
	}
	
	function _form_kompetensi($id_dtl_skema=false, $kompetensi=false, $post= TRUE){
		if (isPost() && post('action') == 'post-kompetensi' && $post){
			if (post('tipe') == 'kompetensi')
				$this->form_validation->set_rules('nm_kompetensi', 'Nama Kompetensi', 'required');
			else 
				$this->form_validation->set_rules('asesmen_mandiri', 'Nama Kompetensi', 'required');
			
			if ($this->form_validation->run() != FALSE){
				if (post('tipe') == 'kompetensi'){
					if ($this->input->post('id_post') != '')
						$kompetensi = lsp_kompetensi::where('id_kompetensi', $this->input->post('id_post'))->first();
					else	
						$kompetensi = new lsp_kompetensi();
					$kompetensi->nm_kompetensi = $this->input->post('nm_kompetensi', TRUE);
					$kompetensi->id_dtl_skema = $id_dtl_skema;
					$kompetensi->keterangan = $this->input->post('keterangan', TRUE);
					$kompetensi->save();
					
					$flash_message = ($this->input->post('id_post') != '' ? 'Edit ' : 'Tambah '). 'Kompetensi dengan nama <strong>"'.$this->input->post('nm_kompetensi', TRUE).'"</strong>';
				} else {
					if ($this->input->post('id_post') != '')
						$detail_kompetensi = lsp_dtl_kompetensi::where('id_dtl_kompetensi', $this->input->post('id_post'))->first();
					else {
						$detail_kompetensi = new lsp_dtl_kompetensi();
						$detail_kompetensi->id_kompetensi = $this->input->post('parent', TRUE);
					}
					$detail_kompetensi->asesmen_mandiri = $this->input->post('asesmen_mandiri', TRUE);
					$detail_kompetensi->save();
					
					$flash_message = ($this->input->post('id_post') != '' ? 'Edit ' : 'Tambah '). 'Detail Kompetensi dengan nama <strong>"'.$this->input->post('asesmen_mandiri', TRUE).'"</strong>';
				}
				
				$data = [
					'status'	=> 'success',
					'html'		=> $this->_modal_kompetensi($id_dtl_skema, $flash_message)
				];
				return $data;
			}
			
			$kompetensi = post();
			if (post('id_post') != '')
				$kompetensi['id'] = $this->input->post('id_post', TRUE);
		}
		
		$data = [
			'kompetensi'	=> $kompetensi,
			'id'			=> $id_dtl_skema
		];
		
		return $this->load->view($this->config->item('layout').'/master/_form_kompetensi', $data, TRUE);
	}
	
	function _modal_kompetensi($id=false, $flash_message=false){
		if ($id){
			$detail = lsp_detail_skema::where('id_dt_skema', $id)->with('kompetensi')->first()->toArray();
			$data = [
				'detail'		=> $detail,
				'form'			=> $this->_form_kompetensi($id, FALSE, FALSE),
				'flash_message' => $flash_message, 
			];
			
			return $this->load->view($this->config->item('layout').'/master/_detail_skema', $data, TRUE);
		} else 
			return false;
		
	}
	
	function remote(){
		if (isPost() && isAjax())
			switch (post('action')) {
				case 'detail_skema' :
					$id = post('id');
					
					$return = [
						'status'	=> 'success',
						'html'		=> $this->_modal_kompetensi($id)
					];
					
					echo json_encode($return);
				break;
				case 'post-kompetensi' :
					$kompetensi = post();
					$result = $this->_form_kompetensi($kompetensi['id_dtl_skema']);
					
					if (is_array($result) && isset($result['html']))
						$return = [
							'status'	=> 'success',
							'html'		=> $result['html']
						];
					else 
						$return = [
							'status'	=> 'failure',
							'html'		=> $result
						];
						
					echo json_encode($return);
				break;
				case 'reset-form' : 
					$id = post('id');
					$return = [
						'html'	=> $this->_form_kompetensi($id)
					];
					
					echo json_encode($return);
				break;
				case 'edit-kompetensi' : 
					if ($this->input->post('tipe') == 'kompetensi')
						$kompetensi = lsp_kompetensi::where('id_kompetensi', $this->input->post('id'))->first();
					else 
						$kompetensi = lsp_dtl_kompetensi::where('id_dtl_kompetensi', $this->input->post('id'))->with('kompetensi')->first();
					
					if ($kompetensi)
						$kompetensi = $kompetensi->toArray();
					
					$kompetensi['id'] = $this->input->post('tipe') == 'kompetensi' ? $kompetensi['id_kompetensi'] : $kompetensi['id_dtl_kompetensi'];
					$kompetensi['tipe'] = $this->input->post('tipe');
					$id_dtl_skema = post('tipe') == 'kompetensi' ? $kompetensi['id_dtl_skema'] : $kompetensi['kompetensi']['id_dtl_skema'];
					
					echo json_encode($this->_form_kompetensi($id_dtl_skema, $kompetensi, FALSE));
				break;
				case 'delete-kompetensi' :
					if (post('tipe') == 'kompetensi')
						$kompetensi = lsp_kompetensi::where('id_kompetensi', $this->input->post('id'))->first();
					else 
						$kompetensi = lsp_dtl_kompetensi::where('id_dtl_kompetensi', $this->input->post('id'))->with('kompetensi')->first();
					
					if ($kompetensi){
						$id = post('tipe') == 'kompetensi' ? $kompetensi['id_dtl_skema'] : $kompetensi['kompetensi']['id_dtl_skema'];
						$nama = post('tipe') == 'kompetensi' ? $kompetensi['nm_kompetensi'] : $kompetensi['asesmen_mandiri'];
						$kompetensi->delete();
						
						$flash = 'Hapus '.post('tipe').' dengan nama <strong>"'.$nama.'"</strong>';
						
						echo json_encode($this->_modal_kompetensi($id, $flash));
					}
				break;
				case 'add-detail-kompetensi' :
					$id = $this->input->post('id');
					$parent = $this->input->post('parent');
					
					$kompetensi = [
						'parent'	=> $parent,
						'tipe'		=> 'detail_kompetensi'
					];
					
					echo json_encode($this->_form_kompetensi($id, $kompetensi, FALSE));
				break;
			}
	}
	
}