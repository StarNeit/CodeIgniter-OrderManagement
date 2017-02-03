<table class="table table-striped">
<thead>
<tr>
	<th><a href="javascript:;" onclick="Sort('id')">Id</a></th>
	<th>
		<a href="javascript:;" onclick="Sort('username')">Username</a> /
		<a href="javascript:;" onclick="Sort('email')">Email</a>
	</th>
	<th><a href="javascript:;" onclick="Sort('first_name')">Full Name</a></th>
	<th><a href="javascript:;" onclick="Sort('role_code')">Role</a></th>
	<th class="options">Options</th>
</tr>
</thead>
<?php foreach($items as $i=> $item):?>
<tr>

	<td><?php echo $item->id?></td>
	<td>
		<a href="<?php echo admin_url("admin_users/edit/".$item->id);?>"><?php echo $item->username?></a><br/>
		<?php echo $item->email?>
	</td>
	<td><?php echo $item->first_name?> <?=$item->last_name?></td>
	<td><?php echo $item->role_code?></td>
	<td>		
		<a href="javascript:;" onclick="Activate('<?php echo $item->id?>', this)" title="activate/deactivate" class="<?php echo $item->active ? 'glyphicon glyphicon-ok':'glyphicon glyphicon-off'?>"></a>
		<a href="<?php echo admin_url("admin_users/edit/".$item->id);?>" class="btn btn-xs btn-info" title="edit"><i class="glyphicon glyphicon-edit"></i></a>
		<a href="javascript:;" onclick="DeleteItem(<?php echo $item->id?>, this)" class="btn btn-xs btn-danger"  title="remove"><i class="glyphicon glyphicon-trash"></i></a>
	</td>
</tr>
<?php endforeach;?>
<?php if(count($items)==0):?>
	<tr>
    	<td colspan="20" class="no_data">No data defined</td>
	</tr>
<?php endif?>
</table>

<div>		
	<div class="pull-right">Total rows: <? echo ($this->pagination->total_rows)?></div>
	<?php echo $this->pagination->create_links();?>
	<div class="clearfix"></div>		
</div>