<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="panel-title">Visits List on <strong><?=hdate($date)?></strong></h3>
</div>        

	
	<table class="table table-striped">
		<thead>
			<tr>				
				<th>Interval</th>
				<th>Status</th>
				<th>Options</th>				
			</tr>
		</thead>
		<?foreach($items as $item):?>
			<tr>				
				<td><?=visit_period($item->visit_from, $item->visit_to)?></td>
				<td>
					<label class="label ev-<?=$item->status?>">
						<?=$item->status?>
					</label>
				</td>
				<td><a href="<?=care_url("cases")?>" class="btn btn-primary">View Case</a></td>
				
			</tr>
		<?endforeach?>
	</table>


<div class="modal-footer">                                    
    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="-1">Close</button>
</div>   

