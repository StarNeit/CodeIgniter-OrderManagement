	<base href="<?=base_url()?>" />
	<meta charset="utf-8" />
	<title><?=isset($title) ? $title  : ''?> :: <?=conf('site_name')?></title>
	
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
	
	<link rel="stylesheet" href="assets/admin/css/generic.css">

	<!-- Head Libs -->
	<script src="assets/vendor/modernizr/modernizr.js"></script>

	<script src="assets/vendor/jquery/jquery.js"></script>

	
	<script type="text/javascript">
		var index_url = "<?=trim(site_url(),"/")."/"?>";
		var admin_url = "<?=trim(admin_url(), "/")."/" ?>";
		var base_url = "<?=base_url()?>";
		var csrf = "<?=$this->security->get_csrf_hash()?>";
    </script>
   
	
