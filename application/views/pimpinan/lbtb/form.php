<div class="but_list">
	<ol class="breadcrumb">
		<li><a href="#">Laporan</a></li>
		<li class="active">Periode</li>
	</ol>
</div>
<div class="xs">
	<h3>Form Periode LOS, BOR, TOI, BTO</h3>
	<div class="tab-content">
		<div class="tab-pane active" id="horizontal-form">
			<?php echo validation_errors(); ?> 
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('pimpinan/index_btbl', $attributes); ?>
			<form class="form-horizontal" method="POST">
				<div class="form-group">
					<label for="jenis" class="col-sm-2 control-label">Indikator</label>
					<div class="col-sm-8">
						<select name="jenis" id="selector1" class="form-control1" required>
							<option value=""> - Pilih Indikator - </option>
							<option value="LOS"> LOS </option>
							<option value="BOR"> BOR </option>
							<option value="TOI"> TOI </option>
							<option value="BTO"> BTO </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="bulan" class="col-sm-2 control-label">Bulan</label>
					<div class="col-sm-8">
						<input name="bulan" id="bulan" type="month" class="form-control1 ng-invalid ng-invalid-required" ng-model="model.date" required="" placeholder="Bulan Tahun">
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
