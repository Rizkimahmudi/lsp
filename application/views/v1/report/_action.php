<?php 
	switch($action){
		case 'peserta_tipe' : 
				echo '<label class="label '.($peserta['tipe'] == 'mahasiswa' ? 'label-success' : 'label-primary').'">'.ucfirst($peserta['tipe']).'</label>';
			break;
		case 'peserta_status':
				echo '<label class="label label-default">'. $this->config->item('status_pendaftaran')[$peserta['status']] .'</label>';
			break;
	}
?>