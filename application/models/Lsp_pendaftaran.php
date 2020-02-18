<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_pendaftaran extends Eloquent{
	protected $table = 'pendaftaran';
    public $timestamps = false;
	protected $primaryKey = 'id_pendaftaran';
	
	public function mahasiswa(){
		return $this->hasOne('lsp_mahasiswa', 'NRP', 'id_detail_pendaftar');
	}
	
	public function mitra(){
		return $this->hasOne('lsp_mitra', 'id_mitra', 'id_detail_pendaftar');
	}
	
	public function jenis_daftar(){
		return $this->hasOne('lsp_jns_daftar', 'id_jns_daftar', 'id_jns_daftar');
	}
	public function skema(){
		return $this->hasOne('lsp_skema', 'id_skema', 'id_skema');
	}
	
	//
	public function jadwal(){
		return $this->belongsTo('lsp_dtl_jadwal', 'id_pendaftaran', 'id_pendaftaran')->with('jadwal');
	}
	
	public function hasJadwal(){
		return $this->hasOne('lsp_dtl_jadwal', 'id_pendaftaran', 'id_pendaftaran')->with('jadwal');
	}
	
	public function skema_detail(){
		return $this->hasOne('lsp_skema', 'id_skema', 'id_skema')->with('detail');
	}
	
	public function sertifikat(){
		return $this->hasOne('lsp_sertifikat', 'id_pendaftaran', 'id_pendaftaran');
	}
    
}
