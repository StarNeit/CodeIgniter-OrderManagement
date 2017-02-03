
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
								<li class="tab-red">
									<a href="<?=admin_url('carepro/1/skills')?>">
										Skills & Qualifications
									</a>
								</li>
								<li class="active">
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
													Criminal Record Check
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 skills">
															Have you ever been convicted of a crime in and / or outside Singapore?<br/>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Yes</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">No</span>
																</label>
															</div>
														</div>
													</div>
												</div>
												<br/>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12">
															If your answer is Yes, please give details of the nature and circumstances of the crime(s), the date and the location in which each crime occurred.<br/><br/>
															<textarea rows="5" cols="5" class="form-control"></textarea>
														</div>
													</div>
												</div>
												<br/>
												<div class="form-title">
													Contact Reference No.1
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">Name: </label>
																<input type="text" class="form-control" name="fullname" value="Magaritha Quek"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cardInput">Relationship: </label>
																<input type="text" class="form-control" name="cardno" value="Ex-Colleague"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cvcInput">Contact Number: </label>
																<input type="text" class="form-control" name="cvc" value="+65 9123 8123"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cvcInput">Email Address: </label>
																<input type="text" class="form-control" name="cvc" value="example@email.com"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
													</div>
												</div>

												<div class="form-title">
													Contact Reference No.2
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">Name: </label>
																<input type="text" class="form-control" name="fullname" value="John Lim"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cardInput">Relationship: </label>
																<input type="text" class="form-control" name="cardno" value="Ex-Colleague"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cvcInput">Contact Number: </label>
																<input type="text" class="form-control" name="cvc" value="+65 9123 8123"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cvcInput">Email Address: </label>
																<input type="text" class="form-control" name="cvc" value="example@email.com"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
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