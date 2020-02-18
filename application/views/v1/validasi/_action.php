<a href="<?=url('validasi-sertifikat/detail/'.$sertifikat['id_pendaftaran'])?>"><button class="btn btn-sm btn-primary"><i class="fa fa-list"></i></button></a>
<?php 
	if ($sertifikat['sertifikat']['status_sertifikat'] == 1){
?>
<a href="<?=url('validasi-sertifikat/export/'. $sertifikat['id_pendaftaran'])?>"><button class="btn btn-sm btn-success"><i class="fa fa-save"></i></button></a>
<?php }?>