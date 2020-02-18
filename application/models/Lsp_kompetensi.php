<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_kompetensi extends Eloquent{
	protected $table = 'kompetensi';
    public $timestamps = false;
	protected $primaryKey = 'id_kompetensi';
    
	public function detail(){
		return $this->hasMany('lsp_dtl_kompetensi', 'id_kompetensi', 'id_kompetensi');
	}
}
