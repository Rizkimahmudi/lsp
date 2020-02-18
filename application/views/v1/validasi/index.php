<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="small-box bg-teal">
				<div class="inner">
					<form id="form_edit_id" action="<?=url().'validasi-sertifikat/search'?>" method="post" class="form-inline">
						<label for="k" class="form-label">Find</label>
						<div class="form-group">
							<input type="text" id="k" class="form-control input-sm" placeholder="Keyword" name="k" value="<?=@$search['k']?>">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-primary btn-flat" type="button"><i class="fa fa-search"></i> Search</button>
							<a href="<?=url().'validasi-sertifikat/'?>" class="btn btn-default btn-sm"><i class="fa fa-list-alt"></i> Show All</a>
						</div>
					</form>
				</div>
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