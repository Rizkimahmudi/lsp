<?php if ($bayar) {
	$_bayar = json_decode($bayar['jmlh_bayar'], TRUE);
	if (!isset($bayar['jmlh_bayar_mahasiswa']))
		$bayar['jmlh_bayar_mahasiswa'] = isset($_bayar['mahasiswa']) ? $_bayar['mahasiswa'] : 0;
	if (!isset($bayar['jmlh_bayar_mitra']))
		$bayar['jmlh_bayar_mitra'] = isset($_bayar['mitra']) ? $_bayar['mitra'] : 0;
?>
<div class="box box-success">
	<div class="box-header col-xs-12">
		<h3 class="box-title"><?php echo (@$bayar['id']) ? 'Update Biaya Pendaftaran' : 'Add New Biaya Pendaftaran'; ?></h3>
	</div>
	<div class="box-body">
		<form method="post" id="biaya-form" action="<?php echo url('setting/biaya-pendaftaran')?>" enctype="multipart/form-data">
			<input type="hidden" name="id" id="form-id" value="<?php echo @$bayar['id']?>" />
			<div class="form-group <?php echo (form_error('nm_jns_daftar') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-nm_jns_daftar" class="control-label">Nama</label>
		      	<input name="nm_jns_daftar" class="form-control" id="form-nm_jns_daftar" placeholder="Nama" value="<?php echo @$bayar['nm_jns_daftar']?>">
			    <?php if (form_error('nm_jns_daftar') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_jns_daftar')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('ket') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-ket" class="control-label">Keterangan</label>
		      	<textarea name="ket" class="form-control" id="form-ket" placeholder="Keterangan" value=""><?php echo @$bayar['ket']?></textarea>
			    <?php if (form_error('ket') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('ket')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('jmlh_bayar_mahasiswa') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-jmlh_bayar_mahasiswa" class="control-label">Jumlah Bayar Mahasiswa</label>
		      	<div class="input-group date">
				  <div class="input-group-addon">
					Rp.
				  </div>
				  <input type="text" name="jmlh_bayar_mahasiswa" value="<?php echo @$bayar['jmlh_bayar_mahasiswa']?>" class="form-control pull-right">
                </div>
			    <?php if (form_error('jmlh_bayar_mahasiswa') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jmlh_bayar_mahasiswa')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('jmlh_bayar_mitra') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-jmlh_bayar_mitra" class="control-label">Jumlah Bayar Mitra</label>
		      	<div class="input-group date">
				  <div class="input-group-addon">
					Rp.
				  </div>
				  <input type="text" name="jmlh_bayar_mitra" value="<?php echo @$bayar['jmlh_bayar_mitra']?>" class="form-control pull-right">
                </div>
			    <?php if (form_error('jmlh_bayar_mitra') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jmlh_bayar_mitra')?></small>
			    <?php }?>
		    </div>
			<div class="form-group">
		    	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo @$bayar['id'] ? 'Save Changes' : 'Save New Biaya Pendaftaran'; ?></button>
		    	<a href="<?php echo url('setting/biaya-pendaftaran')?>" class="btn btn-default button-reset">Reset</a>
		    </div>
		</form>
	</div>
</div>
<?php }?>