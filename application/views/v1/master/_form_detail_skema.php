<div class="box box-success">
	<div class="box-header col-xs-12">
		<h3 class="box-title"><?php echo (@$detail['id']) ? 'Update Detail Skema' : 'Add New Detail Skema'; ?></h3>
	</div>
	<div class="box-body">
		<form method="post" id="mahasiwa-form" action="<?php echo url('setting/skema', $param)?>" enctype="multipart/form-data">
			<input type="hidden" name="id" id="form-id" value="<?php echo @$detail['id']?>" />
			<input type="hidden" name="type" id="form-detail" value="detail" />
			<div class="form-group <?php echo (form_error('kd_unit') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-kd_unit" class="control-label">Kode Unit</label>
		      	<input type="text" name="kd_unit" class="form-control" id="form-kd_unit" placeholder="Kode Unit" value="<?php echo @$detail['kd_unit']?>">
			    <?php if (form_error('kd_unit') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('kd_unit')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('jdl_kompetensi') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-jdl_kompetensi" class="control-label">Judul Kompetensi</label>
		      	<textarea name="jdl_kompetensi" class="form-control" id="form-jdl_kompetensi" placeholder="Judul Kompetensi"><?php echo @$detail['jdl_kompetensi']?></textarea>
			    <?php if (form_error('jdl_kompetensi') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jdl_kompetensi')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('order') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-order" class="control-label">Order</label>
		      	<input type="number" name="order" class="form-control" id="form-order" placeholder="Order" value="<?php echo @$detail['order']?>">
			    <?php if (form_error('order') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('order')?></small>
			    <?php }?>
		    </div>
			<div class="form-group <?php echo (form_error('id_skema') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-id_skema" class="control-label">Skema</label>
				<select name="id_skema" id="form-id_skema" class="form-control">
					<?php 
						$id_skema = get('parent') ? get('parent') : @$detail['id_skema']; 
						if (is_array($skema_option) && count($skema_option))
							foreach ($skema_option as $k=>$v)
								echo '<option value="'.$v['id_skema'].'" '.($v['id_skema'] == $id_skema ? 'selected' : '').'>'.$v['nm_skema'].'</option>';
					?>
				</select>
			    <?php if (form_error('id_skema') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('jdl_kompetensi')?></small>
			    <?php }?>
		    </div>
			<div class="form-group">
		    	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo @$detail['id'] ? 'Save Changes' : 'Save New Detail Skema'; ?></button>
		    	<a href="<?php echo url('setting/skema', $param)?>" class="btn btn-default button-reset">Reset</a>
		    </div>
		</form>
	</div>
</div>
