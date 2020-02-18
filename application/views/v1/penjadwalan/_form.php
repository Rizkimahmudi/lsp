<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
	<div class="box-header with-border">
		&nbsp;
	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip">
		  <i class="fa fa-minus"></i></button>
		<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip">
		  <i class="fa fa-times"></i></button>
	  </div>
	</div> 
	<form class="form-horizontal" id="form-jadwal" method="post" action="<?php echo url('penjadwalan/add', $param)?>" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group <?php echo (form_error('skema') != '') ? 'has-error' : '' ; ?>">
						<label for="form-skema" class="control-label col-md-2">Skema</label>
						<div class="col-md-5">
							<select name="skema" class="form-control">
								<option selected disabled hidden>Pilih Skema</option>
								<?php 
									if ($skema_option && is_array(@$skema_option) && count(@$skema_option))
										foreach ($skema_option as $k=>$v)
											echo '<option value="'.$v['id_skema'].'">'.$v['nm_skema'].'</option>';
								?>
							</select>
							<small id="error-skema" class="help-block" style="<?=(form_error('skema') == '') ? 'display:none': ''?>><i class="fa fa-times-circle-o"></i> <?php echo form_error('skema')?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="form-kd_tuk" class="control-label col-md-2">TUK</label>
						<div class="col-md-5">
							<input type="text" name="kd_tuk" class="form-control" id="form-kd_tuk" placeholder="Tempat Unjuk Kerja" value="<?php echo @$jadwal['kd_tuk']?>">
							<small id="error-tuk" class="help-block" style="<?=(form_error('kd_tuk') == '') ? 'display:none': ''?>"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kd_tuk')?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="form-id_asesor" class="control-label col-md-2">Asesor</label>
						<div class="col-md-5">
							<input type="text" name="id_asesor" class="form-control" id="form-id_asesor" placeholder="Nama Asesor" value="<?php echo @$jadwal['id_asesor']?>">
							<small class="help-block" id="error-asesor" style="<?=(form_error('id_asesor') == '') ? 'display:none': ''?>><i class="fa fa-times-circle-o"></i> <?php echo form_error('id_asesor')?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="form-tanggal" class="control-label col-md-2">Tanggal</label>
						<div class="col-md-5">
							<div class="input-group date">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
							  <input type="text" name="tanggal" value="<?php echo (isset($jadwal['tanggal']) ? $jadwal['tanggal'] : '')?>" placeholder="YYYY-MM-DD" class="form-control pull-right datepicker" id="datepicker" onkeydown="return false">
							</div>
							<small class="help-block" id="error-tanggal" style="<?=(form_error('tanggal') == '') ? 'display:none': ''?>><i class="fa fa-times-circle-o"></i> <?php echo form_error('tanggal')?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="form-id_asesor" class="control-label col-md-2">Jam</label>
						<div class="col-md-2" id="jam-penjadwalan">
							<select name="jam" class="form-control">
								<option value="null" selected disabled hidden>Pilih Jam</option>
								<?php 
									if ($jam && is_array(@$jam) && count(@$jam))
										foreach ($jam as $k=>$v)
											echo '<option value="'.$v.'">'.$v.'</option>';
								?>
							</select>
							<small class="help-block" id="error-jam" style="<?=(form_error('jam') == '') ? 'display:none': ''?>><i class="fa fa-times-circle-o"></i> <?php echo form_error('jam')?></small>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-8 col-md-offset-1">
					<input type="hidden" value="" name="pendaftar_id" />
					<a href="#" id="random-list" class="btn btn-default button-reset pull-right" style="margin: 15px 0">Random</a>
					<div id="table-pendaftar">
						<?=$table?>
						<small class="help-block" id="error-total" style="<?=(form_error('total') == '') ? 'display:none': ''?>><i class="fa fa-times-circle-o"></i> <?php echo form_error('total')?></small>
					</div>
					<label class="control-label col-md-8" style="text-align:left; margin-top: -20px; margin-left: -15px; margin-bottom:25px">Jumlah Pendaftar : <span id="id-jumlah-pendaftar">0</span></label>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-5 col-md-offset-2">
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Jadwal</button>
							<a href="<?php echo url('penjadwalan/add')?>" class="btn btn-default button-reset">Reset</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->