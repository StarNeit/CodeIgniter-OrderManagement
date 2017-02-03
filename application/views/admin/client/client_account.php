<div class="page-content">
	
	<? $this->load->view("admin/client/client_breadcrumbs")?>

	<!-- Page Body -->
	<div class="page-body">
		
		<div class="tabbable">
			
			<? $this->load->view("admin/client/client_tabs")?>
			<div class="tab-content radius-bordered">
				<div class="tab-pane in active">

				<?=form_open(admin_url("client/save_account"), 'onsubmit="return SendForm(this)" class="form-horizontal"')?>

					<div id="message"><?=show_message()?></div>


					<div class="form-title">
						Account
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-3">
								<div class="form-group">
									<label>Email: </label>
									<input type="text" class="form-control" name="email" value="<?=$user->email?>"/>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-3">
								<div class="form-group">
									<label>Password: <small>Optional</small></label>
									<input type="password" class="form-control" name="password" value=""/>
								</div>
							</div>
						</div>
					</div>

					

					<div class="form-title"></div>
					<div class="form-group">
						<div class="col-lg-6 pull-right">
							<input type="hidden" name="user_id" value="<?=$user->user_id?>" />
							<input class="btn btn-palegreen pull-right" type="submit" value="Save" />
						</div>
					</div>
					<?=form_close()?>

				</div>

			</div>


		</div>
		<br/><br/>
		<!--/tabs-->
	</div>