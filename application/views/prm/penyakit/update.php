<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_penyakit'); ?>">Penyakit</a></li>
		<li class="active">Edit</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Penyakit</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_update_penyakit/'.$item['kd_pyk']); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_pyk" class="col-sm-2 control-label">Kode</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="kd_pyk" value="<?php echo $item['kd_pyk']; ?>" required>
						<input type="hidden" class="form-control1" id="focusedinput" name="kd_pyk" value="<?php echo $item['kd_pyk']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="nm_pyk" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_pyk" value="<?php echo $item['nm_pyk']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="desk_pyk" class="col-sm-2 control-label">Deskripsi</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="desk_pyk" value="<?php echo $item['desk_pyk']; ?>" required>
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
