<?php
use Illuminate\Database\Capsule\Manager as Capsule;
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapController extends MY_HomeController {
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
			'lsp_dtl_jadwal'
		]);
		$this->load->library(['tables','form_validation']);
		$this->checkLogin(['admin']);

		//fu1
		$this->search = [
			'search_start'	=> get('search_start'),
			'search_end'	=> get('search_end'),
			'search_asesor' => get('search_asesor'), 
			'search_tuk'	=> get('search_tuk'), 
			'search_skema'	=> get('search_skema')
		];

	}
	
	function index(){
		$rekap = false;
		
		if (get('search')){			
			
		}
		
		// echoPre($rekap);
		
		if (isPost()){
			if (post('search')!=''){
				$rekap = lsp_jadwal::where('status', '=', 1);
				// echoPre(post());
				if (post('skema')){
					$rekap = $rekap->where('id_skema', '=', post('skema')); 
					// $rekap = $rekap->where('id_skema', '=', post('skema')[0]);
				}

				if (post('id_asesor')){
					$rekap = $rekap->where('id_asesor', post('id_asesor')[0]);
				}
				
				if (post('kd_tuk')){
					$rekap = $rekap->where('kd_tuk', post('kd_tuk')[0]);
				}

				$rekap = $rekap->with('detail')
							->with('detail_daftar_hadir')
							->get();
				if ($rekap){
					$rekap = $rekap->toArray();
					$_rekap = [];
					foreach ($rekap as $k=>$v){
						$_rekap = array_merge($_rekap, $v['detail_daftar_hadir']);
					}
					$rekap['detail_daftar'] = $_rekap;
					// $rekap['detail_daftar'] = $rekap['detail_daftar_hadir'];
				}else 
					$rekap = [];
			} else {
				$jadwal = lsp_jadwal::where('id_jadwal', $this->input->post('id_jadwal', TRUE))
							->with('detail')
							->first()->toArray();
				$post = post();			
				foreach ($jadwal['detail'] as $k=>$v){
					$pendaftaran = lsp_pendaftaran::where('id_pendaftaran', $v['id_pendaftaran'])->first();
					
					$skema = lsp_skema::where('id_skema', $pendaftaran['id_skema'])->with('detail')->first()->toArray();
					$rekap = [];
					foreach ($skema['detail'] as $kk=>$vv){
						$rekap[$vv['id_dt_skema']] = isset($post['kompeten'][$v['id_pendaftaran']][$vv['id_dt_skema']]) ? 1 : 0;
					}
					//rubah status menjadi selesai ujian
					$pendaftaran->status = 3;
					$pendaftaran->rekap_asesmen = json_encode($rekap);
					$pendaftaran->save();
					
					$this->session->set_flashdata('status', 'success');	
					$this->session->set_flashdata('text', 'Success <strong>UPDATE</strong> asesmen');
					redirect(url('rekap-asesmen'));		
				}			
			}
		}
		
		$data = [
			'title'				=> 'Rekap Asesmen',
			'header_title'		=> 'Rekap Asesmen',
			'header_sub'		=> 'Rekap Asesmen !',
			'active_menu'		=> ['rekap-asesmen'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'rekap-asesmen', 'text'	=> 'Rekap Asesmen', 'class'	=> 'fa fa-check-square-o'], 
			], 
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/rekap-asesmen.js'
			],
			'rekap'				=> $rekap,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search,
			'skema_option'		=> lsp_skema::get()->toArray(),
			'jam'				=> $this->availableHour,
			'table'				=> $this->_buildTable($rekap),
			'option_tuk'		=> lsp_tuk::where('status', '=', 1)->get()->toArray(),
			'option_skema'		=> lsp_skema::get()->toArray(),
		];
		
		$this->render('asesmen/index', $data);
	}
	
	function search(){
		if (isPost())
		{
			$param     = [];
			$paramable = ['search_start', 'search_end','search_asesor', 'search_tuk', 'search_skema', 'search'];
			foreach ($paramable as $key => $value) {
				$post = post($value);
				if ($post && strtolower(@$post) != 'all'){
					if ($value == 'search_asesor')
						$post = $post[0];
					$param[$value] = $post;
				}					
			}
			redirect(url('rekap-asesmen', $param));
		}
	}
	
	function _buildTable($rekap=[], $skema=false){
		// if ($skema)
			// $skema = lsp_skema::where('id_skema', $skema)->with('detail')->first()->toArray();
		// echoPre($skema);
		return $this->load->view($this->config->item('layout').'/asesmen/_table', ['rekap'=>$rekap], TRUE);
	}
	
	function remote(){
		if (isAjax() && isPost()){
			switch(post('action')){
				case 'get-rekap':
					$rekap = lsp_jadwal::where('kd_tuk', $this->input->post('tuk', TRUE))
								->where('id_skema', $this->input->post('skema', TRUE))
								->where('id_asesor', $this->input->post('asesor', TRUE))
								->where('tgl_sertifikasi', $this->input->post('tanggal', TRUE))
								->where('jam_sertifikasi', $this->input->post('jam', TRUE))
								->with('detail')
								->with('detail_daftar_hadir')
								->where('status', '=', 1)
								->first();
					if ($rekap){
						$rekap = $rekap->toArray();
						$rekap['detail_daftar'] = $rekap['detail_daftar_hadir'];
					}else 
						$rekap = [];
					
					$return = [
						'status'	=> count($rekap) ? 'success' : 'failed',
						'html'		=> $this->_buildTable($rekap, post('skema'))
					];
					
					echo json_encode($return);
				break;
				case 'get-rekap-detail':
					$rekap = lsp_pendaftaran::where('id_pendaftaran', '=', post('id'))
							->with('skema_detail')
							->whereHas('jadwal', function($q){
								$q->where('status_kehadiran', '=', 1);
							})
							->first()
							->toArray();
					$view = $this->load->view($this->config->item('layout').'/asesmen/_table_modal', ['rekap'=>$rekap], TRUE);
					$result = [
						'status' => 'success',
						'html' => $view,
					];
					echo json_encode($result);
				break;
				case 'set-rekap':
					//cek		
					$pendaftaran = lsp_pendaftaran::where('id_pendaftaran', '=', post('id_pendaftaran'))->first();
					//delok kosong menjadikan aarray kosong| if isi - dijupuk di decode/ dadi array 
					$rekap = $pendaftaran['rekap_asesmen'] == '' ? [] : json_decode($pendaftaran['rekap_asesmen'], TRUE);
					// mengecek jika (detail skema pada array rekap ada dan isinya adalah 0 )ATAU tidak ada key detail skema pada array repak, maka akan diisi 1, jika tidak diisi 0	
					$rekap[post('id')] = isset($rekap[post('id')]) && @$rekap[post('id')] == 0 || !isset($rekap[post('id')]) ? 1 : 0;
					
					$pendaftaran->rekap_asesmen = json_encode($rekap);
					$pendaftaran->status = $pendaftaran->status > 3 ? $pendaftaran->status : 3;
					$pendaftaran->save();
					
					echo json_encode('sukses');
				break;
			}
		}
	}
}
?>