<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<form method="post" action="<?=url('report/peserta/search')?>" class="form-horizontal">
					<input type="hidden" name="route" value="peserta">
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
							<label class="form-label col-sm-3 control-label">Jenis</label>
							<div class="col-sm-9">
								<select class="form-control input-sm" name="jenis">
									<option>All</option>
									<?php 
										if (isset($option_jenis))
											foreach ($option_jenis as $k=>$v)
												echo '<option value="'.$v['id_jns_daftar'].'" '.(@$search['jenis'] == $v['id_jns_daftar'] ? 'selected' : '').'>'.$v['nm_jns_daftar'].'</option>';
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="tipe" class="col-sm-3 control-label">Nama</label>
							<div class="col-sm-9">
								<input type="text" name="nama" class="form-control input-sm" value="<?=@$search['nama']?>">
							</div>
						</div>
						<div class="form-group">
							<label for="tipe" class="col-sm-3 control-label">Tipe</label>
							<div class="col-sm-9">
								<select class="form-control input-sm" name="tipe">
									<option>All</option>
									<option value="mahasiswa" <?=@$search['tipe'] == 'mahasiswa' ? 'selected': ''?>>Mahasiswa</option>
									<option value="mitra" <?=@$search['tipe'] == 'mitra' ? 'selected': ''?>>Mitra</option>
								</select>
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
						<div class="form-group">
							<label for="jenis" class="col-sm-3 control-label">Status</label>
							<div class="col-sm-9">
								<select class="form-control input-sm" name="status">
									<option>All</option>
									<?php 
										if (isset($option_status))
											foreach ($option_status as $k=>$v)
												echo '<option value="'.$k.'" '.(@$search['status'] == $k ? 'selected' : '').'>'.$v.'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="pull-right text-center">
							<button type="submit" class="btn btn-primary btn-flat btn-sm" type="button"><i class="fa fa-search"></i> Search</button>
							<a href="<?=url().'report/peserta/'?>" class="btn btn-default btn-sm"><i class="fa fa-list-alt"></i> Show All</a>
							<a href="<?=url('report/peserta/', array_merge($param, ['export' => 1]))?>" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Export</a>
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