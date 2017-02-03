<!-- Page Content -->
<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=admin_url()?>">Home</a>
            </li>
            <li class="active">Clients</li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Header -->
    <div class="page-header position-relative">
        <div class="header-title">
            <h1>
                Clients
            </h1>
        </div>
    </div>
    <!-- /Page Header -->
    <!-- Page Body -->
    <div class="page-body">

        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="<?=admin_url('client')?>">
                        Client List
                    </a>
                </li>
                <li>
                    <a href="<?=admin_url("client/add")?>">
                        <i class="fa fa-plus"></i>
                        New Client
                    </a>
                </li>
            </ul>

            <div class="tab-content radius-bordered">
                <div class="tab-pane in active">
                    <form action="<?=admin_url("client")?>" method="get">
                       <div class="row">

                        <div class="form-group col-lg-3">
                            <span class="input-icon inverted">
                                    <input type="text" name="q" value="<?=$keyword=='Nil'?'':$keyword?>" class="form-control input-sm">
                                    <i class="glyphicon glyphicon-search bg-blue"></i>
                                </span>
                        </div>
                    </div>
                    </form>


                    <div class="flip-scroll">
                        <table class="table table-striped table-condensed flip-content">
                            <thead class="flip-content bordered-palegreen">
                                <tr>
                                    <th>#</th>
                                    <th class="asc numeric" data-orderby="first_name">Name</th>
                                    <th class="asc numeric" data-orderby="contact_mobile">Phone</th>
                                    <th class="asc numeric" data-orderby="email">Email</th>
                                    <th class="asc numeric" data-orderby="registered_at">Registration Date</th>
                                    <th class="numeric">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?foreach ($items as $index => $item):?>         
                                <tr>
                                    <td><?=$index+1;?></td>
                                    <td>
                                        <a href="<?= admin_url("client/details/$item->id") ?>">
                                            <?=$item->first_name?> <?=$item->last_name?>
                                        </a>
                                    </td>
                                    <td><?=$item->contact_mobile?></td>
                                    <td>
                                        <?=$item->email?>
                                    </td>
                                    <td class="numeric">
                                        <?=hdate($item->registered_at)?>
                                    </td>
                                    <td>
                                        <a href="javascript:;" onclick="Activate('<?=$item->id?>', this)" title="activate/deactivate" class="<?= $item->is_active ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-off'?>"></a>		
                                    </td>
                                </tr>
                                <?endforeach?>

                                <?if(!$items):?>
                                    <tr><td colspan="6" align="center">No Record Found!</td></tr>
                                <?endif?>
                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">Total rows: <?= $this->pagination->total_rows?></div>
                        <?= $this->pagination->create_links();?>        
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
<!--
	
	 function Activate(id, obj)
	 {
	 	SimpleActivate(id, obj, admin_url+"client/activate");
	 }

// -->
order_by = '<?=$orderby?>';
order = '<?=$order?>';
keyword = '<?=$keyword=='Nil'?'':$keyword?>';
$('.table thead th[data-orderby="'+order_by+'"]').removeClass();
$('.table thead th[data-orderby="'+order_by+'"]').addClass(order);
$('.table thead th[data-orderby="'+order_by+'"]').addClass('numeric');
$('.table thead th[data-orderby]').click(function(e){
    var $this = $(this), 
        order_by = $this.data('orderby'), 
        myURL = '<?=$url?>', 
        order='';

    // Handle Asc and Desc
    if( $this.hasClass('asc') ) {
        order = 'desc';
    }
    else {
        order = 'asc';
    }

    document.location.href = myURL +'/'+order_by+'/'+order+'/'+keyword;
});
</script>

