<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('kb/index_status'); ?>">Status</a></li>
		<li class="active">Form</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Status Tempat Tidur</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php echo validation_errors(); ?> 
			<?php foreach ($gunattawal as $tt) {?>
				<form class="form-horizontal" action="<?php echo base_url('kb/update_disiapkanpesan_dipakai/'.$this->uri->segment(3).'/'.$tt['kd_gn'].'/'.$tt['kd_rm']); ?>" enctype="multipart/form-data" method="post" >
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
					<div class="panel-footer">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2">
								<button type="submit" name="submit" class="btn btn-success warning_2">Ubah ke Status Dipakai</button>
							</div>
						</div>
					</div> 
				</form>
			<?php } ?>
		</div>
	</div>
</div>