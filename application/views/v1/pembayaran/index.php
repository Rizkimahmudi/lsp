<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<form method="post" action="<?=url('pembayaran/search')?>" class="form-horizontal">
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="k" class="col-sm-3 control-label">Search</label>
							<div class="col-sm-9">
							  <input type="text" name="k" id="k" class="form-control input-sm" value="<?=@$search['k']?>" placeholder="Search">
							</div>
						</div>
						<div class="form-group">
							<label for="tipe" class="col-sm-3 control-label">Tipe</label>
							<div class="col-sm-9">
								<select id="tipe" name="tipe" class="form-control input-sm">      
									<option value="all">All</option>
									<option value="mahasiswa" <?=@$search['tipe'] == 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
									<option value="mitra" <?=@$search['tipe'] == 'mitra' ? 'selected' : '' ?>>Mitra</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="datetimepicker1" class="control-label col-sm-3">Schedule</label>
							<div class="col-sm-9">
								<div class="input-daterange" id="datepicker">
									<div class="input-group">
										<input type="text" id="datetimepicker1" class="input-sm form-control date" name="start" rel="start" placeholder="Start" value="<?=@$search['start']?>"/>
										<span class="input-group-addon" style="background-color:#d2d6de; padding:0 15px">to</span>
										<input type="text" id="datetimepicker2" class="input-sm form-control date" name="end" rel="end" placeholder="End"  value="<?=@$search['end']?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="jenis" class="col-sm-3 control-label">Jenis</label>
							<div class="col-sm-9">
								<select id="jenis" name="jenis" class="form-control input-sm">      
								<option value="all">All</option>
								<?php 
									if (count($jns_daftar))
										foreach ($jns_daftar as $k=>$v)
											echo '<option value="'.$v['id_jns_daftar'].'" '.(@$search['jenis'] == $v['id_jns_daftar'] ? 'selected' : '').'>'.$v['nm_jns_daftar'].'</option>';
								?>
								</select>
							</div>
						</div>
						<div class="pull-right text-center">
								<button type="submit" style="margin-bottom:10px;" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
								<a href="<?=url('pembayaran')?>" style="margin-bottom:10px;" class="btn btn-default"><i class="fa fa-list-alt"></i> Show All</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-8">
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
		
		<div class="col-xs-12 col-md-4">
			<?=$form?>
		</div>
		
	</div>
</section>