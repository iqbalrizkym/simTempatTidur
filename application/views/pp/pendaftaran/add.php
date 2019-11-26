<div class="but_list">
	<ol class="breadcrumb">
		<li class="active">Pendaftaran</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Pasien</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php if ($error = $this->session->flashdata('success_msg')): ?>
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
				<strong>Berhasil</strong> Data berhasil disimpan.
			</div> <?php $error ?>
			<?php endif; ?>
			<?php if ($error = $this->session->flashdata('error_msg')): ?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
				<strong>Gagal !</strong> Data gagal disimpan.
			</div> <?php $error ?>
			<?php endif; ?>
			<form class="form-horizontal" action="<?php echo base_url('pp/simpan_add_pendaftran/'); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="nm_psn" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_psn" placeholder="Nama Pasien" required>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_lahir" class="col-sm-2 control-label">Tanggal Lahir</label>
					<div class="col-sm-8">
						<input name="tgl_lahir" type="date" class="form-control1 ng-invalid ng-invalid-required" ng-model="model.date" required>
					</div>
				</div>
				<div class="form-group">
					<label for="alm_psn" class="col-sm-2 control-label">Alamat</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="alm_psn" placeholder="Alamat Pasien" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="jns_psn" class="col-sm-2 control-label">Jenis</label>
					<div class="col-sm-8">
						<select name="jns_psn" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<option value='Umum'>Umum</option>
							<option value='Khusus'>Khusus</option>
							<option value='Asuransi'>Asuransi</option>
							<option value='BPJS'>BPJS</option>
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
