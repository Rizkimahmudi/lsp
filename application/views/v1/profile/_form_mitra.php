<form class="form-horizontal" method="POST">
	<div class="form-group">
		<label for="form-nm_mitra" class="col-md-4 control-label">Nama</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="nm_mitra" value="<?=$peserta['nm_mitra']?>" placeholder="Tempat Lahir" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('nm_mitra') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_mitra')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-tmpt_lahir" class="col-md-4 control-label">Tempat Lahir</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="tmpt_lahir" value="<?=$peserta['tmpt_lahir']?>" placeholder="Tempat Lahir" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('tmpt_lahir') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tmpt_lahir')?></small>
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
		<label for="form-jk_mitra" class="col-md-4 control-label">Jenis Kelamin</label>
		<div class="col-md-8">
		<?php if (!$edit) { ?>
			<input type="text" class="form-control" name="jk_mitra" value="<?=$peserta['jk_mitra']?>" readonly />
		<?php } else { ?>
			<input type="radio" id="jk_male" name="jk_mitra" value="laki-laki" <?=@$peserta['jk_mitra'] == 'laki-laki' || !isset($peserta['jk_mitra'])? 'checked' : '' ?> /> <label for="jk_male" class="control-label" style="margin-right:10px"> Laki-laki </label>
            <input type="radio" id="jk_vemale" name="jk_mitra" value="perempuan" <?=@$peserta['jk_mitra'] == 'perempuan' ? 'checked' : '' ?> /> <label for="jk_vemale" class="control-label" style="margin-right:10px"> Perempuan </label>
		<?php } ?>
			<?php if (form_error('jk_mitra') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jk_mitra')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-alamat_mitra" class="col-md-4 control-label">Alamat</label>
		<div class="col-md-8">
			<textarea class="form-control" name="alamat_mitra" <?=$edit ? '' : 'readonly' ?>><?=$peserta['alamat_mitra']?></textarea>
			<?php if (form_error('alamat_mitra') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('alamat_mitra')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-kd_pos" class="col-md-4 control-label">Kode Pos</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="kd_pos" value="<?=$peserta['kd_pos']?>" <?=$edit ? '' : 'readonly' ?> />
			<?php if (form_error('kd_pos') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kd_pos')?></small>
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
		<label for="form-telp_mitra" class="col-md-4 control-label">Telp rumah</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="telp_mitra" value="<?=$peserta['telp_mitra']?>" <?=$edit ? '' : 'readonly' ?> />
			<?php if (form_error('telp_mitra') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_mitra')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-kebangsaan" class="col-md-4 control-label">Kebangsaan</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="kebangsaan" value="<?=$peserta['kebangsaan']?>" <?=$edit ? '' : 'readonly' ?> />
			<?php if (form_error('kebangsaan') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kebangsaan')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group">
		<label for="form-pendidikan_terakhir" class="col-md-4 control-label">Pendidikan Terakhir</label>
		<div class="col-md-8">
			<select name="pendidikan_terakhir" id="form-pendidikan" class="form-control" <?=$edit ? '' : 'readonly' ?>>
				<option value="D1" <?=@$peserta['pendidikan_terakhir'] == 'D1' || !isset($peserta['pendidikan_terakhir']) ? 'selected' : ''?>>Diploma 1 (D1)</option>
				<option value="D3" <?=@$peserta['pendidikan_terakhir'] == 'D3' ? 'selected' : ''?>>Diploma 3 (D3)</option>
				<option value="D4" <?=@$peserta['pendidikan_terakhir'] == 'D4' ? 'selected' : ''?>>Diploma 4 (D4)</option>
				<option value="S1" <?=@$peserta['pendidikan_terakhir'] == 'S1' ? 'selected' : ''?>>Strata 1 (S1)</option>
				<option value="S2" <?=@$peserta['pendidikan_terakhir'] == 'S2' ? 'selected' : ''?>>Strata 2 (S2)</option>
				<option value="S3" <?=@$peserta['pendidikan_terakhir'] == 'S3' ? 'selected' : ''?>>Strata 3 (S3)</option>
			</select>
			<?php if (form_error('pendidikan_terakhir') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('pendidikan_terakhir')?></small>
			<?php }?>
		</div>
	</div>
	<br/><br/>
	<div class="form-group">
		<label for="form-work_nm_lembaga" class="col-md-4 control-label">Nama Lembaga</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="work_nm_lembaga" value="<?=$peserta['work_nm_lembaga']?>" placeholder="Nama Lembaga" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('work_nm_lembaga') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_nm_lembaga')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-work_jabatan" class="col-md-4 control-label">Jabatan</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="work_jabatan" value="<?=$peserta['work_jabatan']?>" placeholder="Jabatan" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('work_jabatan') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_jabatan')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-work_alamat" class="col-md-4 control-label">Alamat</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="work_alamat" value="<?=$peserta['work_alamat']?>" placeholder="Alamat" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('work_alamat') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_alamat')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-work_kd_pos" class="col-md-4 control-label">Kodepos</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="work_kd_pos" value="<?=$peserta['work_kd_pos']?>" placeholder="Kodepos" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('work_kd_pos') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_kd_pos')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-work_telp" class="col-md-4 control-label">Telp</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="work_telp" value="<?=$peserta['work_telp']?>" placeholder="Telp" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('work_telp') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_telp')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-work_fax" class="col-md-4 control-label">Fax</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="work_fax" value="<?=$peserta['work_fax']?>" placeholder="Fax" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('work_fax') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_fax')?></small>
		<?php }?>
	</div>
	<div class="form-group">
		<label for="form-work_email" class="col-md-4 control-label">Email</label>
		<div class="col-md-8">
			<input type="text" class="form-control" name="work_email" value="<?=$peserta['work_email']?>" placeholder="Email" <?=$edit ? '' : 'readonly' ?> />
		</div>
		<?php if (form_error('work_email') != '') {?>
			<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_email')?></small>
		<?php }?>
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
	<!-- fu1 <div class="form-group">
		<a class="btn btn-primary col-md-offset-3 pull-left" href="<?=url('profile/edit')?>"><i class="fa fa-pencil"></i> Edit</a>
	</div> -->
	<?php } else { ?>
	<div class="form-group pull-right">
		<button class="btn btn-success" ><i class="fa fa-save"></i> Save</button>
		<a class="btn btn-default" href="<?=url('profile')?>">Cancel</a>
	</div>
	<?php } ?>
	
</form>