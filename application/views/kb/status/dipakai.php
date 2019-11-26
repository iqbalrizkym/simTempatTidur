<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('kb/index_status'); ?>">Status</a></li>
		<li class="active">Update</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Diagnosa Akhir Pasien</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php echo validation_errors(); ?> 
			<?php foreach ($gunattawal as $tt) {?>
			<form class="form-horizontal" action="<?php echo base_url('kb/simpan_update_dipakai_direncanakan/'.$this->uri->segment(3).'/'.$tt['kd_gn'].'/'.$tt['kd_rm']); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_gn" class="col-sm-2 control-label">Kode Guna</label>
					<div class="col-sm-8">
						<input type="hidden" name="kd_gn" value="<?php echo $tt['kd_gn']; ?>">
						<input disabled type="text" class="form-control1" id="disabledinput" placeholder="Kode Guna" value="<?php echo $tt['kd_gn']; ?>">
						<input type="hidden" class="form-control1" id="disabledinput" placeholder="Kode Guna" value="<?php echo $tt['kd_gn']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="kd_tt" class="col-sm-2 control-label">Tempat Tidur</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_tt']; ?>">
						<input type="hidden" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_tt']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="kd_kls" class="col-sm-2 control-label">Kelas</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="disabledinput" placeholder="Kelas" value="<?php echo $tt['nm_kls']; ?>">
						<input type="hidden" class="form-control1" id="disabledinput" placeholder="Kelas" value="<?php echo $tt['nm_kls']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="kd_psn" class="col-sm-2 control-label">Pasien</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="disabledinput" placeholder="Pasien" value="<?php echo $tt['nm_psn']; ?>">
						<input type="hidden" class="form-control1" id="disabledinput" placeholder="Pasien" value="<?php echo $tt['nm_psn']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="diagnosa" class="col-sm-2 control-label">Diagnosa Awal</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="diagnosa" placeholder="Penanggung Jawab" value="<?php echo $tt['nm_pyk']; ?>">
						<input type="hidden" class="form-control1" id="focusedinput" name="diagnosa" placeholder="Penanggung Jawab" value="<?php echo $tt['nm_pyk']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="tgjwb_gn" class="col-sm-2 control-label">Penanggung Jawab</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="tgjwb_gn" placeholder="Penanggung Jawab" required>
					</div>
				</div>
				<div class="form-group">
					<label for="kd_dkt" class="col-sm-2 control-label">Dokter</label>
					<div class="col-sm-8">
						<select name="kd_dkt" id="selector1" class="form-control1" required="">
							<option value=""> - Pilih - </option>
							<?php
							foreach ($dokter as $item5){
								echo "<option value='$item5[kd_dkt]'>$item5[kd_dkt] | $item5[nm_dkt]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="kd_ptg" class="col-sm-2 control-label">Petugas</label>
					<div class="col-sm-8">
						<select name="kd_ptg" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($petugas as $item6){
								echo "<option value='$item6[kd_ptg]'>$item6[nm_ptg]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="jns_klr" class="col-sm-2 control-label">Status Keluar Pasien</label>
					<div class="col-sm-8">
						<select name="jns_klr" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<option value='Dipindahkan'>Dipindahkan</option>
							<option value='Pulang Hidup'>Pulang Hidup</option>
							<option value='Pulang Atas Permintaan Sendiri'>Pulang Atas Permintaan Sendiri</option>
							<option value='Keluar Melarikan Diri'>Keluar Melarikan Diri</option>
							<option value='Keluar Dirujuk'>Keluar Dirujuk</option>
							<option value='Meninggal < 48 Jam'>Meninggal < 48 Jam</option>
							<option value='Meninggal > 48 Jam'>Meninggal > 48 Jam</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="diagnosa1" class="col-sm-2 control-label">Diagnosa 1</label>
					<div class="col-sm-8">
						<select name="diagnosa1" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($penyakit as $item1){
								echo "<option value='$item1[kd_pyk]'>$item1[kd_pyk] | $item1[nm_pyk]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="diagnosa2" class="col-sm-2 control-label">Diagnosa 2</label>
					<div class="col-sm-8">
						<select name="diagnosa2" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($penyakit as $item2){
								echo "<option value='$item2[kd_pyk]'>$item2[kd_pyk] | $item2[nm_pyk]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="diagnosa3" class="col-sm-2 control-label">Diagnosa 3</label>
					<div class="col-sm-8">
						<select name="diagnosa3" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($penyakit as $item3){
								echo "<option value='$item3[kd_pyk]'>$item3[kd_pyk] | $item3[nm_pyk]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="diagnosa4" class="col-sm-2 control-label">Diagnosa 4</label>
					<div class="col-sm-8">
						<select name="diagnosa4" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($penyakit as $item4){
								echo "<option value='$item4[kd_pyk]'>$item4[kd_pyk] | $item4[nm_pyk]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" class="btn btn-success warning_2">Submit</button>
						</div>
					</div>
				</div> 
			<?php } ?>
			</form>
		</div>
	</div>
</div>