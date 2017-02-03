<!-- Page Content -->
<div class="page-content">
	<!-- Page Breadcrumb -->
	<div class="page-breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">Cases</li>
		</ul>
	</div>
	<!-- /Page Breadcrumb -->
	
	<!-- Page Header -->
	<div class="page-header position-relative">
		<div class="header-title">
			<h1>
				Care Pro
			</h1>
		</div>
	</div>		
	<!-- /Page Header -->

	<!-- Page Body -->
	<div class="page-body">
		<!-- Tabs -->
		
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="<?=$tab == 'placed' ? 'active' : ''?>">
					<a href="<?=admin_url('carepro')?>">
						Approved Care Pro
						<span class="badge badge-success">
							<?=$count_approved?>
						</span>
					</a>
				</li>

				<li class="<?=$tab == 'applicant' ? 'active' : ''?>">
					<a href="<?=admin_url('carepro/index/applicant')?>">
						Applicant
						<span class="badge badge-success">
							<?=$count_applicants?>
						</span>
					</a>
				</li>
				<li class="<?=$tab == 'rejected' ? 'active' : ''?>">
					<a href="<?=admin_url('carepro/index/rejected')?>">
						Blacklisted
						<span class="badge badge-success">
							<?=$count_rejected?>
						</span>
					</a>
				</li>
				<li class="<?=$tab == 'add' ? 'active' : ''?>">
					<a href="<?=admin_url("carepro/add")?>">
						<i class="fa fa-plus"></i>
						New Care Pro
					</a>
				</li>
			</ul>

			<div class="tab-content radius-bordered">
				<div class="tab-pane in active">
					<!--Registration Form Starts-->
					<?if($tab == 'applicant'):?>
					<form action="<?=admin_url("carepro/index/applicant")?>" method="get">
					<?else:?>
					<form action="<?=admin_url("carepro")?>" method="get">
					<?endif?>

					
						<div class="row">
							<div class="form-group col-lg-3">
								<span class="input-icon inverted">
									<input type="text" name="q" value="<?=$keyword=='Nil'?'':$keyword?>" class="form-control input-sm">
									<i class="glyphicon glyphicon-search bg-blue"></i>
								</span>
							</div>
							<?if($tab == 'applicant'):?>
								<div class="form-group col-lg-3">
									<span class="input-icon inverted">
										Status: 
										<?=form_dropdown('status', applicant_status_options(), $this->input->get('status'), 'onchange="this.form.submit()"');?>
									</span>
								</div>
							<?endif?>
						</div>
					</form>
				</div>
				
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead class="bordered-palegreen">
							<tr>
								<th>#</th>
								<th class="asc" data-orderby="first_name">Name</th>
								<th class="asc" data-orderby="nationality">Nationality</th>
								<th class="asc" data-orderby="dob">Date of Birth</th>
								<th>Application Date</th>
                                <th>Application Status</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
                                                    <?$total = $this->uri->segment(8)==''?0: ($this->uri->segment(8))?>
                                                    <?if(count($items)>0):?>
							<?foreach ($items as $index => $item):?>											
							<tr>
								<td><?=++$total ?></td>
								<td>
									<a href="<?=admin_url('carepro/details/'.$item->id)?>">
										<?=$item->first_name . ' ' . $item->last_name?>
									</a>
								</td>
								<td class="numeric"><?=$item->nationality?></td>
								<td class="numeric"><?=hdate($item->dob)?></td>
                                                                <td><?=hdate($item->registered_at)?></td>
                                                                <td>
                                                                    <?if($item->application_status=='Placed'):?>
                                                                        Approved
                                                                    <?elseif($item->application_status=='Rejected'):?>
                                                                        Blacklisted
                                                                    <?else:?>
                                                                        <?=$item->application_status?>
                                                                    <?endif?>
                                                                    
                                                                </td>
								<td>		
									<a href="javascript:;" onclick="Activate('<?=$item->id?>', this)" title="activate/deactivate" class="<?= $item->is_active ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-off'?>"></a>					
								</td>
							</tr>
							<?endforeach?>
                                                    <?else:?>
                                                    <tr><td colspan="8" align="center">No Record Found!</td></tr>
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
	<br/><br/>
	<!--/tabs-->
</div>




<script type="text/javascript">
<!--
	
	 function Activate(id, obj)
	 {
	 	SimpleActivate(id, obj, admin_url+"carepro/activate");
	 }

// -->
order_by = '<?=$orderby?>';
order = '<?=$order?>';
keyword = '<?=$keyword=='Nil'?'':$keyword?>';
$('.table thead th[data-orderby="'+order_by+'"]').removeClass();
$('.table thead th[data-orderby="'+order_by+'"]').addClass(order);
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