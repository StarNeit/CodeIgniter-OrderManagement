<table class="table table-striped">
	<thead>
	<tr>		
		<th width="50"><a href="javascript:;" onclick="Sort('id')">Id</a></th>	
		<th><a href="javascript:;" onclick="Sort('client')">Client</a></th>	
		<th><a href="javascript:;" onclick="Sort('product')">Product Name</a></th>	
		<th><a href="javascript:;" onclick="Sort('moderator')">Moderator</a></th>	
		<th><a href="javascript:;" onclick="Sort('has_review')">Reviewed</a></th>			
		<th class="options">Options</th>			
	</tr>
	</thead>
	<tbody>
	<? foreach($items as $item):?> 
	<tr>	
		<td><?= $item->id?></td>
		<td><?= $item->client?></td>		
		<td><?= $item->product?></td>		
		<td>
			<?if($item->moderator):?>
				<?= $item->moderator?>	
			<?else:?>
				<?= form_dropdown('moderator_id', $moderators, '', 'class="form-control" onchange="SetModerator('.$item->id.', this)"');?>
			<?endif?>
		</td>		
		<td>
			<? if($item->has_review):?>
				<label class="label label-primary">Yes</label>
			<? else:?>
				<label class="label label-danger">No</label>
			<? endif?>
		</td>
		<td>
			<a href="<?=admin_url("reviews/edit/$item->id")?>"><i class="fa fa-pencil"></i>
		</td>
		
	</tr>
	<? endforeach;?>
	<? if(count($items)==0):?> 
		<tr>
	    	<td colspan="20" class="alert alert-warning text-center">No data found</td>
		</tr>
	<? endif?>	
	</tbody>
</table>

<div class="panel-footer">
	<div class="pull-right">Total rows: <?= $this->pagination->total_rows?></div>
	<?= $this->pagination->create_links();?>		
	<div class="clearfix"></div>
</div>