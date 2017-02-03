<? $func = $this->uri->rsegment(2);?>
<ul class="nav nav-tabs" id="myTab7">
    <li class="<?=$func=='detail' ? 'active' : 'tab-red'?>">
        <a href="<?= admin_url('visits/detail/'.$visit->id) ?>">
            Detail
        </a>
    </li>
    <li class="<?=$func=='visit' ? 'active' : 'tab-red'?>">
        <a href="<?= $visit->status=='Completed' ? admin_url('visits/visit/'.$visit->id):'javascript:void(0)' ?>">
            Visit
        </a>
    </li>
    <li class="<?=$func=='review' ? 'active' : 'tab-red'?>">
        <a href="<?= $visit->status=='Completed' ? admin_url('visits/review/'.$visit->id):'javascript:void(0)' ?>">
            Review
        </a>
    </li>
</ul>