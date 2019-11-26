<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('statusc'); ?>">Bangsal</a></li>
    <li class="active">Umum</li>
</ol>
</div>
<div class="xs">
  <div class="bebas">
    <div class="row">
        <div class="col-md-6">
            <h3>Informasi Tempat Tidur Kosong</h3>
        </div>        
    </div>
</div> 
<div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th data-sortable="true" width="5%">No</th>
                    <th data-sortable="true" width="25%">Bangsal</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Kosong</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Direncanakan</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Diminta</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Dipesan</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Disiapkan</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Dipakai</th>
                    <th data-sortable="true" width="10%" style="text-align: center;">Rusak</th>

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
                        <?php $pesanan = array( $item['Dipesan'], $item['Disisan']); ?>
                        <td style="text-align: center;"><?php echo array_sum($pesanan); ?></td>
                        <td style="text-align: center;"><?php echo $item['Disiapkan']; ?></td>
                        <td style="text-align: center;"><?php echo $item['Dipakai']; ?></td>
                        <td style="text-align: center;"><?php echo $item['Rusak']; ?></td>
                    </tr>    
                    <?php $no++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
