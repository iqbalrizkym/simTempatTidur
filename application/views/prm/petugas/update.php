<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Data</a></li>
		<li><a href="<?php echo site_url('prm/index_petugas'); ?>">Petugas</a></li>
		<li class="active">Edit</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Petugas</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<form class="form-horizontal" action="<?php echo base_url('prm/simpan_update_pasien/'.$item['kd_ptg']); ?>" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					<label for="kd_ptg" class="col-sm-2 control-label">Kode</label>
					<div class="col-sm-8">
						<input disabled type="text" class="form-control1" id="focusedinput" name="kd_ptg" value="<?php echo $item['kd_ptg']; ?>" required>
						<input type="hidden" class="form-control1" id="focusedinput" name="kd_ptg" value="<?php echo $item['kd_ptg']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="nm_ptg" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="nm_ptg" value="<?php echo $item['nm_ptg']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="jns_ptg" class="col-sm-2 control-label">Jenis</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="jns_ptg" value="<?php echo $item['jns_ptg']; ?>" required>
					</div>									
				</div>
				<div class="form-group">
					<label for="kd_bgs" class="col-sm-2 control-label">Bangsal</label>
					<div class="col-sm-8">
						<select name="kd_bgs" id="selector1" class="form-control1" required>
							<option value=""> - Pilih Bangsal - </option>
							<?php
							foreach ($bangsal as $item1) {
								echo "<option value='$item1[kd_bgs]' ";
								echo $item['kd_bgs'] == $item1['kd_bgs'] ? 'selected' : '';
								echo">$item1[nm_bgs]</option>";
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
