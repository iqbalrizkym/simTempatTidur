<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Laporan</a></li>
		<li class="active">Periode</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Periode Permintaan Tempat Tidur</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php echo validation_errors(); ?> 
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('pimpinan/lap_mintacari', $attributes); ?>
			<form class="form-horizontal" method="POST">
				<div class="form-group">
					<label for="tgl1" class="col-sm-2 control-label">Tanggal Awal</label>
					<div class="col-sm-8">
						<input name="tgl1" id="tgl1" type="date" class="form-control1 ng-invalid ng-invalid-required" ng-model="model.date" required>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl2" class="col-sm-2 control-label">Tanggal Akhir</label>
					<div class="col-sm-8">
						<input name="tgl2" id="tgl2" type="date" class="form-control1 ng-invalid ng-invalid-required" ng-model="model.date" required>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="search" id="search" value="Filter" class="btn btn-success warning_2">Filter</button>
							<button type="reset" class="btn btn-danger">Reset</button>
						</div>
					</div>
				</div> 
			</form>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
