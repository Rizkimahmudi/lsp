<?php 
	switch ($action){
		case 'mahasiswa' :
?>
<div class="btn-group btn-action-3">	
	<a title="Edit Mahasiswa" href="<?php echo url('setting/mahasiswa', array_merge($param, ['page' => get('page', 1), 'id' => $mahasiswa['NRP']])) ?>" class="btn btn-sm btn-default button-edit"><i class="fa fa-pencil"></i></a>
	<a title="Delete Mahasiswa" href="<?php echo url('setting/mahasiswa/delete', ['id' => $mahasiswa['NRP']]) ?>" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>
</div>
<?php 
		break;
		case 'asesor' :
			echo '<div class="btn-group btn-action-3">';
			echo '<a title="Edit Asesor" href="'. url('setting/asesor', array_merge($param, ['page' => get('page', 1), 'id' => $asesor['NIP']])) .'" class="btn btn-sm btn-default button-edit"><i class="fa fa-pencil"></i></a>';
			echo '<a title="Delete Asesor" href="'. url('setting/asesor/delete', ['id' => $asesor['NIP']]) .'" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>';
			echo '</div>';
		break;
		case 'tuk' :
			echo '<div class="btn-group btn-action-3">';
			echo '<a title="Edit TUK" href="'. url('setting/tuk', array_merge($param, ['page' => get('page', 1), 'id' => $tuk['kd_tuk']])) .'" class="btn btn-sm btn-default button-edit"><i class="fa fa-pencil"></i></a>';
			echo '<a title="Delete TUK" href="'. url('setting/tuk/delete', ['id' => $tuk['kd_tuk']]) .'" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>';
			echo '</div>';
		break;
		case 'mitra' :
			echo '<div class="btn-group btn-action-3">';
			echo '<a title="Edit Mitra" href="'. url('setting/mitra', array_merge($param, ['page' => get('page', 1), 'id' => $mitra['id_mitra']])) .'" class="btn btn-sm btn-default button-edit"><i class="fa fa-pencil"></i></a>';
			echo '<a title="Delete Mitra" href="'. url('setting/mitra/delete', ['id' => $mitra['id_mitra']]) .'" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>';
			echo '</div>';
		break;
	}
?>