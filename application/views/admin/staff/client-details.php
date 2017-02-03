
		<!-- Page Content -->
		<div class="page-content">
			<!-- Page Breadcrumb -->
			<div class="page-breadcrumbs">
				<ul class="breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="#">Home</a>
					</li>
					<li><a href="client_view.html">Clients</a></li>
					<li class="active">Lim Keng Siang</li>
				</ul>
			</div>
			<!-- /Page Breadcrumb -->
			<!-- Page Header -->
			<div class="page-header position-relative">
				<div class="header-title">
					<h1>
						Lim Keng Siang
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
									<a href="<?=admin_url('client/2')?>">
										Personal Info
									</a>
								</li>

								<li class="tab-red">
									<a href="<?=admin_url('client/2/payment')?>">
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
													Basic Information
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-1">
															<div class="form-group">
																<label for="registrationInput">Salutation</label>
																<div class="input-group-btn">
																	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Mr <span class="caret"></span></button>
																	<ul class="dropdown-menu">
																		<li><a href="#">Ms</a></li>
																		<li class="divider"></li>
																		<li><a href="#">Mrs</a></li>
																		<li class="divider"></li>
																		<li><a href="#">Mdm</a></li>
																		<li class="divider"></li>
																		<li><a href="#">Dr</a></li>
																	</ul>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">First Name:</label>
																<input type="text" class="form-control" name="firstName" placeholder="First Name"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">

																<label for="nameInput">Last Name:</label>
																<input type="text" class="form-control" name="lastName" placeholder="Last Name"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="regidateInput">Registration Date:</label>
																<div class="input-group">
																	<input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="form-title">
													Contact Information
												</div>

												<div class="row">
													<div class="col-lg-12">

														<div class="col-lg-3">
															<div class="form-group">
																<label for="emailInput">Email: </label>
																<input type="text" class="form-control" name="email" placeholder="example@mail.com"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="mobileInput">Home:</label>
																<input type="text" class="form-control" name="mobile" placeholder="+99-9999-9999" data-mask="+99-9999-9999"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="mobileInput">H/P:</label>
																<input type="text" class="form-control" name="mobile" placeholder="+99-9999-9999" data-mask="+99-9999-9999"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">Postal Code: </label>
																<input type="text" class="form-control" name="fullname" value="123456"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cardInput">Unit. No: </label>
																<input type="text" class="form-control" name="cardno" value="#00-0000"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cvcInput">Block No.: </label>
																<input type="text" class="form-control" name="cvc" value="123"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cvcInput">Street: </label>
																<input type="text" class="form-control" name="cvc" value="Street Name Avenue 123"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
													</div>
												</div>
												<div class="form-title">
													Care Recipient(s)
												</div>

												<div class="profile-container">
													<div class="profile-header row">
														<div class="col-lg-2 col-md-4 col-sm-12 text-center">
															<img src="assets/admin/img/avatars/hongsiew.jpg" alt="" class="header-avatar" />
														</div>
														<div class="col-lg-5 col-md-8 col-sm-12 profile-info">
															<div class="header-fullname">Siah Hong Siew</div>
															<div>(Relationship to Client: Mother)</div>
															<div class="header-information">
																Lorem ipsum dolor sit amet consectur adipiscing elit. Morbi in pulvinar urna.
																Curabitur varius lectus eu libero ...
															</div>
															<br/>
															<a href="case_detail.html" class="btn btn-palegreen btn-sm btn-follow">
																<i class="fa fa-user"></i>
																View Profile
															</a>
														</div>
														<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
															<div class="row">
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value palegreen">3</div>
																	<div class="stats-title">UPCOMING</div>
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value info">3</div>
																	<div class="stats-title">PENDING</div>
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value blueberry">12</div>
																	<div class="stats-title">COMPLETED</div>
																</div>
															</div>
															<div class="row">
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
																	<i class="glyphicon glyphicon-map-marker"></i> Punggol East
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
																	Rating: <strong>4.3 / 5</strong>
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
																	Age: <strong>62</strong>
																</div>
															</div>
														</div>
													</div>
												</div>
												<hr>
												<div class="profile-container">
													<div class="profile-header row">
														<div class="col-lg-2 col-md-4 col-sm-12 text-center">
															<img src="assets/admin/img/avatars/desmond.jpg" alt="" class="header-avatar" />
														</div>
														<div class="col-lg-5 col-md-8 col-sm-12 profile-info">
															<div class="header-fullname">Desmond Tan</div>
															<div>(Relationship to Client: Uncle)</div>
															<div class="header-information">
																Lorem ipsum dolor sit amet consectur adipiscing elit. Morbi in pulvinar urna.
																Curabitur varius lectus eu libero ...
															</div>
															<br/>
															<a href="#" class="btn btn-palegreen btn-sm btn-follow">
																<i class="fa fa-user"></i>
																View Profile
															</a>
														</div>
														<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
															<div class="row">
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value palegreen">3</div>
																	<div class="stats-title">UPCOMING</div>
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value info">3</div>
																	<div class="stats-title">PENDING</div>
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value blueberry">12</div>
																	<div class="stats-title">COMPLETED</div>
																</div>
															</div>
															<div class="row">
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
																	<i class="glyphicon glyphicon-map-marker"></i> Punggol East
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
																	Rating: <strong>4.3 / 5</strong>
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
																	Age: <strong>62</strong>
																</div>
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
