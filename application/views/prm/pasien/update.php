<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_pasien'); ?>">Pasien</a></li>
		<li class="active">Edit</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Pasien</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_update_pasien/'.$item['kd_rm']); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_rm" class="col-sm-2 control-label">No. Rekam Medik</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="kd_rm" value="<?php echo $item['kd_rm']; ?>" required>
						<input type="hidden" class="form-control1" id="focusedinput" name="kd_rm" value="<?php echo $item['kd_rm']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="nm_psn" class="col-sm-2 control-label">Nama Pasien</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_psn" value="<?php echo $item['nm_psn']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="tgl_lahir" class="col-sm-2 control-label">Tanggal Lahir</label>
					<div class="col-sm-8">
						<input name="tgl_lahir" type="date" class="form-control1 ng-invalid ng-invalid-required" ng-model="model.date" value="<?php echo $item['tgl_lahir']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="alm_psn" class="col-sm-2 control-label">Alamat</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="alm_psn" value="<?php echo $item['alm_psn']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="jns_psn" class="col-sm-2 control-label">Jenis</label>
					<div class="col-sm-8">
						<select name="jns_psn" id="selector1" class="form-control1" required>
							<option value="Umum"<?=$item['jns_psn'] == 'Umum' ? ' selected="selected"' : '';?>>Umum</option>
							<option value="Khusus"<?=$item['jns_psn'] == 'Khusus' ? ' selected="selected"' : '';?>>Khusus</option>
							<option value="Asuransi"<?=$item['jns_psn'] == 'Asuransi' ? ' selected="selected"' : '';?>>Asuransi</option>
							<option value="BPJS"<?=$item['jns_psn'] == 'BPJS' ? ' selected="selected"' : '';?>>BPJS</option>
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
