<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormulirController extends MY_HomeController {
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
			'lsp_tuk'
		]);
		$this->load->library(['tables','form_validation', 'word']);
		$this->checkLogin(['admin', 'peserta', 'manager']);
	}
	
	function index($kd_pendaftaran){
		$pendaftar = lsp_pendaftaran::where('id_pendaftaran', '=', $kd_pendaftaran)
					->with('mahasiswa')
					->with('mitra')
					->first();
		
		//setValue
		$nama       = $pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['nm_mahasiswa'] : $pendaftar['mitra']['nm_mitra'];
		$tempat     = $pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['tempat_lahir'] : $pendaftar['mitra']['tmpt_lahir'];
		$tanggal    = $pendaftar['tipe'] == 'mahasiswa' ? date('j F Y', strtotime($pendaftar['mahasiswa']['tgl_lahir'])) : date('j F Y', strtotime($pendaftar['mitra']['tgl_lahir']));
		$alamat     = $pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['alamat_mhs'] : $pendaftar['mitra']['alamat_mitra'];
		$kodepos    = $pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['kodepos'] : $pendaftar['mitra']['kd_pos'];
		$telp_rumah = $pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['telp_rumah'] : $pendaftar['mitra']['telp_mitra'];
		$telp_hp    = $pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['telp_hp'] : $pendaftar['mitra']['telp_hp'];
		$email      = $pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['email'] : $pendaftar['mitra']['email'];
		$nama_work  = $pendaftar['tipe'] == 'mahasiswa' ? 'Sekolah Tinggi Informatika dan Komputer Indonesia' : $pendaftar['mitra']['work_nm_lembaga'];
		$jabatan    = $pendaftar['tipe'] == 'mahasiswa' ? 'Mahasiswa' : $pendaftar['mitra']['work_jabatan'];
		$alamat_work= $pendaftar['tipe'] == 'mahasiswa' ? 'Jl. Tidar 100, Karangbesuki, Sukun, Kota Malang' : $pendaftar['mitra']['work_alamat'];
		$kodepos_work = $pendaftar['tipe'] == 'mahasiswa' ? '65149' : $pendaftar['mitra']['work_kd_pos'];
		$telp_work    = $pendaftar['tipe'] == 'mahasiswa' ? '+62 341 560823' : $pendaftar['mitra']['work_telp'];
		$fax_work     = $pendaftar['tipe'] == 'mahasiswa' ? '0341-562525' : $pendaftar['mitra']['work_fax'];
		$email_work    = $pendaftar['tipe'] == 'mahasiswa' ? 'stiki@stiki.ac.id' : $pendaftar['mitra']['work_email'];
		
		if ($pendaftar){
			$filename = FCPATH. '/assets/temp/formulir-'. $pendaftar['id_pendaftaran'].'.docx';
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH. '/assets/template/formulir-'. $pendaftar->id_skema .'.docx');
			$templateProcessor->setValue('nama', $nama);
			$templateProcessor->setValue('tempat', $tempat);
			$templateProcessor->setValue('tanggal', $tanggal);
			$templateProcessor->setValue('alamat', $alamat);
			$templateProcessor->setValue('kodepos', $kodepos);
			$templateProcessor->setValue('telp_rumah', $telp_rumah);
			$templateProcessor->setValue('telp_kantor', '');
			$templateProcessor->setValue('telp_hp', $telp_hp);
			$templateProcessor->setValue('email', $email);
			$templateProcessor->setValue('nama_work', $nama_work);
			$templateProcessor->setValue('jabatan', $jabatan);
			$templateProcessor->setValue('alamat_work', $alamat_work);
			$templateProcessor->setValue('kodepos_work', $kodepos_work);
			$templateProcessor->setValue('telp_work', $telp_work);
			$templateProcessor->setValue('fax_work', $fax_work);
			$templateProcessor->setValue('email_work', $email_work);
			$templateProcessor->saveAs($filename);	
			
			$file_url = assets_url().'/temp/formulir-'. $pendaftar['id_pendaftaran'] .'.docx';
			header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");	
			ob_clean(); flush();		
			readfile($file_url);
		} else {
			redirect(url());
		}
		
	}
	
	function absensi($id){
		$jadwal = lsp_jadwal::where('id_jadwal', '=', $id)
				->with('detail_daftar_hadir')
				->with('tuk')
				->first()->toArray();
		
		
		$filename = FCPATH. '/assets/temp/absensi-'. $jadwal['id_jadwal'].'.docx';
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH. '/assets/template/Absensi.docx');
		$templateProcessor->cloneRow('no', count($jadwal['detail_daftar_hadir']));
		$i = 1;
		foreach ($jadwal['detail_daftar_hadir'] as $k=>$v){
			$templateProcessor->setValue('no#'.$i, $i);
			$templateProcessor->setValue('nama#'.$i, ($v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra']));
			$templateProcessor->setValue('institusi#'.$i, ($v['tipe'] == 'mahasiswa' ? 'STIKI' : $v['mitra']['work_nm_lembaga']));
			$templateProcessor->setValue('alamat#'.$i, ($v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['alamat_mhs'] : $v['mitra']['alamat_mitra']));
			$templateProcessor->setValue('pekerjaan#'.$i, ($v['tipe'] == 'mahasiswa' ? 'Mahasiswa' : $v['mitra']['work_jabatan']));
			$templateProcessor->setValue('telp#'.$i, ($v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['telp_hp'] : $v['mitra']['telp_hp']));
			$templateProcessor->setValue('ttd_ganjil#'.$i, ($i%2 == 0 ? '' : $i));
			$templateProcessor->setValue('ttd_genap#'.$i, ($i%2 == 0 ? $i : ''));
			
			$i++;
		}
		$time = strtotime($jadwal['tgl_sertifikasi'].' '.$jadwal['jam_sertifikasi']);
		$templateProcessor->setValue('hari_tanggal', hari(date('N', $time)).' / '. date('j', $time) .' '. bulan(date('n', $time)).' '. date('Y H:i', $time));
		$templateProcessor->setValue('tempat', 'STIKI - '. $jadwal['tuk']['nm_tuk']);
		$templateProcessor->saveAs($filename);	
		
		$file_url = assets_url().'/temp/absensi-'. $jadwal['id_jadwal'] .'.docx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");	
		ob_clean(); flush();		
		readfile($file_url);
	}
	
}