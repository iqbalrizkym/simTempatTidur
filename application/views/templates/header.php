<!DOCTYPE HTML>
<html>
<head>
	<title>HBMIS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Rumah Sakit, Tempat Tidur Rumah Sakit, RSU Islam Harapan Anda, Manajemen Tempat Tidur" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url()?>asset/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="<?php echo base_url()?>asset/css/style.css" rel='stylesheet' type='text/css' />
	<link href="<?php echo base_url()?>asset/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url()?>asset/css/dataTables.bootstrap.min.css" rel="stylesheet"> 
	<!-- jQuery -->
	<script src="<?php echo base_url()?>asset/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>asset/js/Chart.min.js"></script>
	<script src="<?php echo base_url()?>asset/js/jquery-1.12.4.js"></script>
	<script src="<?php echo base_url()?>asset/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url()?>asset/js/dataTables.bootstrap.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url()?>asset/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>asset/js/bootbox.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<script>
		$(document).on("click", "#alertDelete", function(e){
			e.preventDefault();
			var link = $(this).attr("href");
			bootbox.confirm("Anda ingin menghapus data ini ?", function(confirmed){
				if (confirmed){
					window.location.href = link;
				};
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">