<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_tmp_tdr'); ?>">Tempat Tidur</a></li>
		<li class="active">Edit</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Tempat Tidur</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_update_tmp_tdr/'.$item['kd_tt']); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_tt" class="col-sm-2 control-label">Kode</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="kd_tt" value="<?php echo $item['kd_tt']; ?>"  required>
						<input type="hidden" class="form-control1" id="focusedinput" name="kd_tt" value="<?php echo $item['kd_tt']; ?>"  required>
					</div>
				</div>
				<div class="form-group">
					<label for="nm_tt" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_tt" value="<?php echo $item['nm_tt']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="status_tt" class="col-sm-2 control-label">Status</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="status_tt" value="<?php echo $item['status_tt']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="kd_bgs" class="col-sm-2 control-label">Bangsal</label>
					<div class="col-sm-8">
						<select name="kd_bgs" id="selector1" class="form-control1" required>
							<?php
							foreach ($bangsal as $item1) {
								echo "<option value='$item1[kd_bgs]' ";
								echo $item['kd_bgs'] === $item1['kd_bgs'] ? 'selected' : '';
								echo">$item1[nm_bgs]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="kd_kls" class="col-sm-2 control-label">Kelas</label>
					<div class="col-sm-8">
						<select name="kd_kls" id="selector1" class="form-control1" required>
							<?php
							foreach ($kelas as $item2) {
								echo "<option value='$item2[kd_kls]' ";
								echo $item['kd_kls'] === $item2['kd_kls'] ? 'selected' : '';
								echo">$item2[nm_kls]</option>";
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
		</div>
	</div>
</div>
