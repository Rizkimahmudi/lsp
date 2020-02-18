<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
		</div> 
		<div class="box-body">
			<div class="row">
				<form method="post" action="<?=url('report/tuk/search')?>" class="form-horizontal">
					<input type="hidden" name="route" value="tuk">
					<div class="col-lg-8 col-md-6 col-sm-12">					
						<div class="form-group">
							<label for="nama" class="col-sm-3 control-label">Nama</label>
							<div class="col-sm-9">
								<input type="text" name="nama" id="nama" class="form-control input-sm" value="<?=@$search['nama']?>">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="pull-right text-center">
							<button type="submit" class="btn btn-primary btn-flat btn-sm" type="button"><i class="fa fa-search"></i> Search</button>
							<a href="<?=url().'report/tuk/'?>" class="btn btn-default btn-sm"><i class="fa fa-list-alt"></i> Show All</a>
							<a href="<?=url('report/tuk/', array_merge($param, ['export' => 1]))?>" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Export</a>
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