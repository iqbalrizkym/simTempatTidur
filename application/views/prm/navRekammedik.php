<nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('prm/index_home'); ?>"><span class="fa fa-plus"></span> HBMIS RSU Islam Harapan Anda Tegal</a>
    </div>
    <ul class="nav navbar-nav navbar-right">    
        <li class="dropdown">
            <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><i class="fa fa-user"></i></a>
            <ul class="dropdown-menu">
                <li class="dropdown-menu-header text-center"><strong>Account</strong></li>
                <li class="m_2"><a href="<?php echo site_url('prm/update_profil'); ?>"><i class="fa fa-user"></i> Profile</a></li>            
                <!-- <li class="divider"></li> -->            
                <li class="m_2"><a href="<?php echo base_url().'login'?>"><i class="fa fa-lock"></i> Logout</a></li>  
            </ul>
        </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li><a href="<?php echo site_url('prm/index_home'); ?>"><i class="fa fa-home nav_icon"></i>Home</a></li>
                <li><a href="#"><i class="fa fa-desktop nav_icon"></i>Data<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo site_url('prm/index_pasien'); ?>">Pasien</a></li>
                        <li><a href="<?php echo site_url('prm/index_tmp_tdr'); ?>">Tempat Tidur</a></li>
                        <li><a href="<?php echo site_url('prm/index_petugas'); ?>">Petugas</a></li>
                        <li><a href="<?php echo site_url('prm/index_penyakit'); ?>">Penyakit</a></li>
                        <li><a href="<?php echo site_url('prm/index_dokter'); ?>">Dokter</a></li>
                        <li><a href="<?php echo site_url('prm/index_bangsal'); ?>">Bangsal</a></li>
                        <li><a href="<?php echo site_url('prm/index_kelas'); ?>">Kelas</a></li>
                        <li><a href="<?php echo site_url('prm/index_aktor'); ?>">Aktor</a></li>
                        <li><a href="<?php echo site_url('prm/index_status'); ?>">Status Tempat Tidur</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-desktop nav_icon"></i>Laporan<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo site_url('prm/form_sensus'); ?>">Sensus Harian</a></li>
                        <li><a href="<?php echo site_url('prm/form_btbl'); ?>">LOS, BOR, BTO, TOI</a></li>
                        <li><a href="<?php echo site_url('prm/form_grafik'); ?>">Grafik</a></li>
                    </ul>
                </li>   
            </ul>
        </div>
    </div>
</nav>
<div id="page-wrapper">
    <div class="col-md-12 graphs">