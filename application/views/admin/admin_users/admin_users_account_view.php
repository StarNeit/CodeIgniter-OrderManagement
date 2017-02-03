<div class="row">
	<div class="col-md-6">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<h4 class="panel-title">Edit account</h4>
			</div>

			<?=form_open(admin_url('auth/save_account'), 'onsubmit="return SendForm(this);"')?>
				<div class="panel-body">
					<div class="form-group">
						<label>First Name <b class="err err_first_name"></b></label>
						<input type="text" name="first_name"  value="<?php echo $item->first_name?>" class="form-control"/>			
					</div>
					<div class="form-group">
						<label>Last Name <b class="err err_last_name"></b></label>
						<input type="text" name="last_name"  value="<?php echo $item->last_name?>" class="form-control"/>
						
					</div>
					<div class="form-group">
						<label>Email <b class="err err_email"></b></label>
						<input type="text" name="email"  value="<?php echo $item->email?>" class="form-control"/>			
					</div>
					<div class="form-group">
						<label>Contact Number <b class="err err_contact_no"></b></label>
						<input type="text"   name="contact_no"  value="<?php echo $item->contact_no?>" class="form-control"/>			
					</div>
					<div class="form-group">
						<label>Username<b class="err err_username"></b></label>
						<input type="text"  name="username"  autocomplete="off" value="<?php echo $item->username?>" class="form-control"/>
					</div>
				
				  	<div class="form-group">			 	
						<button type="submit" class="btn btn-success">Save Changes</button>
					</div>
					
				</div>
			<?=form_close()?>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<h4 class="panel-title">Change password</h4>
			</div>

			<?=form_open(admin_url('auth/change_password'), 'onsubmit="return SendForm(this)"')?>
			<div class="panel-body">
				<div id="pass_message"></div>
				<div class="form-group">
					<label>Current Password <b class="err err_current_password" /></b></label>
					<input type="password" name="current_password" class="form-control" />
				</div>
				<div class="form-group">
					<label>New Password <b class="err err_new_password" /></b></label>
					<input type="password" name="new_password" class="form-control" />
				</div>
				<div class="form-group">
					<label>Confirm Password <b class="err err_new_password2" /></b></label>
					<input type="password" name="new_password2" class="form-control" />		
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Change Password</buttton>
				</div>
			</div>
			
			<?=form_close()?>
		</div>
	</div>
</div>