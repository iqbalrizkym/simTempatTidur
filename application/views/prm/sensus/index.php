<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="#">Laporan</a></li>
    <li><a href="<?php echo site_url('prm/form_sensus'); ?>">Periode</a></li>
    <li class="active">Periode</li>
</ol>
</div>
<div class="xs">
  <div class="bebas">
    <div class="row">
        <div class="col-md-6">
            <h3>Sensus Harian PRI</h3>
        </div>        
    </div>
</div> 
<div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th data-sortable="true" rowspan="2" width="3%" style="vertical-align : middle; text-align:center; color: #4481b5;">Tgl</th>
                    <th data-sortable="true" rowspan="2" width="3%" style="vertical-align: middle; text-align:center; color: #4481b5;">Awal</th>
                    <th data-sortable="true" colspan="3" style="text-align: center;">Masuk</th>
                    <th data-sortable="true" colspan="6" style="text-align: center;">Keluar Hidup</th>
                    <th data-sortable="true" colspan="3" style="text-align: center;">Keluar Mati</th>
                    <th data-sortable="true" rowspan="2" width="3%" style="vertical-align : middle; text-align:center; color: #4481b5;">Lama Dirawat</th>
                    <th data-sortable="true" rowspan="2" width="3%" style="vertical-align : middle; text-align:center; color: #4481b5;">In-Out</th>
                    <th data-sortable="true" rowspan="2" width="3%" style="vertical-align : middle; text-align:center; color: #4481b5;">Pasien Dirawat</th>
                </tr>
                <tr>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Baru</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Transfer</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Jml</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Mutasi</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Pulang</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Minta Sdr</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Kabur</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Dirujuk</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Jml</th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;"> <48 Jam </th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;"> >48 Jam </th>
                    <th data-sortable="true" width="3%" style="text-align: center; color: #4481b5;">Jml</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = array_replace_recursive($masuk, $keluar, $awal, $inout);             
                $tgl = 1; ?>
                <tr>
                    <?php foreach ($result as $item){ ?>
                        <th style="text-align: center;"><?php echo $tgl; ?></th>
                        <?php 
                            $jml_msk = $item['Baru'] + $item['Transfer'];
                            $jml_klr = $item['Pindah'] + $item['Pulang'] + $item['Sendiri'] + $item['Lari'] + $item['Rujuk'];
                            $jml_klr1 = $item['Kurang'] + $item['Lebih']; 
                            $jml_lama = $item['Hp'] + $item['pinout'];
                            $jml_awal = $item['Awaltt'] - $jml_msk;
                            $jml_rwt = $item['Awaltt'] - $jml_klr - $jml_klr1; 
                        ?>
                        <th style="text-align: center;"><?php echo $jml_awal; ?></th>
                        <th style="text-align: center;"><?php echo $item['Baru']; ?></th>
                        <th style="text-align: center;"><?php echo $item['Transfer']; ?></th>
                        <th style="text-align: center;"><?php echo $jml_msk; ?></th>
                        <th style="text-align: center;"><?php echo $item['Pindah']; ?></th>
                        <th style="text-align: center;"><?php echo $item['Pulang']; ?></th>
                        <th style="text-align: center;"><?php echo $item['Sendiri']; ?></th>
                        <th style="text-align: center;"><?php echo $item['Lari']; ?></th>
                        <th style="text-align: center;"><?php echo $item['Rujuk']; ?></th>
                        <th style="text-align: center;"><?php echo $jml_klr; ?></th>
                        <th style="text-align: center;"><?php echo $item['Kurang']; ?></th>
                        <th style="text-align: center;"><?php echo $item['Lebih']; ?></th>
                        <th style="text-align: center;"><?php echo $jml_klr1; ?></th>
                        <th style="text-align: center;"><?php echo $jml_lama;?></th>
                        <th style="text-align: center;"><?php echo $item['pinout']; ?></th>
                        <th style="text-align: center;"><?php echo $jml_rwt; ?></th>
                    </tr>    
                    <?php $tgl++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>