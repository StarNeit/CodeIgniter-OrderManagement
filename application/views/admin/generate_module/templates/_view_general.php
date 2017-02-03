<div class="panel panel-inverse">
	<div class="panel-heading">

		<a href="<?php echo admin_url('{{controller_name}}/add')?>" class="btn btn-success" id="add" title="Add F4">
			Create
		</a>

		<div class="col-sm-10 pull-right">
			<!-- filter form-->
			<?=form_open(admin_url('{{controller_name}}/get_ajax_list'),'onsubmit="return SendForm(this)" id="filter_form" class="form-inline" ')?>
				<div class="col-md-6 col-md-offset-2 col-xs-6">
					<div class="input-group">
						<input type="text"  placeholder="search item..." class="form-control" name="filter_name"  value="<?php echo f('name')?>" autofocus />
						<span class="input-group-btn">
							<button type="button" id="clear_btn" class="btn btn-default" tabindex="-1" >X</button>
							<button type="submit" class="btn btn-default">Search</button>
						</span>
					</div>
				</div>	   
				<div class="col-md-3 col-xs-4">		
					<?php $filter_options = array('2'=>'All Statuses', '1'=>'Active items', '0'=>'Inactive items');?>
					<?php echo form_dropdown('filter_status', $filter_options, f('status'), 'id="filter_status" class="form-control"');?>
				</div>		
				<div class="col-md-1 col-xs-2">
					<?php echo form_dropdown('filter_per_page', get_per_page_options(), f('per_page', LIMIT), 'id="per_page" class="form-control"')?>
				</div>
				<input type="hidden" name="sort_col" id="sort_col" value="<?php  echo f('sort_col');?>" />
				<input type="hidden" name="sort_dir" id="sort_dir" value="<?php  echo f('sort_dir');?>" />
				<input type="hidden" name="filter" id="filter" value="filter" />
			<?=form_close()?>		
			<!-- / filter form-->
		</div>
		<div class="clearfix"></div>

	</div>

	<div class="panel-body" id="list" >
		<?php $this->load->view('admin/{{controller_name}}/{{controller_name}}_list');?>
	</div>
</div>



<script type="text/javascript">
<!--

	$(function(){
		$("select", '#filter_form').change(function(){SendFilter()});
		$("#clear_btn").click(function(){$("[name=filter_name]").val(''); SendFilter();})
	});

	function DeleteItem(id, obj){	   	
		SimpleDelete(id, obj, admin_url+"{{controller_name}}/delete");
	}

	function Activate(id, obj){	 	
		SimpleActivate(id, obj, admin_url+"{{controller_name}}/activate");
	}

// -->
</script>