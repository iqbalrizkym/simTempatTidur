<div class="but_list">
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('kb/index_status'); ?>">Status</a></li>
    <li class="active">Bangsal <?php echo $nama ?></li>
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
        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th data-sortable="true" width="5%">No</th>
                    <th data-sortable="true" width="10%">Tempat Tidur</th>
                    <th data-sortable="true" width="10%">Kelas</th>
                    <th data-sortable="true" width="20%">Pasien</th>
                    <th data-sortable="true" width="10%">Diagnosa</th>
                    <th data-sortable="true" width="10%">Status</th>
                    <th data-sortable="true" width="5%" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                $no = 1;
                foreach ($tempat_tidur as $tt){
                    $kd_tt = $tt['kd_tt'];
                    foreach ($guna_tt as $g_tt){
                      $kd_tt1 = $g_tt['kd_tt'];
                      if ($kd_tt == $kd_tt1){
                          $i++; 
                      }
                  }
              }
              if ($i > 0) {
                foreach ($status as $item){
                    // print_r($status);
                    // exit(0);
                    if ($item['status_tt'] == 'Diminta') { ?>
                        <tr>
                            <th><?php echo $no; ?></th>
                            <td><?php echo $item['nm_tt']; ?></td>
                            <td><?php echo $item['nm_kls']; ?></td>
                            <td><?php echo $item['nm_psn']; ?></td>
                            <td> - </td>
                            <td><?php echo $item['status_tt']; ?></td>
                            <td style="text-align: center;"><a href='<?php echo site_url('kb/update_guna_tt_diminta/'.$item['kd_tt'].'/'.$item['kd_gn']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a></td>
                        </tr>
                    <?php } elseif ($item['status_tt'] == 'Dipesan') { ?>
                        <tr>
                            <th><?php echo $no; ?></th>
                            <td><?php echo $item['nm_tt']; ?></td>
                            <td><?php echo $item['nm_kls']; ?></td>
                            <td><?php echo $item['nm_psn']; ?></td>
                            <td><?php echo $item['nm_pyk']; ?></td>
                            <td><?php echo $item['status_tt']; ?></td>
                            <td style="text-align: center;"><a href='<?php echo site_url('kb/update_guna_tt_dipesan/'.$item['kd_tt'].'/'.$item['kd_gn']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a></td>
                        </tr>
                    <?php } elseif ($item['status_tt'] == 'Disiapkan (Pesan)') { ?>
                        <tr>
                            <th><?php echo $no; ?></th>
                            <td><?php echo $item['nm_tt']; ?></td>
                            <td><?php echo $item['nm_kls']; ?></td>
                            <td><?php echo $item['nm_psn']; ?></td>
                            <td><?php echo $item['nm_pyk']; ?></td>
                            <td><?php echo "Disiapkan"; ?></td>
                            <td style="text-align: center;"><a href='<?php echo site_url('kb/update_guna_tt_disiapkan_pesan/'.$item['kd_tt'].'/'.$item['kd_gn']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a></td>
                        </tr>
                    <?php } elseif ($item['status_tt'] == 'Dipakai') { ?>
                        <tr>
                            <th><?php echo $no; ?></th>
                            <td><?php echo $item['nm_tt']; ?></td>
                            <td><?php echo $item['nm_kls']; ?></td>
                            <td><?php echo $item['nm_psn']; ?></td>
                            <td><?php echo $item['nm_pyk']; ?></td>
                            <td><?php echo $item['status_tt']; ?></td>
                            <td style="text-align: center;"><a href='<?php echo site_url('kb/update_guna_tt_dipakai/'.$item['kd_tt'].'/'.$item['kd_gn'].'/'.$item['kd_rm']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a></span></td>
                        </tr>
                    <?php }  ?>     
                    <?php 
                } $no++;
            } 
            $nomor = $no;
            foreach ($tt_kosong as $item1){ 
                if ($item1['status_tt'] == 'Kosong'){
                    ?>
                    <tr>
                        <th><?php echo $nomor; ?></th>
                        <td><?php echo $item1['nm_tt']; ?></td>
                        <td><?php echo $item1['nm_kls']; ?></td>
                        <td> - </td>
                        <td> - </td>
                        <td><?php echo $item1['status_tt']; ?></td>
                        <td style="text-align: center;"><a href='<?php echo site_url('kb/update_guna_tt_kosong/'.$item1['kd_tt']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a></td>
                        </tr>
                    <?php  } elseif ($item1['status_tt'] == 'Rusak') { ?>
                        <tr>
                            <th><?php echo $nomor; ?></th>
                            <td><?php echo $item1['nm_tt']; ?></td>
                            <td><?php echo $item1['nm_kls']; ?></td>
                            <td> - </td>
                            <td> - </td>
                            <td><?php echo $item1['status_tt']; ?></td>
                            <td style="text-align: center;"><a href='<?php echo site_url('kb/update_guna_tt_rusak/'.$item1['kd_tt']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a></td>
                        </tr>
                    <?php } elseif($item1['status_tt'] == 'Direncanakan'){ ?>
                        <tr>
                            <th><?php echo $nomor; ?></th>
                            <td><?php echo $item1['nm_tt']; ?></td>
                            <td><?php echo $item1['nm_kls']; ?></td>
                            <td> - </td>
                            <td> - </td>
                            <td><?php echo $item1['status_tt']; ?></td>
                            <td style="text-align: center;"><a href='<?php echo site_url('kb/update_guna_tt_direncanakan/'.$item1['kd_tt']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a></td>
                        </tr>
                    <?php  } elseif ($item1['status_tt'] == 'Disiapkan') { ?>
                        <tr>
                            <th><?php echo $nomor; ?></th>
                            <td><?php echo $item1['nm_tt']; ?></td>
                            <td><?php echo $item1['nm_kls']; ?></td>
                            <td> - </td>
                            <td> - </td>
                            <td><?php echo $item1['status_tt']; ?></td>
                            <td style="text-align: center;"><a href='<?php echo site_url('kb/update_guna_tt_disiapkan/'.$item1['kd_tt']); ?>'><span class='fa fa-pencil' aria-hidden='true'></span></a></td>
                        </tr> 
                    <?php } $nomor++;
                } ?>
            </tbody>
        </table>
    </div>
</div>