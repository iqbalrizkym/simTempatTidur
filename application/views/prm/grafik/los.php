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
				<h3>Garfik LOS</h3>
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
					// print_r($resultFormated);
					// exit(0);
		$result1 = [];
		array_walk($btbl3, function($item) use (&$result1) {
			if (!isset($result1[$item['kd_bgs']])) {
				$result1[$item['kd_bgs']] = 0;
			}
			$result1[$item['kd_bgs']] += $item['d'];
		});
		$resultFormated1 = [];
		foreach ($result1 as $key => $value) {
			$resultFormated1[] = array("kd_bgs" => $key, "tgl_msk" => $item['tgl_msk'], "d" => $value);
		}
					// print_r($resultFormated1);
					// exit(0);
		$output1 = array();
		usort($resultFormated,function($a,$b){
			return strnatcmp($a['kd_bgs'],$b['kd_bgs']);
		});
		$array3 = array_replace_recursive($resultFormated1, $resultFormated);

		$result1 = array_uintersect($array3,$resultFormated1,function($a,$b){
			return strnatcmp($a['kd_bgs'],$b['kd_bgs']);
		});
					// print_r($result1);
					// exit(0);
		$output = array();
		usort($result1,function($a,$b){
			return strnatcmp($a['kd_bgs'],$b['kd_bgs']);
		});
		$array3 = array_replace_recursive($btbl1, $result1);

		$result = array_uintersect($array3,$btbl1,function($a,$b){
			return strnatcmp($a['kd_bgs'],$b['kd_bgs']);
		});
					// print_r($result);
					// exit(0);
		$length = count($resultFormated);
		$p=0;
		foreach ($result as $key) {						
			if ($p < $length ){
				$output[] = array('kd_bgs' => $key['kd_bgs'], 'nm_bgs' => $key['nm_bgs'], 'tgl_msk' => $bulan, 'a'=>$key['a'], 'hp'=>$key['hp'], 'd'=>$key['d']);								
			} else {
				$output[] = array('kd_bgs' => $key['kd_bgs'], 'nm_bgs' => $key['nm_bgs'], 'tgl_msk' => $bulan, 'a'=>$key['a'], 'hp'=>"0", 'd'=>"0");

			}
			$p++;
		}
		?>
		<script>
			var ctx = document.getElementById("myChart");
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels:[ <?php foreach ($output as $item) { ?> "<?php echo $item['nm_bgs']; ?>",  <?php } ?>],
					datasets: [{
						label: 'Nilai LOS',
						data: [<?php foreach ($output as $item) { ?>
							<?php
							$t = date("t", strtotime($item['tgl_msk']));
							$o = $item['hp'] / $t;
							if( $item['d'] > 0 ){
								$los = $o * $t / $item['d'];
							}else{
								$los = "0";
							}
							?>
							<?php echo round($los, 0); ?>,
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
						<th data-sortable="true" width="24%">Nilai LOS</th>
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
							if( $item['d'] > 0 ){
								$los = $o * $t / $item['d'];
							}else{
								$los = "0";
							}
							?>
							<td><?php echo round($los, 0); ?> Hari</td>
						</tr>
						<?php $no++; ?>
					<?php } ?>
				</tbody>	
			</table>
		</div>
	</div>
</div>