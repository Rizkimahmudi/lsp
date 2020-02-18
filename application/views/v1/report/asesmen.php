<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<form method="post" action="<?=url('report/asesmen/search')?>" class="form-horizontal">
					<input type="hidden" name="route" value="asesmen">
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="id_jadwal" class="col-sm-3 control-label" style="margin-top: -15px">ID Jadwal</label>
							<div class="col-sm-9">
								<input type="text" name="id_jadwal" id="id_jadwal" class="form-control input-sm" value="<?=@$search['id_jadwal']?>">
							</div>
						</div>					
						<div class="form-group">
							<label for="tuk" class="col-sm-3 control-label">TUK</label>
							<div class="col-sm-9">
								<input type="text" name="tuk" id="tuk" class="form-control input-sm" value="<?=@$search['tuk']?>">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label class="form-label col-sm-3 control-label">Date </label>
							<div class="col-sm-9">
								<div class="input-daterange">
									<div class="input-group">
										<input type="text" name="start" class="form-control input-sm datepicker" value="<?=isset($search['start']) ? $search['start'] : ''?>">
										<span class="input-group-addon" style="background-color: #DCDCDC">to</span>
										<input type="text" name="end" class="form-control input-sm datepicker" value="<?=isset($search['end']) ? $search['end'] : ''?>">
									</div>
								</div>
							</div>
						</div>		
						<div class="form-group">
							<label for="asesor" class="col-sm-3 control-label">Asesor</label>
							<div class="col-sm-9">
								<input type="text" name="asesor" id="asesor" class="form-control input-sm" value="<?=@$search['asesor']?>">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="jenis" class="col-sm-3 control-label">Skema</label>
							<div class="col-sm-9">
								<select class="form-control input-sm" name="skema">
									<option>All</option>
									<?php 
										if (isset($option_skema))
											foreach ($option_skema as $k=>$v)
												echo '<option value="'.$v['id_skema'].'" '.(@$search['skema'] == $v['id_skema'] ? 'selected' : '').'>'.$v['nm_skema'].'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="pull-right text-center">
							<button type="submit" class="btn btn-primary btn-flat btn-sm" type="button"><i class="fa fa-search"></i> Search</button>
							<a href="<?=url().'report/asesmen/'?>" class="btn btn-default btn-sm"><i class="fa fa-list-alt"></i> Show All</a>
							<a href="<?=url('report/asesmen/', array_merge($param, ['export' => 1]))?>" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Export</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="box box-primary">
				<div class="box-body no-padding">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="text-center" style="width:30px;">No</th>
									<th class="text-center" style="width:350px;">Nama</th>
									<th class="text-center">Kode Unit</th>
								</tr>
							</thead>
                            <tbody>
							<?php 
							if (is_array($asesmen) && count($asesmen)) {
								foreach ($asesmen as $k=>$v){
									echo '<tr class="odd ">
											<td class="info" colspan="3"><strong>Skema: '. $v['detail_skema']['nm_skema'] .' | Asesor: '. $v['asesor']['gelar_depan'].' '. $v['asesor']['nm_asesor'] . ($v['asesor']['gelar_belakang'] != '' ? ', '. $v['asesor']['gelar_belakang']:'') .' | TUK: '. $v['tuk']['nm_tuk'] .' | Tgl Sertifikasi: '. date('j F Y', strtotime($v['tgl_sertifikasi'])).' '.date('H:i', strtotime($v['jam_sertifikasi'])) .'</strong></td>
										</tr>';
									
									$i = 1;
									foreach ($v['detail_daftar'] as $kk=>$vv){
										echo '
											<tr>
												<td class="text-center">'. $i .'</td>
												<td>'. ($vv['tipe'] == 'mahasiswa' ? $vv['mahasiswa']['nm_mahasiswa'] : $vv['mitra']['nm_mitra']) .'</td>
												<td>';
										
										$_rekap_asesmen = $vv['rekap_asesmen'] != '' ? objToArr(json_decode($vv['rekap_asesmen'])) : [];
										foreach ($v['detail_skema']['detail'] as $kDetail=>$vDetail){
											$kompeten = !isset($_rekap_asesmen[$vDetail['id_dt_skema']]) || @$_rekap_asesmen[$vDetail['id_dt_skema']] == 0 ? false : true;
											echo '<label class="label '. ($kompeten ? 'label-success' : 'label-danger') .'">'. ($kompeten ? 'Kompeten' : 'Belum kompeten') .'</label> ';
											echo '<strong>['. $vDetail['kd_unit'] .']</strong> '.$vDetail['jdl_kompetensi'];
											echo ' <br/>';
										}
										
										echo '</td>
											</tr>
										';
										$i++;
									}
								}
							} else {
								echo '<tr><td colspan="3">no data found !</td></tr>';
								
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom:20px;">
				<div class="pull-left">
					Showing <strong><?php echo $total == 0 ? '0' : $offset + 1; ?></strong> - <strong><?php echo $offset+$limit > $total ? $total : $offset+$limit ;?></strong> of <strong><?php echo $total?></strong> data
				</div>
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
</section>