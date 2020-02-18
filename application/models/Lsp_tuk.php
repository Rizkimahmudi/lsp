<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_tuk extends Eloquent{
	protected $table = 'tuk';
    public $timestamps = false;
	protected $primaryKey = 'kd_tuk';
    
}
