<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_kelas'); ?>">Kelas</a></li>
		<li class="active">Edit</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Kelas</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_update_kelas/'.$item['kd_kls']); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_kls" class="col-sm-2 control-label">Kode</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="kd_kls" value="<?php echo $item['kd_kls']; ?>" required>
						<input type="hidden" class="form-control1" id="focusedinput" name="kd_kls" value="<?php echo $item['kd_kls']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="nm_kls" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_kls" value="<?php echo $item['nm_kls']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="fasilitas" class="col-sm-2 control-label">Fasilitas</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="fasilitas" value="<?php echo $item['fasilitas']; ?>" required>
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
