<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_pembayaran extends Eloquent{
	protected $table = 'pembayaran';
    public $timestamps = false;
	protected $primaryKey = 'id_pembayaran';
    
	public function jenis_daftar(){
		return $this->hasOne('lsp_jns_daftar', 'id_jns_daftar', 'id_jenis_bayar');
	}
	
	public function pendaftar(){
		return $this->hasOne('lsp_pendaftaran', 'id_pendaftaran', 'id_pendaftaran')->with('mahasiswa')->with('mitra');
	}
}
