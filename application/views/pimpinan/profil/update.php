<div class="but_list">
	<ol class="breadcrumb">
		<li class="active">Aktor</li>
	</ol>
</div>
<div class="xs">
	<h3>Data Profil</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php echo validation_errors(); ?> 
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('pimpinan/update_profil/'.$this->session->userdata('kd_akt'), $attributes); ?>
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
			<form class="form-horizontal">
				<div class="form-group">
					<label for="nm_akt" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_akt" value="<?php echo $this->session->userdata('nm_akt'); ?>" required>
					</div>		
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="username" value="<?php echo $this->session->userdata('username'); ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control1" id="focusedinput" name="password" value="<?php echo $this->session->userdata('password'); ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="level" class="col-sm-2 control-label">Jabatan</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="level" value="<?php echo $this->session->userdata('level'); ?>">
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
			<?php echo form_close(); ?> 
		</div>
	</div>
</div>
