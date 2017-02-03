<? $func = $this->uri->rsegment(3);?>
<!-- Page Content -->
<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=admin_url()?>">Home</a>
            </li>
            <li class="active"><?=$title?></li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Header -->
    <div class="page-header position-relative">
        <div class="header-title">
            <h1>
                <?=$title?>
            </h1>
        </div>
    </div>
    <!-- /Page Header -->
    <!-- Page Body -->
    <div class="page-body">
        
        <div class="tabbable">              
            <? $this->load->view("admin/recipients/recipients_tabs")?>
            <div class="tab-content radius-bordered">
                <div class="tab-pane in active">
                    <!--Registration Form Starts-->
                    <form action="<?=admin_url("recipients")?>" method="get">
                       <div class="row">

                        <div class="form-group col-lg-3">
                            <span class="input-icon inverted">
                                    <input type="text" name="q" value="<?=$this->input->get('q')?>" class="form-control input-sm">
                                    <i class="glyphicon glyphicon-search bg-blue"></i>
                                </span>
                        </div>
                    </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="bordered-palegreen">
                                <tr>
                                    <th>#</th>
                                    <th>Recipient</th>
                                    <th>Client</th>
                                    <th>Services</th>
                                    <th>Skills</th>
                                    <?if($func!=''):?>
                                        <th>Upcoming</th>
                                        <th>Pending/Requested</th>
                                    <?endif?>
                                </tr>
                            </thead>
                            <tbody>
                                <?foreach($items as $item):?>
                                <tr>
                                    <td><?=$item->case_id?></td>
                                    <td>
                                        <a href="<?=admin_url("recipients/details/$item->case_id")?>">
                                            <?=$item->recipient?>
                                        </a>
                                    </td>                                   
                                    <td><?=$item->client?></td>
                                    <td><?=implode(', ', $item->services)?></td>
                                    <td><?=implode(', ',$item->skills)?></td>
                                    <?if($func!=''):?>
                                        <td><?=$item->upcoming?></td>
                                        <td><?=round($item->pending_requested, 2)?></td>
                                    <?endif?>
                                </tr>
                                <?endforeach?>
                                <?if(!$items):?>
                                <tr colspan="20"><td class="alert alert-info">No records were found</td></tr>
                                <?endif?>                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
        <br/><br/>
        <!--/tabs-->
    </div>
    <!-- /Page Body -->
</div>
<!-- /Page Content -->
