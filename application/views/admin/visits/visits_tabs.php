<? $func = $this->uri->rsegment(3);?>
<ul class="nav nav-tabs" id="myTab7">
	<li class="<?=$func == ''||$func=='pending' ? 'active' : 'tab-red'?>">
		<a href="<?=admin_url('visits')?>">
			Pending
            <span class="badge badge-success">
                <?=$count_pending?>
            </span>
		</a>
	</li>

	<li class="<?=$func=='assigned' ? 'active' : 'tab-red'?>">
		<a href="<?=admin_url('visits/assigned')?>">
			Assigned
                <span class="badge badge-success">
                    <?=$count_assigned?>
                </span>
		</a>
	</li>
	<li class="<?=$func=='completed' ? 'active' : 'tab-red'?>">
		<a href="<?=admin_url('visits/completed')?>">
			Completed
                <span class="badge badge-success">
                    <?=$count_completed?>
                </span>
		</a>
	</li>
</ul>