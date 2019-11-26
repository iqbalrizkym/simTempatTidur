<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('pp/index_minta_cari'); ?>">Permintaan</a></li>
		<li class="active">Tambah</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Permintaan Tempat Tidur</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('pp/simpan_add_minta_cari/'); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="nm_cari" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_cari" placeholder="Nama Cari" required>
					</div>
				</div>
				<div class="form-group">
					<label for="alm_cari" class="col-sm-2 control-label">Alamat</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="alm_cari" placeholder="Alamat Cari" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="desk_minta" class="col-sm-2 control-label">Deskripsi Minta</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="desk_minta" placeholder="Deskripsi Tempat Tidur" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="kd_ptg" class="col-sm-2 control-label">Petugas</label>
					<div class="col-sm-8">
						<select name="kd_ptg" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($petugas as $item){
								echo "<option value='$item[kd_ptg]'>$item[nm_ptg]</option>";
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