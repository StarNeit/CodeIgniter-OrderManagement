<div >
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<?=$title?>
		</div>

		<?=form_open(admin_url('admin_users/save'), 'onsubmit="return SendForm(this);"')?>
			<div class="panel-body">
				<div class="form-group">
					<label>First Name <b class="err err_first_name"></b></label>
					<input type="text" name="first_name" value="<?php echo $item->first_name?>" autofocus class="form-control"/>
				</div>
			    <div class="form-group">
					<label>Last Name <b class="err err_last_name"></b></label>
					<input type="text" name="last_name"  value="<?php echo $item->last_name?>" class="form-control"/>
				</div>
			    <div class="form-group">
					<label>Email <b class="err err_email"></b></label>
					<input type="text" name="email" value="<?php echo $item->email?>" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Role <b class="err err_role_code"></b></label>
					<?=form_dropdown('role_code', $roles, $item->role_code, 'class="form-control"');?>	   
				</div>
				
				<div class="form-group">
					<label>Username <b class="err err_username"></b></label>
					<input type="text" name="username"  autocomplete="off" value="<?php echo $item->username?>" class="form-control"/>
					
				</div>
				<div class="form-group">
					<label>Password <b class="err err_password"></b></label>
					<input type="password" name="password" autocomplete="off" class="form-control" />
					<?php if($item->id):?><div class="d">Leave blank if you don't want to change password</div> <?php endif?>
				</div>

			    <div class="form-group">
					<input type="hidden" name="id" value="<?= $item->id?>" />
					<input type="submit" class="btn btn-primary" value="Save" />
					<a href="<?php echo admin_url('admin_users');?>"  class="btn" id="cancel"> Cancel </a>
				</div>
			</div>
		<?=form_open()?>
	</div>
</div>