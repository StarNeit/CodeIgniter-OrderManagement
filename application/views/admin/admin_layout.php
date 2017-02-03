<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="sidebar-left-collapsed">
<!--<![endif]-->
<head>
	
	<? $this->load->view('admin/admin_header')?>

</head>
<body>

	<section class="body">

		<!-- start: header -->
		<? $this->load->view('admin/topmenu_view')?>
		<!-- end: header -->

		<div class="inner-wrapper">
			
			<? $this->load->view('admin/sidebar_view')?>

			<section role="main" class="content-body">
				<header class="page-header">
					<h2><?=isset($title) ? $title :''?> <? if(isset($subtitle)):?> <small><?=$subtitle?></small><?endif?></h2>
				
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="<?=admin_url()?>">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span><?=$title?></span></li>
						</ol>
						&nbsp;				
						&nbsp;				
						&nbsp;				
					</div>
				</header>


				<!--  general messages-->
				<div id="message"><?show_message()?></div>
				<!-- end general messages -->

				<!-- page content -->
				<? $this->load->view($view_file)?>
				<!-- end page content -->

			</section>
		</div>

	
	</section>
	
	
	<? $this->load->view('admin/admin_footer')?>

</body>	

</html>
