<div class="page-breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=admin_url()?>">Home</a>
		</li>
		<li><a href="<?=admin_url("client")?>">Clients</a></li>
		<li class="active"><?=$user->full_name?></li>
	</ul>
</div>

<div class="page-header position-relative">
	<div class="header-title">
		<h1>
			<?=$title ? $title: $user->full_name?>
		</h1>
	</div>
</div>
	