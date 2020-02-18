<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_admin extends Eloquent{
	protected $table = 'admin';
    public $timestamps = false;
	protected $primaryKey = 'id_admin';
	
	
	protected $fillable = ['id_detail'];
    
}
