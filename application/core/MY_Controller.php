<?php
use Illuminate\Database\Capsule\Manager as DB;

class MY_HomeController extends CI_Controller{
	public $login;
	public $availableHour; 
	public $kode_pendaftaran = 'kd-[ID]';
	
	function __construct(){
		parent::__construct();
		//DB::enableQueryLog();
		$this->load->library(['session']);
		$this->load->helper(['url','form','html']);
		$this->load->model(['lsp_admin']);
		$this->login = $this->session->userdata('login');
		
		$this->availableHour = $this->config->item('availableHour');
	}
	
	protected function checkLogin($akses=[]){
		$login = $this->session->userdata('login');
		
		if (!$login)
			redirect(url().'login');
		else {
			if (in_array($login['status'], $akses))
				return $login;
			else 
				redirect(url());
		}
			
	}
	
	protected function render($view = '', $data = []){
		if ($view == '')
			$view = false;
	
		$data['active_menu']		= (isset($data['active_menu']) ? $data['active_menu'] : false);
		$data['content'] 			= $view ? $this->load->view($this->config->item('layout').'/'.$view,$data,TRUE) : '';
		//$data['show_query'] 		= $this->load->view('_system/_bottom_bar', ['query' => DB::getQueryLog()], TRUE);
		
		$this->load->view('layout/layout',$data);
	}
	
	function _historyPendaftaran($id=false, $type=false){
		if ($id && $type){
			$history = lsp_pendaftaran::where('id_detail_pendaftar', $id)
					->whereHas('jenis_daftar', function($q){
						return $q->where('is_ujian', '=', 1);
					})
					->where('status', '!=', 9)
					->where('tipe',$type)
					->with('jenis_daftar')
					->with('skema')
					->get();
			if ($history)
				$history = $history->toArray();
			else
				$history = [];
			$_temp = [];
			
			foreach ($history as $k=>$v){
				$_temp[$v['id_skema']][$v['id_jns_daftar']] = $v['status'];
				
				if ($v['status'] >= 1 && $v['status'] < 4)
					$_temp['aktif'] = [
						'id_pendaftaran' => $v['id_pendaftaran'],
						'id_jns_daftar'  => $v['id_jns_daftar'],
						'id_skema'       => $v['id_skema'],
						'nama_jenis'     => $v['jenis_daftar']['nm_jns_daftar'],
						'nama_skema'     => $v['skema']['nm_skema'],
					];
			}
			return $_temp;
		}
	}
}