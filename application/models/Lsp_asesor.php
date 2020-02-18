<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_asesor extends Eloquent{
	protected $table = 'asesor';
    public $timestamps = false;
	protected $primaryKey = 'NIP';
    
}
