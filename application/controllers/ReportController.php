<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportController extends MY_HomeController {
	private $limit = 25;
	private $page = 1;
	private $search = [];
	
	function __construct(){
		parent::__construct();
		$this->load->model([
			'lsp_mahasiswa',
			'lsp_mitra',
			'lsp_skema',
			'lsp_detail_skema',
			'lsp_tuk',
			'lsp_asesor',
			'lsp_pendaftaran',
			'lsp_jns_daftar',
			'lsp_jadwal',
			'lsp_dtl_jadwal',
			'lsp_pembayaran'
		]);
		$this->load->library(['tables','form_validation','PHPExcelCore/PHPExcel']);
		$this->checkLogin(['admin', 'manager']);
		$this->search = [
			'jenis'	=> trim(get('jenis')),
			'start'	=> trim(get('start')),
			'end'	=> trim(get('end')),
			'nama'	=> trim(get('nama')),
			'tipe'	=> trim(get('tipe')),
			'status'=> trim(get('status')),
			'skema'	=> trim(get('skema')),
			'jenis_daftar' => trim(get('jenis_daftar')), //pembayaran
			'tuk'   => get('tuk') ? get('tuk')[0] : false, //jadwal
			'asesor' => get('asesor') ? get('asesor')[0] : false, //jadwal
			'id_jadwal' => get('id_jadwal')
		];
	}
	
	function tuk(){
		$this->page = get('page', 1);
		$param['page'] = $this->page;
		$param = [];
		
		$rows = lsp_tuk::where('status', '=', '1');
		
		if (get('nama')){
			$rows = $rows->where('nm_tuk', 'like', '%'. get('nama') .'%')
					->orWhere('kd_tuk', 'like', '%'. get('nama') .'%');
			$param['name'] = get('nama');
		}
		
		if (get('export')){
			$rows = $rows->get();
			if ($rows)
				$rows = $rows->toArray();
			else 
				$rows = [];
			
			$this->export($rows, 'tuk');
			
			return;
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->orderBy('kd_tuk', 'ASC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$i++; 
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Kode', 'data' => 'kd_tuk', 'width' => '150px'),
            array('header' => 'Nama', 'data' => 'nm_tuk'),
            array('header' => 'Jenis', 'data' => 'jns_tuk', 'width' => '150px'),
            array('header' => 'Keterangan', 'data' => 'ket_tuk', 'width' => '150px'),
            array('header' => 'Kapasitas', 'data' => 'kapasitas_tuk', 'width' => '150px'),
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('report/tuk?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Report TUK - LSP STIKI',
			'header_title'		=> 'Report',
			'header_sub'		=> 'Tempat Uji Kerja !',
			'active_menu'		=> ['report', 'report-tuk'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> '#', 'text'	=> 'Report', 'class'	=> 'fa-file-text-o'], 
				['url'	=> url().'report/tuk', 'text'	=> 'Tempat Uji Kerja', 'class'	=> 'fa fa-circle'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/report.js'
			],
			'tuk'			    => $rows,
			'total'				=> $total,
			'table'				=> $table,
			'param'				=> $param,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('report/tuk', $data);
	}
	
	function asesor(){
		$this->page = get('page', 1);
		$param['page'] = $this->page;
		$param = [];
		
		$rows = lsp_asesor::where('status', '=', '1');
		
		if (get('nama')){
			$rows = $rows->where('nm_asesor', 'like', '%'. get('nama') .'%');
			$param['name'] = get('nama');
		}
		
		if (get('export')){
			$rows = $rows->get();
			if ($rows)
				$rows = $rows->toArray();
			else 
				$rows = [];
			
			$this->export($rows, 'asesor');
			
			return;
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->orderBy('NIP', 'ASC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['nama'] = $v['gelar_depan'].' '. $v['nm_asesor'] . ($v['gelar_belakang'] != '' ? ', '. $v['gelar_belakang']: '');
			$rows[$k]['jenis_kelamin'] = $v['jk_asesor'] == 'perempuan' ? '<label class="label label-success">Perempuan</label>' : '<label class="label label-primary">Laki-laki</label>';
			$i++; 
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'NIP', 'data' => 'NIP', 'width' => '150px'),
            array('header' => 'Nama', 'data' => 'nama'),
            array('header' => 'Email', 'data' => 'email', 'width' => '150px'),
            array('header' => 'Jenis Kelamin', 'data' => 'jenis_kelamin', 'width' => '150px'),
            array('header' => 'Pendidikan terakhir', 'data' => 'pend_terakhir', 'width' => '150px'),
            array('header' => 'Telp', 'data' => 'telp', 'width' => '150px'),
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('report/asesor?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Report Asesor - LSP STIKI',
			'header_title'		=> 'Report',
			'header_sub'		=> 'Asesor !',
			'active_menu'		=> ['report', 'report-asesor'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> '#', 'text'	=> 'Report', 'class'	=> 'fa-file-text-o'], 
				['url'	=> url().'report/asesor', 'text'	=> 'Asesor', 'class'	=> 'fa fa-users'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/report.js'
			],
			'asesor'			=> $rows,
			'total'				=> $total,
			'table'				=> $table,
			'param'				=> $param,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('report/asesor', $data);
	}
	
	function sertifikasi(){
		$this->page = get('page', 1);
		$param['page'] = $this->page;
		$param = [];
		
		$rows = lsp_pendaftaran::where('status', '>=', '3')
						->where('status', '<>', '9');
		
		if (get('nama')){
			$rows = $rows->where(function($query){
						$query->whereHas('mahasiswa', function($q){
							if (ctype_digit(get('nama'))){
								$q->whereRaw("CAST(NRP as CHAR) LIKE '".get('nama')."%'")
									->orWhere('nm_mahasiswa','LIKE', '%'.get('nama').'%');
							} else 
								$q->where('nm_mahasiswa','LIKE', '%'.get('nama').'%');
						})
						->orWhereHas('mitra', function($q){
							$q->where('nm_mitra','LIKE', '%'.get('nama').'%');
						});
					});		
			$param['k'] = $this->input->get('nama');
		}
		if (get('jenis_daftar')){
			$rows = $rows->where('id_jns_daftar', '=', get('jenis_daftar'));
			$param['tuk'] = get('jenis_daftar');
		}
		if (get('asesor')){
			$rows = $rows->where('id_asesor', '=', get('asesor'));
			$param['asesor'] = get('asesor');
		}
		if (get('skema')){
			$rows = $rows->where('id_skema', '=', get('skema'));
			$param['skema'] = get('skema');
		}
		
		if (get('export')){
			$rows = $rows->with('mahasiswa')
					->with('mitra')
					->with('skema')
					->with('jenis_daftar')
					->get();
			if ($rows)
				$rows = $rows->toArray();
			else 
				$rows = [];
			
			$this->export($rows, 'hasil_sertifikasi');
			
			return;
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->with('mahasiswa')
					->with('mitra')
					->with('skema')
					->with('jenis_daftar')
					->orderBy('id_pendaftaran', 'DESC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['nama'] = $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra'];
			$rows[$k]['nm_skema'] = $v['skema']['nm_skema'];
			$rows[$k]['nm_jns_daftar'] = $v['jenis_daftar']['nm_jns_daftar'];
			$rows[$k]['kompeten'] = $v['status'] == 4 ? '<label class="label label-success">Kompeten</label>' : '<label class="label label-danger">Tidak kompeten</label>';
			$i++; 
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Nama', 'data' => 'nama', 'width' => '250px'),
            array('header' => 'Skema', 'data' => 'nm_skema', 'width' => '150px'),
            array('header' => 'Jenis Daftar', 'data' => 'nm_jns_daftar', 'width' => '150px'),
            array('header' => 'Kompeten', 'data' => 'kompeten', 'width' => '150px'),
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('report/sertifikasi?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Report Hasil Sertifikasi - LSP STIKI',
			'header_title'		=> 'Report',
			'header_sub'		=> 'Hasil Sertifikasi !',
			'active_menu'		=> ['report', 'report-sertifikasi'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> '#', 'text'	=> 'Report', 'class'	=> 'fa-file-text-o'], 
				['url'	=> url().'report/sertifikasi', 'text'	=> 'Hasil Sertifikasi', 'class'	=> 'fa fa-check'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/report.js'
			],
			'sertifikasi'			=> $rows,
			'total'				=> $total,
			'table'				=> $table,
			'param'				=> $param,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
			'option_skema'		=> lsp_skema::get()->toArray(),
			'option_jenis'		=> lsp_jns_daftar::whereStatus('1')->get()->toArray(),
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('report/sertifikasi', $data);
	}
	
	public function asesmen(){
		$this->limit = 3;
		$this->page = get('page', 1);
		$param['page'] = $this->page;
		$param = [];
		
		$rows = new lsp_jadwal();
		
		if (get('start')){
			$rows = $rows->where('tgl_sertifikasi', '>=', get('start'));
			$param['start'] = get('start');
		}
		if (get('end')){
			$rows = $rows->where('tgl_sertifikasi', '<=', get('end'));
			$param['end'] = get('end');
		}
		if (get('tuk')){
			$rows = $rows->where('kd_tuk', '=', get('tuk'));
			$param['tuk'] = get('tuk');
		}
		if (get('asesor')){
			$rows = $rows->where('id_asesor', '=', get('asesor'));
			$param['asesor'] = get('asesor');
		}
		if (get('skema')){
			$rows = $rows->where('id_skema', '=', get('skema'));
			$param['skema'] = get('skema');
		}
		if (get('id_jadwal')){
			$rows = $rows->where('id_jadwal', '=', get('id_jadwal'));
			$param['id_jadwal'] = get('id_jadwal');
		}
		
		if (get('export')){
			$rows = $rows->with('detail_daftar')
					->with('detail_skema')
					->with('tuk')
					->with('asesor')
					->orderBy('jam_sertifikasi', 'DESC')
					->orderBy('tgl_sertifikasi', 'DESC')
					->get();
			if ($rows)
				$rows = $rows->toArray();
			else 
				$rows = [];
			
			$this->export($rows, 'asesmen');
			
			return;
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->with('detail_skema')
					->with('tuk')
					->with('asesor')
					->with('detail_daftar')
					->orderBy('jam_sertifikasi', 'DESC')
					->orderBy('tgl_sertifikasi', 'DESC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$i++; 
		}
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('report/asesmen?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Report Hasil Asesmen - LSP STIKI',
			'header_title'		=> 'Report',
			'header_sub'		=> 'Hasil Assesmen !',
			'active_menu'		=> ['report', 'report-asesmen'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> '#', 'text'	=> 'Report', 'class'	=> 'fa-file-text-o'], 
				['url'	=> url().'report/asesmen', 'text'	=> 'Hasil Asesmen', 'class'	=> 'fa fa-check'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/report.js'
			],
			'asesmen'			=> $rows,
			'total'				=> $total,
			'param'				=> $param,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
			'option_skema'		=> lsp_skema::get()->toArray(),
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('report/asesmen', $data);
	}
	
	public function jadwal(){
		$this->page = get('page', 1);
		$param['page'] = $this->page;
		$param = [];
		
		$rows = new lsp_jadwal();
		
		if (get('start')){
			$rows = $rows->where('tgl_sertifikasi', '>=', get('start'));
			$param['start'] = get('start');
		}
		if (get('end')){
			$rows = $rows->where('tgl_sertifikasi', '<=', get('end'));
			$param['end'] = get('end');
		}
		if (get('tuk')){
			$rows = $rows->where('kd_tuk', '=', get('tuk'));
			$param['tuk'] = get('tuk');
		}
		if (get('asesor')){
			$rows = $rows->where('id_asesor', '=', get('asesor'));
			$param['asesor'] = get('asesor');
		}
		if (get('skema')){
			$rows = $rows->where('id_skema', '=', get('skema'));
			$param['skema'] = get('skema');
		}
		
		if (get('export')){
			$rows = $rows->with('asesor')
					->with('tuk')
					->with('skema')
					->with('detail')
					->orderBy('jam_sertifikasi', 'DESC')
					->orderBy('tgl_sertifikasi', 'DESC')
					->get();
			if ($rows)
				$rows = $rows->toArray();
			else 
				$rows = [];
			
			$this->export($rows, 'jadwal');
			
			return;
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->with('asesor')
					->with('tuk')
					->with('skema')
					->with('detail')
					->orderBy('jam_sertifikasi', 'DESC')
					->orderBy('tgl_sertifikasi', 'DESC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['nm_tuk'] = $v['tuk']['nm_tuk'];
			$rows[$k]['nm_skema'] = $v['skema']['nm_skema'];
			$rows[$k]['nm_asesor'] = $v['asesor']['gelar_depan'] .' '. $v['asesor']['nm_asesor'] . ($v['asesor']['gelar_belakang'] != '' ? ', '. $v['asesor']['gelar_belakang'] : '');
			$rows[$k]['tanggal'] = date('j F Y', strtotime($v['tgl_sertifikasi'])).' '. date('H:i', strtotime($v['jam_sertifikasi']));
			$rows[$k]['jumlah_peserta'] = count($v['detail']).' Peserta';
			$i++; 
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Tempat Uji Kerja', 'data' => 'nm_tuk', 'width' => '250px'),
            array('header' => 'Skema', 'data' => 'nm_skema', 'width' => '150px'),
            array('header' => 'Asesor', 'data' => 'nm_asesor', 'width' => '150px'),
            array('header' => 'Tanggal', 'data' => 'tanggal', 'width' => '150px'),
            array('header' => 'Jumlah Peserta', 'data' => 'jumlah_peserta', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('report/jadwal?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Report Jadwal - LSP STIKI',
			'header_title'		=> 'Report',
			'header_sub'		=> 'Jadwal Sertifikasi !',
			'active_menu'		=> ['report', 'report-jadwal'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> '#', 'text'	=> 'Report', 'class'	=> 'fa-file-text-o'], 
				['url'	=> url().'report/jadwal', 'text'	=> 'Jadwal', 'class'	=> 'fa fa-calendar'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/report.js'
			],
			'jadwal'			=> $rows,
			'total'				=> $total,
			'table'				=> $table,
			'param'				=> $param,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
			'option_skema'		=> lsp_skema::get()->toArray(),
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('report/jadwal', $data);
	}
	
	public function pembayaran(){
		$this->page = get('page', 1);
		$param['page'] = $this->page;
		$param = [];
		
		$rows = new lsp_pembayaran();
		
		if (get('start')){
			$rows = $rows->where('tgl_bayar', '>=', $this->search['start']);
			$param['start'] = get('start');
		}
		
		if (get('end')){
			$rows = $rows->where('tgl_bayar', '<=', $this->search['end']);
			$param['end'] = get('end');
		}
		
		if (get('jenis_daftar')){
			$rows = $rows->where('id_jenis_bayar', '=', $this->search['jenis_daftar']);
			$param['jenis_daftar'] = get('jenis_daftar');
		}
		
		if (get('nama')){
			$rows = $rows->whereHas('pendaftar', function($qq){
				return $qq->where('status', '<>', '9')
						->where(function($query){
							$query->whereHas('mahasiswa', function($q){
								if (ctype_digit(get('nama'))){
									$q->whereRaw("CAST(NRP as CHAR) LIKE '".get('nama')."%'")
										->orWhere('nm_mahasiswa','LIKE', '%'.get('nama').'%');
								} else 
									$q->where('nm_mahasiswa','LIKE', '%'.get('nama').'%');
							})
							->orWhereHas('mitra', function($q){
								$q->where('nm_mitra','LIKE', '%'.get('nama').'%');
							});
						});
			});
			$param['nama'] = get('nama');
		}	
		
		if (get('export')){
			$rows = $rows->with('pendaftar')
					->with('jenis_daftar')
					->orderBy('tgl_bayar', 'DESC')
					->get();
			if ($rows)
				$rows = $rows->toArray();
			else 
				$rows = [];
			
			$this->export($rows, 'pembayaran');
			
			return;
		}
		
		$total = $grand_total = clone $rows;
		$total = $total->count();
		$grand_total = $grand_total->selectRaw('SUM(jumlah) as grand')->first();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->with('pendaftar')
					->with('jenis_daftar')
					->orderBy('tgl_bayar', 'DESC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$_style_label = [
			1 => 'label-info',
			2 => 'label-success',
			3 => 'label-primary'
		];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['nm_jns_daftar'] = '<label class="label '. $_style_label[$v['id_jenis_bayar']] .'">'. $v['jenis_daftar']['nm_jns_daftar'] .'</label>';
			$rows[$k]['jumlah_format'] = number_format($v['jumlah'],0,",",".");
			$i++; 
		}
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('report/pembayaran?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Report Pembayaran - LSP STIKI',
			'header_title'		=> 'Report',
			'header_sub'		=> 'Pembayaran Sertifikasi !',
			'active_menu'		=> ['report', 'report-pembayaran'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> '#', 'text'	=> 'Report', 'class'	=> 'fa-file-text-o'], 
				['url'	=> url().'report/pembayaran', 'text'	=> 'Pembayaran', 'class'	=> 'fa fa-money'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/report.js'
			],
			'pembayaran'		=> $rows,
			'total'				=> $total,
			'grand_total'		=> $grand_total->grand,
			// 'table'				=> $table,
			'param'				=> $param,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search,
			'option_jenis'		=> lsp_jns_daftar::where('status','=','1')->get()->toArray()
		];
		
		$this->render('report/pembayaran', $data);
	}
	
	public function peserta(){
		$this->page = get('page', 1);
		$param['page'] = $this->page;
		$param = [];
		
		$rows = lsp_pendaftaran::where('status', '<>', '9')
				// penambahan
				->where(function($query){
					$query->orWhereHas('mahasiswa', function($q){
						$q->where('NRP', '>', 0);
					})
					->orWhereHas('mitra', function($q){
						$q->where('id_mitra', '>', 0);
					});
				});
				
		
		if (get('nama')){
			$rows = $rows->where(function($query){
						$query->whereHas('mahasiswa', function($q){
							if (ctype_digit(get('nama'))){
								$q->whereRaw("CAST(NRP as CHAR) LIKE '".get('nama')."%'")
									->orWhere('nm_mahasiswa','LIKE', '%'.get('nama').'%');
							} else 
								$q->where('nm_mahasiswa','LIKE', '%'.get('nama').'%');
						})
						->orWhereHas('mitra', function($q){
							$q->where('nm_mitra','LIKE', '%'.get('nama').'%');
						});
					});		
			$param['k'] = $this->input->get('nama');
		}
		
		if (get('start')){
			$rows = $rows->where('tgl_daftar', '>=', get('start'));
			$param['start'] = get('start');
		}
		
		if (get('end')){
			$rows = $rows->where('tgl_daftar', '<=', get('end'));
			$param['end'] = get('end');
		}
		
		if (get('jenis')){
			$rows = $rows->where('id_jns_daftar', '=', get('jenis'));
			$param['jenis'] = get('jenis');
		}
		
		if (get('tipe')){
			$rows = $rows->where('tipe', '=', get('tipe'));
			$param['tipe'] = get('tipe');
		}
		
		if (get('status')){
			$rows = $rows->where('status', '=', get('status'));
			$param['status'] = get('status');
		}
		
		if (get('skema')){
			$rows = $rows->where('id_skema', '=', get('skema'));
			$param['skema'] = get('skema');
		}
		
		if (get('export')){
			$rows = $rows->with('mahasiswa')
					->with('mitra')
					->with('jenis_daftar')
					->with('skema')
					->orderBy('tgl_daftar', 'DESC')
					->get();
			if ($rows)
				$rows = $rows->toArray();
			else 
				$rows = [];
			
			$this->export($rows, 'peserta');
			
			return;
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->with('mahasiswa')
					->with('mitra')
					->with('jenis_daftar')
					->with('skema')
					->orderBy('tgl_daftar', 'DESC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['tanggal'] = date('j F Y', strtotime($v['tgl_daftar']));
			$rows[$k]['nama'] = $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra'];
			$rows[$k]['nm_skema'] = $v['skema']['nm_skema'];
			$rows[$k]['nm_jenis'] = $v['jenis_daftar']['nm_jns_daftar'];
			$rows[$k]['nm_tipe'] = $this->load->view($this->config->item('layout').'/report/_action', ['action'=>'peserta_tipe', 'peserta'=>$v], TRUE);
			$rows[$k]['nm_status'] = $this->load->view($this->config->item('layout').'/report/_action', ['action'=>'peserta_status', 'peserta'=>$v], TRUE);
			$i++; 
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Tanggal', 'data' => 'tanggal', 'width' => '150px'),
            array('header' => 'Nama', 'data' => 'nama'),
            array('header' => 'Skema', 'data' => 'nm_skema', 'width' => '150px'),
            array('header' => 'Jenis', 'data' => 'nm_jenis', 'width' => '150px'),
            array('header' => 'Tipe', 'data' => 'nm_tipe', 'width' => '150px'),
            array('header' => 'Status', 'data' => 'nm_status', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('report/peserta?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Report Peserta - LSP STIKI',
			'header_title'		=> 'Report',
			'header_sub'		=> 'Peserta Sertifikasi !',
			'active_menu'		=> ['report', 'report-peserta'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> '#', 'text'	=> 'Report', 'class'	=> 'fa-file-text-o'], 
				['url'	=> url().'report/peserta', 'text'	=> 'Peserta', 'class'	=> 'fa fa-users'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/report.js'
			],
			'mahasiswa'			=> $rows,
			'total'				=> $total,
			'table'				=> $table,
			'param'				=> $param,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
			'option_skema'		=> lsp_skema::get()->toArray(),
			'option_jenis'		=> lsp_jns_daftar::where('status','=','1')->get()->toArray(),
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('report/peserta', $data);
	}
	
	function search($tipe=false){
		$param     = [];
		$paramable = ['jenis', 'skema', 'start', 'end', 'nama', 'tipe', 'status', 'jenis_daftar', 'asesor', 'tuk', 'id_jadwal'];
		foreach ($paramable as $key => $value) {
			$post = post($value);
			if ($post && $post != 'All')
				$param[$value] = $post;
		}
		redirect(url('report/'. post('route'), $param));
		
	}
	
	function export($rows, $tipe=false){
		if (!is_array($rows) && !count($rows) && !isset($rows))
			redirect_back();
		
		$report_title = 'Report '.str_replace('_', ' ', $tipe).' LSP STIKI - '. date('j F Y');
        $i        = 1;
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("LSP STIKI");
		$objPHPExcel->getProperties()->setLastModifiedBy("LSP STIKI");
		$objPHPExcel->getProperties()->setTitle("Office XLS");
		$objPHPExcel->getProperties()->setSubject("Office XLS");
		$objPHPExcel->getProperties()->setDescription($report_title.", generated using PHP classes.");

		// Add some data
		// set header
		$objPHPExcel->setActiveSheetIndex(0);
		// Config
		$link_style_array = [
		  'font'  => [
			'color' => ['rgb' => '0000FF'],
			'underline' => 'single'
		  ]
		];

		$style_center = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			)
		);
		
		switch ($tipe){
			case 'tuk' :
				$objPHPExcel->getActiveSheet()->SetCellValue('A1', $report_title);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				
				// set header
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Kode TUK');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Nama');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Jenis');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Keterangan');
				$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Kapasitas');
				// style of column
				$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($style_center);
				$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'D3D3D3')
						)
					)
				);
				
				$cell = $i+3;
				foreach ($rows as $k=>$v){
					$cell = $i+3;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, $i);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_center);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cell, $v['kd_tuk']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cell, $v['nm_tuk']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cell, $v['jns_tuk']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cell, $v['ket_tuk']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cell, $v['kapasitas_tuk']);	
					$i++;
				}
				
				$objPHPExcel->getActiveSheet()->getStyle('A'. ($cell+1) .':F'. ($cell+1))->getFont()->setBold(true);
				//set border
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
						),
					),
				);
				$objPHPExcel->getActiveSheet()->getStyle('A3:F'.($cell+1))->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				break;
			case 'asesor' :
				$objPHPExcel->getActiveSheet()->SetCellValue('A1', $report_title);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				
				// set header
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'NIP');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Nama');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Alamat');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Telp');
				$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Email');
				$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Tempat Lahir');
				$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Tanggal Lahir');
				$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Agama');
				$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Jenis Kelamin');
				$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Pendidikan Terakhir');
				// style of column
				$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->applyFromArray($style_center);
				$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'D3D3D3')
						)
					)
				);
				
				$cell = $i+3;
				foreach ($rows as $k=>$v){
					$cell = $i+3;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, $i);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_center);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cell, $v['NIP']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cell, $v['gelar_depan'].' '. $v['nm_asesor'] . ($v['gelar_belakang'] != '' ? ', '. $v['gelar_belakang']: '') );					
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cell, $v['alamat_asesor']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cell, $v['telp']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cell, $v['email']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$cell, $v['tempat_lhr']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$cell, $v['tgl_lahir']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$cell, $v['agama']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('J'.$cell, $v['jk_asesor']);	
					$objPHPExcel->getActiveSheet()->SetCellValue('K'.$cell, $v['pend_terakhir']);	
					$i++;
				}
				
				$objPHPExcel->getActiveSheet()->getStyle('A'. ($cell+1) .':K'. ($cell+1))->getFont()->setBold(true);
				//set border
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
						),
					),
				);
				$objPHPExcel->getActiveSheet()->getStyle('A3:K'.($cell+1))->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
				break;
			case 'hasil_sertifikasi' :
				$objPHPExcel->getActiveSheet()->SetCellValue('A1', $report_title);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				
				// set header
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Nama');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Skema');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Jenis Daftar');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Kompeten');
				// style of column
				$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($style_center);
				$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'D3D3D3')
						)
					)
				);
				
				$cell = $i+3;
				foreach ($rows as $k=>$v){
					$cell = $i+3;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, $i);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_center);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra']);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cell, $v['skema']['nm_skema']);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cell, $v['jenis_daftar']['nm_jns_daftar']);					
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cell, ($v['status'] == 4 ? 'Kompeten' : 'Tidak kompeten') );					
					$i++;
				}
				
				$objPHPExcel->getActiveSheet()->getStyle('A'. ($cell+1) .':E'. ($cell+1))->getFont()->setBold(true);
				//set border
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
						),
					),
				);
				$objPHPExcel->getActiveSheet()->getStyle('A3:E'.($cell+1))->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				break;
			case 'asesmen' :
				$objPHPExcel->getActiveSheet()->SetCellValue('A1', $report_title);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				
				// set header
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Nama');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Kode Unit');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Judul Unit');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Kompeten');
				// style of column
				$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($style_center);
				$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'D3D3D3')
						)
					)
				);
				
				$cell = $i+3;
				foreach ($rows as $k=>$v){
					$cell = $i+3;
					$_judul = 'Skema: '. $v['detail_skema']['nm_skema'] .' | Asesor: '. $v['asesor']['gelar_depan'].' '. $v['asesor']['nm_asesor'] . ($v['asesor']['gelar_belakang'] != '' ? ', '. $v['asesor']['gelar_belakang']:'') .' | TUK: '. $v['tuk']['nm_tuk'] .' | Tgl : '. date('Y-m-d', strtotime($v['tgl_sertifikasi'])).' '.date('H:i', strtotime($v['jam_sertifikasi']));
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, $_judul);	
					$objPHPExcel->getActiveSheet()->mergeCells('A'.$cell.':E'.$cell);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->getFont()->setBold(true);
					$i++;
					
					$_i = 1;
					
					foreach ($v['detail_daftar'] as $kk=>$vv){
						$_rekap_asesmen = $vv['rekap_asesmen'] != '' ? objToArr(json_decode($vv['rekap_asesmen'])) : [];
						$cell = $i+3;
						
						$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, $_i);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_center);
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cell, ($vv['tipe'] == 'mahasiswa' ? $vv['mahasiswa']['nm_mahasiswa'] : $vv['mitra']['nm_mitra']));
						$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cell, @$v['detail_skema']['detail'][0]['kd_unit']);
						$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cell, @$v['detail_skema']['detail'][0]['jdl_kompetensi']);
						$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cell, (isset($v['detail_skema']['detail'][0]['jdl_kompetensi']) ? (!isset($_rekap_asesmen[$v['detail_skema']['detail'][0]['id_dt_skema']]) || @$_rekap_asesmen[$v['detail_skema']['detail'][0]['id_dt_skema']] == 0 ? 'Tidak kompeten' : 'Kompeten') : ''));
						$i++;
						unset($v['detail_skema']['detail'][0]);
						
						foreach (@$v['detail_skema']['detail'] as $kDetail=>$vDetail){
							$cell = $i+3;
							$kompeten = !isset($_rekap_asesmen[$vDetail['id_dt_skema']]) || @$_rekap_asesmen[$vDetail['id_dt_skema']] == 0 ? false : true;
							
							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, '');
							$objPHPExcel->getActiveSheet()->mergeCells('A'.$cell.':B'.$cell);
							$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cell, $vDetail['kd_unit']);
							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cell, $vDetail['jdl_kompetensi']);
							$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cell, ($kompeten ? 'Kompeten' : 'Tidak kompeten'));
							$i++;
						}
						
						$_i++;
					}
				}
				
				$objPHPExcel->getActiveSheet()->getStyle('A'. ($cell+1) .':E'. ($cell+1))->getFont()->setBold(true);
				//set border
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
						),
					),
				);
				$objPHPExcel->getActiveSheet()->getStyle('A3:E'.($cell+1))->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				break;
			case 'peserta' :
				$objPHPExcel->getActiveSheet()->SetCellValue('A1', $report_title);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:O1');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				
				// set header
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Tanggal');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Nama');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Skema');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Jenis');
				$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Tipe');
				$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Status');
				$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Tempat Lahir');
				$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Tanggal Lahir');
				$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Jenis Kelamin');
				$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Alamat');
				$objPHPExcel->getActiveSheet()->SetCellValue('L3', 'Kodepos');
				$objPHPExcel->getActiveSheet()->SetCellValue('M3', 'Telp Rumah');
				$objPHPExcel->getActiveSheet()->SetCellValue('N3', 'No Handphone');
				$objPHPExcel->getActiveSheet()->SetCellValue('O3', 'Email');
				// style of column
				$objPHPExcel->getActiveSheet()->getStyle('A3:O3')->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A3:O3')->applyFromArray($style_center);
				$objPHPExcel->getActiveSheet()->getStyle('A3:O3')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'D3D3D3')
						)
					)
				);
				
				$cell = $i+3;
				foreach ($rows as $k=>$v){
					$cell = $i+3;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, $i);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_center);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cell, date('j F Y', strtotime($v['tgl_daftar'])));
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra']);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cell, $v['skema']['nm_skema']);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cell, $v['jenis_daftar']['nm_jns_daftar']);
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cell, ucfirst($v['tipe']));
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$cell, $this->config->item('status_pendaftaran')[$v['status']]);
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['tempat_lahir'] : $v['mitra']['tmpt_lahir']);
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['tgl_lahir'] : $v['mitra']['tgl_lahir']);
					$objPHPExcel->getActiveSheet()->SetCellValue('J'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['jk_mhs'] : $v['mitra']['jk_mitra']);
					$objPHPExcel->getActiveSheet()->SetCellValue('K'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['alamat_mhs'] : $v['mitra']['alamat_mitra']);
					$objPHPExcel->getActiveSheet()->SetCellValue('L'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['kodepos'] : $v['mitra']['kd_pos']);
					$objPHPExcel->getActiveSheet()->SetCellValue('M'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['telp_rumah'] : $v['mitra']['work_telp']);
					$objPHPExcel->getActiveSheet()->SetCellValue('N'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['telp_hp'] : $v['mitra']['telp_hp']);
					$objPHPExcel->getActiveSheet()->SetCellValue('O'.$cell, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['email'] : $v['mitra']['email']);			
					
					$i++;
				}
				
				$objPHPExcel->getActiveSheet()->getStyle('A'. ($cell+1) .':O'. ($cell+1))->getFont()->setBold(true);
				//set border
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
						),
					),
				);
				$objPHPExcel->getActiveSheet()->getStyle('A3:O'.($cell+1))->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
				// $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
				break;
			case 'pembayaran':
				$objPHPExcel->getActiveSheet()->SetCellValue('A1', $report_title);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				
				// set header
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'ID Pembayaran');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Kode Pendaftaran');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Nama Pendaftar');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Tanggal Bayar');
				$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Jenis Bayar');
				$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Jumlah');
				// style of column
				$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($style_center);
				$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'D3D3D3')
						)
					)
				);
				$cell = $i+3;
				$grand_total = 0;
				foreach ($rows as $k=>$v){
					$cell = $i+3;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, $i);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_center);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cell, $v['id_pembayaran']);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cell, $v['id_pendaftaran']);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cell, $v['pendaftar']['tipe'] == 'mahasiswa' ? $v['pendaftar']['mahasiswa']['nm_mahasiswa'] : $v['pendaftar']['mitra']['nm_mitra']);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cell, date('j F Y', strtotime($v['tgl_bayar'])));
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cell, $v['jenis_daftar']['nm_jns_daftar']);
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$cell, $v['jumlah']);		
					$grand_total += $v['jumlah'];
					$i++;
				}
								
				$objPHPExcel->getActiveSheet()->SetCellValue('A'. ($cell+1) , 'Total');
				$objPHPExcel->getActiveSheet()->mergeCells('A'. ($cell+1) .':F'. ($cell+1));
				$objPHPExcel->getActiveSheet()->SetCellValue('G'. ($cell+1) , 'Rp '. $grand_total);
				$objPHPExcel->getActiveSheet()->getStyle('A'. ($cell+1) .':G'. ($cell+1))->getFont()->setBold(true);
				//set border
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
						),
					),
				);
				$objPHPExcel->getActiveSheet()->getStyle('A3:G'.($cell+1))->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				break;
			case 'jadwal' :
				$objPHPExcel->getActiveSheet()->SetCellValue('A1', $report_title);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				
				// set header
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Tempat Uji Kerja');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Skema');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Asesor');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Tanggal');
				$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Jumlah Peserta');
				// style of column
				$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($style_center);
				$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'D3D3D3')
						)
					)
				);
				$cell = $i+3;
				foreach ($rows as $k=>$v){
					$cell = $i+3;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cell, $i);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->applyFromArray($style_center);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cell, $v['tuk']['nm_tuk']);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cell, $v['skema']['nm_skema']);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cell, $v['asesor']['gelar_depan'] .' '. $v['asesor']['nm_asesor'] . ($v['asesor']['gelar_belakang'] != '' ? ', '. $v['asesor']['gelar_belakang'] : ''));
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cell, date('j F Y', strtotime($v['tgl_sertifikasi'])).' '. date('H:i', strtotime($v['jam_sertifikasi'])));
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cell, count($v['detail']).' Peserta');
					$i++;
				}
				$objPHPExcel->getActiveSheet()->getStyle('A'. ($cell+1) .':F'. ($cell+1))->getFont()->setBold(true);
				//set border
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
						),
					),
				);
				$objPHPExcel->getActiveSheet()->getStyle('A3:F'.($cell+1))->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				break;
		}
		
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Report');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel5)

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$report_title.'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
        $this->end();

	}
	
	
	
}
?>