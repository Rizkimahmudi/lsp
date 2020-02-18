<!-- Main content -->
<section class="content">
<?php 
	echo $flash_message;
?>
	<div class="row">
		<div class="col-xs-12 col-md-9">
			<div class="row">
				<div class="col-lg-12">
					<?php 
						if (count($biaya) && is_array($biaya))
						{
							echo '<ul class="tree-list">';
							foreach ($biaya as $k=>$v)
								echo '<li style="list-style:none; margin-left: -40px">
										<div class="list-group-item ">
											<i class="glyphicon glyphicon-chevron-right"></i> '. $v['nm_jns_daftar'] .'</i>
											<div class="btn-group pull-right">
												<a href="'. url('setting/biaya-pendaftaran', ['id' => $v['id_jns_daftar']]) .'" title="Edit Biaya Pendaftaran" class="ajax-load-form"><i class="btn btn-primary btn-sm fa fa-pencil"></i></a>
											</div>
										</div>
									</li>';
							echo '</ul>';
						}
					?>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-md-3">
			<?php echo $form?>
		</div>
	</div>
</section>
