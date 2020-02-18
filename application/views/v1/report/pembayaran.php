<!-- Main content -->
<section class="content">
    <?=html_entity_decode($flash_message)?>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<form method="post" action="<?=url('report/pembayaran/search')?>" class="form-horizontal">
					<input type="hidden" name="route" value="pembayaran">
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
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="tipe" class="col-sm-3 control-label">Nama</label>
							<div class="col-sm-9">
								<input type="text" name="nama" class="form-control input-sm" value="<?=@$search['nama']?>">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="jenis" class="col-sm-3 control-label">Jenis Daftar</label>
							<div class="col-sm-9">
								<select class="form-control input-sm" name="jenis_daftar">
									<option>All</option>
									<?php 
										if (isset($option_jenis))
											foreach ($option_jenis as $k=>$v)
												echo '<option value="'.$v['id_jns_daftar'].'" '.(@$search['jenis_daftar'] == $v['id_jns_daftar'] ? 'selected' : '').'>'.$v['nm_jns_daftar'].'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="pull-right text-center">
							<button type="submit" class="btn btn-primary btn-flat btn-sm" type="button"><i class="fa fa-search"></i> Search</button>
							<a href="<?=url().'report/pembayaran/'?>" class="btn btn-default btn-sm"><i class="fa fa-list-alt"></i> Show All</a>
							<a href="<?=url('report/pembayaran/', array_merge($param, ['export' => 1]))?>" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Export</a>
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
									<th class="text-center" style="width:130px;">ID Pembayaran</th>
									<th>Pendaftar</th>
									<th style="width:150px;">Tgl Bayar</th>
									<th style="width:150px;">Jenis</th>
									<th style="width:150px; text-align:right">Jumlah</th>
								</tr>
							</thead>
                            <tbody>
							<?php 
							$subtotal = 0;
							if (is_array($pembayaran) && count($pembayaran)) {
								foreach ($pembayaran as $k=>$v){
									echo '<tr class="odd ">
											<td class="text-center">'. $v['number'] .'</td>
											<td class="text-center">'. $v['id_pembayaran'] .'</td>
											<td><strong>'. ($v['pendaftar']['tipe'] == 'mahasiswa' ? $v['pendaftar']['mahasiswa']['nm_mahasiswa']: $v['pendaftar']['mitra']['nm_mitra']) .'</strong><br/><small><strong>kode:</strong> '. $v['pendaftar']['id_pendaftaran'] .'</small></td>
											<td>'. date('j F Y', strtotime($v['tgl_bayar'])) .'</td>
											<td>'. $v['nm_jns_daftar'] .'</td>
											<td style="text-align:right">'. $v['jumlah_format'] .'<td>
										</tr>';
									$subtotal += $v['jumlah'];
								}
							} else {
								echo '<tr><td colspan="6">no data found !</td></tr>';
								
							}
							?>
							</tbody>
							<tfoot>
								<?php if ($total > $limit) {?>
								<tr>
									<th colspan="5" style="text-align: right">Subtotal</th>
									<th style="text-align: right">Rp <?=number_format($subtotal,0,",",".")?></th>
								</tr>
								<?php } ?>
								<tr>
									<th colspan="5" style="text-align: right">Grand Total</th>
									<th style="text-align: right">Rp <?=number_format($grand_total,0,",",".")?></th>
								</tr>
							</tfoot>
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