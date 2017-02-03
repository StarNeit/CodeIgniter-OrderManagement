<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">
	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">

				<ul class="nav nav-main">
					<li><a href="<?=base_url()?>"><i class="fa fa-external-link"></i> <span>Front End</span></a></li>										
					<? $menus = $this->util->menus_permissions(conf('menus'), $this->permissions)?>
					<?foreach($menus as $uri => $menu):?>
						<? $subitems = element('items', $menu);?>
						<li class="<?=$subitems ? 'nav-parent' : ''?>">
							<a href="<?=$subitems ? 'javascript:;' : admin_url($uri)?>">
								
								<?if($icon = element('icon', $menu)):?>
									<i class="fa <?=$icon?>" aria-hidden="true"></i>
								<?endif?>
								<span><?=$menu['label']?></span>
							</a>

							<?if($subitems): //build subitems?>
								<ul class="nav nav-children">
								<?foreach($subitems as $uri =>$menu):?>
									<li>
										<a href="<?=admin_url($uri)?>">
											<?=$menu['label']?>
										</a>
									</li>
								<?endforeach?>
								</ul>
							<?endif?>
						
						</li>
					<?endforeach?>
				</ul>
			</nav>
		</div>				
	</div>	
</aside>			