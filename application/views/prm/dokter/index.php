<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="#">Data</a></li>
    <li class="active">Dokter</li>
  </ol>
</div>
<div class="xs">
  <div class="bebas">
  	<div class="row">
  		<div class="col-md-6">
  			<h3>Data Dokter</h3>
  		</div>
  		<div class="col-md-6">
  			<!-- <a href="<?php echo site_url('prm/add_dokter'); ?>" style="float:right; "><button class="btn lg btn-default"><span class='fa fa-print' aria-hidden='true'></span> </button></a> -->
  			<a href="<?php echo site_url('prm/add_dokter'); ?>" style="float:right; margin-right:4px;"><button class="btn btn-warning warning_22"><span class='fa fa-plus' aria-hidden='true'></span> Tambah</button></a>
  		</div>  		
  	</div>
  </div> 
  <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
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
      <?php if ($error = $this->session->flashdata('success_msg_edit')): ?>
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
          <strong>Berhasil</strong> Data berhasil diperbarui.
        </div> <?php $error ?>
      <?php endif; ?>
      <?php if ($error = $this->session->flashdata('error_msg_edit')): ?>
        <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
          <strong>Gagal !</strong> Data gagal diperbarui.
        </div> <?php $error ?>
      <?php endif; ?>
      <table id="example" class="table table-bordered" cellspacing="0" width="100%">
       <thead>
        <tr>
          <th data-sortable="true" width="6%">No</th>
          <th data-sortable="true" width="10%">Kode</th>
          <th data-sortable="true" width="17%">Nama</th>
          <th data-sortable="true" width="40%">Penanganan</th>
          <th data-sortable="true" width="20%">Bangsal</th>
          <th data-sortable="true" width="7%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        <tr>
         <?php foreach ($dokter as $item) { ?>
           <th><?php echo $no; ?></th>
           <td><?php echo $item['kd_dkt']; ?></td>
           <td><?php echo $item['nm_dkt']; ?></td>
           <td><?php echo $item['keahlian']; ?></td>          
           <td><?php echo $item['nm_bgs']; ?></td>
           <td>
            <a href='<?php echo site_url('prm/update_dokter/'.$item['kd_dkt']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a>&nbsp&nbsp 
            <a href="<?php echo site_url('prm/simpan_delete_dokter/'.$item['kd_dkt']); ?>" id="alertDelete"><span class='fa fa-trash-o' aria-hidden='true'></span></a></td>
         </tr>
         <?php $no++; ?>
       <?php } ?>
     </tbody>	
   </table>
 </div>
</div>
</div>