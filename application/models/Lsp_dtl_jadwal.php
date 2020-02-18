<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_dtl_jadwal extends Eloquent{
	protected $table = 'dtl_jadwal';
    public $timestamps = false;
	protected $primaryKey = 'id_dtl_jadwal';
	
	public function jadwal(){
		return $this->belongsTo('lsp_jadwal', 'id_jadwal', 'id_jadwal')->with('asesor')->with('tuk');
	}
}
