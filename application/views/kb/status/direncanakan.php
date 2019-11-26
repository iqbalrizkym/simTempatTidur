<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('kb/index_status'); ?>">Status</a></li>
		<li class="active">Update</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Status Tempat Tidur</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php echo validation_errors(); ?> 
			<?php foreach ($ttrencana as $tt) {?>
			<form class="form-horizontal" action="<?php echo base_url('kb/update_guna_tt_direncanakan_form/'.$this->uri->segment(3)); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_tt" class="col-sm-2 control-label">Kode Tempat Tidur</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['kd_tt']; ?>">
						<input type="hidden" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['kd_tt']; ?>">
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
				</div><div class="form-group">
					<label for="status_tt" class="col-sm-2 control-label">Status</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="disabledinput" placeholder="Kelas" value="<?php echo $tt['status_tt']; ?>">
						<input type="hidden" class="form-control1" id="disabledinput" placeholder="Kelas" value="<?php echo $tt['status_tt']; ?>">
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" class="btn btn-success warning_2">Ubah ke Status Dipesan</button>
							<button type="submit" name="submit" class="btn btn-danger" formaction="<?php echo base_url('kb/update_direncanakan_disiapkan/'.$this->uri->segment(3)); ?>">Ubah ke Status Disiapkan</button>
						</div>
					</div>
				</div> 
			<?php } ?>
			</form>
		</div>
	</div>
</div>