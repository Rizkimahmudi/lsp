<div class="box box-success">
	<div class="box-header col-xs-12">
		<h3 class="box-title"><?php echo (@$asesor['id']) ? 'Update Asesor' : 'Add New Asesor'; ?></h3>
	</div>
	<div class="box-body">
		<form method="post" id="mahasiwa-form" action="<?php echo url('setting/asesor', $param)?>" enctype="multipart/form-data">
			<input type="hidden" name="id" id="form-id" value="<?php echo @$asesor['id']?>" />
			<div class="form-group <?php echo (form_error('NIP') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-nip" class="control-label">NIP</label>
		      	<input type="text" name="NIP" class="form-control" id="form-nip" <?=(@$asesor['id'] !='' ? 'readonly' : '')?> placeholder="NIP" value="<?php echo @$asesor['NIP']?>">
			    <?php if (form_error('NIP') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('NIP')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('nm_asesor') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-nama" class="control-label">Nama</label>
		      	<input type="text" name="nm_asesor" class="form-control" id="form-nama" placeholder="Nama Asesor" value="<?php echo @$asesor['nm_asesor']?>">
			    <?php if (form_error('nm_asesor') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_asesor')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('no_met') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-nama" class="control-label">No. MET</label>
		      	<input type="text" name="no_met" class="form-control" id="form-no_met" placeholder="No MET" value="<?php echo @$asesor['no_met']?>">
			    <?php if (form_error('no_met') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('no_met')?></small>
			    <?php }?>
		    </div>
			<div class="form-group col-md-6 <?php echo (form_error('gelar_depan') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-gelar-depan" class="control-label">Gelar Depan</label>
		      	<input type="text" name="gelar_depan" class="form-control" id="form-nama" placeholder="Depan" value="<?php echo @$asesor['gelar_depan']?>">
		    </div>
			<div class="form-group col-md-6 <?php echo (form_error('gelar_belakang') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-gelar-belakang" class="control-label">Gelar Belakang</label>
		      	<input type="text" name="gelar_belakang" class="form-control" id="form-nama" placeholder="Belakang" value="<?php echo @$asesor['gelar_belakang']?>">
		    </div>
			<div class="form-group <?php echo (form_error('alamat_asesor') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-alamat" class="control-label">Alamat</label>
				<textarea name="alamat_asesor" id="form-alamat" class="form-control" placeholder="Alamat Asesor"><?=@$asesor['alamat_asesor']?></textarea>
			    <?php if (form_error('alamat_asesor') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('alamat_asesor')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('telp') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-telp" class="control-label">Telepon</label>
		      	<input type="text" name="telp" class="form-control" id="form-telp" placeholder="No Telepon" value="<?php echo @$asesor['telp']?>">
			    <?php if (form_error('telp') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('email') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-email" class="control-label">Email</label>
		      	<input type="text" name="email" class="form-control" id="form-email" placeholder="Email" value="<?php echo @$asesor['email']?>">
			    <?php if (form_error('email') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('email')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('tgl_lahir') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-ttl" class="control-label">Tanggal Lahir</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  <input type="text" name="tgl_lahir" value="<?php echo @$asesor['tgl_lahir']?>" class="form-control pull-right" id="datepicker" onkeydown="return false">
                </div>
			    <?php if (form_error('tgl_lahir') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tgl_lahir')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('tempat_lhr') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-ttl" class="control-label">Tempat Lahir</label>
		      	<input type="text" name="tempat_lhr" class="form-control" id="form-ttl" placeholder="Tempat Lahir" value="<?php echo @$asesor['tempat_lhr']?>">
			    <?php if (form_error('tempat_lhr') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tempat_lhr')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('jk_asesor') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-jk" class="control-label">Jenis Kelamin</label><br/>
		      	<input type="radio" id="jk_male" name="jk_asesor" value="laki-laki" <?=@$asesor['jk_asesor'] == 'laki-laki' || !isset($asesor['jk_asesor'])? 'checked' : '' ?> /> <label for="jk_male" class="control-label" style="margin-right:10px"> Laki-laki </label>
                <input type="radio" id="jk_vemale" name="jk_asesor" value="perempuan" <?=@$asesor['jk_asesor'] == 'perempuan' ? 'checked' : '' ?>  /> <label for="jk_vemale" class="control-label" style="margin-right:10px"> Perempuan </label>
			    <?php if (form_error('jk_asesor') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jk_asesor')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('agama') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-agama" class="control-label">Agama</label>
				<select name="agama" id="form-agama" class="form-control">
					<option value="islam" <?=@$asesor['agama'] == 'islam' || !isset($asesor['agama']) ? 'selected' : ''?>>Islam</option>
					<option value="kristen" <?=@$asesor['agama'] == 'kristen' ? 'selected' : ''?>>Kristen</option>
					<option value="katholik" <?=$asesor['agama'] == 'katholik' ? 'selected' : ''?>>Katholik</option>
					<option value="hindu" <?=$asesor['agama'] == 'hindu' ? 'selected' : ''?>>Hindu</option>
					<option value="budha" <?=$asesor['agama'] == 'budha' ? 'selected' : ''?>>Budha</option>
					<option value="konghucu" <?=$asesor['agama'] == 'konghucu' ? 'selected' : ''?>>Konghucu</option>
				</select>
			    <?php if (form_error('agama') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('agama')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('pend_terakhir') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-pendidikan" class="control-label">Pendidikan Terakhir</label>
				<select name="pend_terakhir" id="form-pendidikan" class="form-control">
					<option value="D1" <?=@$asesor['pend_terakhir'] == 'D1' || !isset($asesor['pend_terakhir']) ? 'selected' : ''?>>Diploma 1 (D1)</option>
					<option value="D3" <?=@$asesor['pend_terakhir'] == 'D3' ? 'selected' : ''?>>Diploma 3 (D3)</option>
					<option value="D4" <?=@$asesor['pend_terakhir'] == 'D4' ? 'selected' : ''?>>Diploma 4 (D4)</option>
					<option value="S1" <?=$asesor['pend_terakhir'] == 'S1' ? 'selected' : ''?>>Strata 1 (S1)</option>
					<option value="S2" <?=$asesor['pend_terakhir'] == 'S2' ? 'selected' : ''?>>Strata 2 (S2)</option>
					<option value="S3" <?=$asesor['pend_terakhir'] == 'S3' ? 'selected' : ''?>>Strata 3 (S3)</option>
				</select>
			    <?php if (form_error('pend_terakhir') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('pend_terakhir')?></small>
			    <?php }?>
		    </div>
			<div class="form-group">
		    	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo @$asesor['id'] ? 'Save Changes' : 'Save New Asesor'; ?></button>
		    	<a href="<?php echo url('setting/asesor', $param)?>" class="btn btn-default button-reset">Reset</a>
		    </div>
		</form>
	</div>
</div>
