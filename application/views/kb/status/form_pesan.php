<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('status'); ?>">Status</a></li>
		<li class="active">Alokasi</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Alokasi Pasien Rawat Inap</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php echo validation_errors(); ?> 
			<form class="form-horizontal" action="<?php echo base_url('kb/update_direncanakan_dipesan/'); ?>" enctype="multipart/form-data" method="post" >
				<?php foreach ($ttrencana as $tt) {?>
				<div class="form-group">
					<label for="kd_gn" class="col-sm-2 control-label">Kode Guna</label>
					<div class="col-sm-8">
						<input type="text" class="form-control1" id="focusedinput" name="kd_gn" placeholder="Kode Guna">
					</div>
				</div>
				<div class="form-group">
					<label for="kd_tt" class="col-sm-2 control-label">Tempat Tidur</label>
					<div class="col-sm-8">
						<input type="hidden" name="kd_tt" value="<?php echo $tt['kd_tt']; ?>">
						<input name="nm_tt" disabled type="text" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_tt']; ?>">
						<input name="nm_tt" type="hidden" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_tt']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="kd_kls" class="col-sm-2 control-label">Kelas</label>
					<div class="col-sm-8">
						<input name ="kd_kls" disabled type="text" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_kls']; ?>">
						<input name ="kd_kls" type="hidden" class="form-control1" id="disabledinput" placeholder="Tempat Tidur" value="<?php echo $tt['nm_kls']; ?>">
					</div>									
				</div>
				<div class="form-group">
					<label for="kd_rm" class="col-sm-2 control-label">Pasien</label>
					<div class="col-sm-8">
						<select name="kd_rm" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($pasien as $item){
								echo "<option value='$item[kd_rm]'>$item[kd_rm] | $item[nm_psn]</option>";
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
				<div class="form-group">
					<label for="diagnosa" class="col-sm-2 control-label">Penyakit</label>
					<div class="col-sm-8">
						<select name="diagnosa" id="selector1" class="form-control1" required>
							<option value=""> - Pilih - </option>
							<?php
							foreach ($penyakit as $item1){
								echo "<option value='$item1[kd_pyk]'>$item1[kd_pyk] | $item1[nm_pyk]</option>";
							}
							?>
						</select>
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="kd_ptg" class="col-sm-2 control-label">Pasien</label>
					<div class="col-sm-8">
						<div class="input-group input-icon right">
							<input type="text" class="form-control1" placeholder="Pasien">
							<span class="input-group-addon">
								<a href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i></a>
							</span>
						</div>
					</div> -->
					<!-- Modal -->
					<!-- <div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Pasien</h4>
								</div>
								<div class="modal-body">
									<select name="kd_ptg" id="selector1" class="form-control1">
										<?php
										foreach ($pasien as $item){
											echo "<option value='$item[kd_rm]'>$item[kd_rm] | $item[nm_psn]</option>";
										}
										?>
									</select>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
				</div> -->
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" class="btn btn-success warning_2">Submit</button>
							<button type="reset" class="btn btn-danger">Reset</button>
						</div>
					</div>
				</div> 
			<?php } ?>
			</form>
		</div>
	</div>
</div>
