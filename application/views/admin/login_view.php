<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=base_url()?>" />
	<meta charset="utf-8" />
	<title>Login Page</title>

	<meta name="description" content="login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="assets/admin/img/favicon.png" type="image/x-icon">

	<!--Basic Styles-->
	<link href="assets/admin/css/bootstrap.min.css" rel="stylesheet" />
	<link id="bootstrap-rtl-link" href="" rel="stylesheet" />
	<link href="assets/admin/css/font-awesome.min.css" rel="stylesheet" />

	<!--Fonts-->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

	<!--Beyond styles-->
	<link id="beyond-link" href="assets/admin/css/beyond.min.css" rel="stylesheet" />
	<link href="assets/admin/css/demo.min.css" rel="stylesheet" />
	<link href="assets/admin/css/animate.min.css" rel="stylesheet" />
	<link id="skin-link" href="" rel="stylesheet" type="text/css" />

	<!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
	<script src="assets/admin/js/skins.min.js"></script>
        <script src="assets/admin/js/main.js"></script>
</head>
<!--Head Ends-->
<!--Body-->
<body>
    <?=form_open(admin_url("auth/try_login"),array('id' => 'admin_login'))?> 
<div class="login-container animated fadeInDown">
	<div class="loginbox bg-white" style="height:auto !important">
		<div class="loginbox-title">SIGN IN</div>
                <div><?=show_message()?></div>
		<div class="loginbox-textbox">
			<input type="text" name="username" class="form-control" placeholder="Username" />
		</div>
		<div class="loginbox-textbox">
			<input name="password" type="password" class="form-control" placeholder="Password" />
		</div>
		<div class="loginbox-forgot">
			<a href="javascript:void(0)">Forgot Password?</a>
		</div>
		<div class="loginbox-submit">
<!--			<input type="button" class="btn btn-primary btn-block" value="Login" onclick="window.location='dashboard.html'">-->
                        <button type="submit" class="btn btn-primary btn-block">Login</button><br/><br/>
		</div>
		<!--            <div class="loginbox-signup">
						<a href="register.html">Sign Up With Email</a>
					</div>-->
	</div>
<!--	<div class="logobox">
	</div>-->
</div>
<?=form_close()?>
<!--Basic Scripts-->
<script src="assets/admin/js/jquery-2.0.3.min.js"></script>
<script src="assets/admin/js/bootstrap.min.js"></script>
<script src="assets/admin/js/slimscroll/jquery.slimscroll.min.js"></script>

<!--Beyond Scripts-->
<script src="assets/admin/js/beyond.js"></script>

<!--Google Analytics::Demo Only-->
<script>
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date(); a = s.createElement(o),
			m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'http://www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-52103994-1', 'auto');
	ga('send', 'pageview');

</script>
</body>
<!--Body Ends-->
</html>

