<div class="panel panel-inverse">
	<div class="panel-heading">
		<a  href="<?php echo admin_url('admin_users/add')?>"  id="add" class="btn btn-success" title="Add New">
			Create
		</a>
		<div class="col-md-3 pull-right">
			<?=form_open(admin_url('admin_users/get_ajax_list'), 'id="filter_form"' )?>	
			    <?php $filter_options = array('2'=>'All Users', '1'=>'Active Users', '0'=>'Inactive Users');?>
		        <?php echo form_dropdown('filter_status', $filter_options, f('status'), 'id="filter_status" class="form-control"');?>
				<input type="hidden" name="sort_col" id="sort_col" value="<?php  echo f('sort_col');?>" />
				<input type="hidden" name="sort_dir" id="sort_dir" value="<?php  echo f('sort_dir');?>" />
				<input type="hidden" name="filter" value="1" />
			<?=form_close()?>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="panel-body" id="list">
		<?php $this->load->view('admin/admin_users/admin_users_list');?>
	</div>
</div>



<script type="text/javascript">
<!--

	$(function(){
		$("#filter_status").change(function(){SendFilter()});
	});


	 function DeleteItem(id, obj){
	   	url = admin_url+"admin_users/delete";
		SimpleDelete(id, obj, url);
	 }

	 function Activate(id, obj)
	 {
	 	SimpleActivate(id, obj, admin_url+"admin_users/activate");
	 }

// -->
</script>