<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="text-center" style="width:70px;">No</th>
				<th class="text-center">Kode Unit</th>
				<th class="text-center">Judul Kompetensi</th>
				<th class="text-center" style="width:100px;">Hasil Cek</th>
			</tr>
		</thead>
		<tbody>
		<?php
			// echoPre($rekap);
			$i= 1;
			$rekap_asesmen = json_decode($rekap['rekap_asesmen'], TRUE);
			// echoPre($rekap_asesmen);
			if (count(@$rekap['skema_detail']['detail']) && is_array(@$rekap['skema_detail']['detail']))
				foreach ($rekap['skema_detail']['detail'] as $k=>$v){
					echo '<tr>
						<td class="text-center">'. $i .'</td>
						<td>'. $v['kd_unit'] .'</td>
						<td>'. $v['jdl_kompetensi'] .'</td>
						<td class="text-center"><input type="checkbox" class="checkRekap" data-pendaftar="'. $rekap['id_pendaftaran'] .'" data-id="'. $v['id_dt_skema'] .'" value="1" '. (isset($rekap_asesmen[$v['id_dt_skema']]) && @$rekap_asesmen[$v['id_dt_skema']] == 1 ? 'checked' : NULL) .'></td>
					</tr>';
					$i++;
				}
			else 
				echo '<tr>
					<td colspan="4">no data found</td>
				</tr>';
		?>
		</tbody>
	</table>
</div>