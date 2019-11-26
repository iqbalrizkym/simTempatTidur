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
				<h3>Grafik Barber Johnson</h3>
			</div>
			<div class="col-md-6">
				<!-- <a href="<?php echo site_url('kelas/add'); ?>" style="float:right;"><button class="btn lg btn-default"><span class='fa fa-print' aria-hidden='true'></span> </button></a> -->
			</div>  		
		</div>
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
	// print_r($output);
	// exit(0);
	$suma = array_sum(array_map(function($item) { 
		return $item['a'];
	}, $output));
	$sumhp = array_sum(array_map(function($item) { 
		return $item['hp'];
	}, $output));
	$sumd = array_sum(array_map(function($item) { 
		return $item['d'];
	}, $output));

	// print_r($suma);
	// print_r($sumhp); 
	// print_r($sumd);
	// exit(0);



	?>
	<div class="bs-example4">
		<?php
		$t = date("t", strtotime($bulan));
		$o = $sumhp / $t;
		// nilai BOR
		if( $suma > 0 ){
			$bor = $o / $suma *100;
		}else{
			$bor = "0";
		}
		// nilai TOI
		if( $sumd > 0 ){
			$toi = ($suma - $o) * ($t / $sumd);
		}else{
			$toi = "0";
		}
		// nilai LOS
		if( $sumd > 0 ){
			$los = $o * $t / $sumd;
		}else{
			$los = "0";
		}
		// nilai BTO
		if( $sumd > 0 ){
			$bto = $sumd / $suma;
		}else{
			$bto = "0";
		}
		?>
		<!-- mencari nilai BOR untuk garis dengan rumus -->
		<!-- nilai  los = nilai_bor / 10 -->
		<!-- nilai  toi = 10 - nilai_los -->


		<!-- dik nilai bor = 50% -->
		<!-- nilai  los = 50 / 10 -->
		<!-- nilai los = 5 -->
		<?php $losbor50 = 50; ?>
		<!-- nilai  toi = 10 - 5 -->
		<!-- nilai toi = 5-->
		<?php $toibor50 = 50; ?>


		<!-- dik nilai bor = 70% -->
		<!-- nilai  los = 70 / 10 -->
		<!-- nilai los = 7 -->
		<?php $losbor70 = 70; ?>
		<!-- nilai  toi = 10 - 7 -->
		<!-- nilai toi = 3 -->
		<?php $toibor70 = 30; ?>


		<!-- dik nilai bor = 80% -->
		<!-- nilai  los = 80 / 10 -->
		<!-- nilai los = 2 -->
		<?php $losbor80 = 26; ?>
		<!-- nilai  toi = 10 - 2 -->
		<!-- nilai toi = 8 -->
		<?php $toibor80 = 104; ?>


		<!-- dik nilai bor = 90% -->
		<!-- nilai  los = 90 / 10 -->
		<!-- nilai los = 1 -->
		<?php $losbor90 = 25; ?>
		<!-- nilai  toi = 10 - 1 -->
		<!-- nilai toi = 9 -->
		<?php $toibor90 = 225; ?>


		<!-- titik nilai BOR -->
		<!-- nilai los -->
		<?php $titikBorA = $bor / 10; ?>
		<!-- nilai toi -->
		<?php $titikBorB = 10 - $titikBorA; ?>


		<!-- mencari nilai BTO untuk garis dengan rumus -->
		<!-- nilai  los = - toi + ( $t / bto) -->
		<!-- dik nilai BTO = 30 -->
		<!-- nilai  los = - toi + ( $t / 30) -->
		<?php $losbto30 = 365 / 30; ?>
		<?php $toibto30 = 365 / 30; ?>
		<!-- dik nilai BTO = 20 -->
		<!-- nilai  los = - toi + ( $t / 30) -->
		<?php $losbto20 = 365 / 20; ?>
		<?php $toibto20 = 365 / 20; ?>
		<!-- dik nilai BTO = 15 -->
		<!-- nilai  los = - toi + ( $t / 30) -->
		<?php $losbto15 = 365 / 15; ?>
		<?php $toibto15 = 365 / 15; ?>
		<!-- dik nilai BTO = 12.5 -->
		<!-- nilai  los = - toi + ( $t / 30) -->
		<?php $losbto125 = 365 / 12.5; ?>
		<?php $toibto125 = 365 / 12.5; ?>

		<div class="graph_box1">
			<div class="grid_1">
				<center><canvas id="myChart" width="2px" height="1" style=" width: 2px; height: 1px;;"></canvas></center>
			</div>
			<div class="clearfix"> </div>
		</div>
		<script>
			Chart.plugins.register({
				beforeDatasetsDraw: function(chartInstance) {
					var ctx = chartInstance.chart.ctx;
					var chartArea = chartInstance.chartArea;
					ctx.save();
					ctx.beginPath();

					ctx.rect(chartArea.left, chartArea.top, chartArea.right - chartArea.left, chartArea.bottom - chartArea.top);
					ctx.clip();
				},
				afterDatasetsDraw: function(chartInstance) {
					chartInstance.chart.ctx.restore();
				},
			});
			var ctx = document.getElementById('myChart').getContext('2d');
			var myLineChart = new Chart(ctx, {
				type: 'scatter',
				data: {
					datasets: [{
						// garis BOR
						label: "BOR 50%",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#c11212',
						data: [{
							x: 0,
							y: 0
						}, {
							x: <?php echo $losbor50; ?>,
							y: <?php echo $toibor50; ?>
						}],
					},
					{
						label: "BOR 70%",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#2e12c1',
						data: [{
							x: 0,
							y: 0
						}, {
							x: <?php echo $losbor70; ?>,
							y: <?php echo $toibor70; ?>
						}],
					},
					{
						label: "BOR 80%",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#dcea1d',
						data: [{
							x: 0,
							y: 0
						}, {
							x: <?php echo $losbor80; ?>,
							y: <?php echo $toibor80; ?>
						}],
					},
					{
						label: "BOR 90%",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#4cc112',
						data: [{
							x: 0,
							y: 0
						}, {
							x: <?php echo $losbor90; ?>,
							y: <?php echo $toibor90; ?>
						}],
					},
					// garis BTO
					{
						label: "BTO 30",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#c11212',
						data: [{
							x: 0,
							y: <?php echo $losbto30; ?>
						}, {
							x: <?php echo $toibto30; ?>,
							y: 0
						}],
					},
					{
						label: "BTO 20",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#2e12c1',
						data: [{
							x: 0,
							y: <?php echo $losbto20; ?>
						}, {
							x: <?php echo $toibto20; ?>,
							y: 0
						}],
					},
					{
						label: "BTO 15",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#dcea1d',
						data: [{
							x: 0,
							y: <?php echo $losbto15; ?>
						}, {
							x: <?php echo $toibto15; ?>,
							y: 0
						}],
					},
					{
						label: "BTO 12.5",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#4cc112',
						data: [{
							x: 0,
							y: <?php echo $losbto125; ?>
						},{
							x: <?php echo $toibto125; ?>,
							y: 0
						}],
					},				
					{
						label: "Wilayah Efisien",
						backgroundColor: 'transparent',
						borderWidth: '1px',
						pointBorderColor: 'transparent',
						borderColor: '#000',
						data: [{
							x: 12,
							y: 36
						},{
							x: 1,
							y: 3
						},{
							x: 1,
							y: 3
						},{
							x: 1,
							y: 36
						}],
					},
					{
						label: "Titik BOR",
						backgroundColor: '#000',
						borderWidth: '1px',
						pointBackgroundColor: '#000',
						pointBorderColor: '#000',
						borderColor: '#000',
						data: [{
							x: <?php echo $titikBorB; ?>,
							y: <?php echo $titikBorA; ?>
						}],
					}]
				},
				options: {
					legend: {
						display: true,
						position: 'right',
					},
					title: {
						display: true,
						text: '',
						fontStyle : 'bold',
						fontSize : 16,
					},
					elements: {
						line: {
			                tension: 0, // disables bezier curves
			            }
			        },
			        scales: {
			        	yAxes : [{
			        		scaleLabel : {
			        			display : true,
			        			labelString : "L O S",
			        			fontStyle : 'bold',
			        			fontSize : 14
			        		},
			        		ticks: {
			        			max: 25,
			        			stepSize: 1
			        		}
			        	}],
			        	xAxes: [{
			        		type: 'linear',
			        		position: 'bottom',
			        		scaleLabel : {
			        			display : true,
			        			labelString : "T O I",
			        			fontStyle : 'bold',
			        			fontSize : 14
			        		},
			        		ticks: {
			        			max: 12,
			        			stepSize: 1
			        		}
			        	}]
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
						<th data-sortable="true" width="34%">Bulan</th>
						<th data-sortable="true" width="15%">BOR</th>
						<th data-sortable="true" width="15%">TOI</th>
						<th data-sortable="true" width="15%">LOS</th>
						<th data-sortable="true" width="15%">BTO</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<tr>
						<th><?php echo $no; ?></th>
						<?php $bulan = date("F",strtotime($bulan));?>
						<td><?php echo $bulan; ?></td>
						<td><?php echo round($bor, 2); ?>%</td>
						<td><?php echo round($toi, 0); ?> Hari</td>
						<td><?php echo round($los, 0); ?> Hari</td>
						<td><?php echo round($bto, 0); ?> Kali</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>