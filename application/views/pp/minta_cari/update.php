<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('pp/index_minta_cari'); ?>">Permintaan</a></li>
		<li class="active">Edit</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Permintaan Tempat Tidur</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php if ($error = $this->session->flashdata('success_msg')): ?>
				<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
					<strong>Berhasil</strong> Data berhasil diupdate.
				</div> <?php $error ?>
			<?php endif; ?>
			<?php if ($error = $this->session->flashdata('error_msg')): ?>
				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
					<strong>Gagal !</strong> Data gagal diupdate.
				</div> <?php $error ?>
			<?php endif; ?>
			<form class="form-horizontal" action="<?php echo base_url('pp/simpan_update_minta_cari/'.$item['kd_cari']); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="nm_cari" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="nm_cari" value="<?php echo $item['nm_cari']; ?>" required>
						<input type="hidden" class="form-control1" id="focusedinput" name="nm_cari" value="<?php echo $item['nm_cari']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="alm_cari" class="col-sm-2 control-label">Alamat</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="alm_cari" value="<?php echo $item['alm_cari']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="desk_minta" class="col-sm-2 control-label">Deskripsi Minta</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="desk_minta" value="<?php echo $item['desk_minta']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="kd_ptg" class="col-sm-2 control-label">Petugas</label>
					<div class="col-sm-8">
						<select name="kd_ptg" id="selector1" class="form-control1" required>
							<?php
							foreach ($petugas as $item1) {
								echo "<option value='$item1[kd_ptg]' ";
								echo $item['kd_ptg'] == $item1['kd_ptg'] ? 'selected' : '';
								echo">$item1[nm_ptg]</option>";
							}
							?>
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
			<?php echo form_close(); ?> 
		</div>
	</div>
</div>
