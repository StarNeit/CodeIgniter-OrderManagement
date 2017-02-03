<div class="modal-dialog">
	<div class="panel panel-default">
		<div class="panel-heading">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<i class="glyphicon glyphicon-cog"></i> 
			<?=$title?>
		</div>
		<?=form_open(admin_url('generate_module/export'))?>
		<div class="panel-body">
				<div class="col-sm-5">
					<label>Export Tables</label>
					<a href="javascript:SelAll()" class="pull-right">Select All</a> 
					<br/>
					<?=form_multiselect('tables[]', $tables, $tables, 'size="'.count($tables).'" class="form-control" id="tables"')?>
				</div>
				<div class="col-sm-7">
					<div>
						<label>File Format</label>
						<?=form_dropdown('format', $format, 'zip', 'class="form-control"')?>
					</div>
					<div>
						<label>Export type</label>
						<?=form_dropdown('add_insert', $add_insert, TRUE, 'class="form-control"')?>
					</div>
					<div>
						<label class="checkbox">
							Add DROP TABLE statements
							<?=form_checkbox('add_drop', 1, true)?>
						</label>
					</div>
					<br/>
				</div>
		</div>
		<div class="panel-footer text-right">
			<button class="btn btn-link" data-dismiss="modal">Cancel</button>
			<button class="btn btn-primary">Export Database</button>
		</div>
		<?=form_close()?>	
	</div>
</div>

<script type="text/javascript">
	function SelAll() {
		$("#tables option").prop('selected', true);
	}
</script>