<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('kb/index_dashboard'); ?>">Dashboard</a></li>
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
                    <th data-sortable="true" width="40%">Tempat Tidur</th>
                    <th data-sortable="true" width="25%">Kelas</th>
                    <th data-sortable="true" width="30%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($tt_kosong as $item){ ?>
                    <?php if($item['status_tt'] == 'Direncanakan'){ ?>
                        <tr style="background-color:rgba(199,5,199,0.3);">
                        <?php } elseif ($item['status_tt'] == 'Diminta') { ?>
                        <tr style="background-color:rgba(255,255,0,0.3);">
                        <?php } elseif ($item['status_tt'] == 'Dipesan') { ?>
                        <tr style="background-color:rgba(0,255,0,0.3);">
                        <?php  } elseif ($item['status_tt'] == 'Disiapkan') { ?>
                        <tr style="background-color:rgba(22,22,245,0.3);">
                        <?php  } elseif ($item['status_tt'] == 'Disiapkan (Pesan)') { ?>
                        <tr style="background-color:rgba(22,22,245,0.3);">
                        <?php } elseif ($item['status_tt'] == 'Dipakai') { ?>
                        <tr style="background-color:rgba(255,0,0,0.3);">
                        <?php } elseif ($item['status_tt'] == 'Rusak') { ?>
                        <tr style="background-color:rgba(195,42,7,0.3);">
                        <?php } elseif ($item['status_tt'] == 'Kosong') { ?>
                        <tr style="background-color:none;">
                    <?php } ?>                           
                        <th><?php echo $no; ?></th>
                        <td><?php echo $item['nm_tt']; ?></td>
                        <td><?php echo $item['nm_kls']; ?></td>
                        <?php 
                            if ($item['status_tt'] == 'Disiapkan (Pesan)') { ?>
                                <td><?php echo $item['status_tt']; ?></td>
                        <?php } else { ?>
                                <td><?php echo $item['status_tt']; ?></td>

                        <?php } ?>
                    </tr>    
                <?php $no++; ?>
                <?php } ?>
            </tbody>     
        </table>
    </div>
</div>