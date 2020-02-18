<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_skema extends Eloquent{
	protected $table = 'skema';
    public $timestamps = false;
	protected $primaryKey = 'id_skema';
	
	public function detail(){
		return $this->hasMany('lsp_detail_skema','id_skema', 'id_skema')->orderBy('order','ASC');
		//nama tabel yg join, primary key dari tabel yg ke 2 , pk tabel 1
	}
    
}
