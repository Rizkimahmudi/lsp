<?php 
	if ($flash_message){
		echo '<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success alert-dismissable">
						<h4><i class="icon fa fa-check"></i> Success!</h4>
						'.$flash_message.'
					</div>
				</div>
			</div>';
	}
?>
<div class="row" style="margin-bottom: 15px">
	<div class="col-md-7">
		<div class="pull-right">
			<button class="btn btn-success btn-sm reset-kompetensi" data-id="<?=$detail['id_dt_skema']?>"><i class="fa fa-plus"></i> Add New Kompetensi</button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
		<div class="row" style="max-height: 400px; overflow: auto;">
			<div class="col-md-12">
				<?php 
					if (count($detail['kompetensi']) && is_array($detail['kompetensi']))
					{
						echo '<ul class="tree-list">';
						foreach ($detail['kompetensi'] as $k=>$v){
							echo '<li style="list-style:none; margin-left: -40px">
									<div class="list-group-item">
										<i class="glyphicon glyphicon-chevron-right"></i> '. $v['nm_kompetensi'] .'</i>
										<div class="btn-group pull-right">
											<a href="#" title="Add Skema Detail" class="add-detail-kompetensi" data-id="'.$detail['id_dt_skema'].'" data-parent="'.$v['id_kompetensi'].'"><i class="btn btn-success btn-sm fa fa-plus"></i></a>
											<a href="#" title="Edit Skema" data-id="'.$v['id_kompetensi'].'" data-edit="kompetensi" class="edit-modal-kompetensi"><i class="btn btn-primary btn-sm fa fa-pencil"></i></a>
											<a href="#" title="Delete Skema" data-id="'.$v['id_kompetensi'].'" data-tipe="kompetensi" class="confirm-skema"><i class="btn btn-danger btn-sm fa fa-trash"></i></a>
										</div>
									</div>
								</li>';
								
								if (is_array($v['detail']) && count($v['detail'])){
									echo '<ul class="tree-list">';
									foreach ($v['detail'] as $kk=>$vv)
										echo '<li style="list-style:none; margin-left: -40px">
											<div class="list-group-item ">
												<i class="glyphicon glyphicon-chevron-right"></i> '. $vv['asesmen_mandiri'] .'
												<div class="btn-group pull-right">		
													<a href="#" title="Edit Detail Kompetensi" data-id="'.$vv['id_dtl_kompetensi'].'" data-edit="detail_kompetensi" class="edit-modal-kompetensi"><i class="btn btn-primary btn-sm fa fa-pencil"></i></a>
													<a href="#" title="Delete Detail Kompetensi" class="confirm-skema" data-id="'.$vv['id_dtl_kompetensi'].'" data-tipe="detail_kompetensi"><i class="btn confirm btn-danger btn-sm fa fa-trash"></i></a>
												</div>
											</div>
										</li>';
									echo '</ul>';
								}
						}
						echo '</ul>';
					}
				?>
			</div>
		</div>
	</div>
	
	<div class="col-md-4 col-md-offset-1" id="form-detail-skema-on-modal" style="margin-top: -50px">
		<?=$form?>
	</div>
</div>