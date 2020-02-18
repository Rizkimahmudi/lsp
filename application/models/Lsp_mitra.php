<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_mitra extends Eloquent{
	protected $table = 'mitra';
    public $timestamps = false;
	protected $primaryKey = 'id_mitra';
    
}
