<table class="table table-striped">
	<thead>
		<tr>
			<th><a href="javascript:;" onclick="Sort('code')">Code</a></th>
			<th><a href="javascript:;" onclick="Sort('name')">Name</a></th>
			<th><a href="javascript:;" onclick="Sort('description')">Description</a></th>
			<th class="options">Options</th>
		</tr>
	</thead>
<?php foreach($items as $i=> $item):?>
<tr>
	<td><?php echo anchor(admin_url('roles/edit/'.$item->code), $item->code)?></td>
	<td><?php echo $item->name?></td>
	<td><?php echo $item->description?></td>
	<td>
		<a href="<?php echo admin_url("permissions/index/$item->code")?>" class="btn btn-xs btn-warning" title="permissions">
			<i class="glyphicon glyphicon-lock"></i>
		</a>
		<a href="<?php echo site_url("admin/roles/edit/".$item->code);?>" class="btn btn-xs btn-info" title="edit">
			<i class="glyphicon glyphicon-edit"></i>
		</a>
		<a href="javascript:;" onclick="DeleteItem('<?php echo $item->code?>', this)" class="btn btn-xs btn-danger" title="remove">
			<i class="glyphicon glyphicon-trash"></i>
		</a>
	</td>
</tr>
<?php endforeach;?>
<?php if(count($items)==0):?>
	<tr>
    	<td colspan="5" class="no_data">No data defined</td>
	</tr>
<?php endif?>
</table>

<? $this->load->view('admin/pagination_view')?>