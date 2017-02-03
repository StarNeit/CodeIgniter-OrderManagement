<h2>Set new password</h2>
<?if($user):?>
	<?=form_open(admin_url('auth/set_new_password'), 'onsubmit="return SendForm(this)"')?>
		<div>
			<label>Username: <b><?=$user->username?></b></label>
		</div>
		<div>
			<label>Email: <b><?=$user->email?></b></label>
		</div>
		<hr>
		<div class="form-group">
			<label>New Password <b class="err err_new_password" /></b></label>
			<?=form_password('new_password', '', 'class="form-control"')?>
		</div>
		<div class="form-group">
			<label>Confirm Password <b class="err err_new_password2" /></b></label>
			<?=form_password('new_password2', '', 'class="form-control"')?>			
		</div>
		<hr/>
		<div>		
			<input type="hidden" name="password_reset_key" value="<?=$password_reset_key?>" />	
			<input type="hidden" name="user_id" value="<?=$user->id?>" />	
			<input type="submit" class="btn btn-primary" value="Change Password" />
		</div>
	<?=form_close()?>
<?else:?>
	<div class="alert alert-error"><?=$error?></div>
<?endif?>
