<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_aktor'); ?>">Aktor</a></li>
		<li class="active">Tambah</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Aktor</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_add_aktor/'); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_akt" class="col-sm-2 control-label">Kode</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="kd_akt" placeholder="Kode Aktor" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="nm_akt" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_akt" placeholder="Nama" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="username" placeholder="Username" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control1" id="focusedinput" name="password" placeholder="Password" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="level" class="col-sm-2 control-label">Level</label>
					<div class="col-sm-8">
						<select name="level" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<option value='Petugas Pendaftar PRI'>Petugas Pendaftar PRI</option>
							<option value='Kepala Bangsal'>Kepala Bangsal</option>
							<option value='Petugas Rekam Medik'>Petugas Rekam Medik</option>
							<option value='Pimpinan'>Pimpinan</option>
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