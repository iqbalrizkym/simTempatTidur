<nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('pp/index_home'); ?>"><span class="fa fa-plus"></span> HBMIS RSU Islam Harapan Anda Tegal</a>
    </div>
    <ul class="nav navbar-nav navbar-right">    
        <li class="dropdown">
            <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><i class="fa fa-user"></i></a>
            <ul class="dropdown-menu">
                <li class="dropdown-menu-header text-center"><strong>Account</strong></li>
                <li class="m_2"><a href="<?php echo site_url('pp/update_profil'); ?>"><i class="fa fa-user"></i> Profile</a></li>            
                <!-- <li class="divider"></li> -->            
                <li class="m_2"><a href="<?php echo base_url().'login'?>"><i class="fa fa-lock"></i> Logout</a></li>  
            </ul>
        </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li><a href="<?php echo site_url('pp/index_home'); ?>"><i class="fa fa-home nav_icon"></i>Home</a></li> 
                <li><a href="<?php echo site_url('pp/index_status'); ?>"><i class="fa fa-desktop nav_icon"></i>Status</a></li>
                <li><a href="<?php echo site_url('pp/add_pendaftaran'); ?>"><i class="fa fa-desktop nav_icon"></i>Pendaftaran</a></li>
                <li><a href="<?php echo site_url('pp/index_minta_cari'); ?>"><i class="fa fa-desktop nav_icon"></i>Permintaan</a></li>
            </ul>
        </div>
    </div>
</nav>
<div id="page-wrapper">
    <div class="col-md-12 graphs">   