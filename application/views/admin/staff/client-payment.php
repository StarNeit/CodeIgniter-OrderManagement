
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
								<li class="tab-red">
									<a href="client_detail.html">
										Personal Info
									</a>
								</li>

								<li class="active">
									<a href="client_payment.html">
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
													Payment Method
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<div class="control-group">
																<div class="radio-inline">
																	<label>
																		<input name="form-field-radio" type="radio" class="colored-success" checked="checked">
																		<span class="text"> Credit Card</span>
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input name="form-field-radio" type="radio" class="colored-success">
																		<span class="text"> Offline Payment</span>
																	</label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">Full Name: </label>
																<input type="text" class="form-control" name="fullname" value="Jane Doe"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cardInput">Card Number: </label>
																<input type="text" class="form-control" name="cardno" value="5463 7123 1111 0000"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="cvcInput">CVC: </label>
																<input type="text" class="form-control" name="cvc" value="123"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<label for="registrationInput">Expiry Date</label><br/>
															<div class="btn-group"> <!-- group container for buttons merging -->
																<div class="btn-group">  <!-- button and dropdown group in one -->
																	<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
																		01
																		<span class="caret"></span>
																	</a>
																	<ul class="dropdown-menu">
																		<li><a href="#">02</a></li>
																	</ul>
																</div>
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

												<div class="form-title">
													Oustanding Payment
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-4 col-sm-6 col-xs-12">
															<div class="payment databox databox-halved databox-lg radius-bordered databox-shadowed">
																<div class="databox-left bg-pink">
																	<div class="databox-text white">UNPAID BALANCE</div>
																	<span class="databox-title white">SGD 500.00</span>
																</div>
																<div class="databox-right bg-white">
																	<a href="javascript:void(0);" class="btn btn-yellow">Send Reminder</a>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="form-title">
													Transaction
												</div>
												<div class="table-responsive">
													<table class="table table-hover table-striped">
														<thead class="bordered-palegreen">
														<tr>
															<th>
																Date
															</th>
															<th>
																Care Recipient
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
														<tr>
															<td>
																2-Apr-16
															</td>
															<td>
																Siah Hong Siew
															</td>
															<td>
																Lim Ai Xian
															</td>
															<td>
																SGD 100.00
															</td>
														</tr>
														<tr>
															<td>
																23-Mar-16
															</td>
															<td>
																Siah Hong Siew
															</td>
															<td>
																Nur Amelia
															</td>
															<td>
																SGD 10.00
															</td>
														</tr>
														<tr>
															<td>
																21-Feb-16
															</td>
															<td>
																Desmond Tan
															</td>
															<td>
																Nur Amelia
															</td>
															<td>
																SGD 100.00
															</td>
														</tr>
														<tr>
															<td>
																2-Feb-16
															</td>
															<td>
																Siah Hong Siew
															</td>
															<td>
																Paul Smith
															</td>
															<td>
																SGD 45.00
															</td>
														</tr>
														</tbody>
													</table>
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
<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

<!--Beyond Scripts-->
<script src="assets/js/beyond.js"></script>

<!--Easy Pie Charts Needed Scripts-->
<script src="assets/js/charts/easypiechart/jquery.easypiechart.js"></script>
<script src="assets/js/charts/easypiechart/easypiechart-init.js"></script>




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
