<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_dtl_kompetensi extends Eloquent{
	protected $table = 'dtl_kompetensi';
    public $timestamps = false;
	protected $primaryKey = 'id_dtl_kompetensi';
    
	public function kompetensi(){
		return $this->belongsTo('lsp_kompetensi', 'id_kompetensi', 'id_kompetensi');
	}
}
