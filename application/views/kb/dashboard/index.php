<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('kb/index_dashboard'); ?>">Dashboard</a></li>
    <li class="active">Bangsal Umum</li>
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
        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th data-sortable="true" width="5%">No</th>
                    <th data-sortable="true" width="20%">Bangsal</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Kosong</th>
                    <th data-sortable="true" width="10%" style="text-align: center; background-color:rgba(199,5,199,0.3)">Direncanakan</th>
                    <th data-sortable="true" width="10%" style="text-align: center; background-color:rgba(255,255,0,0.3)">Diminta</th>
                    <th data-sortable="true" width="10%" style="text-align: center; background-color:rgba(0,255,0,0.3)">Dipesan</th>
                    <th data-sortable="true" width="10%" style="text-align: center; background-color:rgba(22,22,245,0.3)">Disiapkan</th>
                    <th data-sortable="true" width="10%" style="text-align: center; background-color:rgba(255,0,0,0.3)">Dipakai</th>
                    <th data-sortable="true" width="10%" style="text-align: center; background-color:rgba(195,42,7,0.3)">Rusak</th>
                    <th data-sortable="true" width="5%" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <tr>
                    <?php foreach ($count_tt as $item){ ?>
                        <th><?php echo $no; ?></th>
                        <th><?php echo $item['nm_bgs']; ?></th>
                        <th style="text-align: center;"><?php echo $item['Kosong']; ?></td>
                        <th style="text-align: center; background-color:rgba(199,5,199,0.3)"><?php echo $item['Direncanakan']; ?></th>
                        <th style="text-align: center; background-color:rgba(255,255,0,0.3)"><?php echo $item['Diminta']; ?></th>
                        <th style="text-align: center; background-color:rgba(0,255,0,0.3)"><?php echo $item['Dipesan']; ?></th>
                        <?php $disiapkan = array( $item['Disiapkan'], $item['Disisan']); ?>
                        <th style="text-align: center; background-color:rgba(22,22,245,0.3)"><?php echo array_sum($disiapkan); ?></th>
                        <th style="text-align: center; background-color:rgba(255,0,0,0.3)"><?php echo $item['Dipakai']; ?></th>
                        <th style="text-align: center; background-color:rgba(195,42,7,0.3)"><?php echo $item['Rusak']; ?></th>
                        <th style="text-align: center;"><a href='<?php echo site_url('kb/detail_dashboard/'.$item['kd_bgs']); ?>'><span class='fa fa-eye' aria-hidden='true'></span></a></th>
                    </tr>    
                    <?php $no++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
