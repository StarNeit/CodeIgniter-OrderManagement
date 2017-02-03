<? $func = $this->uri->rsegment(2);?>
<ul class="nav nav-tabs" id="myTab7">
	<li class="<?=$func == 'details' ? 'active' : ''?>">
		<a href="<?=admin_url("client/details/$user->id")?>">
			Personal Info
		</a>
	</li>
	<?if($user->id):?>
                <li class="<?=$func == 'recipient' ? 'active' : ''?>">
			<a href="<?=admin_url("client/recipient/$user->id")?>">
				Care Recipient
			</a>
		</li>
		<li class="<?=$func == 'payment' ? 'active' : ''?>">
			<a href="<?=admin_url("client/payment/$user->id")?>">
				Payment
			</a>
		</li>
		<li class="<?=$func == 'account' ? 'active' : ''?>">
			<a href="<?=admin_url("client/account/$user->id")?>">
				Account
			</a>
		</li>
	<?endif?>
</ul>