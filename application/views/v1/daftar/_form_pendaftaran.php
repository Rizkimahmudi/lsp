<?php 
	if (isset($history['aktif']))
	{
		echo '<div class="form-group">
					<label for="form-name" class="control-label col-md-12" style="text-align:center">'.ucfirst($pendaftar['tipe']).' '.$pendaftar['nm_lengkap'].' masih aktif mengikuti skema '.$history['aktif']['nama_skema'].' 
					<a class="btn btn-primary btn-sm" target="_blank" href="'. url('formulir/'. $history['aktif']['id_pendaftaran']) .'"><i class="fa fa-save"></i> Export formulir</a>
					</label> 
				</div>';
	} else {
?>

<?php 
	// if (isAjax()) echoPre($history);  
?>

<script>
	var _mhs = [<?=@$pendaftar['detail'] == 'mahasiswa' ? '{"name":"'.@$pendaftar['id_detail_pendaftar'].'","id":'.@$pendaftar['id_detail_pendaftar'].'}': ''?>];
	var _mitra = [<?=@$pendaftar['detail'] == 'mitra' && @$pendaftar['id_detail_pendaftar'] !='' ? '{"name":"'.@$pendaftar['nm_lengkap'].'","id":'.@$pendaftar['id_detail_pendaftar'].'}': ''?>];
</script>
	<?php 
		if (isset($pendaftar['id']) || @$pendaftar['tipe'] == 'mitra'){
	?>
	<input type="hidden" name="id_detail_pendaftar" value="<?=@$pendaftar['id_detail_pendaftar']?>" />
	<input type="hidden" name="kode_next" value="<?=@$pendaftar['kode_next']?>" />
	<div class="form-group <?php echo (form_error('nm_lengkap') != '') ? 'has-error' : '' ; ?>">
		<label for="form-name" class="control-label col-md-2">Nama</label>
		<div class="col-md-5">
			<input type="text" name="nm_lengkap" class="form-control" id="form-name" placeholder="Name" value="<?php echo @$pendaftar['nm_lengkap']?>">
			<?php if (form_error('nm_lengkap') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_lengkap')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('tmpt_lahir') != '') ? 'has-error' : '' ; ?>">
		<label for="form-name" class="control-label col-md-2">Tempat Lahir</label>
		<div class="col-md-5">
			<input type="text" name="tmpt_lahir" class="form-control" id="form-name" placeholder="Tempat Lahir" value="<?php echo @$pendaftar['tmpt_lahir']?>">
			<?php if (form_error('tmpt_lahir') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tmpt_lahir')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('tgl_lahir') != '') ? 'has-error' : '' ; ?>">
		<label for="datepicker" class="control-label col-md-2">Tanggal Lahir</label>
		<div class="col-md-2">
			<div class="input-group date">
			  <div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			  </div>
			  <input type="text" name="tgl_lahir" value="<?php echo @$pendaftar['tgl_lahir']?>" placeholder="YYYY-MM-DD" class="form-control pull-right datepicker" id="datepicker" onkeydown="return false">
			</div>
			<?php if (form_error('tgl_lahir') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tgl_lahir')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('jk') != '') ? 'has-error' : '' ; ?>">
		<label for="form-jk" class="control-label col-md-2">Jenis Kelamin</label>
		<div class="col-md-5">
			<input type="radio" id="jk_male" name="jk" value="laki-laki" <?=@$pendaftar['jk'] == 'laki-laki' || !isset($pendaftar['jk'])? 'checked' : '' ?> /> <label for="jk_male" class="control-label" style="margin-right:10px"> Laki-laki </label>
			<input type="radio" id="jk_vemale" name="jk" value="perempuan" <?=@$pendaftar['jk'] == 'perempuan' ? 'checked' : '' ?> /> <label for="jk_vemale" class="control-label" style="margin-right:10px"> Perempuan </label>
			<?php if (form_error('jk') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jk')?></small>
			<?php }?>
		</div>
	</div>
	<?php 
		if (@$pendaftar['tipe'] != 'mahasiswa') {
	?>
	<div class="form-group <?php echo (form_error('kebangsaan') != '') ? 'has-error' : '' ; ?>">
		<label for="form-name" class="control-label col-md-2">Kebangsaan</label>
		<div class="col-md-5">
			<input type="text" name="kebangsaan" class="form-control" id="form-name" placeholder="Kewarganegaraan" value="<?php echo @$pendaftar['kebangsaan']?>">
			<?php if (form_error('kebangsaan') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kebangsaan')?></small>
			<?php }?>
		</div>
		<div class="col-md-5">
			<small style="color:#dd4b39">* contoh: Indonesia</small>
		</div>
	</div>
	<?php }?>
	<div class="form-group <?php echo (form_error('almt_rmh') != '') ? 'has-error' : '' ; ?>">
		<label for="form-alamat" class="control-label col-md-2">Alamat</label>
		<div class="col-md-5">
			<textarea name="almt_rmh" id="form-alamat" class="form-control" placeholder="Alamat"><?=@$pendaftar['almt_rmh']?></textarea>
			<?php if (form_error('almt_rmh') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('almt_rmh')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('kd_pos') != '') ? 'has-error' : '' ; ?>">
		<label for="form-kd_pos" class="control-label col-md-2">Kode Pos</label>
		<div class="col-md-2">
			<input type="text" name="kd_pos" class="form-control" id="form-kd_pos" placeholder="Kode Pos" value="<?php echo @$pendaftar['kd_pos']?>">
			<?php if (form_error('kd_pos') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kd_pos')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('telp_rumah') != '') ? 'has-error' : '' ; ?>">
		<label for="form-telp_rumah" class="control-label col-md-2">Telp Rumah</label>
		<div class="col-md-3">
			<input type="text" name="telp_rumah" class="form-control" id="form-telp_rumah" placeholder="Telp Rumah" value="<?php echo @$pendaftar['telp_rumah']?>">
			<?php if (form_error('telp_rumah') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_rumah')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('telp_hp') != '') ? 'has-error' : '' ; ?>">
		<label for="form-telp_hp" class="control-label col-md-2">No Handhpone</label>
		<div class="col-md-3">
			<input type="text" name="telp_hp" class="form-control" id="form-telp_hp" placeholder="No Handhpone" value="<?php echo @$pendaftar['telp_hp']?>">
			<?php if (form_error('telp_hp') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_hp')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('email') != '') ? 'has-error' : '' ; ?>">
		<label for="form-email" class="control-label col-md-2">Email</label>
		<div class="col-md-5">
			<input type="text" name="email" class="form-control" id="form-email" placeholder="Email" value="<?php echo @$pendaftar['email']?>">
			<?php if (form_error('email') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('email')?></small>
			<?php }?>
		</div>
	</div>
	<?php 
		if (@$pendaftar['tipe'] != 'mahasiswa') {
	?>
	<div class="form-group <?php echo (form_error('pendidikan_terakhir') != '') ? 'has-error' : '' ; ?>">
		<label for="form-pendidikan" class="control-label col-md-2">Pendidikan Terakhir</label>
		<div class="col-md-3">
			<select name="pendidikan_terakhir" id="form-pendidikan" class="form-control">
				<option value="D1" <?=@$pendaftar['pendidikan_terakhir'] == 'D1' || !isset($pendaftar['pendidikan_terakhir']) ? 'selected' : ''?>>Diploma 1 (D1)</option>
				<option value="D3" <?=@$pendaftar['pendidikan_terakhir'] == 'D3' ? 'selected' : ''?>>Diploma 3 (D3)</option>
				<option value="D4" <?=@$pendaftar['pendidikan_terakhir'] == 'D4' ? 'selected' : ''?>>Diploma 4 (D4)</option>
				<option value="S1" <?=@$pendaftar['pendidikan_terakhir'] == 'S1' ? 'selected' : ''?>>Strata 1 (S1)</option>
				<option value="S2" <?=@$pendaftar['pendidikan_terakhir'] == 'S2' ? 'selected' : ''?>>Strata 2 (S2)</option>
				<option value="S3" <?=@$pendaftar['pendidikan_terakhir'] == 'S3' ? 'selected' : ''?>>Strata 3 (S3)</option>
			</select>
			<?php if (form_error('pendidikan_terakhir') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('pendidikan_terakhir')?></small>
			<?php }?>
		</div>
	</div>
	<?php }?>
	<br/>
	<br/>
	
	<div class="form-group <?php echo (form_error('work_nm_lembaga') != '') ? 'has-error' : '' ; ?>">
		<label for="form-work_nm_lembaga" class="control-label col-md-2" style="margin-top:-12px">Nama Lembaga/perusahaan</label>
		<div class="col-md-5">
			<?php 
				if (@$pendaftar['tipe'] != 'mahasiswa')
					echo '<input type="text" name="work_nm_lembaga" class="form-control" id="form-work_nm_lembaga" placeholder="Nama tempat kerja" value="'.$pendaftar['work_nm_lembaga'].'">';
				else 
					echo 'Sekolah Tinggi Informatika dan Komputer Indonesia <b>(STIKI)</b>';
			?>
			<?php if (form_error('work_nm_lembaga') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_nm_lembaga')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('work_jabatan') != '') ? 'has-error' : '' ; ?>">
		<label for="form-work_jabatan" class="control-label col-md-2">Jabatan</label>
		<div class="col-md-5">
			<?php 
				if (@$pendaftar['tipe'] != 'mahasiswa')
					echo '<input type="text" name="work_jabatan" class="form-control" id="form-work_jabatan" placeholder="Jabatan" value="'.$pendaftar['work_jabatan'].'">';
				else 
					echo 'Mahasiswa';
			?>
			<?php if (form_error('work_jabatan') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_jabatan')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('work_alamat') != '') ? 'has-error' : '' ; ?>">
		<label for="form-almt_rmh" class="control-label col-md-2">Alamat</label>
		<div class="col-md-5">
			<?php 
				if (@$pendaftar['tipe'] != 'mahasiswa')
					echo '<textarea name="work_alamat" id="form-almt_rmh" class="form-control" placeholder="Alamat">'.$pendaftar['work_alamat'].'</textarea>';
				else 
					echo 'Jl. Tidar 100, Karangbesuki, Sukun,<br/>Kota Malang'
			?>
			<?php if (form_error('work_alamat') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_alamat')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('work_kd_pos') != '') ? 'has-error' : '' ; ?>">
		<label for="form-work_kd_pos" class="control-label col-md-2">Kode Pos</label>
		<div class="col-md-2">
			<?php 
				if (@$pendaftar['tipe'] != 'mahasiswa')
					echo '<input type="text" name="work_kd_pos" class="form-control" id="form-work_kd_pos" placeholder="Kode Pos" value="'.$pendaftar['work_kd_pos'].'">';
				else
					echo '65149';
			?>
			<?php if (form_error('work_kd_pos') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_kd_pos')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('work_telp') != '') ? 'has-error' : '' ; ?>">
		<label for="form-work_telp" class="control-label col-md-2">Telp Kantor</label>
		<div class="col-md-3">
			<?php 
				if (@$pendaftar['tipe'] != 'mahasiswa')
					echo '<input type="text" name="work_telp" class="form-control" id="form-work_telp" placeholder="Telp Kantor" value="'.$pendaftar['work_telp'].'">';
				else
					echo '+62 341 560823';
			?>
			<?php if (form_error('work_telp') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_telp')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('work_fax') != '') ? 'has-error' : '' ; ?>">
		<label for="form-work_fax" class="control-label col-md-2">Fax</label>
		<div class="col-md-3">
			<?php 
				if (@$pendaftar['tipe'] != 'mahasiswa')
					echo '<input type="text" name="work_fax" class="form-control" id="form-work_fax" placeholder="Fax" value="'.$pendaftar['work_fax'].'">';
				else 
					echo '0341-562525';
			?>			
			<?php if (form_error('work_fax') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_fax')?></small>
			<?php }?>
		</div>
	</div>
	<div class="form-group <?php echo (form_error('work_email') != '') ? 'has-error' : '' ; ?>">
		<label for="form-work_email" class="control-label col-md-2">Email</label>
		<div class="col-md-3">
			<?php 
				if (@$pendaftar['tipe'] != 'mahasiswa')
					echo '<input type="text" name="work_email" class="form-control" id="form-work_email" placeholder="Email" value="'.$pendaftar['work_email'].'">';
				else 
					echo 'stiki@stiki.ac.id';
			?>
			<?php if (form_error('work_email') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('work_email')?></small>
			<?php }?>
		</div>
	</div>
	<br/>
	<br/>
	<div class="form-group <?php echo (form_error('id_jns_daftar') != '') ? 'has-error' : '' ; ?>">
		<label for="form-id_jns_daftar" class="control-label col-md-2">Jenis Daftar</label>
		<div class="col-md-3">
			<select name="id_jns_daftar" id="form-id_jns_daftar" class="form-control">
				<?php 
					if (is_array($jenis_daftar_option) && count($jenis_daftar_option))
						foreach ($jenis_daftar_option as $k=>$v){
							switch ($k){
								case 0 :
									if (isset($history[$id_skema][$v['id_jns_daftar']]))
										$available = FALSE;
									else 
										$available = TRUE;
									break;
								case 1 : 
									if (@$history[$id_skema][1] == 5)
										$available = TRUE;
									else 
										$available = FALSE;
									break;
								case 2 : 
									if (@$history[$id_skema][1] == 4 || @$history[$id_skema][2] == 4)
										$available = TRUE;
									else 
										$available = FALSE;
									break;
								default :
									$available = FALSE;
								break;
							}
							
							echo '<option value="'.$v['id_jns_daftar'].'" '.($v['id_jns_daftar'] == $pendaftar['id_jns_daftar'] ? 'selected' : '').' '. ($available ? '' : 'disabled') .'>'.$v['nm_jns_daftar'].'</option>';
						}
				?>
			</select>
			<?php if (form_error('id_jns_daftar') != '') {?>
				<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('id_jns_daftar')?></small>
			<?php }?>
		</div>
	</div>
	<br/>
	<br/>
	<div class="form-group">
		<div class="col-md-5 col-md-offset-2">
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo @$pendaftar['id'] ? 'Save Changes' : 'Save New Pendaftaran'; ?></button>
			<a href="<?php echo url('pendaftaran')?>" class="btn btn-default button-reset">Reset</a>
		</div>
	</div>
	
	<?php } ?>
			
			
	
	<?php 
	} 
	// end of seleksi aktif 
	?>