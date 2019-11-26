<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Laporan</a></li>
		<li><a href="<?php echo site_url('pimpinan/periode_tmp_tdr'); ?>">Periode</a></li>
		<li class="active">Pemakaian</li>
	</ol>
</div>
<div class="xs">
	<div class="bebas">
		<div class="row">
			<div class="col-md-6">
				<h3>Pemakaian Tempat Tidur</h3>
			</div>
			<div class="col-md-6">
				<!-- <a href="<?php echo site_url('kelas/add'); ?>" style="float:right;"><button class="btn lg btn-default"><span class='fa fa-print' aria-hidden='true'></span> </button></a> -->
			</div>  		
		</div>
	</div>
	<div class="bs-example4">
		<div class="graph_box1">
			<div class="grid_1">
				<center><canvas id="myChart" width="4px" height="1" style=" width: 4px; height: 1px;"></canvas></center>
			</div>
			<div class="clearfix"> </div>
		</div>
		<?php
			$output = array();
					usort($digunakan,function($a,$b){
						return strnatcmp($a['kd_bgs'],$b['kd_bgs']);
					});
					$array3 = array_replace_recursive($kosong, $digunakan);

					$result = array_uintersect($array3,$kosong,function($a,$b){
						return strnatcmp($a['kd_bgs'],$b['kd_bgs']);
					});
					// print_r($result);
					// exit(0);
						$length = count($digunakan);
						$p=0;
						foreach ($result as $key) {						
							if ($p < $length ){
								$output[] = array("kd_bgs" => $key,"nm_bgs" => $key['nm_bgs'],"tmp_tdr1"=>$key['tmp_tdr1'],"tmp_tdr2"=>$key['tmp_tdr2']);
							 } else {
							 	$output[] = array("kd_bgs" => $key,"nm_bgs" => $key['nm_bgs'],"tmp_tdr1"=>$key['tmp_tdr1'],"tmp_tdr2"=>"0");

							}
						$p++;
						} 					
					// print_r($output);
					// exit(0);
		?>
		<script>
			var ctx = document.getElementById("myChart");
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels:[<?php foreach ($output as $item) { ?> 
						"<?php echo $item['nm_bgs']; ?>",
					<?php } ?>
					],
					datasets: [{
						label: 'Dipakai',
						data: [	<?php foreach ($output as $item) { ?> 
							<?php echo $item['tmp_tdr2']; ?>, 
						<?php } ?>
						],
						backgroundColor: 'rgba(255,0,0,0.7)',
						borderColor: 'rgba(255,0,0,0.7)',
						borderWidth: 1
					},
					{
						label: 'Kosong',
						data: [	<?php foreach ($output as $item) { ?> 
							<?php $a = $item['tmp_tdr1'] - $item['tmp_tdr2']; ?>
							<?php echo $a; ?>,  
							<?php } ?>],
							backgroundColor: '#fdfdfd',
							borderColor: 'rgba(22,22,245,0.7)',
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						},
						legend: {
							display: true,
							position: 'right',
						}
					}
				});
			</script>
		</div>
	</div>
</br>
<div class="xs">
	<div class="bs-example4" data-example-id="simple-responsive-table">
		<div class="table-responsive">
			<table id="example" class="table table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th data-sortable="true" width="6%">No</th>
						<th data-sortable="true" width="54%">Nama Bangsal</th>
						<th data-sortable="true" width="20%">Digunakan</th>
						<th data-sortable="true" width="20%">Kosong</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						foreach ($output as $key ) {
					?> 
					<tr>
						<th><?php echo $no; ?></th>
						<td><?php echo $key['nm_bgs']; ?></td>
						<td><?php echo $key['tmp_tdr2']; ?></td>
						<?php $b = $key['tmp_tdr1'] - $key['tmp_tdr2']; ?>
						<td><?php echo $b; ?></td>
					</tr>
					<?php $no++; ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>