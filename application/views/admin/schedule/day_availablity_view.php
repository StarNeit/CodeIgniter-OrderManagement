<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="panel-title">CarePro Availability: <strong><?=hdate($date)?></strong></h3>
</div>        


	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Interval</th>
				<th>Options</th>
			</tr>
		</thead>
		<?foreach($items as $item):?>
			<tr>
				<td><?=$item->full_name?></td>
				<td><?=$item->all_day ? 'All Day' : date("h:i", strtotime($item->start)) . '-'. date("h:i", strtotime($item->end))?></td>
				<td>
					<a href="<?=admin_url("carepro/details/$item->user_id")?>" class="btn btn-info btn-sm" target="_blank">
						View Profile
					</a>
					<a href="<?=admin_url("carepro/schedule/$item->user_id")?>" class="btn  btn-sm" target="_blank">
						View Schedule
					</a>
				</td>
			</tr>
		<?endforeach?>
	</table>


<div class="modal-footer">                                    
    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="-1">Close</button>
</div>   

