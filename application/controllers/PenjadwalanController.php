<?php
use Illuminate\Database\Capsule\Manager as Capsule;
defined('BASEPATH') OR exit('No direct script access allowed');

class PenjadwalanController extends MY_HomeController {
	private $limit = 25;
	private $page = 1;
	private $search;
	
	function __construct(){
		parent::__construct();
		$this->load->model([
			'lsp_mahasiswa',
			'lsp_mitra',
			'lsp_skema',
			'lsp_tuk',
			'lsp_asesor',
			'lsp_pendaftaran',
			'lsp_jns_daftar',
			'lsp_jadwal',
			'lsp_dtl_jadwal'
		]);
		$this->load->library(['tables','form_validation', 'word']);
		$this->checkLogin(['admin']);
		$this->search = [
			'search_start'	=> get('search_start'),
			'search_end'	=> get('search_end'),
			'search_asesor' => get('search_asesor'), 
			'search_tuk'	=> get('search_tuk'), 
			'search_skema'	=> get('search_skema')
		];
	}
	
	function index(){		
		$this->page = get('page', 1);
		$param = [];
		$penjadwalan = false; 
		
		$rows = new lsp_jadwal();
		
		if ($this->search['search_start'] && $this->search['search_end']){
			if (strtotime($this->search['search_start']) > strtotime($this->search['search_end'])){
				$_temp = $this->search['search_start'];
				$this->search['search_start'] = $this->search['search_end'];
				$this->search['search_end'] = $_temp;
			}
		}
		
		if ($this->search['search_start']){
			$rows = $rows->where('tgl_sertifikasi', '>=', $this->search['search_start']);
			$param['search_start'] = $this->search['search_start'];
		}		
		
		if ($this->search['search_end']){
			$rows = $rows->where('tgl_sertifikasi', '<=', $this->search['search_end']);
			$param['search_end'] = $this->search['search_end'];
		}
		
		if ($this->search['search_asesor']){
			$rows = $rows->where('id_asesor', $this->input->get('search_asesor', TRUE));
			$param['search_asesor'] = get('search_asesor');
		}
		
		if ($this->search['search_tuk']){
			$rows = $rows->where('kd_tuk', $this->input->get('search_tuk', TRUE));
			$param['search_tuk'] = get('search_tuk');
		}
		
		if ($this->search['search_skema']){
			$rows = $rows->where('id_skema', $this->input->get('search_skema', TRUE));
			$param['search_skema'] = get('search_skema');
		}
		
		$total = $rows->count();
		
		$offset = ($this->limit * ($this->page - 1));
		$rows = $rows->take($this->limit)->skip($offset)
					->with('tuk')
					->with('skema')
					->with('asesor')
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
			$rows[$k]['tanggal'] = date('d F Y', strtotime($v['tgl_sertifikasi']));
			$rows[$k]['jam'] = date('H:i', strtotime($v['jam_sertifikasi']));
			$rows[$k]['nm_tuk'] = $v['tuk']['nm_tuk'];
			$rows[$k]['nm_skema'] = $v['skema']['nm_skema'];
			$rows[$k]['nm_asesor'] = $v['asesor']['nm_asesor'];
			$rows[$k]['jumlah'] = '<span id="count-'. $v['id_jadwal'] .'">'. count($v['detail']).' Peserta</span>' ;
			$rows[$k]['action']	= $this->load->view($this->config->item('layout').'/penjadwalan/_action', ['action'=>'jadwal', 'jadwal'=>$v, 'param'=>$param], TRUE);
			$i++;
		}
		
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Tanggal', 'data' => 'tanggal', 'width' => '150px'),
            array('header' => 'Jam', 'data' => 'jam', 'width' => '100px'),
            array('header' => 'TUK', 'data' => 'nm_tuk', 'width'=>'150px'),
            array('header' => 'Skema', 'data' => 'nm_skema', 'width' => '150px'),
            array('header' => 'Asesor', 'data' => 'nm_asesor', 'width' => '150px'),
            array('header' => 'Detail', 'data' => 'jumlah'),
            array('header' => 'Action', 'data' => 'action', 'width' => '170px')
        );

        $table = $this->tables->create_list(['class' => 'table'], $rows, $column);
		
		$pagination_config = array(
            'total_rows'      => $total,
            'page'            => $this->page,
            'total_side_link' => 3,
            'per_page'        => $this->limit,
            'class'           => 'pull-right',
            'base_url'        => url('penjadwalan/?', $param),
        );
        $pagination        = $this->tables
            ->set_pagination($pagination_config)
            ->link_pagination();
			
		$jns_daftar = lsp_jns_daftar::where('status', 1)->get()->toArray();
		
		$data = [
			'title'				=> 'Tambah Penjadwalan',
			'header_title'		=> 'Data Penjadwalan',
			'header_sub'		=> 'manage data penjadwalan!',
			'active_menu'		=> ['penjadwalan'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'penjadwalan', 'text'	=> 'Penjadwalan', 'class'	=> 'fa fa-calendar'], 
			], 
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'plugins/validate/jquery.validate.min.js',
				url_cdn().'js/custom/penjadwalan.js'
			],
			'penjadwalan'		=> $penjadwalan,
			'total'				=> $total,
			'table'				=> $table,
			'offset'			=> $offset,
			'limit'				=> $this->limit,
			'page'				=> $this->page,
			'pagination'		=> $pagination,
            'flash_message'		=> $this->load->view($this->config->item('layout'). '/_flash_message', [], true),
			'search'			=> $this->search,
			'option_tuk'		=> lsp_tuk::where('status', '=', 1)->get()->toArray(),
			'option_skema'		=> lsp_skema::get()->toArray(),
			'jns_daftar'		=> $jns_daftar
		];
		
		$this->render('penjadwalan/index', $data);
	}
	
	function suratTugas($id = '', $surat = ''){
		//$id = get('id');
		//die("idnya $id");
		if (!$id)
			return false;
		
		$jadwal = lsp_jadwal::where('id_jadwal', '=', $id)
				->with('asesor')
				->with('tuk')
				->first();
		$day = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'];
		$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$time = strtotime($jadwal['tgl_sertifikasi']);
		
		$filename = FCPATH. '/assets/temp/surat-tugas-'. $jadwal['id_jadwal'].'.docx';
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH. '/assets/template/surat-tugas-'. $jadwal->id_skema .'.docx');
		$templateProcessor->setValue('hari', $day[(date('N', strtotime($jadwal['tgl_sertifikasi']))) -1] );
		$templateProcessor->setValue('tanggal', date('j', $time). ' '. $bulan[(date('n', $time)) - 1].' '. date('Y', $time) );
		$templateProcessor->setValue('jam', date('H.i', strtotime($jadwal['jam_sertifikasi'])) );
		$templateProcessor->setValue('tuk', $jadwal['tuk']['nm_tuk'] );
		$templateProcessor->setValue('name', ($jadwal['asesor']['gelar_depan'] != '' ? $jadwal['asesor']['gelar_depan'].' ' : '') . $jadwal['asesor']['nm_asesor'] . ($jadwal['asesor']['gelar_belakang'] != '' ? ', '. $jadwal['asesor']['gelar_belakang']: "") );
		$templateProcessor->setValue('met', $jadwal['asesor']['no_met'] );
		$templateProcessor->setValue('tanggal-now', date('j F Y') );
		$templateProcessor->saveAs($filename);	
		$file_url = assets_url().'/temp/surat-tugas-'. $jadwal['id_jadwal'] .'.docx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");	
		ob_clean(); flush();		
		readfile($file_url);
	}
	
	function detail(){
		$param = [];
		$jadwal = false;
		
		if (isPost()){
			$this->form_validation->set_rules('skema', 'Skema', 'required');
			// $this->form_validation->set_rules('kd_tuk', 'TUK', 'required');
			// $this->form_validation->set_rules('id_asesor', 'Asesor', 'required');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
			$this->form_validation->set_rules('jam', 'Jam', 'required');
			$this->form_validation->set_rules('pendaftar_id', 'Pendaftar List', 'required');
			
			if ($this->form_validation->run() !=false){
				$detail = $this->input->post('pendaftar_id', TRUE);
				
				$_penjadwalan = new lsp_jadwal();
				$_penjadwalan->kd_tuk = $this->input->post('kd_tuk', TRUE)[0];
				$_penjadwalan->id_skema = $this->input->post('skema', TRUE);
				$_penjadwalan->id_asesor = $this->input->post('id_asesor', TRUE)[0];
				$_penjadwalan->tgl_sertifikasi = $this->input->post('tanggal', TRUE);
				$_penjadwalan->jam_sertifikasi = $this->input->post('jam', TRUE);
				$_penjadwalan->save();
				
				$detail = explode(',', $detail);
				foreach ($detail as $k=>$v){
					$_detail = new lsp_dtl_jadwal();
					$_detail->id_jadwal = $_penjadwalan->id_jadwal;
					$_detail->id_pendaftaran = $v;
					$_detail->save();
				}
				
				$this->session->set_flashdata('status', 'success');	
				$this->session->set_flashdata('text', 'Success <strong>ADD NEW</strong> Jadwal dengan id <strong>"' . $_penjadwalan->id_jadwal . '"</strong>');
				redirect(url('penjadwalan'));
			} else 
				echoPre(validation_errors());
		} 
		
		$data = [
			'title'				=> 'Tambah Penjadwalan',
			'header_title'		=> 'Tambah Jadwal',
			'header_sub'		=> 'tambah data penjadwalan!',
			'active_menu'		=> ['penjadwalan'],
			'breadcrumbs'		=> [
				['url'	=> url(), 'text'	=> 'Dashboard', 'class'	=> 'fa fa-home'], 
				['url'	=> url().'penjadwalan', 'text'	=> 'Penjadwalan', 'class'	=> 'fa fa-calendar'], 
			], 
			'custom_css'		=> [
				url_cdn().'plugins/noty/button.css'
			],
			'custom_js'			=> [
				url_cdn().'plugins/noty/noty.min.js',
				url_cdn().'js/custom/penjadwalan.js',
				url_cdn().'plugins/validate/jquery.validate.min.js'
			],
			'jadwal'			=> $jadwal,
			'param'				=> $param,
			'jam'				=> $this->availableHour,
			'table'				=> $this->_buildTable(),
			'skema_option'		=> lsp_skema::get()->toArray(),
		];
		
		$this->render('penjadwalan/_form', $data);
	}
	
	function remote(){
		if (isPost() && isAjax())
			switch ($this->input->post('action', TRUE)) {
				case 'get-tuk' :
					$tuk = lsp_tuk::where('status', '=', 1)
							->where(function($query){
								$query->where('kd_tuk', 'like', '%'.$this->input->post('query', TRUE).'%')
									->orWhere('nm_tuk', 'like', '%'.$this->input->post('query', TRUE).'%');
							})
							->selectRaw('nm_tuk as name, kd_tuk as id')
							->take(10)
							->get()->toArray();
					
					foreach ($tuk as $k=>$v)
						$tuk[$k]['name'] = '['.$v['id'].'] '. $v['name'];
					
					echo json_encode($tuk);
				break;
				case 'get-asesor' :
					$asesor = lsp_asesor::where('status', '=', 1)
							->where(function($query){
								$query->where('nm_asesor', 'like', '%'.$this->input->post('query', TRUE).'%');
							})
							->selectRaw('nm_asesor as name, NIP as id')
							->take(10)
							->get()->toArray();
										
					echo json_encode($asesor);
				break;
				case 'get-jam' :
					$get = lsp_jadwal::where('tgl_sertifikasi', '=', $this->input->post('tanggal'))
								->where(function($q){
									$q->where('id_asesor', '=', $this->input->post('asesor'))
										->orWhere('kd_tuk', '=', $this->input->post('tuk'));
								})->get();
								
					$not_available = [];
					foreach ($get as $k=>$v){
						$not_available[] = $v->jam_sertifikasi;
					}
					
					$html = '
						<select name="jam" class="form-control">
							<option value="null" selected disabled hidden>Pilih Jam</option>		
					';
					foreach ($this->availableHour as $k=>$v)
						$html .= '<option value="'.$v.'" '. (in_array($v.':00', $not_available) ? 'disabled' : '') .'>'.(in_array($v.':00', $not_available) ? '<strike>'.$v.'</strike>' : $v).'</option>';
					$html .= '
						</select>
					';
					
					$ret = [
						'status'	=> 'success',
						'html'		=> $html
					];
					
					echo json_encode($ret);
				break;
				case 'get-pendaftar-list' :
					$pendaftar = lsp_pendaftaran::where('id_skema', $this->input->post('id_skema'))
									->whereHas('jenis_daftar', function ($q){
										return $q->where('is_ujian', '1');
									})
									->where('status', '<', 3)
									->with('mahasiswa')->with('mitra')
									->where(function($query){
										$query->has('jadwal', '<', 1)
											->orWhereHas('jadwal', function($q){
												$q->where('status_kehadiran', '2');
											});
									});
									// ->whereRaw('(SELECT COUNT(id_pendaftaran) FROM dtl_jadwal where dtl_jadwal.id_pendaftaran = pendaftaran.id_pendaftaran) = 0');
					// echoPre($pendaftar);
					$total = clone $pendaftar;
					$pendaftar = $pendaftar->take(10)
									->orderByRaw("RAND()")
									->get();
					if ($pendaftar)
						$pendaftar = $pendaftar->toArray();
					else 
						$pendaftar = [];
					
					$_row = [];
					$_pendaftar_list = [];
					foreach ($pendaftar as $k=>$v){
						$key = $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa']: $v['mitra']['nm_mitra'] ;
						$_row[$key] = $v;
						$_pendaftar_list[] = $v['id_pendaftaran'];
					}
					ksort($_row);
					
					$i=1;
					foreach ($_row as $k=>$v){
						$_row[$k]['number'] = $i;
						$_row[$k]['nama'] = $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra'];
						$_row[$k]['tmpt_lahir'] = $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['tempat_lahir'] : $v['mitra']['tmpt_lahir'];
						$_row[$k]['tgl_lahir'] = $v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['tgl_lahir'] : $v['mitra']['tgl_lahir'];
						
						$i++;
					}
									
					$return = [
						'status'	=> 'success',
						'html'		=> $this->_buildTable($_row),
						'total'		=> $total->count(),
						'pendaftar_list'	=> implode(',', $_pendaftar_list),
					];
					
					echo json_encode($return);
				break;
				case 'get-detail' :
					$jadwal = lsp_jadwal::where('id_jadwal', $this->input->post('id'))
							->with('tuk')
							->with('skema')
							->with('asesor')
							->with('detail_daftar')
							->first();
					if ($jadwal)
						$jadwal = $jadwal->toArray();
					else 
						$jadwal = [];
					
					if (count($jadwal))
						$return = [
							'status'	=> 'success',
							'html'		=> $this->load->view($this->config->item('layout').'/penjadwalan/_modal_detail', ['jadwal'=> $jadwal], TRUE)
						];
					else 
						$return = [
							'status'	=> 'failed'
						];
						
					echo json_encode($return);
				break;
				case 'get-pendaftar':
					$pendaftaran = lsp_pendaftaran::where('status', '<=', 2)
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
						->where(function($query){
							$query->has('jadwal', '<', 1)
								->orWhereHas('jadwal', function($q){
									$q->where('status_kehadiran', '2');
								});
						})
						// ->whereHas('hasJadwal', function($q){
							// $q->where('status_kehadiran', '=', 2);
						// })
						->where('id_skema', intval(post('id_skema')))
						->with('mitra')
						->with('mahasiswa')
						->take(10)
						->get()
						->toArray();
						// echoPre(post());
					$return = [];
					foreach ($pendaftaran as $k=>$v){
						$name = $v['tipe']=='mahasiswa' ? '['.$v['mahasiswa']['NRP'].'] '. $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra'];
						$return[] = ['id' => $v['id_pendaftaran'], 'name' => $name];
					}
					
					echo json_encode($return);
				break;
				case 'set-pendaftar' :
					$count = lsp_dtl_jadwal::where('id_jadwal', '=', post('id_jadwal'))->count();
					
					if ($count < 20){
						$dtl_jadwal = new lsp_dtl_jadwal();
						$dtl_jadwal->id_jadwal = post('id_jadwal');
						$dtl_jadwal->id_pendaftaran = post('pendaftar')[0];
						$dtl_jadwal->status_kehadiran = '0';
						$dtl_jadwal->save();
						
						$count++;
						
						$jadwal = lsp_jadwal::where('id_jadwal', post('id_jadwal'))
								->with('tuk')
								->with('skema')
								->with('asesor')
								->with('detail_daftar')
								->first();
						if ($jadwal)
							$jadwal = $jadwal->toArray();
						else 
							$jadwal = [];
						
						$return = [
							'status'	=> 'success',
							'html'		=> $this->load->view($this->config->item('layout').'/penjadwalan/_modal_detail', ['jadwal'=> $jadwal], TRUE),
							'count'     => $count,
							'id'        => post('id_jadwal')
						];
					} else {
						$return = [
							'status'	=> 'failed',
							'html'		=> 'Maaf pendaftar sudah memenuhi kuota'
						];
					}
					
					echo json_encode($return);
				break;
				case 'delete-pendaftar' :
					$dtl_jadwal = lsp_dtl_jadwal::where('id_pendaftaran', '=', post('pendaftar'))
							->where('id_jadwal', '=', post('id_jadwal'))
							->first();
					$dtl_jadwal->delete();
					
					$jadwal = lsp_jadwal::where('id_jadwal', post('id_jadwal'))
							->with('tuk')
							->with('skema')
							->with('asesor')
							->with('detail_daftar')
							->first();
					if ($jadwal)
						$jadwal = $jadwal->toArray();
					else 
						$jadwal = [];
					
					$count = isset($jadwal['detail_daftar']) ? count($jadwal['detail_daftar']) : 0;
					
					$return = [
						'status'	=> 'success',
						'html'		=> $this->load->view($this->config->item('layout').'/penjadwalan/_modal_detail', ['jadwal'=> $jadwal], TRUE),
						'count'     => $count,
						'id'        => $jadwal['id_jadwal']
					];
					
					echo json_encode($return);
					
				break;
				case 'get-absensi':
					$jadwal = lsp_jadwal::where('id_jadwal', '=', post('id_jadwal'))
							->with('tuk')
							->with('skema')
							->with('asesor')
							->with('detail')
							->with('detail_daftar')
							->first();
					if ($jadwal)
						$jadwal = $jadwal->toArray();
					else 
						$jadwal = [];
					
					$return = [
						'status'	=> 'success',
						'html'		=> $this->load->view($this->config->item('layout').'/penjadwalan/_modal_absensi', ['jadwal'=> $jadwal], TRUE),
						'id'        => $jadwal['id_jadwal']
					];
					
					echo json_encode($return);
				break;
				case 'post-absensi':
					$jadwal = lsp_jadwal::where('id_jadwal', '=', post('id_jadwal'))->first();
					
					foreach (post('absensi') as $k=>$v){
						$dtl_jadwal = lsp_dtl_jadwal::where('id_jadwal', '=', post('id_jadwal'))
									->where('id_pendaftaran', '=', $k)->first();
						$dtl_jadwal->status_kehadiran = $v == 'hadir' ? '1' : '2';
						$dtl_jadwal->save();
					}
					$jadwal->status = 1;
					$jadwal->save();
					
					$return = [
						'status' => 'success',
					];
					
					echo json_encode($return);
				break;
			}
	}
	
	function _buildTable($rows=[]){
		$column = array(
            array('header' => 'No', 'data' => 'number', 'width' => '30px', 'class' => 'text-center'),
            array('header' => 'Nama', 'data' => 'nama'),
            array('header' => 'Tempat Lahir', 'data' => 'tmpt_lahir', 'width'=>'120px'),
            array('header' => 'Tanggal Lahir', 'data' => 'tgl_lahir', 'width' => '120px'),
        );

        return $table = $this->tables->create_list(['class' => 'table table-bordered table-hover'], $rows, $column);
		
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
			redirect(url('penjadwalan', $param));
		}
	}
	
	function delete(){
		if (get('id')){
			$jadwal = lsp_jadwal::where('id_jadwal', get('id'))->first();
			if ($jadwal)
				$dtl = lsp_dtl_jadwal::where('id_jadwal', get('id'))
						->delete();
			$jadwal->delete();
			
			$this->session->set_flashdata('status', 'success');	
			$this->session->set_flashdata('text', 'Success <strong>DELETE</strong> Jadwal dengan id <strong>"' . $jadwal->id_jadwal . '"</strong>');
			redirect(url('penjadwalan'));
		}
	}
}
?>