<div class="row">
	<div class="col-md-12">
		<div class="form-group" style="display:block">
			<label class="form-label control-label col-md-3">Skema</label>
			<div class="col-md-9">
				<?=$jadwal['skema']['nm_skema']?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group" style="display:block">
			<label class="form-label control-label col-md-3">Tanggal</label>
			<div class="col-md-9">
				<?=date('d F Y', strtotime($jadwal['tgl_sertifikasi']))?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group" style="display:block">
			<label class="form-label control-label col-md-3">Jam</label>
			<div class="col-md-9">
				<?=date('H:i', strtotime($jadwal['jam_sertifikasi']))?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group" style="display:block">
			<label class="form-label control-label col-md-3">TUK</label>
			<div class="col-md-9">
				<?=$jadwal['tuk']['nm_tuk']?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group" style="display:block">
			<label class="form-label control-label col-md-3">Asesor</label>
			<div class="col-md-9">
				<?=$jadwal['asesor']['nm_asesor']?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group" style="display:block">
			<label class="form-label control-label col-md-3">Jumlah peserta</label>
			<div class="col-md-9">
				<?=count($jadwal['detail_daftar'])?> Peserta
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover" style="width: 100%">
			<thead>
				<tr>
					<th class="text-center" style="width:70px;">No</th>
					<th>Nama</th>
					<?=$jadwal['status'] == 0 ? '<th style="width:50px"></th>' : ''?>
				</tr>
			</thead>
			<tbody>
			<?php 
				$i=1;
				if (count($jadwal['detail_daftar']))
					foreach ($jadwal['detail_daftar'] as $k=>$v){
						echo '
							<tr>
								<td class="text-center">'.$i.'</td>
								<td>'.($v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra']).'</td>
								'. ($jadwal['status'] == 0 ? '<td>'. ($v['status'] < 3 ? '<button class="btn btn-sm btn-danger hapusFromJadwal" data-id="'. $v['id_pendaftaran'] .'" data-jadwal="'. $jadwal['id_jadwal'] .'"><i class="fa fa-trash"></i></button>' : '') .'</td>' : ''). '
							</tr>
						';
						$i++;
					}
				else 
					echo '<tr><td colspan="2">No records found !</td></tr>';
			?>					
			</tbody>
		</table>
	</div>
</div>

<?php 
	if ($jadwal['status'] == 0 ){
?>
<div class="row" style="margin-top:15px">
	<div class="col-md-12">
		<input type="hidden" name="id_jadwal" value="<?=$jadwal['id_jadwal']?>">
		<div class="form-group" style="display:block">
			<label class="form-label control-label col-md-3">Tambah Peserta</label>
			<div class="col-md-6">
				<input type="text" name="tambah_pendaftar" class="form-control" data-skema="<?=$jadwal['id_skema']?>" />
			</div>
			<div class="col-md-3">	
				<button class="btn btn-sm btn-success btnAddPendaftar"><i class="fa fa-plus"></i> Add</button>
			</div>
		</div>
	</div>
</div>
<?php 
	}
?>
