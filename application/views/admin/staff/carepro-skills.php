
		<!-- Page Content -->
		<div class="page-content">
			<!-- Page Breadcrumb -->
			<div class="page-breadcrumbs">
				<ul class="breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="#">Home</a>
					</li>
					<li><a href="carepro_view.html">CarePro</a></li>
					<li class="active">Lim Ai Xian</li>
				</ul>
			</div>
			<!-- /Page Breadcrumb -->
			<!-- Page Header -->
			<div class="page-header position-relative">
				<div class="header-title">
					<h1>
						Lim Ai Xian
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
								<li class="tab-red">
									<a href="<?=admin_url('carepro/1')?>">
										Personal Info
									</a>
								</li>
								<li  class="active">
									<a href="<?=admin_url('carepro/1/skills')?>">
										Skills & Qualifications
									</a>
								</li>
								<li class="tab-red">
									<a href="<?=admin_url('carepro/1/background')?>">
										Background Check
									</a>
								</li>
								<li class="tab-red">
									<a href="<?=admin_url('carepro/1/documents')?>">
										Documents
									</a>
								</li>
								<li class="tab-red">
									<a href="<?=admin_url('carepro/1/payment')?>">
										Payment
									</a>
								</li>
							</ul>

							<div class="tab-content radius-bordered">
								<div class="tab-pane in active">
									<!--Registration Form Starts-->
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-xs-12">


											<form id="registrationForm" method="post" class="form-horizontal"
												  data-bv-message="This value is not valid"
												  data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
												  data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
												  data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">

												<div class="form-title">
													Certification Information
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 skills">
															What kind of caregiving training/experience do you have?<br/>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Certification in Nursing</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Certification in Caregiving</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Formal CPR/BCLS Certification</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Formal First Aid Certification</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Others</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">NA</span>
																</label>
															</div>
														</div>
													</div>
												</div>
												<br/>

												<div class="form-title">
													Type of Certification(s) Obtained
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" name="OTrate" placeholder="Certification Name"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-2 control-label no-padding-right">From</label>
																<div class="col-sm-10">
																	<div class="btn-group"> <!-- group container for buttons merging -->
																		<div class="btn-group">
																			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
																				07
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu">
																				<li><a href="#">08</a></li>
																			</ul>
																		</div>
																		<div class="btn-group">
																			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
																				2020
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu">
																				<li><a href="#">2021</a></li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-2 control-label no-padding-right">From</label>
																<div class="col-sm-10">
																	<div class="btn-group"> <!-- group container for buttons merging -->
																		<div class="btn-group">
																			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
																				07
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu">
																				<li><a href="#">08</a></li>
																			</ul>
																		</div>
																		<div class="btn-group">
																			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
																				2020
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu">
																				<li><a href="#">2021</a></li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group btn-add-minus">
																<a class="btn btn-blue btn-xs icon-only white" href="javascript:void(0);"><i class="fa fa-plus"></i></a>
																<a class="btn btn-xs icon-only" href="javascript:void(0);"><i class="fa fa-minus"></i></a>
															</div>
														</div>
													</div>
												</div>
												<br/>

												<div class="form-title">
													Caregiving Experience
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 experience">
															Kindly indicate your experience taking care of patient(s) with the following conditions/artificial devices:<br/>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">ALS</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Palliative</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Incontinence</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Multiple sclerosis</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Prosthetics</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Parkinson’s</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Seizures</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Skin/wound condition</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Stroke</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Alzheimer’s</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Trachea</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Other</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Dementia</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">COPD</span>
																</label>
															</div>
														</div>
													</div>
												</div>
												<br/>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12">
															Please provide a brief summary of your experience:<br/><br/>
															<textarea rows="5" cols="5" class="form-control"></textarea>
														</div>
													</div>
												</div>
												<br/>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 care-services">
															How many years of caregiving experience do you have?<br/>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Less than 1 year</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">1 - 3 years</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">3 - 5 years</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">5 - 10 years</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">More than 10 years</span>
																</label>
															</div>
														</div>
													</div>
												</div>
												<br/>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 activities">
															Kindly indicate activities that you have assisted patient(s)/senior(s) from your past experience:<br/>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Bathing</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Wheelchair transfer</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Assisting patients with ambulation</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Hospice care</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Personal Care</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Meal preparation</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Medication adherence</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Overnight surveillance</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Groceries and shopping</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Toileting</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Transferring</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Companionship</span>
																</label>
															</div>
														</div>
													</div>
												</div>

												<div class="form-title">
												</div>
												<div class="form-group">
													<div class="col-lg-6 pull-right">
														<input class="btn btn-palegreen pull-right" type="submit" value="Save" />
													</div>
												</div>
											</form>

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
</div>
<!-- /Page Container -->
<!-- Main Container -->

</div>

<!--Basic Scripts-->
<script src="assets/admin/js/jquery-2.0.3.min.js"></script>
<script src="assets/admin/js/bootstrap.min.js"></script>
<script src="assets/admin/js/slimscroll/jquery.slimscroll.min.js"></script>

<!--Beyond Scripts-->
<script src="assets/admin/js/beyond.js"></script>

<!--Easy Pie Charts Needed Scripts-->
<script src="assets/admin/js/charts/easypiechart/jquery.easypiechart.js"></script>
<script src="assets/admin/js/charts/easypiechart/easypiechart-init.js"></script>




<!--Google Analytics::Demo Only-->
<script>
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date(); a = s.createElement(o),
			m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'http://www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-52103994-1', 'auto');
	ga('send', 'pageview');

</script>
