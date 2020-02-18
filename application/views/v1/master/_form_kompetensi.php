<div class="row">
	<div class="col-md-12">
		<form id="form-kompetensi">
			<input type="hidden" name="id_dtl_skema" value="<?=$id?>" />
			<input type="hidden" name="parent" value="<?=@$kompetensi['parent']?>" />
			<input type="hidden" name="action" value="post-kompetensi">
			<input type="hidden" name="id_post" value="<?=@$kompetensi['id']?>" />
			<input type="hidden" name="tipe" value="<?=!isset($kompetensi['tipe']) || @$kompetensi['tipe'] == 'kompetensi' ? 'kompetensi' : 'detail_kompetensi' ?>">
			<?php 
				if (!isset($kompetensi['tipe']) || @$kompetensi['tipe'] == 'kompetensi' ) {
			?>
			<div class="form-group <?php echo (form_error('nm_kompetensi') != '') ? 'has-error' : '' ; ?>">
				<label for="form-nm_kompetensi" class="control-label">Nama Kompetensi</label>
				<input type="text" name="nm_kompetensi" class="form-control" id="form-nm_kompetensi" placeholder="Nama" value="<?php echo @$kompetensi['nm_kompetensi']?>"></textarea>
				<?php if (form_error('nm_kompetensi') != '') {?>
					<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('nm_kompetensi')?></small>
				<?php }?>
			</div>
			<div class="form-group <?php echo (form_error('keterangan') != '') ? 'has-error' : '' ; ?>">
				<label for="form-keterangan" class="control-label">keterangan</label>
				<textarea name="keterangan" class="form-control" id="form-keterangan" placeholder="Keterangan" value=""><?php echo @$kompetensi['keterangan']?></textarea>
				<?php if (form_error('keterangan') != '') {?>
					<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('keterangan')?></small>
				<?php }?>
			</div>
			<?php } else { ?>
			<div class="form-group <?php echo (form_error('asesmen_mandiri') != '') ? 'has-error' : '' ; ?>">
				<label for="form-asesmen_mandiri" class="control-label">Asesmen Mandiri</label>
				<textarea name="asesmen_mandiri" class="form-control" id="form-asesmen_mandiri" placeholder="Asesmen Mandiri" value=""><?php echo @$kompetensi['asesmen_mandiri']?></textarea>
				<?php if (form_error('asesmen_mandiri') != '') {?>
					<small class="help-block"><i class="fa fa-times-circle-o"></i> <?php echo form_error('asesmen_mandiri')?></small>
				<?php }?>
			</div>
			<?php } ?>
			<div class="form-group">
				<button class="btn btn-sm btn-success" id="save-kompetensi"><i class="fa fa-save"></i> Save</button>
				<button class="btn btn-sm btn-default reset-kompetensi" data-id="<?=$id?>">Reset</button>
			</div>
		</form>
	</div>
</div>