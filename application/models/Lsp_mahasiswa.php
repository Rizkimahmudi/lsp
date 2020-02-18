<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_mahasiswa extends Eloquent{
	protected $table = 'mahasiswa';
    public $timestamps = false;
	protected $primaryKey = 'NRP';
    
}
