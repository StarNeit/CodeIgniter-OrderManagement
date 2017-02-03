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
				<div class="row">
					<div class="col-lg-12">
						<div class="tabbable">
							<ul class="nav nav-tabs" id="myTab7">
								<li class="active">
									<a href="<?=site_url('admin/carepro')?>">
										Approved Care Pro
									</a>
								</li>

								<li class="tab-red">
									<a href="<?=site_url('admin/carepro/new')?>">
										New Registration
                                            <span class="badge badge-success">
                                                4
                                            </span>
									</a>
								</li>
							</ul>

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
								</div>
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-xs-12">
										<div class="table-responsive">
											<table class="table table-hover table-striped">
												<thead class="bordered-palegreen">
												<tr>
													<th>
														#
													</th>
													<th>
														Name
													</th>
													<th>
														No. of Visits
													</th>
													<th>
														Start Date
													</th>
													<th>
														Rating (Out of 5)
													</th>
													<th>
														Status
													</th>
												</tr>
												</thead>
												<tbody>

												<? foreach ($careproList AS $key => $carepro)
												{
													?>
													<tr>
													<td>
														<? echo $key + 1 ?>
													</td>
													<td>
														<a href="<?=admin_url('carepro/'.$carepro->id)?>"><? echo $carepro->first_name . ' ' . $carepro->last_name?></a>
													</td>
													<td>
														5
													</td>
													<td class="numeric">
														<? echo date_format(date_create($carepro->verified_at), "d-M-y") ?>
													</td>
													<td class="numeric">
														4.3
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<?
												}
												?>

												<tr>
													<td>
														1
													</td>
													<td>
														<a href="<?=admin_url('carepro/1')?>">Lim Ai Xian</a>
													</td>
													<td>
														5
													</td>
													<td class="numeric">
														03-May-16
													</td>
													<td class="numeric">
														4.3
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														2
													</td>
													<td>
														<a href="<?=admin_url('carepro/2')?>">Emanuel Lim</a>
													</td>

													<td class="numeric">
														10
													</td>
													<td class="numeric">
														04-Apr-16
													</td>
													<td class="numeric">
														3
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														3
													</td>
													<td>
														<a href="<?=admin_url('carepro/3')?>">Ashley Tay</a>
													</td>
													<td class="numeric">
														11
													</td>
													<td class="numeric">
														03-Mar-16
													</td>
													<td class="numeric">
														4.8
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														4
													</td>
													<td>
														<a href="carepro_detail.html">Ash Keng</a>
													</td>
													<td>
														11
													</td>
													<td class="numeric">
														02-Dec-15
													</td>
													<td class="numeric">
														4.9
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														5
													</td>
													<td>
														<a href="carepro_detail.html">Siti Nurashafiqah</a>
													</td>
													<td>
														15
													</td>
													<td class="numeric">
														07-Nov-15
													</td>

													<td class="numeric">
														3.2
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														6
													</td>
													<td>
														<a href="carepro_detail.html">Siti Nurashafiqah</a>
													</td>
													<td>
														15
													</td>
													<td class="numeric">
														07-Nov-15
													</td>

													<td class="numeric">
														3.2
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														7
													</td>
													<td>
														<a href="carepro_detail.html">Siti Nurashafiqah</a>
													</td>
													<td>
														15
													</td>
													<td class="numeric">
														07-Nov-15
													</td>

													<td class="numeric">
														3.2
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														8
													</td>
													<td>
														<a href="carepro_detail.html">Siti Nurashafiqah</a>
													</td>
													<td>
														15
													</td>
													<td class="numeric">
														07-Nov-15
													</td>

													<td class="numeric">
														3.2
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														9
													</td>
													<td>
														<a href="carepro_detail.html">Siti Nurashafiqah</a>
													</td>
													<td>
														15
													</td>
													<td class="numeric">
														07-Nov-15
													</td>

													<td class="numeric">
														3.2
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														10
													</td>
													<td>
														<a href="carepro_detail.html">Siti Nurashafiqah</a>
													</td>
													<td>
														15
													</td>
													<td class="numeric">
														07-Nov-15
													</td>

													<td class="numeric">
														3.2
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														11
													</td>
													<td>
														<a href="carepro_detail.html">Siti Nurashafiqah</a>
													</td>
													<td>
														15
													</td>
													<td class="numeric">
														07-Nov-15
													</td>

													<td class="numeric">
														3.2
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												<tr>
													<td>
														12
													</td>
													<td>
														<a href="carepro_detail.html">Siti Nurashafiqah</a>
													</td>
													<td>
														15
													</td>
													<td class="numeric">
														07-Nov-15
													</td>

													<td class="numeric">
														3.2
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
													</td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!--/Registration Form Ends-->
							</div>
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
</div>
<!-- /Page Container -->
<!-- Main Container -->

</div>

</div>
<!-- /Page Body -->
</div>
<!-- /Page Content -->
