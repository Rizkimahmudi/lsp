<div class="table-responsive">
	<input type="hidden" name="id_jadwal" value="<?=@$rekap['id_jadwal']?>" />
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="text-center" style="width:70px;">No</th>
				<th class="">Nama</th>
				<th class="text-center" style="width:100px;">Hasil Cek</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$i=1;
			if (is_array(@$rekap['detail_daftar']) && count(@$rekap['detail_daftar']) && isset($rekap['detail_daftar']))
				foreach ($rekap['detail_daftar'] as $k=>$v){
					echo '
						<tr>
							<td class="text-center">'.$i.'</td>
							<td><strong>'.($v['tipe'] == 'mahasiswa' ? strtoupper($v['mahasiswa']['nm_mahasiswa']) : strtoupper($v['mitra']['nm_mitra'])).'</strong><br/><label class="label label-default">'. $v['tipe'] .'</label></td>
							<td class="text-center"><a href="#" class="rekapAsesmen btn btn-sm btn-success" data-id="'. $v['id_pendaftaran'] .'"><i class="fa fa-server"></i></a></td>
						</tr>
					';					
					$i++;
				}
			else 
				echo '<tr><td colspan="3">No records found !</td></tr>';
		?>					
		</tbody>
	</table>
</div>