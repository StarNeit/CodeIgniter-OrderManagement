<table class="table table-striped">
	<thead>
	<tr>		
<?foreach($fields as $field):?>
		<th><a href="javascript:;" onclick="Sort('<?=$field?>')"><?=ucfirst(str_replace('_', ' ', $field))?></a></th>	
<?endforeach?>		
		<th class="options">Options</th>
	</tr>
	</thead>
	<tbody>
	<?= '<? foreach($items as $item):?>'?> 
	<tr>	
<?foreach($fields as $index => $field):?>
		<td><?= $index==1 ? '<?= anchor(admin_url("'.$controller_name.'/edit/$item->'.$key.'"), $item->'.$field.')?>' : '<?= $item->'.$field.'?>'?></td>
<?endforeach?>
		<td>
<?if(in_array('active', $fields)):?> 
			<a href="javascript:;" onclick="Activate('<?= '<?= $item->'.$key.'?>' ?>', this)" title="activate/deactivate"
				class="<?= '<?= $item->active ? "glyphicon glyphicon-ok":"glyphicon glyphicon-off"?>' ?>"></a>
<?endif?>
			<a href="<?='<?= admin_url("'.$controller_name.'/edit/".$item->'.$key.');?>'?>" class="btn btn-xs btn-primary" title="edit">
				<i class="glyphicon glyphicon-edit"></i>
			</a>
			<a href="javascript:;" onclick="DeleteItem(<?= '<?= $item->'.$key.'?>' ?>, this)" class="btn btn-xs btn-danger" title="remove">
				<i class="glyphicon glyphicon-remove"></i>
			</a>
		</td>
	</tr>
	<?= '<? endforeach;?>'?>

	<?= '<? if(count($items)==0):?>'?> 
		<tr>
	    	<td colspan="20" class="alert alert-warning text-center">No data found</td>
		</tr>
	<?= '<? endif?>'?>
	
	</tbody>
</table>

<?= '<? $this->load->view("admin/pagination_view")?>' ?>