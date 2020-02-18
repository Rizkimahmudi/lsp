
 <!-- Main content -->
<section class="content">

    <?=html_entity_decode($flash_message)?>
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
	<form class="form-horizontal" method="post" action="<?php echo url('daftar')?>" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="detail" value="<?=isset($pendaftar) && @$pendaftar['detail'] == 'mitra' ? 'mitra' : 'mahasiswa'?>" />
					<div class="form-group <?php echo (form_error('id_skema') != '') ? 'has-error' : '' ; ?>">
						<label for="form-id_skema" class="control-label col-md-2">Pilih Skema</label>
						<div class="col-md-5">
							<select name="id_skema" id="form-id_skema" class="form-control">
								<?php 
									if (is_array($skema_option) && count($skema_option))
										foreach ($skema_option as $k=>$v)
											echo '<option value="'.$v['id_skema'].'" '.($v['id_skema'] == $id_skema ? 'selected' : '').'>'.$v['nm_skema'].'</option>';
								?>
							</select>
							<?php if (form_error('id_skema') != '') {?>
								<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('id_skema')?></small>
							<?php }?>
						</div>
					</div>

					<div class="form-group" id="pilihan_mahasiswa" <?=@$pendaftar['detail'] == 'mahasiswa' ? '':'style="display:none"' ?>>
						<label for="form-nrp" class="col-md-2 control-label">NRP</label>
						<div class="col-md-5">
							<input type="text" name="NRP" class="form-control" id="form-nrp" placeholder="NRP" value="<?=@$pendaftar['id']?>" readonly>
						</div>
					</div>
					
					<!-- <div class="form-group" id="pilihan_mitra" <?=@$pendaftar['detail'] == 'mitra' ? '':'style="display:none"'?>>
						<label for="form-find_name" class="col-md-2 control-label">Find from system</label>
						<div class="col-md-5">
							<input type="text" name="find_name" class="form-control" id="find_name" placeholder="Cari Mitra dari system" value="<?=@$pendaftar['id']?>" readonly>
						</div>
					</div> -->
					<br/>
					<br/>
					<div class="mhs-form">
					<?=html_entity_decode($form)?>
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