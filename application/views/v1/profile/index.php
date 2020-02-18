<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-user"></i> Profile</h3>
		</div> 
		<div class="box-body">
			<div class="row">
				<div class="col-md-3 col-md-offset-1 col-xs-12">
					<div class="box-body box-profile">
					  <img class="profile-user-img img-responsive img-circle" style="width:100%; height:auto" src="http://placehold.it/400?text=photo" alt="User profile picture">
					  <h3 class="profile-username text-center"><?=$this->login['nm_admin']?></h3>
					  <h3 class="profile-username text-center"><?=$id?></h3>
					  <p class="text-muted text-center"><?=ucfirst($tipe)?></p>
					</div>
				</div>
				<div class="col-md-7 col-xs-12">
					<?=$form?>
				</div>
			</div>
		</div>
	</div>
	
	<h4>List skema yang diikuti</h4>
	
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="box box-primary">
				<div class="box-body no-padding">
					<div class="table-responsive">
						<?php echo $table; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>