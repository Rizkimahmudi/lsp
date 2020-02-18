<div class="box box-success">
	<div class="box-header col-xs-12">
		<h3 class="box-title"><?php echo (@$mahasiswa['id']) ? 'Update Mahasiswa' : 'Add New Mahasiswa'; ?></h3>
	</div>
	<div class="box-body">
		<form method="post" id="mahasiwa-form" action="<?php echo url('setting/mahasiswa', $param)?>" enctype="multipart/form-data">
			<input type="hidden" name="id" id="form-id" value="<?php echo @$mahasiswa['id']?>" />
			<div class="form-group <?php echo (form_error('NRP') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-nrp" class="control-label">NRP</label>
		      	<input type="text" name="NRP" class="form-control" id="form-nrp" <?=(@$mahasiswa['id'] !='' ? 'readonly' : '')?> placeholder="NRP" value="<?php echo @$mahasiswa['NRP']?>">
			    <?php if (form_error('NRP') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('NRP')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('nm_mahasiswa') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-name" class="control-label">Nama</label>
		      	<input type="text" name="nm_mahasiswa" class="form-control" id="form-name" placeholder="Name" value="<?php echo @$mahasiswa['nm_mahasiswa']?>">
			    <?php if (form_error('nm_mahasiswa') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_mahasiswa')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('alamat_mhs') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-alamat" class="control-label">Alamat</label>
				<textarea name="alamat_mhs" id="form-alamat" class="form-control" placeholder="Alamat Mahasiswa"><?=@$mahasiswa['alamat_mhs']?></textarea>
			    <?php if (form_error('alamat_mhs') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('alamat_mhs')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('kodepos') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-kodepos" class="control-label">Kode Pos</label>
		      	<input type="text" name="kodepos" class="form-control" id="form-kodepos" placeholder="Kode Pos" value="<?php echo @$mahasiswa['kodepos']?>">
			    <?php if (form_error('kodepos') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kodepos')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('tempat_lahir') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-ttl" class="control-label">Tempat Lahir</label>
		      	<input type="text" name="tempat_lahir" class="form-control" id="form-ttl" placeholder="Tempat Lahir" value="<?php echo @$mahasiswa['tempat_lahir']?>">
			    <?php if (form_error('tempat_lahir') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tempat_lahir')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('tgl_lahir') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-ttl" class="control-label">Tanggal Lahir</label>
				<div class="input-group date">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				  <input type="text" name="tgl_lahir" value="<?php echo @$mahasiswa['tgl_lahir']?>" class="form-control pull-right" id="datepicker" onkeydown="return false">
                </div>
			    <?php if (form_error('tgl_lahir') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('tgl_lahir')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('jk_mhs') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-jk" class="control-label">Jenis Kelamin</label><br/>
		      	<input type="radio" id="jk_male" name="jk_mhs" value="laki-laki" <?=@$mahasiswa['jk_mhs'] == 'laki-laki' || !isset($mahasiswa['jk_mhs'])? 'checked' : '' ?> /> <label for="jk_male" class="control-label" style="margin-right:10px"> Laki-laki </label>
                <input type="radio" id="jk_vemale" name="jk_mhs" value="perempuan" <?=@$mahasiswa['jk_mhs'] == 'perempuan' ? 'checked' : '' ?> /> <label for="jk_vemale" class="control-label" style="margin-right:10px"> Perempuan </label>
			    <?php if (form_error('jk_mhs') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jk_mhs')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('agama') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-agama" class="control-label">Agama</label>
				<select name="agama" id="form-agama" class="form-control">
					<option value="islam" <?=@$mahasiswa['agama'] == 'islam' || !isset($mahasiswa['agama']) ? 'selected' : ''?>>Islam</option>
					<option value="kristen" <?=@$mahasiswa['agama'] == 'kristen' ? 'selected' : ''?>>Kristen</option>
					<option value="katholik" <?=$mahasiswa['agama'] == 'katholik' ? 'selected' : ''?>>Katholik</option>
					<option value="hindu" <?=$mahasiswa['agama'] == 'hindu' ? 'selected' : ''?>>Hindu</option>
					<option value="budha" <?=$mahasiswa['agama'] == 'budha' ? 'selected' : ''?>>Budha</option>
					<option value="konghucu" <?=$mahasiswa['agama'] == 'konghucu' ? 'selected' : ''?>>Konghucu</option>
				</select>
			    <?php if (form_error('agama') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('agama')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('telp_hp') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-hp" class="control-label">No Handphone</label>
		      	<input type="text" name="telp_hp" class="form-control" id="form-hp" placeholder="No Handphone" value="<?php echo @$mahasiswa['telp_hp']?>">
			    <?php if (form_error('telp_hp') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_hp')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('email') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-email" class="control-label">Email</label>
		      	<input type="text" name="email" class="form-control" id="form-email" placeholder="Email" value="<?php echo @$mahasiswa['email']?>">
			    <?php if (form_error('email') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('email')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('telp_rumah') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-telp_rumah" class="control-label">Telp Rumah</label>
		      	<input type="text" name="telp_rumah" class="form-control" id="form-telp_rumah" placeholder="Telp Rumah" value="<?php echo @$mahasiswa['telp_rumah']?>">
			    <?php if (form_error('telp_rumah') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('telp_rumah')?></small>
			    <?php }?>
		    </div>
			<div class="form-group">
		      	<label for="form-password" class="control-label">Password</label>
		      	<input type="password" name="password" class="form-control" id="form-password" placeholder="Password" value="">
			    <small class="help-block"><i class="fa fa-times-circle-o"></i> Hanya diisi jika ingin mengganti password</small>
			    
		    </div>
			<!-- <div class="form-group <?php echo (form_error('kantor') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-kantor" class="control-label">Telp Kantor</label>
		      	<input type="text" name="kantor" class="form-control" id="form-kantor" placeholder="Telp Kantor" value="<?php echo @$mahasiswa['kantor']?>">
			    <?php if (form_error('kantor') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kantor')?></small>
			    <?php }?>
		    </div> -->
			<div class="form-group">
		    	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo @$mahasiswa['id'] ? 'Save Changes' : 'Save New Mahasiswa'; ?></button>
		    	<a href="<?php echo url('setting/mahasiswa', $param)?>" class="btn btn-default button-reset">Reset</a>
		    </div>
		</form>
	</div>
</div>
