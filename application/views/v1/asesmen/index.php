<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	
	<div class="box box-primary" style="display:none">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<form method="post" action="<?=url('rekap-asesmen/search')?>" class="form-horizontal">
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
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<form class="form-horizontal" method="post" action="<?php echo url('rekap-asesmen')?>" enctype="multipart/form-data">
	<input type="hidden" name="search" value="1" />	
	<div class="box">
		<div class="box-header with-border">
			&nbsp;
		  <div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip">
			  <i class="fa fa-minus"></i></button>
		  </div>
		</div> 
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group <?php echo (form_error('skema') != '') ? 'has-error' : '' ; ?>">
						<label for="form-skema" class="control-label col-md-2">Skema</label>
						<div class="col-md-10">
							<select name="skema" class="form-control">
								<option value="null" selected disabled hidden>Pilih Skema</option>
								<?php 
									if ($skema_option && is_array(@$skema_option) && count(@$skema_option))
										foreach ($skema_option as $k=>$v)
											echo '<option value="'.$v['id_skema'].'">'.$v['nm_skema'].'</option>';
								?>
							</select>
							<small id="error-skema" class="help-block" style="<?=(form_error('skema') == '') ? 'display:none': ''?>"><i class="fa fa-times-circle-o"></i> <?php echo form_error('skema')?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="form-id_asesor" class="control-label col-md-2">Asesor</label>
						<div class="col-md-10">
							<input type="text" name="id_asesor" class="form-control" id="form-id_asesor" placeholder="Nama Asesor" value="<?php echo @$jadwal['id_asesor']?>">
							<small class="help-block" id="error-asesor" style="<?=(form_error('id_asesor') == '') ? 'display:none': ''?>"><i class="fa fa-times-circle-o"></i> <?php echo form_error('id_asesor')?></small>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="form-kd_tuk" class="control-label col-md-2">TUK</label>
						<div class="col-md-10">
							<input type="text" name="kd_tuk" class="form-control" id="form-kd_tuk" placeholder="Tempat Unjuk Kerja" value="<?php echo @$jadwal['kd_tuk']?>">
							<small id="error-tuk" class="help-block" style="<?=(form_error('kd_tuk') == '') ? 'display:none': ''?>"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kd_tuk')?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="form-tanggal" class="control-label col-md-2">Tanggal</label>
						<div class="col-md-4">
							<div class="input-group date">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
							  <input type="text" name="tanggal" value="<?php echo (isset($jadwal['tanggal']) ? $jadwal['tanggal'] : '')?>" placeholder="YYYY-MM-DD" class="form-control pull-right datepicker" id="datepicker" onkeydown="return false">
							</div>
							<small class="help-block" id="error-tanggal" style="<?=(form_error('tanggal') == '') ? 'display:none': ''?>"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tanggal')?></small>
						</div>
						
						<label for="form-id_asesor" class="control-label col-md-2">Jam</label>
						<div class="col-md-3" id="jam-penjadwalan">
							<select name="jam" class="form-control">
								<option value="null" selected disabled hidden>Pilih Jam</option>
								<?php 
									if ($jam && is_array(@$jam) && count(@$jam))
										foreach ($jam as $k=>$v)
											echo '<option value="'.$v.'">'.$v.'</option>';
								?>
							</select>
							<small class="help-block" id="error-jam" style="<?=(form_error('jam') == '') ? 'display:none': ''?>"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jam')?></small>
						</div>
					</div>

					<div class="pull-right text-center">
						<button type="submit" class="btn btn-primary btn-flat btn-sm" value="search" name="search"><i class="fa fa-search"></i> Search</button>
					</div>
				</div>
			</div>
						
		</div>
	</div>


	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="box box-primary">
				<div class="box-body no-padding" id="table-rekap" style="max-height:500px; overflow-x:auto">
					<?=$table?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row" style="display:none" id="button-simpan">
		<div class="col-xs-12 col-md-12">
			<div class="pull-right">
				<button class="btn btn-success confirm-rekap"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
	</form>
</section>

<div class="modal fade" id="modal-rekap" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rekap Asesmen</h4>
      </div>
      <div class="modal-body rekapAsesmenContent">
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

