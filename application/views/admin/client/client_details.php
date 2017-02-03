<div class="page-content">
	
	<? $this->load->view("admin/client/client_breadcrumbs")?>

	<!-- Page Body -->
	<div class="page-body">
		
		<div class="tabbable">
		
			<? $this->load->view("admin/client/client_tabs")?>
			

			<div class="tab-content radius-bordered">
				<div class="tab-pane in active">


					<?=form_open(admin_url("client/save_details"), 'onsubmit="return SendForm(this)" class="form-horizontal"')?>
						<div id="message"><?=show_message()?></div>
						<div class="form-title">
							Basic Information
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-1">
									<div class="form-group">
										<label for="registrationInput">Salutation</label>
										<?=form_dropdown('salutation', salutation_options(), $user->salutation);?>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="nameInput">First Name:</label>
										<input type="text" class="form-control" name="first_name" value="<?=$user->first_name?>" placeholder="First Name"
										/>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="nameInput">Last Name:</label>
										<input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?=$user->last_name?>" />
									</div>
								</div>

								<div class="col-lg-3">
									<div class="form-group">
										<label for="regidateInput">Registration Date:</label>
										<div class="input-group">
											<input class="form-control date-picker date_of_birth" id="id-date-picker-1" type="text" name="registered_at" value="<?=($user->registered_at=='' || $user->registered_at=='0000-00-00 00:00:00') ? date('d/m/Y'):hdate($user->registered_at)?>" data-date-format="dd-mm-yy" placeholder="DD/MM/YY">
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
										<input type="text" class="form-control" name="email" value="<?=$user->email?>" placeholder="example@mail.com" />
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="mobileInput">Home:</label>
										<input type="text" class="form-control" name="contact_home" value="<?=$user->contact_home?>" placeholder="+99-9999-9999" />
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="mobileInput">H/P:</label>
										<input type="text" class="form-control" name="contact_mobile" value="<?=$user->contact_mobile?>" placeholder="+99-9999-9999"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-3">
									<div class="form-group">
										<label for="nameInput">Postal Code: </label>
										<input type="text" class="form-control" name="postal_code" value="<?=$user->postal_code?>" />
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="cardInput">Unit. No: </label>
										<input type="text" class="form-control" name="unit" value="<?=$user->unit?>" />
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="cvcInput">Block No.: </label>
										<input type="text" class="form-control" name="block" value="<?=$user->block?>"/>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="cvcInput">Street: </label>
										<input type="text" class="form-control" name="street" value="<?=$user->street?>"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-title">
				</div>
				<div class="form-group">
					<div class="col-lg-6 pull-right">
						<input type="hidden" name="id" value="<?=$user->id?>"/>
						<input type="hidden" name="user_type" value="Client"/>
						<input class="btn btn-palegreen pull-right" type="submit" value="Save" />
					</div>
				</div>
				<?=form_close()?>
				<div class="clerfix"></div>
<br/><br/>

				

				
			</div>
		</div>
		

	</div>
	<br/><br/>
	<!--/tabs-->
</div>
