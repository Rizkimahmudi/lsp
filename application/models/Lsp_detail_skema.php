<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_detail_skema extends Eloquent{
	protected $table = 'dtl_skema';
    public $timestamps = false;
	protected $primaryKey = 'id_dt_skema';
    
	public function kompetensi(){
		return $this->hasMany('lsp_kompetensi', 'id_dtl_skema', 'id_dt_skema')->with('detail');
	}
}
