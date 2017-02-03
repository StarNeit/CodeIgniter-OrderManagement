<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=admin_url()?>">Home</a>
            </li>
            <li><a href="<?=admin_url("recipients")?>">Recipients</a></li>
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
		<!-- Tabs -->
                <ul class="nav nav-tabs" id="myTab7">
                <li class="tab-red">
                    <a href="javascript:void(0)">
                        Personal Info
                    </a>
                </li>
                <li class="tab-red">
                    <a href="<?=admin_url("recipients/visit_request/$recipient->id")?>">
                        Visit Request
<!--                        <span class="badge badge-success">
                            1
                        </span>-->
                    </a>
                </li>
                <li class="active">
                    <a href="<?=admin_url('recipients/history/'.$recipient->id)?>">
                        Visit History
                    </a>
                </li>
            </ul>
		<div class="tabbable2">
			<div class="tab-content radius-bordered">
				
				<table class="table table-striped">
					<thead>
					<tr>		
						<th>#</th>	
						<th>Visit Date</th>	
						<th>Service</th>
						<th>Skills</th>
                                                <th>Status</th>	
						
						<th>Options</th>
					</tr>
					</thead>
					<tbody>
					<? foreach($items as $index => $item):?> 
					<tr>	
						<td><?= $index+1?></td>
						<td><?= hdate($item->visit_from)?></td>
						<td><?=implode(',', $item->services)?></td>
						<td><?=implode(',',$item->skills)?></td>
                                                <td><?= $item->status?></td>
						<td>	
                                                   <a href="<?=admin_url('visits/edit/'.$item->id)?>">Edit</a>
						</td>
					</tr>
					<? endforeach;?>
					<? if(count($items)==0):?> 
						<tr>
					    	<td colspan="20" class="alert alert-warning text-center">No data found</td>
						</tr>
					<? endif?>	
					</tbody>
				</table>
				
				<? $this->load->view("admin/pagination_view")?>

			</div>
		</div>
	</div>
</div>

