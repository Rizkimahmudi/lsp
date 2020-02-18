<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_jns_daftar extends Eloquent{
	protected $table = 'jns_daftar';
    public $timestamps = false;
	protected $primaryKey = 'id_jns_daftar';
}
