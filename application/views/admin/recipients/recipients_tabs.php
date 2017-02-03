<? $func = $this->uri->rsegment(3);?>
<ul class="nav nav-tabs" id="myTab7">
	<li class="<?=$func == ''||$func!='reviewed' ? 'active' : 'tab-red'?>">
		<a href="<?=admin_url('recipients')?>">
			New Recipient
            <span class="badge badge-success">
                4
            </span>
		</a>
	</li>

	<li class="<?=$func=='reviewed' ? 'active' : 'tab-red'?>">
		<a href="<?=admin_url('recipients/reviewed')?>">
			Reviewed
                <span class="badge badge-success">
                    4
                </span>
		</a>
	</li>
</ul>