<div class="row">
	<div class="col-md-6">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<? $this->load->view('admin/panel_btns')?>
				<?=$title?>
			</div>
			<div class="panel-body">
				<?=form_open(admin_url('roles/save'), 'onsubmit="return SendForm(this);"')?>
					<div class="form-group">
						<label>Code <b class='d'>(max 5 chars)</b> <b class="err err_code"></b></label>
						<input type="text" autofocus name="code" maxlength="5" value="<?=$item->code?>" class="form-control limited" data-maxlength="5"/>
					</div>
				    <div class="form-group">
						<label>Name <b class="err err_name"></b></label>
						<input type="text" name="name" value="<?=$item->name?>" class="form-control"/>
					</div>
					 <div class="form-group">
						<label>Description <b class="err err_description"></b></label>
						<textarea name="description" class="form-control"><?=$item->description?></textarea>
					</div>		   	
					<div class="form-group">
						<input type="hidden" name="id" value="<?= isset($item->code)? $item->code : ""?>" />
						<label></label>
						<input type="submit" class="btn btn-primary" value="Save" />
						<a href="<?= admin_url('roles');?>" class="btn" id="cancel"> Cancel </a>
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</div>