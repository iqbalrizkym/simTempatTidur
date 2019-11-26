<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('pp/index_status'); ?>">Status</a></li>
		<li class="active">Alokasi</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Alokasi PRI</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php echo validation_errors(); ?> 
			<form class="form-horizontal" action="<?php echo base_url('pp/simpan_add_alokasi/'); ?>" enctype="multipart/form-data" method="post" >
				<?php foreach ($tempat_tidur as $tt) {?>
					<div class="form-group">
						<label for="kd_tt" class="col-sm-2 control-label">Tempat Tidur</label>
						<div class="col-sm-8">
							<input type="hidden" name="kd_tt" value="<?php echo $tt['kd_tt']; ?>">
							<input name="nm_tt" disabled="" type="text" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_tt']; ?>" required>
							<input name="nm_tt" type="hidden" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_tt']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="kd_kls" class="col-sm-2 control-label">Kelas</label>
						<div class="col-sm-8">
							<input name ="kd_kls" disabled="" type="text" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_kls']; ?>" required>
							<input name ="kd_kls" type="hidden" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_kls']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="kd_psn" class="col-sm-2 control-label">Pasien</label>
						<div class="col-sm-8">
							<select name="kd_rm" id="selector1" class="form-control1" required>
								<option value=""> - Pilih Pasien- </option>
								<?php
								foreach ($pasien as $item){
									echo "<option value='$item[kd_rm]'>$item[kd_rm] | $item[nm_psn]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="diagnosa" class="col-sm-2 control-label">Diagnosa</label>
						<div class="col-sm-8">
							<select name="diagnosa" id="selector1" class="form-control1" required>
								<option value=""> - Pilih Penyakit - </option>
								<?php
								foreach ($penyakit as $item){
									echo "<option value='$item[kd_pyk]'>$item[kd_pyk] | $item[nm_pyk]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="jns_msk" class="col-sm-2 control-label">Status Masuk Pasien</label>
						<div class="col-sm-8">
							<select name="jns_msk" id="selector1" class="form-control1" required>
								<option value=""> - Pilih - </option>
								<option value='Baru'>Baru</option>
								<option value='Transfer'>Transfer</option>
							</select>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2">
								<button type="submit" name="submit" class="btn btn-success warning_2">Simpan</button>
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
						</div>
					</div> 
				<?php } ?>
			</form>
		</div>
	</div>
</div>
