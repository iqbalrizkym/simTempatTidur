<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="#">Data</a></li>
    <li class="active">Pasien</li>
  </ol>
</div>
<div class="xs">
  <div class="bebas">
  	<div class="row">
  		<div class="col-md-6">
  			<h3>Data Pasien</h3>
  		</div>
  		<div class="col-md-6">
  			<!-- <a href="<?php echo site_url('prm/add_pasien'); ?>" style="float:right; "><button class="btn lg btn-default"><span class='fa fa-print' aria-hidden='true'></span> </button></a> -->
  			<a href="<?php echo site_url('prm/add_pasien'); ?>" style="float:right; margin-right:4px;"><button class="btn btn-warning warning_22"><span class='fa fa-plus' aria-hidden='true'></span> Tambah</button></a>
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
          <th data-sortable="true" width="5%">No</th>
          <th data-sortable="true" width="15%">No RM</th>
          <th data-sortable="true" width="19%">Nama</th>
          <th data-sortable="true" width="9%">Umur</th>
          <th data-sortable="true" width="30%">Alamat</th>
          <th data-sortable="true" width="15%">Jenis</th>
          <th data-sortable="true" width="7%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        <tr>
         <?php foreach ($pasien as $item) { ?>
           <th><?php echo $no; ?></th>
           <td><?php echo $item['kd_rm']; ?></td>
           <td><?php echo $item['nm_psn']; ?></td>
           <?php 
             $date1=date_create($item['tgl_lahir']);
             $date2=date_create('today');
             $diff=date_diff($date1,$date2);
           ?>
           <td><?php echo $diff->format("%y Thn"); ?></td>
           <td><?php echo $item['alm_psn']; ?></td>
           <td><?php echo $item['jns_psn']; ?></td>
           <td>
            <a href='<?php echo site_url('prm/update_pasien/'.$item['kd_rm']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a>&nbsp&nbsp 
            <a href="<?php echo site_url('prm/simpan_delete_pasien/'.$item['kd_rm']); ?>" id="alertDelete"><span class='fa fa-trash-o' aria-hidden='true'></span></a></td>
         </tr>
         <?php $no++; ?>
       <?php } ?>
     </tbody>	
   </table>
 </div>
</div>
</div>