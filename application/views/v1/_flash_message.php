<?php 
if ($this->session->flashdata('text')){
?>
<div class="row">
	<div class="col-md-12">
		<?php if ($this->session->flashdata('status') == 'error') {?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Error!</h4>
			<?php echo $this->session->flashdata('text')?>
		</div>
		<?php }else{?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Success!</h4>
			<?php echo $this->session->flashdata('text')?>
		</div>
		<?php }?>
	</div>
</div>
<?php }?>