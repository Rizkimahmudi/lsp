<div class="box box-success">
	<div class="box-header col-xs-12">
		<h3 class="box-title">Tambah Pembayaran</h3>
	</div>
	<div class="box-body">
		<form method="post" id="pembayaran-form" action="<?php echo url('pembayaran', $param)?>" enctype="multipart/form-data">
			<div class="form-group">
		      	<label for="form-search-pendaftaran" class="control-label">Pendaftaran</label>
		      	<input type="text" name="pendaftaran" class="form-control" id="form-search-pendaftaran" placeholder="Cari Pendaftaran" value="">
		    </div>
			
			<div class="form-pembayaran-action" style="display:none">
			
			</div>
		</form>
	</div>
</div>
