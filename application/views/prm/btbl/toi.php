<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Laporan</a></li>
		<li><a href="<?php echo site_url('prm/form_btbl'); ?>">Periode</a></li>
		<li class="active">BOR, LOS, TOI, BTO</li>
	</ol>
</div>
<div class="xs">
	<div class="bebas">
		<div class="row">
			<div class="col-md-6">
				<h3>Inikator TOI</h3>
			</div>
			<div class="col-md-6">
				<!-- <a href="<?php echo site_url('prm/add_kelas'); ?>" style="float:right;"><button class="btn lg btn-default"><span class='fa fa-print' aria-hidden='true'></span> </button></a> -->
			</div>  		
		</div>
	</div> 
	<div class="bs-example4" data-example-id="simple-responsive-table">
		<div class="table-responsive">
			<table id="example" class="table table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th data-sortable="true" width="6%">No</th>
						<th data-sortable="true" width="20%">Bulan</th>
						<th data-sortable="true" width="30%">Nama Bangsal</th>
						<th data-sortable="true" width="24%">Nilai TOI</th>
						<th data-sortable="true" width="20%">Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
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
					<?php foreach ($output as $item) { ?>
						<?php 
							$t = date("t", strtotime($item['tgl_msk']));
							$o = $item['hp'] / $t;
							if( $item['d'] > 0 ){
								$toi = ($item['a'] - $o) * ($t / $item['d']);
								$toi = round($toi, 0);
							}else{
								$toi = "0";
							}
						?>
						<?php if ($toi < 1){ ?>
							<tr style="background-color:rgba(255,255,0,0.3);">
							<?php $ket = "Dibawah Nilai Ideal"; ?>
						<?php } else if ($toi >= 1 && $toi <= 3){ ?>
							<tr style="background-color:rgba(0,255,0,0.3);">
							<?php $ket = "Nilai Ideal"; ?>
						<?php } elseif ($toi > 3) { ?>
							<tr style="background-color:rgba(255,0,0,0.3);">
								<?php $ket = "Diatas Nilai Ideal"; ?>
						<?php } ?>
							<th><?php echo $no; ?></th>
							<?php $bulan = date("F",strtotime($item['tgl_msk']));?>
							<td><?php echo $bulan; ?></td>
							<td><?php echo $item['nm_bgs']; ?></td>
							<td><?php echo $toi; ?> Hari</td>
							<td><?php echo $ket; ?></td>
						<?php $no++; ?>
					<?php } ?>
				</tbody>	
			</table>
		</div>
	</div>
</div>