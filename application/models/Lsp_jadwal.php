<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_jadwal extends Eloquent{
	protected $table = 'jadwal';
    public $timestamps = false;
	protected $primaryKey = 'id_jadwal';
    
	public function asesor(){
		return $this->hasOne('lsp_asesor', 'NIP', 'id_asesor');
	}
	
	public function tuk(){
		return $this->hasOne('lsp_tuk', 'kd_tuk', 'kd_tuk');
	}
	
	public function skema(){
		return $this->hasOne('lsp_skema', 'id_skema', 'id_skema');
	}
	
	public function detail(){
		return $this->hasMany('lsp_dtl_jadwal', 'id_jadwal', 'id_jadwal');
	}
	
	public function detail_hadir(){
		return $this->hasMany('lsp_dtl_jadwal', 'id_jadwal', 'id_jadwal')->where('status_kehadiran','=','1');
	}
	
	public function detail_skema(){
		return $this->hasOne('lsp_skema', 'id_skema', 'id_skema')->with('detail');
	}
	
	public function detail_daftar(){
		return $this->belongsToMany('lsp_pendaftaran', 'dtl_jadwal', 'id_jadwal', 'id_pendaftaran')->with('mitra')->with('mahasiswa');
	}
	
	public function detail_daftar_hadir(){
		return $this->belongsToMany('lsp_pendaftaran', 'dtl_jadwal', 'id_jadwal', 'id_pendaftaran')
				->with('mitra')
				->with('mahasiswa')
				->where('status_kehadiran', '=', '1');
	}
}
