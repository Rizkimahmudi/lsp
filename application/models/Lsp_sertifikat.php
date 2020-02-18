<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class lsp_sertifikat extends Eloquent{
	protected $table = 'sertifikat';
    public $timestamps = false;
	protected $primaryKey = 'id_sertifikat';
	
	protected $fillable = ['id_pendaftaran'];
    
}
