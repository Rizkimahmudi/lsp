<?php
use Illuminate\Database\Capsule\Manager as Capsule;
defined('BASEPATH') OR exit('No direct script access allowed');

class ValidasiController extends MY_HomeController {
	private $limit = 25;
	private $page = 1;
	private $search;
	
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
			'lsp_sertifikat'
		]);
		$this->load->library(['tables','form_validation', 'word']);
		$this->checkLogin(['admin']);
		$this->search = ['k'=> get('k')];
	}
	
	function index(){
		$this->page = get('page', 1);
		$sertifikasi = false;	
		$param = [];
		
		$rows = lsp_pendaftaran::where('status', '=', 4);
		
		if (get('k')){
			$rows = $rows->where(function($query){
						$query->whereHas('mahasiswa', function($q){
							if (ctype_digit(post('query'))){
								$q->whereRaw("CAST(NRP as CHAR) LIKE '".get('k')."%'")
									->orWhere('nm_mahasiswa','LIKE', '%'.get('k').'%');
							} else 
								$q->where('nm_mahasiswa','LIKE', '%'.get('k').'%');
						})
						->orWhereHas('mitra', function($q){
							$q->where('nm_mitra','LIKE', '%'.get('k').'%');
						});
					});
			$param['k'] = get('k');
		}
			
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)			
					->with('mitra')
					->with('mahasiswa')
					->with('skema')
					->with('jadwal')
					->with('sertifikat')
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
			$rows[$k]['skema'] = $v['skema']['nm_skema'];
			$rows[$k]['tuk'] = $v['jadwal']['jadwal']['tuk']['nm_tuk'];
			$rows[$k]['asesor'] = $v['jadwal']['jadwal']['asesor']['gelar_depan'].' '.$v['jadwal']['jadwal']['asesor']['nm_asesor'].', '.$v['jadwal']['jadwal']['asesor']['gelar_belakang'];
			$rows[$k]['action']	= $this->load->view($this->config->item('layout').'/validasi/_action', ['sertifikat'=>$v, 'param'=>$param], TRUE);
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '50px', 'class' => 'text-center'),
            array('header' => 'Nama', 'data' => 'nama'),
            array('header' => 'Skema', 'data' => 'skema'),
            array('header' => 'Asesor', 'data' => 'asesor', 'width' => '200px'),
            array('header' => 'TUK', 'data' => 'tuk', 'width' => '150px'),
            array('header' => 'Action', 'data' => 'action', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('validasi-sertifikat/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Validasi Sertifikat',
			'header_title'		=> 'Validasi Sertifikat',
			'header_sub'		=> 'validasi sertifikat',
			'active_menu'		=> ['validasi-sertifikat'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'validasi-sertifikat', 'text'	=> 'Validasi Sertifikat', 'class'	=> 'fa fa-check-square-o'], 
			], 
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
			],
			'sertifikasi'		=> $sertifikasi,
			'total'				=> $total,
			'table'				=> $table,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search,
		];
		
		$this->render('validasi/index', $data);
	}
	
	function detail($id=false){
		if (isPost()){
			$this->form_validation->set_rules('tgl_mulai_sertifikat', 'Berlaku Dari', 'required');
			$this->form_validation->set_rules('tgl_selesai_sertifikat', 'Berlaku Sampai', 'required');
			
			if ($this->form_validation->run() != false){
				$sertifikat = lsp_sertifikat::firstOrNew(['id_pendaftaran' => $this->input->post('id_pendaftaran',TRUE)]);
				$sertifikat->tgl_mulai_sertifikat = $this->input->post('tgl_mulai_sertifikat', TRUE);
				$sertifikat->tgl_selesai_sertifikat = $this->input->post('tgl_selesai_sertifikat', TRUE);
				$sertifikat->status_sertifikat = $this->input->post('validasi', TRUE);
				$sertifikat->save();
				//inert
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>UPDATE</strong> sertifikat');
				redirect(url('validasi-sertifikat'));
			}
		}
		
		$pendaftar = lsp_pendaftaran::where('id_pendaftaran', $id)
						->with('mahasiswa')
						->with('mitra')
						->with('skema_detail')
						->with('sertifikat')
						->first();
		
		if ($pendaftar)
			$pendaftar = $pendaftar->toArray();
		
		// echoPre($pendaftar);
		$data = [
			'title'				=> 'Detail Validasi Sertifikat',
			'header_title'		=> 'Validasi Sertifikat',
			'header_sub'		=> 'validasi sertifikat',
			'active_menu'		=> ['validasi-sertifikat'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'validasi-sertifikat', 'text'	=> 'Validasi Sertifikat', 'class'	=> 'fa fa-check-square-o'], 
				['url'	=> '#', 'text'	=> 'Detail', 'class'	=> 'fa fa-list'], 
			], 
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'js/custom/validasi-sertifikat.js',
			],
			'pendaftar'	=> $pendaftar,
		];
		
		$this->render('validasi/_form', $data);
	}
	
	function export($id=false){
		if (!$id)
			redirect(url('validasi-sertifikat'));
		
		$pendaftar = lsp_pendaftaran::where('id_pendaftaran', $id)
						->with('mahasiswa')
						->with('mitra')
						->with('skema_detail')
						->with('sertifikat')
						->first();
		
		$time = strtotime($pendaftar['sertifikat']['tgl_mulai_sertifikat']);
		$nama = $pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['nm_mahasiswa']: $pendaftar['mitra']['nm_mitra'] ;
		
		$filename = FCPATH. '/assets/temp/sertifikat-'. $pendaftar['id_pendaftaran'].'.docx'; //li
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH. '/assets/template/Sertifikat.docx');
		
		$templateProcessor->setValue('nama', $nama);
		$templateProcessor->setValue('skema', $pendaftar['skema_detail']['nm_skema']);
		$templateProcessor->setValue('tanggal', date('j', $time) .' '. bulan(date('n', $time)) .' '. date('Y', $time));
		$templateProcessor->setValue('hariini', date('j', time()) .' '. bulan(date('n', time())) .' '. date('Y', time()));
		
		$templateProcessor->saveAs($filename);	
		
		$file_url = assets_url().'/temp/sertifikat-'. $pendaftar['id_pendaftaran'] .'.docx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");	
		ob_clean(); flush();		
		readfile($file_url);
	}
	
	function search(){
		$param     = [];
		$paramable = ['k'];
		foreach ($paramable as $key => $value) {
			$post = post($value);
			if ($post)
				$param[$value] = $post;
		}
		redirect(url('validasi-sertifikat', $param));
	}
	
}

?>