<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('kb/index_status'); ?>">Status</a></li>
    <li class="active">Bangsal Umum</li>
</ol>
</div>
<div class="xs">
  <div class="bebas">
    <div class="row">
        <div class="col-md-6">
            <h3>Status Tempat Tidur</h3>
        </div>        
    </div>
</div> 
<div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
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
      <?php if ($error = $this->session->flashdata('success_msg_tambah')): ?>
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
          <strong>Berhasil</strong> Data berhasil ditambah.
        </div> <?php $error ?>
      <?php endif; ?>
      <?php if ($error = $this->session->flashdata('error_msg_tambah')): ?>
        <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
          <strong>Gagal !</strong> Data gagal ditambah.
        </div> <?php $error ?>
      <?php endif; ?>
        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th data-sortable="true" width="5%">No</th>
                    <th data-sortable="true" width="30%">Bangsal</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Kosong</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Direncanakan</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Diminta</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Dipesan</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Disiapkan</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Dipakai</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Rusak</th>
                    <th data-sortable="true" width="5%" style="text-align: center;">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <tr>
                    <?php foreach ($count_tt as $item){ ?>
                        <th><?php echo $no; ?></th>
                        <td><?php echo $item['nm_bgs']; ?></td>
                        <td style="text-align: center;"><?php echo $item['Kosong']; ?></td>
                        <td style="text-align: center;"><?php echo $item['Direncanakan']; ?></td>
                        <td style="text-align: center;"><?php echo $item['Diminta']; ?></td>
                        <td style="text-align: center;"><?php echo $item['Dipesan']; ?></td>
                        <?php $disiapkan = array( $item['Disiapkan'], $item['Disisan']); ?>
                        <td style="text-align: center;"><?php echo array_sum($disiapkan); ?></td>
                        <td style="text-align: center;"><?php echo $item['Dipakai']; ?></td>
                        <td style="text-align: center;"><?php echo $item['Rusak']; ?></td>
                        <td style="text-align: center;"><a href='<?php echo site_url('kb/detail_status/'.$item['kd_bgs']); ?>'><span class='fa fa-eye' aria-hidden='true'></span></a></td>
                    </tr>    
                    <?php $no++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>