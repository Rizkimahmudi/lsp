<form method="post" id="mitra-form" action="<?php echo url('setting/mitra', $param)?>" enctype="multipart/form-data" autocomplete="off">
<div class="box box-success">
	<div class="box-header col-xs-12">
		<h3 class="box-title"><?php echo (@$mitra['id']) ? 'Update Mitra' : 'Add New Mitra'; ?></h3>
	</div>
	<div class="box-body">
		<input type="hidden" name="id" id="form-id" value="<?php echo @$mitra['id']?>" />
		<input type="hidden" name="id_admin" id="form-id" value="<?php echo @$mitra['id_admin']?>" />
		<div class="form-group <?php echo (form_error('nm_mitra') != '') ? 'has-error' : '' ; ?>">
			<label for="form-name" class="control-label">Nama</label>
			<input type="text" name="nm_mitra" class="form-control" id="form-name" placeholder="Name" value="<?php echo @$mitra['nm_mitra']?>">
			<?php if (form_error('nm_mitra') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_mitra')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('alamat_mitra') != '') ? 'has-error' : '' ; ?>">
			<label for="form-alamat" class="control-label">Alamat</label>
			<textarea name="alamat_mitra" id="form-alamat" class="form-control" placeholder="Alamat Mitra"><?=@$mitra['alamat_mitra']?></textarea>
			<?php if (form_error('alamat_mitra') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('alamat_mitra')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('kd_pos') != '') ? 'has-error' : '' ; ?>">
			<label for="form-kd_pos" class="control-label">Kode Pos</label>
			<input type="text" name="kd_pos" class="form-control" id="form-kd_pos" placeholder="Kode Pos" value="<?php echo @$mitra['kd_pos']?>">
			<?php if (form_error('kd_pos') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kd_pos')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('tmpt_lahir') != '') ? 'has-error' : '' ; ?>">
			<label for="form-ttl" class="control-label">Tempat Lahir</label>
			<input type="text" name="tmpt_lahir" class="form-control" id="form-ttl" placeholder="Tempat Lahir" value="<?php echo @$mitra['tmpt_lahir']?>">
			<?php if (form_error('tmpt_lahir') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tmpt_lahir')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('tgl_lahir') != '') ? 'has-error' : '' ; ?>">
			<label for="form-ttl" class="control-label">Tanggal Lahir</label>
			<div class="input-group date">
			  <div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			  </div>
			  <input type="text" name="tgl_lahir" value="<?php echo @$mitra['tgl_lahir']?>" class="form-control pull-right" id="datepicker" onkeydown="return false">
			</div>
			<?php if (form_error('tgl_lahir') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tgl_lahir')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('jk_mitra') != '') ? 'has-error' : '' ; ?>">
			<label for="form-jk" class="control-label">Jenis Kelamin</label><br/>
			<input type="radio" id="jk_male" name="jk_mitra" value="laki-laki" <?=@$mitra['jk_mitra'] == 'laki-laki' || !isset($mitra['jk_mitra'])? 'checked' : '' ?> /> <label for="jk_male" class="control-label" style="margin-right:10px"> Laki-laki </label>
			<input type="radio" id="jk_vemale" name="jk_mitra" value="perempuan" <?=@$mitra['jk_mitra'] == 'perempuan' ? 'checked' : '' ?> /> <label for="jk_vemale" class="control-label" style="margin-right:10px"> Perempuan </label>
			<?php if (form_error('jk_mitra') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jk_mitra')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('telp_hp') != '') ? 'has-error' : '' ; ?>">
			<label for="form-hp" class="control-label">No Handphone</label>
			<input type="text" name="telp_hp" class="form-control" id="form-hp" placeholder="No Handphone" value="<?php echo @$mitra['telp_hp']?>">
			<?php if (form_error('telp_hp') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_hp')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('email') != '') ? 'has-error' : '' ; ?>">
			<label for="form-email" class="control-label">Email</label>
			<input type="text" name="email" class="form-control" id="form-email" placeholder="Email" value="<?php echo @$mitra['email']?>">
			<?php if (form_error('email') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('email')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('telp_mitra') != '') ? 'has-error' : '' ; ?>">
			<label for="form-telp_mitra" class="control-label">Telp Rumah</label>
			<input type="text" name="telp_mitra" class="form-control" id="form-telp_mitra" placeholder="Telp Rumah" value="<?php echo @$mitra['telp_mitra']?>">
			<?php if (form_error('telp_mitra') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_mitra')?></small>
			<?php }?>
		</div>
		
		<div class="form-group <?php echo (form_error('kebangsaan') != '') ? 'has-error' : '' ; ?>">
			<label for="form-name" class="control-label">Kebangsaan</label>				
			<input type="text" name="kebangsaan" class="form-control" id="form-name" placeholder="Kewarganegaraan" value="<?php echo @$mitra['kebangsaan']?>">
			<?php if (form_error('kebangsaan') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kebangsaan')?></small>
			<?php }?>
			<div class="control-label">
				<small style="color:#dd4b39">* contoh: Indonesia</small>
			</div>
		</div>
		
		<div class="form-group <?php echo (form_error('pendidikan_terakhir') != '') ? 'has-error' : '' ; ?>">
			<label for="form-pendidikan" class="control-label">Pendidikan Terakhir</label>
			<select name="pendidikan_terakhir" id="form-pendidikan" class="form-control">
				<option value="D1" <?=@$mitra['pendidikan_terakhir'] == 'D1' || !isset($mitra['pendidikan_terakhir']) ? 'selected' : ''?>>Diploma 1 (D1)</option>
				<option value="D3" <?=@$mitra['pendidikan_terakhir'] == 'D3' ? 'selected' : ''?>>Diploma 3 (D3)</option>
				<option value="D4" <?=@$mitra['pendidikan_terakhir'] == 'D4' ? 'selected' : ''?>>Diploma 4 (D4)</option>
				<option value="S1" <?=@$mitra['pendidikan_terakhir'] == 'S1' ? 'selected' : ''?>>Strata 1 (S1)</option>
				<option value="S2" <?=@$mitra['pendidikan_terakhir'] == 'S2' ? 'selected' : ''?>>Strata 2 (S2)</option>
				<option value="S3" <?=@$mitra['pendidikan_terakhir'] == 'S3' ? 'selected' : ''?>>Strata 3 (S3)</option>
			</select>
			<?php if (form_error('pendidikan_terakhir') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('pendidikan_terakhir')?></small>
			<?php }?>
		</div>
		
		
	</div>
</div>

<div class="box box-success">
	<div class="box-body">
		<div class="form-group <?php echo (form_error('work_nm_lembaga') != '') ? 'has-error' : '' ; ?>">
			<label for="form-work_nm_lembaga" class="control-label" style="margin-top:-12px">Nama Lembaga/perusahaan</label>
			<input type="text" name="work_nm_lembaga" class="form-control" id="form-work_nm_lembaga" placeholder="Nama tempat kerja" value="<?=@$mitra['work_nm_lembaga']?>">
			<?php if (form_error('work_nm_lembaga') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_nm_lembaga')?></small>
			<?php }?>
		</div>
		
		<div class="form-group <?php echo (form_error('work_jabatan') != '') ? 'has-error' : '' ; ?>">
			<label for="form-work_jabatan" class="control-label">Jabatan</label>
			<input type="text" name="work_jabatan" class="form-control" id="form-work_jabatan" placeholder="Jabatan" value="<?=@$mitra['work_jabatan']?>">
			<?php if (form_error('work_jabatan') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_jabatan')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('work_alamat') != '') ? 'has-error' : '' ; ?>">
			<label for="form-almt_rmh" class="control-label">Alamat</label>
			<textarea name="work_alamat" id="form-almt_rmh" class="form-control" placeholder="Alamat"><?=@$mitra['work_alamat']?></textarea>
			<?php if (form_error('work_alamat') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_alamat')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('work_kd_pos') != '') ? 'has-error' : '' ; ?>">
			<label for="form-work_kd_pos" class="control-label">Kode Pos</label>
			<input type="text" name="work_kd_pos" class="form-control" id="form-work_kd_pos" placeholder="Kode Pos" value="<?=@$mitra['work_kd_pos']?>">
			<?php if (form_error('work_kd_pos') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_kd_pos')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('work_telp') != '') ? 'has-error' : '' ; ?>">
			<label for="form-work_telp" class="control-label">Telp Kantor</label>
			<input type="text" name="work_telp" class="form-control" id="form-work_telp" placeholder="Telp Kantor" value="<?=@$mitra['work_telp']?>">
			<?php if (form_error('work_telp') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_telp')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('work_fax') != '') ? 'has-error' : '' ; ?>">
			<label for="form-work_fax" class="control-label">Fax</label>
			<input type="text" name="work_fax" class="form-control" id="form-work_fax" placeholder="Fax" value="<?=@$mitra['work_fax']?>">
			<?php if (form_error('work_fax') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_fax')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('work_email') != '') ? 'has-error' : '' ; ?>">
			<label for="form-work_email" class="control-label">Email</label>
			<input type="text" name="work_email" class="form-control" id="form-work_email" placeholder="Email" value="<?=@$mitra['work_email']?>">
			<?php if (form_error('work_email') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_email')?></small>
			<?php }?>
		</div>
	</div>
</div>

<div class="box box-success">
	<div class="box-body">
		<div class="form-group <?php echo (form_error('username') != '') ? 'has-error' : '' ; ?>">
			<label for="form-username" class="control-label">Username</label>
			<input type="username" name="username" class="form-control" id="form-username" placeholder="Username" value="<?=@$mitra['username']?>" <?=isset($mitra['id_admin']) && trim(@$mitra['id_admin']) != '' ? 'readonly disabled' : ''?>>
			<?php if (form_error('username') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('username')?></small>
			<?php }?>
		</div>
		<div class="form-group <?php echo (form_error('password') != '') ? 'has-error' : '' ; ?>">
			<label for="form-password" class="control-label">Password</label>
			<input type="password" name="password" class="form-control" id="form-password" placeholder="Password" autocomplete="off">
			<?=@$mitra['id'] != '' ? '<small class="help-block"><i class="fa fa-times-circle-o"></i> Hanya diisi jika ingin mengganti password</small>' : '' ?>
			<?php if (form_error('password') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('password')?></small>
			<?php }?>
		</div>
	</div>
</div>

<!--<div class="box box-success">
	<div class="box-body"> -->
		<div class="form-group">
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo @$mitra['id'] ? 'Save Changes' : 'Save New Mitra'; ?></button>
			<a href="<?php echo url('setting/mitra', $param)?>" class="btn btn-default button-reset">Reset</a>
		</div>
<!--	</div>
</div>-->

</form>