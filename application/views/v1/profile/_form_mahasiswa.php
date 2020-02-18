<form class="form-horizontal" method="POST">
	<div class="form-group">
		<label for="form-tempat_lahir" class="col-md-4 control-label">NIK</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="NIK" value="<?=$peserta['NIK']?>" placeholder="NIK" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('NIK') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('NIK')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="tempat_lahir" value="<?=$peserta['tempat_lahir']?>" placeholder="Tempat Lahir" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('tempat_lahir') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tempat_lahir')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-tgl_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
		<div class="col-md-8">
			<?php if (!$edit) {?>
			<input type="text" class="form-control" name="tgl_lahir" value="<?=date('j F Y', strtotime($peserta['tgl_lahir']))?>" placeholder="Tanggal Lahir" <?=$edit ? '' : 'readonly' ?> />
			<?php } else {?>
			<div class="input-group date">
			  <div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			  </div>
			  <input type="text" name="tgl_lahir" value="<?php echo date('Y-m-d', strtotime($peserta['tgl_lahir']))?>" class="form-control pull-right" id="datepicker" onkeydown="return false">
			</div>
			<?php }?>
			<?php if (form_error('tgl_lahir') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tgl_lahir')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-jk_mhs" class="col-md-4 control-label">Jenis Kelamin</label>
		<div class="col-md-8">
		<?php if (!$edit) { ?>
			<input type="text" class="form-control" name="jk_mhs" value="<?=$peserta['jk_mhs']?>" readonly />
		<?php } else { ?>
			<input type="radio" id="jk_male" name="jk_mhs" value="laki-laki" <?=@$peserta['jk_mhs'] == 'laki-laki' || !isset($peserta['jk_mhs'])? 'checked' : '' ?> /> <label for="jk_male" class="control-label" style="margin-right:10px"> Laki-laki </label>
            <input type="radio" id="jk_vemale" name="jk_mhs" value="perempuan" <?=@$peserta['jk_mhs'] == 'perempuan' ? 'checked' : '' ?> /> <label for="jk_vemale" class="control-label" style="margin-right:10px"> Perempuan </label>
		<?php } ?>
			<?php if (form_error('jk_mhs') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jk_mhs')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-agama" class="col-md-4 control-label">Agama</label>
		<div class="col-md-8">
		<?php if (!$edit) { ?>
			<input type="text" class="form-control" name="agama" value="<?=$peserta['agama']?>" readonly />
		<?php } else { ?>
		<select name="agama" id="form-agama" class="form-control">
			<option value="islam" <?=@$peserta['agama'] == 'islam' || !isset($peserta['agama']) ? 'selected' : ''?>>Islam</option>
			<option value="kristen" <?=@$peserta['agama'] == 'kristen' ? 'selected' : ''?>>Kristen</option>
			<option value="katholik" <?=$peserta['agama'] == 'katholik' ? 'selected' : ''?>>Katholik</option>
			<option value="hindu" <?=$peserta['agama'] == 'hindu' ? 'selected' : ''?>>Hindu</option>
			<option value="budha" <?=$peserta['agama'] == 'budha' ? 'selected' : ''?>>Budha</option>
			<option value="konghucu" <?=$peserta['agama'] == 'konghucu' ? 'selected' : ''?>>Konghucu</option>
		</select>
		<?php } ?>
			<?php if (form_error('agama') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('agama')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-alamat_mhs" class="col-md-4 control-label">Alamat</label>
		<div class="col-md-8">
			<textarea class="form-control" name="alamat_mhs" <?=$edit ? '' : 'readonly' ?>><?=$peserta['alamat_mhs']?></textarea>
			<?php if (form_error('alamat_mhs') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('alamat_mhs')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-kodepos" class="col-md-4 control-label">Kode Pos</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="kodepos" value="<?=$peserta['kodepos']?>" <?=$edit ? '' : 'readonly' ?> />
			<?php if (form_error('kodepos') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kodepos')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-email" class="col-md-4 control-label">Email</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="email" value="<?=$peserta['email']?>" <?=$edit ? '' : 'readonly' ?> />
			<?php if (form_error('email') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('email')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-telp_hp" class="col-md-4 control-label">No Handphone</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="telp_hp" value="<?=$peserta['telp_hp']?>" <?=$edit ? '' : 'readonly' ?> />
			<?php if (form_error('telp_hp') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_hp')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-telp_rumah" class="col-md-4 control-label">Telp rumah</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="telp_rumah" value="<?=$peserta['telp_rumah']?>" <?=$edit ? '' : 'readonly' ?> />
			<?php if (form_error('telp_rumah') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_rumah')?></small>
			<?php }?>
		</div>
	</div>
	<?php if ($edit) { ?>
	<br/><br/>
	<div class="form-group">
		<label for="form-telp_rumah" class="col-md-4 control-label">Password</label>
		<div class="col-md-8">
			<input type="password" class="form-control" name="password" />
			<small>*hanya diisi jika ingin mengganti password</small>
		</div>
	</div>
	<?php } ?>
	
	<?php 
		if (!$edit) {
	?>
	<!-- fu1<div class="form-group">
		<a class="btn btn-primary col-md-offset-3 pull-left" href="<?=url('profile/edit')?>"><i class="fa fa-pencil"></i> Edit</a>
	</div> -->
	<?php } else { ?>
	<div class="form-group pull-right">
		<button class="btn btn-success" ><i class="fa fa-save"></i> Save</button>
		<a class="btn btn-default" href="<?=url('profile')?>">Cancel</a>
	</div>
	<?php } ?>
	
</form>