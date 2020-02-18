<div class="box box-success">
	<div class="box-header col-xs-12">
		<h3 class="box-title"><?php echo (@$tuk['id']) ? 'Update TUK' : 'Add New TUK'; ?></h3>
	</div>
	<div class="box-body">
		<form method="post" id="mahasiwa-form" action="<?php echo url('setting/tuk', $param)?>" enctype="multipart/form-data">
			<input type="hidden" name="id" id="form-id" value="<?php echo @$tuk['id']?>" />
			<div class="form-group <?php echo (form_error('kd_tuk') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-kd_tuk" class="control-label">Kode</label>
		      	<input type="text" name="kd_tuk" class="form-control" id="form-kd_tuk" <?=(@$tuk['id'] !='' ? 'readonly' : '')?> placeholder="Kode TUK" value="<?php echo @$tuk['kd_tuk']?>">
			    <?php if (form_error('kd_tuk') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kd_tuk')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('nm_tuk') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-nm_tuk" class="control-label">Nama</label>
		      	<input type="text" name="nm_tuk" class="form-control" id="form-nm_tuk" placeholder="Nama" value="<?php echo @$tuk['nm_tuk']?>">
			    <?php if (form_error('nm_tuk') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_tuk')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('jns_tuk') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-jns_tuk" class="control-label">Jenis</label>
		      	<input type="text" name="jns_tuk" class="form-control" id="form-jns_tuk" placeholder="Jenis" value="<?php echo @$tuk['jns_tuk']?>">
			    <?php if (form_error('jns_tuk') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jns_tuk')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('kapasitas_tuk') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-kapasitas_tuk" class="control-label">Kapasitas</label>
		      	<input type="number" name="kapasitas_tuk" class="form-control" id="form-kapasitas_tuk" placeholder="Kapasitas TUK" value="<?php echo @$tuk['kapasitas_tuk']?>">
			    <?php if (form_error('kapasitas_tuk') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kapasitas_tuk')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('ket_tuk') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-ket_tuk" class="control-label">Keterangan</label>
				<textarea name="ket_tuk" id="form-ket_tuk" class="form-control" placeholder="Keterangan"><?=@$asesor['ket_tuk']?></textarea>
			    <?php if (form_error('ket_tuk') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('ket_tuk')?></small>
			    <?php }?>
		    </div>
			<div class="form-group">
		    	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo @$tuk['id'] ? 'Save Changes' : 'Save New TUK'; ?></button>
		    	<a href="<?php echo url('setting/tuk', $param)?>" class="btn btn-default button-reset">Reset</a>
		    </div>
		</form>
	</div>
</div>
