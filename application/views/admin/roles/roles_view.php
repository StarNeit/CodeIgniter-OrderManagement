<div class="panel panel-inverse">
	<div class="panel-heading">
		<a id="add" class="btn btn-success" href="<?php echo admin_url('roles/add')?>" title="Add New F4"><i class="fa fa-plus"></i> Create</a>
		
		
		<div class="pull-right">
			<?=form_open(admin_url('roles/get_ajax_list'), 'id="filter_form"')?>
				<input type="hidden" name="sort_col" id="sort_col" value="<?php  echo f('sort_col');?>" />
				<input type="hidden" name="sort_dir" id="sort_dir" value="<?php  echo f('sort_dir');?>" />
				<input type="hidden" name="filter" value="1" />
			<?=form_close()?>
		</div>
	</div>

	<div class="panel-body" id="list">	
		<?php $this->load->view('admin/roles/roles_list');?>
	</div>

</div>


<script type="text/javascript">
<!--

	 function DeleteItem(id, obj){
	   	url = admin_url+"roles/delete";
		SimpleDelete(id, obj, url);
	 }

// -->
</script>