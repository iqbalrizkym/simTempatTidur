<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="home">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_pasien'); ?>">Pasien</a></li>
		<li class="active">Tambah</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Pasien</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_add_pasien/'); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_rm" class="col-sm-2 control-label">Kode Rekam Medik</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="kd_rm" placeholder="Kode Rekam Medik" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="nm_psn" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_psn" placeholder="Nama Pasien" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="tgl_lahir" class="col-sm-2 control-label">Tanggal Lahir</label>
					<div class="col-sm-8">
						<input name="tgl_lahir" type="date" class="form-control1 ng-invalid ng-invalid-required" ng-model="model.date" required="">
					</div>
				</div>
				<div class="form-group">
					<label for="alm_psn" class="col-sm-2 control-label">Alamat</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="alm_psn" placeholder="Alamat Pasien" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="kd_pyk" class="col-sm-2 control-label">Diagnosa</label>
					<div class="col-sm-8">
						<select name="kd_pyk" id="selector1" class="form-control1" required>
							<option value=""> - Pilih Penyakit - </option>
							<?php
							foreach ($penyakit as $item){
								echo "<option value='$pitem[kd_pyk]'>$item[kd_pyk] | $item[nm_pyk]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="jns_psn" class="col-sm-2 control-label">Jenis</label>
					<div class="col-sm-8">
						<select name="jns_psn" id="selector1" class="form-control1" required>
							<option value=""> - Pilih Jenis - </option>
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