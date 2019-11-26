<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Laporan</a></li>
		<li><a href="<?php echo site_url('pimpinan/periode_mintacari'); ?>">Periode</a></li>
		<li class="active">Minta Cari</li>	
	</ol>
</div>
<div class="xs">
	<div class="bebas">
		<div class="row">
			<div class="col-md-6">
				<h3>Laporan Permintaan Tempat Tidur</h3>
			</div>
			<div class="col-md-6">
				<!-- <a href="<?php echo site_url('pimpinan/download_minta_cari'); ?>" style="float:right;"><button class="btn lg btn-default"><span class='fa fa-print' aria-hidden='true'></span> </button></a> -->
			</div>  		
		</div>
	</div> 
	<div class="bs-example4" data-example-id="simple-responsive-table">
		<div class="table-responsive">
			<table id="example" class="table table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th data-sortable="true" width="6%">No</th>
						<th data-sortable="true" width="8%">Nama</th>
						<th data-sortable="true" width="15%">Alamat</th>
						<th data-sortable="true" width="10%">Tanggal</th>
						<th data-sortable="true" width="20%">Deskripsi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<tr>
						<?php foreach ($minta_cari as $item) { ?>
							<th><?php echo $no; ?></th>
							<td><?php echo $item['nm_cari']; ?></td>
							<td><?php echo $item['alm_cari']; ?></td>
							<td><?php echo $item['tgl_cari']; ?></td>
							<td><?php echo $item['desk_minta']; ?></td>
						</tr>
						<?php $no++; ?>
					<?php } ?>
				</tbody>	
			</table>
		</div>
	</div>
</div>