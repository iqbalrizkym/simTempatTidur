<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_aktor'); ?>">Aktor</a></li>
		<li class="active">Edit</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Aktor</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_update_aktor/'.$item['kd_akt']); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_akt" class="col-sm-2 control-label">Kode</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="kd_akt" value="<?php echo $item['kd_akt']; ?>" required>
						<input type="hidden" class="form-control1" id="focusedinput" name="kd_akt" value="<?php echo $item['kd_akt']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="nm_akt" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_akt" value="<?php echo $item['nm_akt']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="username" value="<?php echo $item['username']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control1" id="focusedinput" name="password" value="<?php echo $item['password']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="level" class="col-sm-2 control-label">Level</label>
					<div class="col-sm-8">
						<select name="level" id="selector1" class="form-control1" required>
							<option value="Petugas Pendaftaran"<?=$item['level'] == 'Petugas Pendaftaran' ? ' selected="selected"' : '';?>>Petugas Pendaftaran</option>
							<option value="Kepala Bangsal"<?=$item['level'] == 'Kepala Bangsal' ? ' selected="selected"' : '';?>>Kepala Bangsal</option>
							<option value="Petugas Rekam Medik"<?=$item['level'] == 'Petugas Rekam Medik' ? ' selected="selected"' : '';?>>Petugas Rekam Medik</option>
							<option value="Pimpinan"<?=$item['level'] == 'Pimpinan' ? ' selected="selected"' : '';?>>Pimpinan</option>
						</select>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" class="btn btn-success warning_2">Update</button>
							<button type="reset" class="btn btn-danger">Reset</button>
						</div>
					</div>
				</div> 
			</form>
		</div>
	</div>
</div>
