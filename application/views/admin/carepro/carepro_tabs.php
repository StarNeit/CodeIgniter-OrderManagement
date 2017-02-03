<? $func = $this->uri->rsegment(2);?>
<ul class="nav nav-tabs" id="myTab7">
    <li class="<?=in_array($func, array('details', 'add')) ? 'active' : ''?>">
        <a href="<?=admin_url("carepro/details/$user->user_id")?>">
            Personal Info
        </a>
    </li>
    <?if($user->user_id):?>
        <li class="<?=$func == 'skills' ? 'active' : ''?>">
            <a href="<?=admin_url("carepro/skills/$user->user_id")?>">
                Skills & Qualifications
            </a>
        </li>
        <li class="<?=$func == 'background' ? 'active' : ''?>">
            <a href="<?=admin_url("carepro/background/$user->user_id")?>">
                Background Check
            </a>
        </li>
        <li class="<?=$func == 'documents' ? 'active' : ''?>">
            <a href="<?=admin_url("carepro/documents/$user->user_id")?>">
                Documents
            </a>
        </li>
         <li class="<?=$func == 'schedule' ? 'active' : ''?>">
            <a href="<?=admin_url("carepro/schedule/$user->user_id")?>">
                Schedule
            </a>
        </li>
        <?php /*<li class="<?=$func == 'payment' ? 'active' : ''?>">
            <a href="<?=admin_url("carepro/payment/$user->user_id")?>">
                Payment
            </a>
        </li>*/?>
        <li class="<?=$func == 'account' ? 'active' : ''?>">
            <a href="<?=admin_url("carepro/account/$user->user_id")?>">
                Account
            </a>
        </li>
    <?endif?>
</ul>