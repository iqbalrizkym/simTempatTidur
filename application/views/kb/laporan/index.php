<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('kb/form_laporan'); ?>">Periode</a></li>
		<li class="active">Riwayat</li>
	</ol>
</div>
<div class="xs">
	<div class="bebas">
		<div class="row">
			<div class="col-md-6">
				<h3>Riwayat PRI</h3>
			</div>
			<div class="col-md-6">
				<!-- <a href="<?php echo site_url('kelas/add'); ?>" style="float:right;"><button class="btn lg btn-default"><span class='fa fa-print' aria-hidden='true'></span> </button></a> -->
			</div>  		
		</div>
	</div> 
	<div class="bs-example4" data-example-id="simple-responsive-table">
		<div class="table-responsive">
			<table id="example" class="table table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th data-sortable="true" width="6%">No</th>
						<th data-sortable="true" width="8%">Kode RM</th>
						<th data-sortable="true" width="8%">Nama</th>
						<th data-sortable="true" width="7%">Umur</th>
						<th data-sortable="true" width="8%">Tanggung Jawab</th>
						<th data-sortable="true" width="15%">Alamat</th>
						<th data-sortable="true" width="6%">TT</th>
						<th data-sortable="true" width="9%">Tgl Masuk</th>
						<th data-sortable="true" width="11%">Diagnosa Awal</th>
						<th data-sortable="true" width="9%">Tgl Keluar</th>
						<th data-sortable="true" width="11%">Diagnosa akhir</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; 
					$x=0;
					?>
					<tr>
						<?php foreach ($gunatt as $item) { ?>
							<th><?php echo $no; ?></th>
							<td><?php echo $item['kd_gn']; ?></td>
							<td><?php echo $item['nm_psn']; ?></td>
							<?php 
							$date1=date_create($item['tgl_lahir']);
							$date2=date_create('today');
							$diff=date_diff($date1,$date2);
							?>
							<td><?php echo $diff->format("%y Thn"); ?></td>
							<td><?php echo $item['tgjwb_gn']; ?></td>
							<td><?php echo $item['alm_psn']; ?></td>
							<td><?php echo $item['nm_tt']; ?></td>
							<td><?php echo $item['tgl_msk']; ?></td>
							<td><?php echo $item['nm_pyk']; ?></td>
							<td><?php echo $item['tgl_klr']; ?></td>
							<td>
								<?php 
								// foreach ($total_seluruh_diagnosa as $tsd) {
								// 	var_dump($tsd[4]);
								$y=$x+4;
								$nomor=1;
								for($z=$x; $z<$y; $z++){
									echo $nomor.". ".$total_diagnosa[$z]."</br>";
									$x++;
									$nomor++;
								}
								// }
								// exit(0);
								?>
							</td>
						</tr>

						<?php $no++ ; } ?>
					</tbody>	
				</table>
			</div>
		</div>
	</div>