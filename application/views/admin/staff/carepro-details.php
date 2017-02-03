<?
$noInfo = false;


if ($newCarePro == true)
{
	$exist_or_new = 'new';
	$save_or_edit = 'save-details';
	$noInfo = true;
}
else {
	$save_or_edit = 'edit-details';
	$exist_or_new = $careproListDetails->user_id;
}
?>
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
						<? echo $noInfo ? 'New registration' : $careproListDetails->first_name . ' ' . $careproListDetails->last_name ?>
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
									<a href="<?=admin_url('carepro/').'/'.$exist_or_new ?>">
										Personal Info
									</a>
								</li>
								<li class="tab-red">
									<a href="<?=admin_url('carepro/').'/'.$exist_or_new.'/skills' ?>">
										Skills & Qualifications
									</a>
								</li>
								<li class="tab-red">
									<a href="<?=admin_url('carepro/').'/'.$exist_or_new.'/background' ?>">
										Background Check
									</a>
								</li>
								<li class="tab-red">
									<a href="<?=admin_url('carepro/').'/'.$exist_or_new.'/documents' ?>">
										Documents
									</a>
								</li>
								<li class="tab-red">
									<a href="<?=admin_url('carepro/').'/'.$exist_or_new.'/payment' ?>">
										Payment
									</a>
								</li>
							</ul>
							<div class="tab-content radius-bordered">
								<div class="tab-pane in active">
									<!--Registration Form Starts-->
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-xs-12">


											<form id="registrationForm" action="admin/carepro/<? echo $save_or_edit . '/' . $exist_or_new ?>" method="post" class="form-horizontal"
												  data-bv-message="This value is not valid"
												  data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
												  data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
												  data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">

												<div class="form-title">
													About CarePro
												</div>

												<div class="profile-container">
													<div class="profile-header row">
														<div class="col-lg-2 col-md-4 col-sm-12 text-center">
															<img src="assets/admin/img/avatars/aixian.jpg" alt="" class="header-avatar" />
														</div>
														<div class="col-lg-5 col-md-8 col-sm-12 profile-info">
															<!-- Upload Logo -->
															<div class="form-group">
																<div class="header-fullname">Profile Picture</div><br/><br/>
																<div class="btn btn-info">
																	<input type="file" class="file-input-extensions" data-browse-class="btn btn-info btn-sm" data-show-remove="false" data-show-caption="false" data-show-upload="false" multiple="multiple">
																</div>
																<span class="help-block">Only JPEG, JPG, GIF and PNG extensions are allowed.</span>
															</div>
															<!-- /upload logo -->
														</div>
														<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
															<div class="row">
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value palegreen">0</div>
																	<div class="stats-title">UPCOMING</div>
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value info">0</div>
																	<div class="stats-title">PENDING</div>
																</div>
																<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
																	<div class="stats-value blueberry">0</div>
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
													Basic Information
												</div>

												<div class="row">
													<div class="col-lg-12">

														<div class="col-lg-1">
															<div class="form-group">
																<input id="salutation" name="salutation" class="hide" value="<?php echo $noInfo ? ' ' :$careproListDetails->salutation ; ?>">
																<label for="registrationInput">Salutation</label>
																<div class="input-group-btn">
																	<button type="button" class="btn btn-default dropdown-toggle salutation-btn" data-toggle="dropdown"><span class="value"><? echo $noInfo ? ' ' : $careproListDetails->salutation ?></span><span class="caret"></span></button>
																	<ul class="dropdown-menu salutation-dropdown">
																		<li><a>Ms</a></li>
																		<li class="divider"></li>
																		<li><a>Mrs</a></li>
																		<li class="divider"></li>
																		<li><a>Mr</a></li>
																		<li class="divider"></li>
																		<li><a>Dr</a></li>
																	</ul>
																</div>
															</div>
														</div>


														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">First Name:</label>
																<input type="text" class="form-control" name="firstName" placeholder="First Name"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." value="<? echo $noInfo ? ' ' : $careproListDetails->first_name ?>"/>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">Last Name:</label>
																<input type="text" class="form-control" name="lastName" placeholder="Last Name"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." value="<? echo $noInfo ? ' ' : $careproListDetails->last_name ?>"/>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input id="gender" name="gender" class="hide" value="<?php echo $noInfo ? ' ' : $careproListDetails->gender ; ?>">
																<label for="regidateInput">Gender:</label>
																<div class="input-group-btn">
																	<button type="button" class="btn btn-default dropdown-toggle gender-btn" data-toggle="dropdown"><span class="value"><? echo $noInfo ? ' ' : $careproListDetails->gender ?></span><span class="caret"></span></button>
																	<ul class="dropdown-menu gender-dropdown">
																		<li><a>Male</a></li>
																		<li class="divider"></li>
																		<li><a>Female</a></li>
																	</ul>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="regidateInput">Date of Birth:</label>
																<div class="input-group">
																	<input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" value="<? echo $noInfo ? ' ' : $careproListDetails->dob ?>">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-12">

														<? $nationalities = ['Singapore Citizen', 'Singapore PR', 'Other'] ?>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="regidateInput">Nationality:</label>
																<div class="input-group-btn">
																	<button type="button" class="btn btn-default dropdown-toggle nationality-btn" data-toggle="dropdown"><span class="value"><? echo $noInfo ? ' ' : $careproListDetails->nationality ?></span><span class="caret"></span></button>
																	<ul class="dropdown-menu nationality-dropdown">
																		<? foreach ($nationalities AS $value): ?>
																			<li><a><? print $value ?></a></li>
																			<li class="divider"></li>
																		<? endforeach ?>
																	</ul>
																</div>
																<input id="nationality" name="nationality" class="hide" value="<?php echo $noInfo ? ' ' :$careproListDetails->nationality ; ?>">
															</div>
														</div>


														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">NRIC:</label>
																<input type="text" class="form-control" name="nric" placeholder="S1234567A"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>

														<? $races = ['Chinese', 'Malay', 'Indian', 'Eurasian', 'Other'] ?>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="regidateInput">Race:</label>
																<div class="input-group-btn">
																	<button type="button" class="btn btn-default dropdown-toggle race-btn" data-toggle="dropdown"><span class="value"><? echo $noInfo ? ' ' : $careproListDetails->race ?></span><span class="caret"></span></button>
																	<ul class="dropdown-menu race-dropdown">
																		<? foreach ($races AS $value): ?>
																			<li><a><? print $value ?></a></li>
																			<li class="divider"></li>
																		<? endforeach ?>
																	</ul>
																</div>
																<input id="race" name="race" class="hide" value="<?php echo $noInfo ? ' ' :$careproListDetails->race ; ?>">
															</div>
														</div>

														<? $religions = ['Buddhism', 'Christian', 'Catholicism', 'Muslim', 'Taoism', 'Other'] ?>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="regidateInput">Religion:</label>
																<div class="input-group-btn">
																	<button type="button" class="btn btn-default dropdown-toggle religion-btn" data-toggle="dropdown"><span class="value"><? echo $noInfo ? ' ' : $careproListDetails->religion ?></span><span class="caret"></span></button>
																	<ul class="dropdown-menu religion-dropdown">
																		<? foreach ($religions AS $value): ?>
																			<li><a><? print $value ?></a></li>
																			<li class="divider"></li>
																		<? endforeach ?>
																	</ul>
																</div>
																<input id="religion" name="religion" class="hide" value="<?php echo $noInfo ? ' ' :$careproListDetails->religion ; ?>">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">Height:</label>
																<input type="text" class="form-control" name="height" placeholder="CM" value="<? echo $noInfo ? ' ' : $careproListDetails->height ?>"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="nameInput">Weight:</label>
																<input type="text" class="form-control" name="weight" placeholder="KG" value="<? echo $noInfo ? ' ' : $careproListDetails->weight ?>"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
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
																<input type="text" class="form-control" name="email" placeholder="example@mail.com" value="<? echo $noInfo ? ' ' : $careproListDetails->email ?>"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="mobileInput">Home:</label>
																<input type="text" class="form-control" name="contact-home" placeholder="+99-9999-9999" data-mask="+99-9999-9999" value="<? echo $noInfo ? ' ' : $careproListDetails->contact_home ?>"
																	   data-bv-notempty="true"
																	   data-bv-notempty-message="This field is required and cannot be empty." />
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="mobileInput">H/P:</label>
																<input type="text" class="form-control" name="contact-mobile" placeholder="+99-9999-9999" data-mask="+99-9999-9999" value="<? echo $noInfo ? ' ' : $careproListDetails->contact_mobile ?>"
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
																<input type="text" class="form-control" name="postal" value="123456"
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
													Other Information
												</div>

												<? $languages = ['English', 'Mandarin', 'Malay', 'Tamil', 'Hokkien', 'Teochew', 'Cantonese', 'Hakka', 'Hainanese', 'Others'] ?>
												<?
												if (!$noInfo) {
														$user_languages = explode(",", $careproListDetails->language);
													}
												?>
												<script>
													$(document).ready(function() {

														var checkboxes = $('div.checkbox-lang');

														checkboxes.each(function(i, element) {
															var label = $(this).find('input');
															$(label).click(function(){
																$(this).attr("checked") ? $(this).attr("checked", false) : $(this).attr("checked", true);
																$( "input#languages" ).val(
																	checkboxes.find('input').map(function() {
																		if ($(this).attr("checked")) {
																			return $(this).val();
																		}
																	}).get().join( "," ));
															});
														});

													});
												</script>

												<input id="languages" name="languages" class="hide" value="<?php echo $noInfo ? ' ' : $careproListDetails->language ; ?>">
												<div id="languages-checkboxes" class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 request">
															Do you have any language requests?<br/>
															<? foreach ($languages AS $value): ?>
																<? if (!$noInfo) {
																	$checked = (in_array($value, $user_languages)) ? 'checked' : '';
																}
																else {
																	$checked = '';
																}?>
																<div class="checkbox checkbox-lang" >
																	<label>
																		<input type="checkbox" class="colored-blue" <? print $checked ?> value="<? print $value ?>">
																		<span class="text"><? print $value ?></span>
																	</label>
																</div>
																<input type="checkbox"/>
															<? endforeach ?>
														</div>
													</div>
												</div>
												<br/>


												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 request">
															Are you suffering from any medical conditions, including neck and back problem?<br/>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">No</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Yes</span>
																</label>
															</div>
															<br/><br/>
															<div class="form-group">
																<label for="xsinput">Specify:</label>
																<input type="text" class="form-control" id="xsinput" value="I suffer from back problems due to a sports injury">
															</div>
														</div>
													</div>
												</div>
												<br/>
												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 request">
															Are you on any medication?<br/>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">No</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">Yes</span>
																</label>
															</div>
															<br/><br/>
															<div class="form-group">
																<label for="xsinput">Specify:</label>
																<input type="text" class="form-control" id="xsinput" value="-">
															</div>
														</div>
													</div>
												</div>
												<br/>
												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-12 request">
															Do you have a smart phone?<br/>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue">
																	<span class="text">No</span>
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="colored-blue" checked="checked">
																	<span class="text">Yes</span>
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
							<br/>
							<div class="widget">
								<div class="widget-header bg-palegreen">
									<i class="widget-icon fa fa-arrow-down"></i>
									<span class="widget-caption">Cases In-charge</span>
									<div class="widget-buttons">
										<a href="#" data-toggle="collapse">
											<i class="fa fa-minus"></i>
										</a>
									</div><!--Widget Buttons-->
								</div><!--Widget Header-->
								<div class="widget-body">

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
															Date Requested
														</th>
														<th>
															Care Recipient
														</th>
														<th>
															Visit No.
														</th>
														<th>
															Payment
														</th>
														<th>
															Remarks
														</th>
													</tr>
													</thead>
													<tbody>
													<tr>
														<td>
															1
														</td>
														<td>
															2-Apr-16
														</td>
														<td>
															<a href="case_detail.html">Siah Hong Siew</a>
														</td>
														<td>
															02042016
														</td>
														<td>
                                                            <span class="badge badge-success">
                                                                <i class="fa fa-check"></i>
                                                            </span>
															100.00
														</td>
														<td>
															Paid
														</td>
													</tr>
													<tr>
														<td>
															2
														</td>
														<td>
															23-Mar-16
														</td>
														<td>
															<a href="javascript:void(0);">Siah Hong Siew</a>
														</td>
														<td>
															23032016
														</td>
														<td>
                                                            <span class="badge badge-default">
                                                                <i class="fa fa-close"></i>
                                                            </span>
															10.00
														</td>
														<td>
															Collect Cash
														</td>
													</tr>
													<tr>
														<td>
															3
														</td>
														<td>
															21-Feb-16
														</td>
														<td>
															<a href="javascript:void(0);">Desmond Tan</a>
														</td>
														<td>
															21022016
														</td>
														<td>
                                                            <span class="badge badge-default">
                                                                <i class="fa fa-close"></i>
                                                            </span>
															100.00
														</td>
														<td>
															Collect Cash
														</td>
													</tr>
													<tr>
														<td>
															4
														</td>
														<td>
															2-Feb-16
														</td>
														<td>
															<a href="javascript:void(0);">Siah Hong Siew</a>
														</td>
														<td>
															02022016
														</td>
														<td>
                                                            <span class="badge badge-success">
                                                                <i class="fa fa-check"></i>
                                                            </span>
															45.00
														</td>
														<td>
															Paid
														</td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>



								</div>

							</div><!--Widget Body-->
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



<script>
	$(document).ready(function() {

		function dropdownClick(input, button, dropdown) {

			var inputElement = $('input#' + input);
			var buttonElement = $('button.' + button);
			var dropdownElement = $('ul.' + dropdown);
			var items = dropdownElement.find('a');

			items.click(function(i, element) {
				buttonElement.find('span.value').text(($(this).text()));
				inputElement.val(($(this).text()));
			});
		}

		function dropdownClickOther(input, button, dropdown) {
			var inputElement = $('input#' + input);
			var buttonElement = $('button.' + button);
			var dropdownElement = $('ul.' + dropdown);
			var items = dropdownElement.find('a');
			items.click(function(i, element) {
				if ($(this).text() === 'Other') {
					inputElement.val(' ');
					inputElement.removeClass('hide');
				}
				else {
					inputElement.addClass('hide');
					inputElement.val(($(this).text()));
				}
				buttonElement.find('span.value').text(($(this).text()));
			});

		}

		var elementsKey = [
			{
				func: dropdownClick('salutation', 'salutation-btn', 'salutation-dropdown')
			},
			{
				func: dropdownClick('gender', 'gender-btn', 'gender-dropdown')
			},
			{
				func: dropdownClickOther('nationality', 'nationality-btn', 'nationality-dropdown')
			},
			{
				func: dropdownClickOther('race', 'race-btn', 'race-dropdown')
			},
			{
				func: dropdownClickOther('religion', 'religion-btn', 'religion-dropdown')
			}

		];

		elementsKey.forEach(function(item) {
			item.func;
		});


	});
</script>


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
