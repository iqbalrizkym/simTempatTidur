<nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-brand" href="#"><span class="fa fa-plus"></span> HBMIS RSU Islam Harapan Anda Tegal</a>
    </div>
    <ul class="nav navbar-nav navbar-right">    
        <a class="navbar-brand" href="<?php echo site_url('login'); ?>"><h4>Login</h4></a>  
    </ul>
</nav>
<div class="col-md-12 graphs">
    <script type="text/javascript">
      $(document).ready(function() {
          $('#example').DataTable();
      } );
</script>
<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('pengunjung/index'); ?>">Dashboard</a></li>
    <li class="active">Bangsal <?php echo $nama; ?></li>
</ol>
</div>
<div class="xs">
  <div class="bebas">
    <div class="row">
        <div class="col-md-6">
            <h3>Informasi Status Tempat Tidur</h3>
        </div>        
    </div>
</div> 
<div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
        <table id="example" class="table table-bordered" cellspacing="0" width="100%" id="highlight">
            <thead>
                <tr>
                    <th data-sortable="true" width="5%">No</th>
                    <th data-sortable="true" width="15%">Tempat Tidur</th>
                    <th data-sortable="true" width="10%">Kelas</th>
                    <th data-sortable="true" width="30%">Fasilitas</th>
                    <th data-sortable="true" width="15%">Status</th>
                    <th data-sortable="true" width="15%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($tt_kosong as $item){ ?>
                    <?php if($item['status_tt'] == 'Direncanakan'){ ?>
                        <tr style="background-color:rgba(199,5,199,0.3);">
                        <?php $ket = "Dapat dipesan" ?>
                    <?php } elseif ($item['status_tt'] == 'Diminta') { ?>
                        <tr style="background-color:rgba(255,255,0,0.3);">
                        <?php $ket = "Tidak dapat digunakan" ?>
                    <?php } elseif ($item['status_tt'] == 'Dipesan') { ?>
                        <tr style="background-color:rgba(0,255,0,0.3);">
                        <?php $ket = "Tidak dapat digunakan" ?>
                    <?php  } elseif ($item['status_tt'] == 'Disiapkan') { ?>
                        <tr style="background-color:rgba(22,22,245,0.3);">
                        <?php $ket = "Tidak dapat digunakan" ?>
                    <?php  } elseif ($item['status_tt'] == 'Disiapkan (Pesan)') { ?>
                        <tr style="background-color:rgba(22,22,245,0.3);">
                        <?php $ket = "Tidak dapat digunakan" ?>
                    <?php } elseif ($item['status_tt'] == 'Dipakai') { ?>
                        <tr style="background-color:rgba(255,0,0,0.3);">
                        <?php $ket = "Tidak dapat digunakan" ?>
                    <?php } elseif ($item['status_tt'] == 'Rusak') { ?>
                        <tr style="background-color:rgba(195,42,7,0.3);">
                        <?php $ket = "Tidak dapat digunakan" ?>
                    <?php } elseif ($item['status_tt'] == 'Kosong') { ?>
                        <tr style="background-color:none;">
                        <?php $ket = "Dapat digunakan" ?>
                    <?php } ?>                           
                        <th><?php echo $no; ?></th>
                        <td><?php echo $item['nm_tt']; ?></td>
                        <td><?php echo $item['nm_kls']; ?></td>
                        <td><?php echo $item['fasilitas']; ?></td>
                        <?php 
                            if ($item['status_tt'] == 'Disiapkan (Pesan)') { ?>
                                <td>Disiapkan</td>
                        <?php } else { ?>
                                <td><?php echo $item['status_tt']; ?></td>
                        <?php } ?>
                        <td><?php echo $ket; ?></td>
                    </tr>    
                <?php $no++; ?>
                <?php } ?>
            </tbody>     
        </table>
    </div>
</div>