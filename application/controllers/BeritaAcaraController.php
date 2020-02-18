<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaAcaraController extends MY_HomeController {
	private $limit = 25;
	private $page = 1;
	private $search = [];
	
	function __construct(){
		parent::__construct();
		$this->load->model([
			'lsp_pendaftaran',
			'lsp_mahasiswa',
			'lsp_mitra',
			'lsp_jadwal',
			'lsp_dtl_jadwal',
			'lsp_tuk',
			'lsp_asesor',
			'lsp_skema',
		]);
		$this->load->library(['tables','form_validation', 'word']);
		$this->checkLogin(['admin', 'peserta', 'manager']);		
		
		$this->search = [
			'search_start'	=> get('search_start'),
			'search_end'	=> get('search_end'),
			'search_asesor' => get('search_asesor'), 
			'search_tuk'	=> get('search_tuk'), 
			'search_skema'	=> get('search_skema')
		];
	}
	
	function index(){
		$param = false;
		
		$jadwal = lsp_jadwal::where('status', '=', '1');
		
		if ($this->search['search_start'] && $this->search['search_end']){
			if (strtotime($this->search['search_start']) > strtotime($this->search['search_end'])){
				$_temp = $this->search['search_start'];
				$this->search['search_start'] = $this->search['search_end'];
				$this->search['search_end'] = $_temp;
			}
		}
		
		if ($this->search['search_start']){
			$jadwal = $jadwal->where('tgl_sertifikasi', '>=', $this->search['search_start']);
			$param['search_start'] = $this->search['search_start'];
		}		
		
		if ($this->search['search_end']){
			$jadwal = $jadwal->where('tgl_sertifikasi', '<=', $this->search['search_end']);
			$param['search_end'] = $this->search['search_end'];
		}
		
		if ($this->search['search_asesor']){
			$jadwal = $jadwal->where('id_asesor', $this->input->get('search_asesor', TRUE));
			$param['search_asesor'] = get('search_asesor');
		}
		
		if ($this->search['search_tuk']){
			$jadwal = $jadwal->where('kd_tuk', $this->input->get('search_tuk', TRUE));
			$param['search_tuk'] = get('search_tuk');
		}
		
		if ($this->search['search_skema']){
			$jadwal = $jadwal->where('id_skema', $this->input->get('search_skema', TRUE));
			$param['search_skema'] = get('search_skema');
		}
		
		// $total = clone $jadwal;
		$total = $jadwal->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$jadwal = $jadwal->orderBy('tgl_sertifikasi', 'DESC')
						->with('asesor')
						->with('tuk')
						->with('skema')
						->take($this->limit)->skip($offset)
						->get();
		if ($jadwal)
			$jadwal = $jadwal->toArray();
		else 
			$jadwal = [];
		
		$i = $offset;
		foreach ($jadwal as $k=>$v){
			$time = strtotime($v['tgl_sertifikasi'].' '.$v['jam_sertifikasi']);
			
			$jadwal[$k]['number']    = $i+1;
			$jadwal[$k]['hari']      = hari(date('N', $time)).' / '. date('j', $time) .' '. bulan(date('n', $time)).' '. date('Y H:i', $time);
			$jadwal[$k]['nm_skema']  = $v['skema']['nm_skema'];
			$jadwal[$k]['tempat']    = $v['tuk']['nm_tuk'];
			$jadwal[$k]['nm_asesor'] = $v['asesor']['nm_asesor'];
			$jadwal[$k]['action']    = '<a class="btn btn-primary btn-sm" href="'.url('berita-acara/'.$v['id_jadwal'] ).'" target="_blank"><i class="fa fa-save"></i> Berita Acara</a>'; 
			$i++;
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Hari', 'data' => 'hari'),
            array('header' => 'Skema', 'data' => 'nm_skema', 'width' => '150px'),
            array('header' => 'Tempat', 'data' => 'tempat', 'width' => '150px'),
            array('header' => 'Asesor', 'data' => 'nm_asesor', 'width' => '200px'),
            array('header' => 'Action', 'data' => 'action', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $jadwal, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('berita-acara/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Berita Acara - LSP STIKI',
			'header_title'		=> 'Berita Acara',
			'header_sub'		=> 'Manage Mahasiswa data !',
			'active_menu'		=> ['berita-acara'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'berita-acara', 'text'	=> 'Berita Acara', 'class'	=> 'fa fa-users'], 
			],
			'custom_js'			=> [
				url_cdn().'js/custom/berita-acara.js'
			],
			'jadwal'			=> $jadwal,
			'total'				=> $total,
			'table'				=> $table,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
			'option_tuk'		=> lsp_tuk::where('status', '=', 1)->get()->toArray(),
			'option_skema'		=> lsp_skema::get()->toArray(),
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search
		];
		
		$this->render('berita-acara/index', $data);
	}
	
	function export($id_jadwal=false){
		//jupuk tbl jdwal - id jdwale = id jdwl
		$jadwal = lsp_jadwal::where('id_jadwal', '=', $id_jadwal)
						->where('status', '=', '1')
						->with('asesor')
						->with('skema')
						->with('tuk')
						->with('detail_daftar_hadir')
						->first()->toArray();
		
		$time = strtotime($jadwal['tgl_sertifikasi'].' '.$jadwal['jam_sertifikasi']);
		
		$filename = FCPATH. '/assets/temp/berita-acara-'. $jadwal['id_jadwal'].'.docx'; //li
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH. '/assets/template/Berita-Acara.docx');
		$templateProcessor->cloneRow('no', count($jadwal['detail_daftar_hadir']));
		$i = 1;
		$k = $bk = 0;
		foreach ($jadwal['detail_daftar_hadir'] as $k=>$v){
			$templateProcessor->setValue('no#'. $i, $i);
			$templateProcessor->setValue('nama#'. $i, $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra']);
			$templateProcessor->setValue('hasil#'. $i, $v['status'] == 4 ? 'K' : 'BK');
			$k  += $v['status'] == 4 ? 1 : 0;
			$bk += $v['status'] == 4 ? 0 : 1;
			$i++;
		}
		$a = $jadwal['asesor'];
		$templateProcessor->setValue('jmlh_peserta', count($jadwal['detail_daftar_hadir']).' Peserta');
		$templateProcessor->setValue('jmlh_kompeten', $k.' Peserta');
		$templateProcessor->setValue('jmlh_belum_kompeten', $bk.' Peserta');
		$templateProcessor->setValue('hari', hari(date('N', $time)));
		$templateProcessor->setValue('tanggal', date('j', $time) .' '. bulan(date('n', $time)) .' '. date('Y', $time));
		$templateProcessor->setValue('w_a', date('H:i', $time));
		$templateProcessor->setValue('w_aa', 'selesai');
		$templateProcessor->setValue('skema', $jadwal['skema']['nm_skema']);
		$templateProcessor->setValue('tempat', 'STIKI - '. $jadwal['tuk']['nm_tuk']);
		$templateProcessor->setValue('asesor', ($a['gelar_depan'] != '' ? $a['gelar_depan'].' ' : '') . $a['nm_asesor'] . ($a['gelar_belakang'] != '' ? ', '. $a['gelar_belakang']: ""));
		$templateProcessor->setValue('no_met', $a['no_met']);
		$templateProcessor->setValue('today', date('d-m-Y'));
		
		$templateProcessor->saveAs($filename);	
		
		$file_url = assets_url().'/temp/berita-acara-'. $jadwal['id_jadwal'] .'.docx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");	
		ob_clean(); flush();		
		readfile($file_url);
	}
	
	function search(){
		if (isPost())
		{
			$param     = [];
			$paramable = ['search_start', 'search_end','search_asesor', 'search_tuk', 'search_skema'];
			foreach ($paramable as $key => $value) {
				$post = post($value);
				if ($post && strtolower(@$post) != 'all'){
					if ($value == 'search_asesor')
						$post = $post[0];
					$param[$value] = $post;
				}					
			}
			redirect(url('berita-acara', $param));
		}
	}

	
	
}	
?>