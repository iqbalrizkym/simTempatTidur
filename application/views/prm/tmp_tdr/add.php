<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_tmp_tdr'); ?>">Tempat Tidur</a></li>
		<li class="active">Tambah</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Tempat Tidur</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_add_tmp_tdr/'); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_tt" class="col-sm-2 control-label">Kode</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="kd_tt" placeholder="Kode Tempat Tidur" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="nm_tt" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_tt" placeholder="Nama Tempat Tidur" required>
					</div>
				</div>
				<div class="form-group">
					<label for="kd_bgs" class="col-sm-2 control-label">Bangsal</label>
					<div class="col-sm-8">
						<select name="kd_bgs" id="selector1" class="form-control1" required>
							<option value=""> - Pilih Bangsal- </option> 
							<?php
							foreach ($bangsal as $item){
								echo "<option value='$item[kd_bgs]'>$item[nm_bgs]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="kd_kls" class="col-sm-2 control-label">Kelas</label>
					<div class="col-sm-8">
						<select name="kd_kls" id="selector1" class="form-control1" required>
							<option value=""> - Pilih Kelas - </option> 
							<?php
							foreach ($kelas as $item){
								echo "<option value='$item[kd_kls]'>$item[nm_kls]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="status_tt" class="col-sm-2 control-label">Status</label>
					<div class="col-sm-8">
						<select name="status_tt" id="selector1" class="form-control1" required>
							<option value=""> - Pilih Status Awal - </option>
							<option value='Kosong'>Kosong</option>
							<option value='Disiapkan'>Disiapkan</option>
							<option value='Rusak'>Rusak</option>
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
