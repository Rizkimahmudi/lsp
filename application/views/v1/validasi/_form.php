 <!-- Default box -->
<section class="content">
  <div class="box">
	<div class="box-header with-border">
		&nbsp;
	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip">
		  <i class="fa fa-minus"></i></button>
	  </div>
	</div> 
	<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
		<input type="hidden" name="id_pendaftaran" value="<?=$pendaftar['id_pendaftaran']?>" />
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="form-name" class="control-label col-md-3">Nama</label>
						<div class="col-md-8" style="margin-top: 5px">
							<?=$pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['nm_mahasiswa'] : $pendaftar['mitra']['nm_mitra']?>
						</div>
					</div>
					<div class="form-group">
						<label for="form-name" class="control-label col-md-3">Alamat</label>
						<div class="col-md-8" style="margin-top: 5px">
							<?=$pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['alamat_mhs'] : $pendaftar['mitra']['alamat_mitra']?>
						</div>
					</div>
					<div class="form-group">
						<label for="form-name" class="control-label col-md-3">No Telp</label>
						<div class="col-md-8" style="margin-top: 5px">
							<?=$pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['telp_hp'] : $pendaftar['mitra']['telp_hp']?>
						</div>
					</div>
					<div class="form-group">
						<label for="form-name" class="control-label col-md-3">Email</label>
						<div class="col-md-8" style="margin-top: 5px">
							<?=$pendaftar['tipe'] == 'mahasiswa' ? $pendaftar['mahasiswa']['email'] : $pendaftar['mitra']['email']?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7 col-md-offset-2">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center" style="width:70px;">No</th>
									<th class="text-center">Kode Unit</th>
									<th class="text-center" style="width:400px;">Judul Unit</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i=1;
									if (is_array(@$pendaftar['skema_detail']['detail']) && count(@$pendaftar['skema_detail']['detail']))
										foreach ($pendaftar['skema_detail']['detail'] as $k=>$v){
											echo '
												<tr>
													<td>'.$i.'</td>
													<td>'.$v['kd_unit'].'</td>
													<td>'.$v['jdl_kompetensi'].'</td>
												</tr>
											';
											$i++;
										}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="form-name" class="control-label col-md-3"><u>Masa Berlaku</u></label>
					</div>
					<div class="form-group">
						<label for="form-name" class="control-label col-md-3">Berlaku dari</label>
						<div class="col-md-2" style="margin-top: 5px">
							<div class="input-group date">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
							  <input type="text" name="tgl_mulai_sertifikat" value="<?php echo @$pendaftar['sertifikat']['tgl_mulai_sertifikat']?>" class="form-control pull-right datepicker" onkeydown="return false">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="form-name" class="control-label col-md-3">Berlaku Sampai</label>
						<div class="col-md-2" style="margin-top: 5px">
							<div class="input-group date">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
							  <input type="text" name="tgl_selesai_sertifikat" value="<?php echo @$pendaftar['sertifikat']['tgl_selesai_sertifikat']?>" class="form-control pull-right datepicker" onkeydown="return false">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="form-name" class="control-label col-md-3">Berlaku Sampai</label>
						<div class="col-md-2" style="margin-top: 5px">
							<select name="validasi" class="form-control">
								<option value="1" <?=@$pendaftar['sertifikat']['status_sertifikat'] == 1 || !isset($pendaftar['sertifikat']['status_sertifikat']) ? 'selected' : ''?>>OK</option>
								<option value="0" <?=@$pendaftar['sertifikat']['status_sertifikat'] == 0 ?  : ''?>>Belum</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-5 col-md-offset-2">
					<button class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
		</div>
	</form>
</div>
</section>