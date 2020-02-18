<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<form method="post" action="<?=url('report/jadwal/search')?>" class="form-horizontal">
					<input type="hidden" name="route" value="jadwal">
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="form-label col-sm-3 control-label">Date </label>
							<div class="col-sm-9">
								<div class="input-daterange">
									<div class="input-group">
										<input type="text" name="start" class="form-control input-sm datepicker" value="<?=isset($search['start']) ? $search['start'] : ''?>">
										<span class="input-group-addon" style="background-color: #DCDCDC">to</span>
										<input type="text" name="end" class="form-control input-sm datepicker" value="<?=isset($search['end']) ? $search['end'] : ''?>">
									</div>
								</div>
							</div>
						</div>						
						<div class="form-group">
							<label for="tuk" class="col-sm-3 control-label">TUK</label>
							<div class="col-sm-9">
								<input type="text" name="tuk" id="tuk" class="form-control input-sm" value="<?=@$search['tuk']?>">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="asesor" class="col-sm-3 control-label">Asesor</label>
							<div class="col-sm-9">
								<input type="text" name="asesor" id="asesor" class="form-control input-sm" value="<?=@$search['asesor']?>">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="jenis" class="col-sm-3 control-label">Skema</label>
							<div class="col-sm-9">
								<select class="form-control input-sm" name="skema">
									<option>All</option>
									<?php 
										if (isset($option_skema))
											foreach ($option_skema as $k=>$v)
												echo '<option value="'.$v['id_skema'].'" '.(@$search['skema'] == $v['id_skema'] ? 'selected' : '').'>'.$v['nm_skema'].'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="pull-right text-center">
							<button type="submit" class="btn btn-primary btn-flat btn-sm" type="button"><i class="fa fa-search"></i> Search</button>
							<a href="<?=url().'report/jadwal/'?>" class="btn btn-default btn-sm"><i class="fa fa-list-alt"></i> Show All</a>
							<a href="<?=url('report/jadwal/', array_merge($param, ['export' => 1]))?>" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Export</a>
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