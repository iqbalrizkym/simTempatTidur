<!DOCTYPE HTML>
<html>
<head>
  <title>HBMIS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Rumah Sakit, Tempat Tidur Rumah Sakit, RSU Islam Harapan Anda, Manajemen Tempat Tidur" />
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <link href="<?php echo base_url()?>asset/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
  <!-- Custom CSS -->
  <link href="<?php echo base_url()?>asset/css/style.css" rel='stylesheet' type='text/css' />
  <link href="<?php echo base_url()?>asset/css/font-awesome.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="<?php echo base_url()?>asset/js/jquery-1.12.4.js"></script>
  <script src="<?php echo base_url()?>asset/js/jquery.min.js"></script>
  <script src="<?php echo base_url()?>asset/js/bootstrap.min.js"></script>
  <!----webfonts--->
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
</head>
<body id="login">
  <div class="login-logo">
    <h1 style="color:rgb(51, 122, 183);">Sistem Informasi Manajemen Tempat Tidur Rumah Sakit </br>RSU Islam Harapan Anda</h1>
  </div>
  <h2 class="form-heading">Masukkan Akun Anda</h2>
  <div class="app-cam">
    <?php echo form_open('login/proses_login'); ?>
    <form>
      <input type="text" class="text" value="Username" name="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
      <input type="password" value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
      <div class="submit"><input type="submit" value="Login"></div>
      <div class="login-social-link">
        <a href="<?php echo site_url('pengunjung'); ?>" class="twitter">Dashboard</a>
      </div>
    </form>
    <?php echo form_close(); ?> 
    <?php if(isset($pesan)){ echo $pesan; } ?>
  </div>
  <div class="copy_layout login">
    <p>Copyright © 2018 Sistem Informasi Manajemen Tempat Tidur Rumah Sakit Umum Islam Harapan Anda Tegal</p>
  </div>
</body>
</html>