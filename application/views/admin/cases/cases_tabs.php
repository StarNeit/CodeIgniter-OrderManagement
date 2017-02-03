<?php $func = $this->uri->rsegment(2);?>
<ul class="nav nav-tabs" id="myTab7">
	<li class="<?=$func == 'details' ? 'active' : ''?>">
		<a href="<?=admin_url("cases/detail/$case->id")?>">
            Personal Info
        </a>
	</li>

	<li class="<?=$func == 'visit_request' ? 'active' : ''?>">
        <a href="<?=admin_url("cases/visit_request/$case->id")?>">
            Visit Request
        </a>
    </li>
	<li class="tab-red">
        <a href="javascript:void(0)">
            Visit History
        </a>
    </li>
</ul>