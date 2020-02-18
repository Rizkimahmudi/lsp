<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="small-box bg-teal">
				<div class="inner">
					<form id="form_edit_id" action="<?=url().'setting/skema/search'?>" method="post" class="form-inline">
						<label for="k" class="form-label">Find</label>
						<div class="form-group">
							<input type="text" id="k" class="form-control input-sm" placeholder="Keyword" name="k" value="<?=@$search['k']?>">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-primary btn-flat" type="button"><i class="fa fa-search"></i> Search</button>
							<a href="<?=url().'setting/skema/'?>" class="btn btn-default btn-sm"><i class="fa fa-list-alt"></i> Show All</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-9">
			<div class="row">
				<div class="col-lg-12">
					<?php 
						if (count($skema) && is_array($skema))
						{
							echo '<ul class="tree-list">';
							foreach ($skema as $k=>$v){
								echo '<li style="list-style:none; margin-left: -40px">
										<div class="list-group-item ">
											<i class="glyphicon glyphicon-chevron-right"></i> '. $v['nm_skema'] .'</i>
											<div class="btn-group pull-right">
												<a href="'. url('setting/skema', ['parent' => $v['id_skema']]) .'" title="Add Skema Detail" class="ajax-load-form"><i class="btn btn-success btn-sm fa fa-plus"></i></a>
												<a href="'. url('setting/skema', ['id' => $v['id_skema']]) .'" title="Edit Skema" class="ajax-load-form"><i class="btn btn-primary btn-sm fa fa-pencil"></i></a>
												<a href="'. url('setting/skema/delete', ['id' => $v['id_skema']]) .'" title="Delete Skema" class="ajax-load-form confirm"><i class="btn btn-danger btn-sm fa fa-trash"></i></a>
											</div>
										</div>
									</li>';
								if (is_array($v['detail']) && count($v['detail'])){
									echo '<ul class="tree-list">';
									foreach ($v['detail'] as $kk=>$vv)
										echo '<li style="list-style:none; margin-left: -40px">
											<div class="list-group-item ">
												<i class="glyphicon glyphicon-chevron-right"></i> <strong>['.$vv['kd_unit'].']</strong> '. $vv['jdl_kompetensi'] .'
												<div class="btn-group pull-right">		
													<a href="#" data-id="'.$vv['id_dt_skema'].'" data-title="Detail Unit - ['.$vv['kd_unit'].'] '.$vv['jdl_kompetensi'].'" class="detail-skema"><i class="fa fa-list-alt btn-sm btn btn-default"></i></a>
													<a href="'. url('setting/skema', ['id' => $vv['id_dt_skema'], 'parent'=>$v['id_skema']]) .'" title="Edit Unit" class="ajax-load-form"><i class="btn btn-primary btn-sm fa fa-pencil"></i></a>
													<a href="'. url('setting/skema/delete', ['id' => $vv['id_dt_skema'], 'parent'=>$v['id_skema']]) .'" title="Delete Unit" class="ajax-load-form confirm"><i class="btn confirm btn-danger btn-sm fa fa-trash"></i></a>
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
			<div class="clearfix" style="margin-bottom:20px;">
				<div class="pull-left">
					Showing <strong><?php echo $total == 0 ? '0' : $offset + 1; ?></strong> - <strong><?php echo $offset+$limit > $total ? $total : $offset+$limit ;?></strong> of <strong><?php echo $total?></strong> data
				</div>
				<?php echo $pagination; ?>
			</div>
		</div>

		<div class="col-xs-12 col-md-3" id="form-container">
			<?php echo $form?>
		</div>
	</div>
</section>

<div class="modal fade" id="modal-skema" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-detail-title">Detail Unit</h4>
      </div>
      <div class="modal-body" id="modal-detail-skema">
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->