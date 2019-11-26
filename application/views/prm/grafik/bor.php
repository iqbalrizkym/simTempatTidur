<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Laporan</a></li>
		<li><a href="<?php echo site_url('prm/form_grafik'); ?>">Periode</a></li>
		<li class="active">Grafik</li>
	</ol>
</div>
<div class="xs">
	<div class="bebas">
		<div class="row">
			<div class="col-md-6">
				<h3>Garfik BOR</h3>
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
		$output1 = array();
		foreach ($btbl2 as $item) {
			if($item['hp'] == 0){
				$output1[] = array("kd_bgs" => $item['kd_bgs'], "tgl_msk" => $item['tgl_msk'], "hp" => "1");
			} else {
				$output1[] = array("kd_bgs"	=> $item['kd_bgs'], "tgl_msk" => $item['tgl_msk'], "hp" => $item['hp']);
			}
			$bulan = $item['tgl_msk'];
		}
					// print_r($output1);
					// exit(0);
		$result = [];
		array_walk($output1, function($item) use (&$result) {
			if (!isset($result[$item['kd_bgs']])) {
				$result[$item['kd_bgs']] = 0;
			}
			$result[$item['kd_bgs']] += $item['hp'];
		});
		$resultFormated = [];
		foreach ($result as $key => $value) {
			$resultFormated[] = array("kd_bgs" => $key, "tgl_msk" => $item['tgl_msk'], "hp" => $value);
		}
					//print_r($resultFormated);
					// exit(0);
		$output = array();
		usort($resultFormated,function($a,$b){
			return strnatcmp($a['kd_bgs'],$b['kd_bgs']);
		});
		$array3 = array_replace_recursive($btbl1, $resultFormated);

		$result = array_uintersect($array3,$btbl1,function($a,$b){
			return strnatcmp($a['kd_bgs'],$b['kd_bgs']);
		});
					// print_r($result);
					// exit(0);
		$length = count($resultFormated);
		$p=0;
		foreach ($result as $key) {						
			if ($p < $length ){
				$output[] = array('kd_bgs' => $key['kd_bgs'], 'nm_bgs' => $key['nm_bgs'], 'tgl_msk' => $bulan, 'a'=>$key['a'], 'hp'=>$key['hp']);								
			} else {
				$output[] = array('kd_bgs' => $key['kd_bgs'], 'nm_bgs' => $key['nm_bgs'], 'tgl_msk' => $bulan, 'a'=>$key['a'], 'hp'=>"0");

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
					labels:[ <?php foreach ($output as $item) { ?> "<?php echo $item['nm_bgs']; ?>",  <?php } ?>],
					datasets: [{
						label: 'Nilai BOR',
						data: [<?php foreach ($output as $item) { ?>
							<?php
							$t = date("t", strtotime($item['tgl_msk']));
							$o = $item['hp'] / $t;
							if( $item['a'] > 0 ){
								$bor = $o / $item['a'] *100;
							}else{
								$bor = "0";
							}

							?>
							<?php echo round($bor, 2); ?>,
						<?php } ?>
						],
						backgroundColor: 'rgba(255,0,0,0.7)',
						borderColor: 'rgba(255,0,0,0.7)',
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
						<th data-sortable="true" width="30%">Bulan</th>
						<th data-sortable="true" width="40%">Nama Bangsal</th>
						<th data-sortable="true" width="24%">Nilai BOR</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<tr>
						<?php foreach ($output as $item) { ?>
							<th><?php echo $no; ?></th>
							<?php $bulan = date("F",strtotime($item['tgl_msk']));?>
							<td><?php echo $bulan; ?></td>
							<td><?php echo $item['nm_bgs']; ?></td>
							<?php 
							$t = date("t", strtotime($item['tgl_msk']));
							$o = $item['hp'] / $t;
							if( $item['a'] > 0 ){
								$bor = $o / $item['a'] *100;
							}else{
								$bor = "0";
							}
							?>
							<td><?php echo round($bor, 2); ?>%</td>
						</tr>
						<?php $no++; ?>
					<?php } ?>
				</tbody>	
			</table>
		</div>
	</div>
</div>