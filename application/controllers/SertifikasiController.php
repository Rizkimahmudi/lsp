<?php
use Illuminate\Database\Capsule\Manager as Capsule;
defined('BASEPATH') OR exit('No direct script access allowed');

class SertifikasiController extends MY_HomeController {
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
		$this->search = ['k'=> get('k')];
	}
	
	function index(){
		$this->page = get('page', 1);
		$sertifikasi = false;	
		$param = [];
		
		$rows = lsp_pendaftaran::where('status', '>=', 3)->where('status', '<=', 5);
		
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
			$rows[$k]['detail']	= '<button class="btn btn-sm btn-default detail-sertifikasi" data-id="'.$v['id_pendaftaran'].'"><i class="fa fa-file"></i></button>';
			$rows[$k]['action']	= $this->load->view($this->config->item('layout').'/sertifikasi/_action', ['sertifikasi'=>$v, 'param'=>$param], TRUE);
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '50px', 'class' => 'text-center'),
            array('header' => 'Nama', 'data' => 'nama'),
            array('header' => 'Skema', 'data' => 'skema'),
            array('header' => 'Asesor', 'data' => 'asesor', 'width' => '200px'),
            array('header' => 'TUK', 'data' => 'tuk', 'width' => '150px'),
            array('header' => 'Detail', 'data' => 'detail', 'width' => '100px'),
            array('header' => 'Kompeten ?', 'data' => 'action', 'width' => '130px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('hasil-sertifikasi/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
		
		$data = [
			'title'				=> 'Hasil Sertifikasi',
			'header_title'		=> 'Hasil Sertifikasi',
			'header_sub'		=> 'tentukan kompeten dan tidaknya pendaftar',
			'active_menu'		=> ['hasil-sertifikasi'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'hasil-sertifikasi', 'text'	=> 'Hasil Sertifikasi', 'class'	=> 'fa fa-check-square'], 
			], 
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/hasil-sertifikasi.js'
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
		
		$this->render('sertifikasi/index', $data);
	}
	
	function remote(){
		if (isPost() && isAjax())
			switch (post('action')){
				//insert sertifikasi
				case 'update-pendaftaran':
					$pendaftaran = lsp_pendaftaran::where('id_pendaftaran', $this->input->post('id', TRUE))->first();
					$pendaftaran->status = $pendaftaran->status == 3 || $pendaftaran->status == 5 ? 4 : 5;
					$pendaftaran->save();
					
					echo json_encode($pendaftaran->status == 4 ? 'lulus' : 'tidak lulus');
				break;
				case 'get-detail' :
					$pendaftaran = lsp_pendaftaran::where('id_pendaftaran', post('id'))->with('skema_detail')->first();
					$kompeten = $pendaftaran['rekap_asesmen'] != '' ? json_decode($pendaftaran['rekap_asesmen'], TRUE) : [];
					// echoPre($kompeten);
					$html = '<div class="row">
					<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center" style="width:70px;">No</th>
											<th class="text-center">Kode Unit</th>
											<th class="text-center" style="width:400px;">Judul Unit</th>
											<th class="text-center" style="width:100px;">Kompeten</th>
										</tr>
									</thead>
									<tbody>';
					if (count($pendaftaran['skema_detail']['detail'])){
						$i = 1;
						foreach ($pendaftaran['skema_detail']['detail'] as $k=>$v){
							$html.= '<tr>
										<td>'. $v['id_dt_skema'] .'</td>
										<td>'. $v['kd_unit'] .'</td>
										<td>'. $v['jdl_kompetensi'] .'</td>
										<td><label class="label label-'. (isset($kompeten[$v['id_dt_skema']]) && @$kompeten[$v['id_dt_skema']] == 1 ? 'success' : 'warning') .'">'. (isset($kompeten[$v['id_dt_skema']]) && @$kompeten[$v['id_dt_skema']] == 1 ? 'Kompeten' : 'Belum Kompeten') .'</label></td>
									</tr>';
							$i++;
						}
					}
										
					$html.='		</tbody>
								</table>
							</div>
						</div>
					</div>';
					
					echo json_encode($html);
				break;
			}
	}
	
	function search(){
		$param     = [];
		$paramable = ['k'];
		foreach ($paramable as $key => $value) {
			$post = post($value);
			if ($post)
				$param[$value] = $post;
		}
		redirect(url('hasil-sertifikasi', $param));
	}
}

?>