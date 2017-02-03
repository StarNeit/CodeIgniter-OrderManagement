<div class="page-sidebar" id="sidebar">
	<!-- Sidebar Menu -->
	<ul class="nav sidebar-menu">
		<!--Dashboard-->
		<li <?=$this->uri->segment(2)=='dashboard'||!$this->uri->segment(2)?'class="active"':''?>>
			<a href="<?=admin_url('dashboard')?>">
				<i class="menu-icon glyphicon glyphicon-home"></i>
				<span class="menu-text"> Dashboard </span>
			</a>
		</li>
		<li <?=$this->uri->segment(2)=='operations'?'class="active"':''?>>
			<a href="<?=admin_url('operations')?>">
				<i class="menu-icon fa fa-gears"></i>
				<span class="menu-text"> Operations </span>
			</a>
		</li>
		<!--Databoxes-->
		<li <?=$this->uri->segment(2)=='carepro'?'class="active"':''?>>
			<a href="<?=admin_url('carepro')?>">
				<i class="menu-icon fa fa-heartbeat"></i>
				<span class="menu-text"> CarePro </span>
			</a>
		</li>
		<!--Widgets-->
		<li <?=$this->uri->segment(2)=='client'?'class="active"':''?>>
			<a href="<?=admin_url('client')?>">
				<i class="menu-icon fa fa-user"></i>
				<span class="menu-text"> Client </span>
			</a>
		</li>
		<!--Profile-->
		<li <?=$this->uri->segment(2)=='recipients'?'class="active"':''?>>
			<a href="<?=admin_url('recipients')?>">
				<i class="menu-icon fa fa-file-text"></i>
				<span class="menu-text"> Recipients </span>
			</a>
		</li>
		<li <?=$this->uri->segment(2)=='visits'?'class="active"':''?>>
			<a href="<?=admin_url('visits')?>">
				<i class="menu-icon fa fa-eye"></i>
				<span class="menu-text"> Visits </span>
			</a>
		</li>
		<li <?=$this->uri->segment(2)=='schedule'?'class="active"':''?>>
			<a href="<?=admin_url('schedule')?>">
				<i class="menu-icon fa fa-calendar"></i>
				<span class="menu-text"> Schedule </span>
			</a>
		</li>
		<!--Calendar-->
		<li <?=$this->uri->segment(2)=='billing'?'class="active"':''?>>
			<a href="<?=admin_url('billing')?>">
				<i class="menu-icon fa fa-money"></i>
				<span class="menu-text"> Billing </span>
			</a>
		</li>
		<li>
			<a>
				<i class="menu-icon fa fa-edit"></i>
				<span class="menu-text"> Staff Management </span>
			</a>
		</li>
		<li>
			<a href="<?=site_url('admin/auth/logout')?>">
				<i class="menu-icon fa fa-sign-out"></i>
				<span class="menu-text">Logout</span>
			</a>
		</li>
	</ul>
	<!-- /Sidebar Menu -->
</div>