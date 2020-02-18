<?php
use Illuminate\Database\Capsule\Manager as Capsule;
defined('BASEPATH') OR exit('No direct script access allowed');

class PembayaranController extends MY_HomeController {
	private $limit = 25;
	private $page = 1;
	private $search;
	
	function __construct(){
		parent::__construct();
		$this->load->model([
			'lsp_mahasiswa',
			'lsp_mitra',
			'lsp_skema',
			'lsp_pendaftaran',
			'lsp_jns_daftar',
			'lsp_pembayaran'
		]);
		$this->load->library(['tables','form_validation']);
		$this->checkLogin(['admin']);
		$this->search = [
			'k'			=> get('k'),
			'start'	=> get('start'),
			'end'		=> get('end'),
			'tipe'		=> get('tipe', 'all'),
			'jenis'	=> get('jenis', 'all'),
		];
	}
	
	function index(){
		$this->page = get('page', 1);
		$param = [];
		$pembayaran = false; 
		
		$rows = new lsp_pembayaran();
		
		if (get('k')){
			$rows = $rows->whereHas('pendaftar', function($qq){
				$qq->where(function($query){
					$query->whereHas('mahasiswa', function($q){
						$q->where('nm_mahasiswa','LIKE', '%'.get('k').'%');
					})
					->orWhereHas('mitra', function($q){
						$q->where('nm_mitra','LIKE', '%'.get('k').'%');
					});
				});		
			});
			$param['k'] = $this->input->get('k');
		}
				
		if (get('start') && get('end')){
			if (strtotime(get('start')) > strtotime(get('end'))){
				$_temp = get('start');
				$this->search['start'] = get('end');
				$this->search['end'] = $_temp;
			}
		}
		
		if (get('start')){
			$rows = $rows->where('tgl_bayar', '>=', $this->search['start']);
			$param['start'] = $this->search['start'];
		}
		
		if (get('end')){
			$rows = $rows->where('tgl_bayar', '<=', $this->search['end'] );
			$param['end'] = $this->search['end'];
		}
		
		if (get('jenis') && get('jenis') != 'all'){
			$rows = $rows->where('id_jenis_bayar','=', $this->search['jenis']);
			$param['jenis'] = $this->search['jenis'];
		}
		
		if (get('tipe') && get('tipe') != 'all'){
			$rows = $rows->whereHas('pendaftar', function($q){
				$q->where('tipe', '=', $this->search['tipe']);
			});
			$param['tipe'] = $this->search['tipe'];
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->whereHas('pendaftar', function($q){
						$q->where('status', '!=', 9);
					})
					->with('jenis_daftar')
					->with('pendaftar')
					->orderBy('tgl_bayar', 'DESC')
					->get();
					
		if ($rows)
			$rows = $rows->toArray();
		else 
			$rows = [];
		
		$i = $offset;
		foreach ($rows as $k=>$v){
			$rows[$k]['number'] = $i+1;
			$rows[$k]['tanggal'] = date('d F Y', strtotime($v['tgl_bayar'])); //.'<br/>'. date('H:i:s', strtotime($v['tgl_bayar']));
			$rows[$k]['nm_jns'] = $v['jenis_daftar']['nm_jns_daftar'];
			$rows[$k]['pendaftar'] = $v['pendaftar']['tipe'] == 'mahasiswa' ? $v['pendaftar']['mahasiswa']['nm_mahasiswa'].'<br/><small><b>[mahasiswa]</b></small>' : $v['pendaftar']['mitra']['nm_mitra'].'<br/><small><b>[mitra]</b></small>';
			$rows[$k]['jumlah'] = 'Rp'. number_format($v['jumlah'],0,",",".");
			$rows[$k]['action']	= $this->load->view($this->config->item('layout').'/pembayaran/_action', ['action'=>'pembayaran', 'pembayaran'=>$v, 'param'=>$param], TRUE);
			$i++;
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Tanggal', 'data' => 'tanggal', 'width' => '140px'),
            array('header' => 'Pendaftar', 'data' => 'pendaftar'),
            array('header' => 'Jenis Daftar', 'data' => 'nm_jns', 'width'=>'120px'),
            array('header' => 'Jumlah', 'data' => 'jumlah', 'width' => '120px'),
            array('header' => 'Action', 'data' => 'action', 'width' => '50px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('pembayaran/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
			
		$jns_daftar = lsp_jns_daftar::where('status', 1)->get()->toArray();
		
		$data = [
			'title'				=> 'Pembayaran - LSP STIKI',
			'header_title'		=> 'Data Pembayaran',
			'header_sub'		=> 'manage data pembayaran !',
			'active_menu'		=> ['pembayaran'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'pembayaran', 'text'	=> 'Pembayaran', 'class'	=> 'fa fa-money'], 
			],
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'js/custom/pembayaran.js'
			],
			'pembayaran'		=> $pembayaran,
			'total'				=> $total,
			'table'				=> $table,
			'offset'				=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'form'				=> $this->_form($pembayaran, $param),
			'search'				=> $this->search,
			'jns_daftar'		=> $jns_daftar
		];
		
		$this->render('pembayaran/index', $data);
	}
	
	function remote(){
		if (isPost() && isAjax()){
			switch ($this->input->post('action')) {
				case 'get-pendaftaran':
					$pendaftaran = lsp_pendaftaran::where('status', 1)
						->where(function($query){
							$query->whereHas('mahasiswa', function($q){
								if (ctype_digit(post('query'))){
									$q->whereRaw("CAST(NRP as CHAR) LIKE '".post('query')."%'")
										->orWhere('nm_mahasiswa','LIKE', '%'.post('query').'%');
								} else 
									$q->where('nm_mahasiswa','LIKE', '%'.post('query').'%');
							})
							->orWhereHas('mitra', function($q){
								$q->where('nm_mitra','LIKE', '%'.post('query').'%');
							});
						})						
						->with('mitra')
						->with('mahasiswa')
						->take(10)
						->get()
						->toArray();
					
					$return = [];
					foreach ($pendaftaran as $k=>$v){
						$name = $v['tipe']=='mahasiswa' ? '['.$v['mahasiswa']['NRP'].'] '. $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra'];
						$return[] = ['id' => $v['id_pendaftaran'], 'name' => $name];
					}
					
					echo json_encode($return);
				break;
				case 'get-detail-pendaftar' :
					$pendaftar = lsp_pendaftaran::where('id_pendaftaran', '=', post('id'))
							->with('mitra')
							->with('mahasiswa')
							->with('skema')
							->with('jenis_daftar')
							->first();		
					
					$bayar = json_decode($pendaftar['jenis_daftar']['jmlh_bayar'], TRUE);
					$bayar = isset($bayar[$pendaftar['tipe']]) ? $bayar[$pendaftar['tipe']] : 0;
					$form = '
							<input type="hidden" name="id_pendaftaran" value="'.$pendaftar['id_pendaftaran'].'" />
							<div class="form-group" style="display:block">
								<label for="form-jdl_kompetensi" class="control-label col-md-5" style="font-weight: normal">Nama</label>
								<label for="form-jdl_kompetensi" class="control-label col-md-7">'.($pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['nm_mahasiswa'] : $pendaftar['mitra']['nm_mitra']).'</label>
							</div>
							<div class="form-group" style="display:block">
								<label for="form-jdl_kompetensi" class="control-label col-md-5" style="font-weight: normal">Tipe</label>
								<label for="form-jdl_kompetensi" class="control-label col-md-7">'.$pendaftar['tipe'].'</label>
							</div>
							<div class="form-group" style="display:block">
								<label for="form-jdl_kompetensi" class="control-label col-md-5" style="font-weight: normal">Skema</label>
								<label for="form-jdl_kompetensi" class="control-label col-md-7">'.$pendaftar['skema']['nm_skema'].'</label>
							</div>
							<div class="form-group" style="display:block">
								<label for="form-jdl_kompetensi" class="control-label col-md-5" style="font-weight: normal">Jenis</label>
								<label for="form-jdl_kompetensi" class="control-label col-md-7">'.$pendaftar['jenis_daftar']['nm_jns_daftar'].'</label>
							</div>
							<div class="form-group" style="display:block">
								<label for="form-jdl_kompetensi" class="control-label col-md-5" style="font-weight: normal">Tgl Daftar</label>
								<label for="form-jdl_kompetensi" class="control-label col-md-7">'.date('d F Y').'</label>
							</div>
							<div class="form-group" style="display:block">
								<label for="form-jdl_kompetensi" class="control-label col-md-5" style="font-weight: normal">Dibayar</label>
								<label for="form-jdl_kompetensi" class="control-label col-md-6">Rp'. number_format($bayar,0,",",".").'</label>
							</div>
							<div class="form-group" style="display:block">
								<label for="form-jdl_kompetensi" class="control-label col-md-5" style="font-weight: normal">Tgl Bayar</label>
								<div class="col-md-7">
									<div class="input-group date">
									  <div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									  </div>
									  <input type="text" required name="tgl_bayar" value="'.date('Y-m-d').'" class="form-control pull-right datepicker" onkeydown="return false">
									</div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Bayar</button>
							</div>
						';
					
					$return = [
						'html'	=> $form,
						'status'	=> 'success'
					];
					
					echo json_encode($return);
			}
		}
	}
	//add
	function _form($pembayaran=false, $param=[]){
		if (isPost()){
			$this->form_validation->set_rules('id_pendaftaran', 'Pendaftaran', 'required');
			$this->form_validation->set_rules('tgl_bayar', 'Pendaftaran', 'required');
			
			if ($this->form_validation->run() != FALSE){
				$pendaftar = lsp_pendaftaran::where('id_pendaftaran', '=', $this->input->post('id_pendaftaran'))
						->with('mahasiswa')->with('mitra')->with('jenis_daftar')
						->first();
				$pendaftar->status = 2; 
				$pendaftar->save();
				//
				$jmlh_bayar = json_decode($pendaftar['jenis_daftar']['jmlh_bayar'], TRUE);
				
				$pembayaran = new lsp_pembayaran();
				$pembayaran->id_pendaftaran = $pendaftar->id_pendaftaran;
				$pembayaran->tgl_bayar = $this->input->post('tgl_bayar'); //date('Y-m-d H:i:s');
				$pembayaran->id_jenis_bayar = $pendaftar->id_jns_daftar;
				$pembayaran->jumlah = isset($jmlh_bayar[$pendaftar['tipe']]) ? $jmlh_bayar[$pendaftar['tipe']] : 0;
				$pembayaran->save();
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>ADD NEW</strong> pembayaran <strong>"' . ($pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['nm_mahasiswa'] : $pendaftar['mitra']['nm_mitra']) . '"</strong>');
				redirect(url('pembayaran'));			
			}
		}
		
		$data = [
			'param'				=> $param,
			'pembayaran'	=> $pembayaran
		];
		
		return $this->load->view($this->config->item('layout').'/pembayaran/_form', $data, TRUE);
	}
	
	function search(){
		if (isPost())
		{
			$param     = [];
			$paramable = ['k', 'start','end', 'tipe', 'jenis'];
			foreach ($paramable as $key => $value) {
				$post = post($value);
				if ($post)
					$param[$value] = $post;
			}
			redirect(url('pembayaran', $param));
		}
	}
	
	function delete(){
		if (get('id')){
			$pembayaran = lsp_pembayaran::where('id_pembayaran', '=', $this->input->get('id', TRUE))->first();
			$pendaftaran = lsp_pendaftaran::where('id_pendaftaran', '=', $pembayaran['id_pendaftaran'])->first();
			if ($pendaftaran['status'] == 2){
				$pendaftaran->status = 1;
				$pendaftaran->save();
				
				$pembayaran->delete();
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>DELETE</strong> pembayaran id <strong>"' . $pembayaran->id_pembayaran . '"</strong>');
			} else {
				$this->session->set_flashdata('status', 'danger');	
				$this->session->set_flashdata('text', 'GAGAL <strong>DELETE</strong> pembayaran id <strong>"' . $pembayaran->id_pembayaran . '"</strong>');
			}
			
		}
		redirect(url('pembayaran'));
	}
	
}

?>