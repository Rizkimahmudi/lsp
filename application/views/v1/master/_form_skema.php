<div class="box box-success">
	<div class="box-header col-xs-12">
		<h3 class="box-title"><?php echo (@$skema['id']) ? 'Update Skema' : 'Add New Skema'; ?></h3>
	</div>
	<div class="box-body">
		<form method="post" id="skema-form" action="<?php echo url('setting/skema', $param)?>" enctype="multipart/form-data">
			<input type="hidden" name="id" id="form-id" value="<?php echo @$skema['id']?>" />
			<div class="form-group <?php echo (form_error('nm_skema') != '') ? 'has-error' : '' ; ?>">
		      	<label for="form-nm_skema" class="control-label">Nama</label>
		      	<textarea name="nm_skema" class="form-control" id="form-nm_skema" placeholder="Nama" value=""><?php echo @$skema['nm_skema']?></textarea>
			    <?php if (form_error('nm_skema') != '') {?>
			    	<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_skema')?></small>
			    <?php }?>
		    </div>
			<div class="form-group">
		    	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo @$skema['id'] ? 'Save Changes' : 'Save New Skema'; ?></button>
		    	<a href="<?php echo url('setting/skema', $param)?>" class="btn btn-default button-reset">Reset</a>
		    </div>
		</form>
	</div>
</div>
