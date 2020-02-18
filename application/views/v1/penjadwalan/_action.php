<?php 
	switch ($action){
		case 'jadwal' :
			echo '<div class="btn-group btn-action-3">';
			echo '<a title="Simpan Surat Tugas" target="_blank" href="'. url('penjadwalan/surat/'.$jadwal['id_jadwal'].'/1') .'" class="btn btn-sm btn-default"><i class="fa fa-save"></i></a>';
			echo '<a title="Absensi" href="#" class="btn btn-sm btn-success absensiJadwal" data-id="'. $jadwal['id_jadwal'] .'"><i class="fa fa-check"></i></a>';
			echo '<a title="Detail Jadwal" href="#" data-id="'.$jadwal['id_jadwal'].'" class="btn-detail btn btn-sm btn-primary"><i class="fa fa-list-alt"></i></a>';
			echo '<a title="Delete Jadwal" href="'. url('penjadwalan/delete', ['id' => $jadwal['id_jadwal']]) .'" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>';
			echo '</div>';
		break;
	}
?>