<!-- Page Content -->
<div class="page-content">
	<!-- Page Breadcrumb -->
	<div class="page-breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="<?=admin_url()?>">Home</a>
			</li>
			<li class="active">Visits</li>
		</ul>
	</div>
	<!-- /Page Breadcrumb -->
	<!-- Page Header -->
	<div class="page-header position-relative">
		<div class="header-title">
			<h1>
				Visits
			</h1>
		</div>
	</div>
	<!-- /Page Header -->
	<!-- Page Body -->
	<div class="page-body">
		<? $this->load->view("admin/cases/cases_tabs")?>
		<div class="tabbable">				

			<div class="tab-content radius-bordered">
				<div class="tab-pane in active">
					<!--Registration Form Starts-->
					<div class="row">
						<div class="form-group col-lg-3">
                                <span class="input-icon inverted">
                                    <input type="text" class="form-control input-sm">
                                    <i class="glyphicon glyphicon-search bg-blue"></i>
                                </span>
						</div>
					</div>
				

					<div class="table-responsive">
						<table class="table table-hover table-striped">
							<thead class="bordered-palegreen">
							<tr>
								<th>
									#
								</th>
								<th>
									Date Requested
								</th>
								<th>
									Care Recipient
								</th>
								<th>
									Visit No.
								</th>
								<th>
									Care Pro
								</th>
								<th>
									Payment
								</th>
							</tr>
							</thead>
							<tbody>
							<?foreach($items as $index =>  $item):?>
								<tr>
									<td>
										<?=$index+1?>
									</td>
									<td>
										<?=hdate($item->created_at)?>
									</td>
									<td>
										<a href="<?=admin_url("cases/details/$item->id")?>">
											<?=$item->full_name?>
										</a>
									</td>
									<td>
										02042016
									</td>
									<td>
										Pending
									</td>
									<td>
                                        <span class="badge badge-success">
                                            <i class="fa fa-check"></i>
                                        </span>
										100.00
									</td>
								</tr>
							<?endforeach?>
							<?if(!$items):?>
								<tr colspan="20"><td class="alert alert-info">No records were found</td></tr>
							<?endif?>							
							</tbody>
						</table>
					</div>
					
					<!--/Registration Form Ends-->
				</div>
			</div>
		</div>
		
		<br/><br/>
		<!--/tabs-->
	</div>
	<!-- /Page Body -->
</div>
<!-- /Page Content -->
