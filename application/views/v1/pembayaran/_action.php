<?php 
	switch ($action){
		case 'pembayaran' :
			echo '<div class="btn-group btn-action-3">';
			echo '<a title="Delete Pembayaran" href="'. url('pembayaran/delete', ['id' => $pembayaran['id_pembayaran']]) .'" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash"></i></a>';
			echo '</div>';
		break;
	}
?>