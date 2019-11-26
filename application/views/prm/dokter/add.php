<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_dokter'); ?>">Dokter</a></li>
		<li class="active">Tambah</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Dokter</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_add_dokter/'); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_dkt" class="col-sm-2 control-label">Kode</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="kd_dkt" placeholder="Kode Dokter" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="nm_dkt" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_dkt" placeholder="Nama Dokter" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="keahlian" class="col-sm-2 control-label">Penanganan</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="keahlian" placeholder="Penanganan" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="kd_bgs" class="col-sm-2 control-label">Ruangan</label>
					<div class="col-sm-8">
						<select name="kd_bgs" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($bangsal as $item){
								echo "<option value='$item[kd_bgs]'>$item[nm_bgs]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" class="btn btn-success warning_2">Submit</button>
							<button type="reset" class="btn btn-danger">Reset</button>
						</div>
					</div>
				</div> 
			</form>
		</div>
	</div>
</div>
