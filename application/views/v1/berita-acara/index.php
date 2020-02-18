<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<form method="post" action="<?=url('berita-acara/search')?>" class="form-horizontal">
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="form-label col-sm-3 control-label">Date </label>
							<div class="col-sm-9">
								<div class="input-daterange">
									<div class="input-group">
										<input type="text" name="search_start" class="form-control input-sm datepicker" value="<?=isset($search['search_start']) ? $search['search_start'] : ''?>">
										<span class="input-group-addon" style="background-color: #DCDCDC">to</span>
										<input type="text" name="search_end" class="form-control input-sm datepicker" value="<?=isset($search['search_end']) ? $search['search_end'] : ''?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label col-sm-3 control-label">Asesor</label>
							<div class="col-sm-9">
								<input type="text" name="search_asesor" class="form-control input-sm" value="" />
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="tipe" class="col-sm-3 control-label">TUK</label>
							<div class="col-sm-9">
								<select class="form-control input-sm" name="search_tuk">
									<option>All</option>
									<?php 
										if (isset($option_tuk))
											foreach ($option_tuk as $k=>$v)
												echo '<option value="'.$v['kd_tuk'].'" '.(@$search['search_tuk'] == $v['kd_tuk'] ? 'selected' : '').'>'.$v['nm_tuk'].'</option>';
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="jenis" class="col-sm-3 control-label">Skema</label>
							<div class="col-sm-9">
								<select class="form-control input-sm" name="search_skema">
									<option>All</option>
									<?php 
										if (isset($option_skema))
											foreach ($option_skema as $k=>$v)
												echo '<option value="'.$v['id_skema'].'" '.(@$search['search_skema'] == $v['id_skema'] ? 'selected' : '').'>'.$v['nm_skema'].'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="pull-right text-center">
							<button type="submit" class="btn btn-primary btn-flat btn-sm" type="button"><i class="fa fa-search"></i> Search</button>
							<a href="<?=url().'berita-acara/'?>" class="btn btn-default btn-sm"><i class="fa fa-list-alt"></i> Show All</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="box box-primary">
				<div class="box-body no-padding">
					<div class="table-responsive">
						<?php echo $table; ?>
					</div>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom:20px;">
				<div class="pull-left">
					Showing <strong><?php echo $total == 0 ? '0' : $offset + 1; ?></strong> - <strong><?php echo $offset+$limit > $total ? $total : $offset+$limit ;?></strong> of <strong><?php echo $total?></strong> data
				</div>
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Sertifikasi</h4>
      </div>
      <div class="modal-body" id="modal-detail-body">
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->