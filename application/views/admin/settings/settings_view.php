<div class="panel panel-inverse">
	<div class="panel-heading">
		<? $this->load->view('admin/panel_btns')?>
		<h4 class="panel-title"><?=$title?></h4>
	</div>
	<div class="panel-body">
		<?=form_open(admin_url('settings/save'))?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th width="200">Key</th>
						<th>Value</th>		
					</tr>
				</thead>
				<? foreach($settings as $key => $value):?>
				<tr>
					<td><?=$key?></td>
					<td><input type="text" name="settings[<?=$key?>]" value = "<?=$value?>" class="form-control"/></td>		
				</tr>
				<? endforeach?>
			</table>
			<hr>
			<div>
				<button class="btn btn-lg btn-success">Save Changes</button>
			</div>
		<?=form_close()?>
	</div>
</div>
