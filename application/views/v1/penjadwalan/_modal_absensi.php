<form action="#" method="post" id="form-absensi">
	<input type="hidden" name="action" value="post-absensi" />
	<input type="hidden" name="id_jadwal" value="<?=$jadwal['id_jadwal']?>" />
	<div class="pilihan">
<?php 
	$no = 1;
	$_temp = [];
	if (count($jadwal['detail']))
		foreach ($jadwal['detail'] as $k=>$v)
			$_temp[$v['id_pendaftaran']] = $v['status_kehadiran'];
	
	if (is_array($jadwal['detail_daftar']) && count($jadwal['detail_daftar'])){
		foreach ($jadwal['detail_daftar'] as $k=>$v){
			echo '
				<div class="row">
					<div class="col-md-12">
						<div class="form-group" style="display:block">
							<label class="form-label control-label col-md-1">'. $no .'</label>
							<label class="form-label control-label col-md-6">'. ($v['tipe'] == 'mahasiswa' ? $v['mahasiswa']['nm_mahasiswa'] : $v['mitra']['nm_mitra']) .'</label>
							<div class="col-md-5">'
							.($jadwal['status'] == 0 ? '<label class="col-md-6 form-label"><input type="radio" name="absensi['.$v['id_pendaftaran'].']" checked value="hadir" class="form-control" />Hadir</label>
							<label class="col-md-6 form-label"><input type="radio" name="absensi['.$v['id_pendaftaran'].']" value="tidak hadir" class="form-control" />Tidak Hadir</label>' : '
							<label>'. ($_temp[$v['id_pendaftaran']] == 1 ? 'Hadir' : 'Tidak Hadir') .'</label>	
							').'
							</div>
						</div>
					</div>
				</div>
			';
			$no++;
		}
	}
?>
	</div>

<?php 
	if ($jadwal['status'] == 0) {
?>	
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-success simpanAbsensi pull-right" style="margin: 10px"><i class="fa fa-save"></i> Save</button
		</div>
	</div>
<?php 
	} else {
		echo '<div class="row">
				<div class="col-md-12">
					<a class="btn btn-success pull-right" href="'. url('absensi/'. $jadwal['id_jadwal']) .'" style="margin: 10px"><i class="fa fa-save"></i> Cetak Absensi</button
				</div>
			</div>';
	}
?>
</form>