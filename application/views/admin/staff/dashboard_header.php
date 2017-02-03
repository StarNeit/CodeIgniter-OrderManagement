<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=base_url()?>" />
	<meta charset="utf-8" />
	<title><?=$title?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="assets/admin/img/favicon.png" type="image/x-icon">


	<!--Basic Styles-->
	<link href="assets/admin/css/bootstrap.min.css" rel="stylesheet" />
	<link id="bootstrap-rtl-link" href="" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link href="assets/admin/css/weather-icons.min.css" rel="stylesheet" />

	<!--Fonts-->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">
	<!--Beyond styles-->
	<link id="beyond-link" href="assets/admin/css/beyond.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/admin/css/demo.min.css" rel="stylesheet" />
	<link href="assets/admin/css/typicons.min.css" rel="stylesheet" />
	<link href="assets/admin/css/animate.min.css" rel="stylesheet" />
	<link id="skin-link" href="" rel="stylesheet" type="text/css" />

	<!--Custom styles-->
	<link href="assets/admin/css/custom.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="assets/admin/css/generic.css">

	<!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
	<script src="assets/admin/js/skins.min.js"></script>
	<script src="assets/admin/js/jquery-2.0.3.min.js"></script>
	<script src="assets/admin/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		var index_url = "<?=trim(site_url(),"/")."/"?>";
		var admin_url = "<?=trim(admin_url(), "/")."/" ?>";
		var base_url = "<?=base_url()?>";
		var csrf = "<?=$this->security->get_csrf_hash()?>";
    </script>
</head>
<!-- /Head -->
<!-- Body -->
<body>
<!-- Navbar -->
<div class="navbar">
	<div class="navbar-inner">
		<div class="navbar-container">
			<!-- Navbar Barnd -->
			<div class="navbar-header pull-left">
				<a href="#" class="navbar-brand">
					<small>
						<div class="logo"></div>
					</small>
				</a>
			</div>
			<!-- /Navbar Barnd -->
			<!-- Sidebar Collapse -->
			<div class="sidebar-collapse" id="sidebar-collapse">
				<i class="collapse-icon fa fa-bars"></i>
			</div>
			<!-- /Sidebar Collapse -->
		</div>
	</div>
</div>
<!-- /Navbar -->
<!-- Main Container -->
<div class="main-container container-fluid">
	<!-- Page Container -->
	<div class="page-container">