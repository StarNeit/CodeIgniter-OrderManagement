<div class="page-content">

	<? $this->load->view("admin/carepro/carepro_breadcrumbs");?>

	<div class="page-body">
		<!-- Tabs -->
                <? $this->load->view("admin/visits/visits_tabs")?>
		<div class="tabbable2">
			<div class="tab-content radius-bordered">
				
				<table class="table table-striped">
					<thead>
					<tr>		
						<th>#</th>	
						<th>Visit Date</th>	
						<th>Recipient</th>	
						<th>Service</th>
						<th>Skills</th>
						<th>Status</th>	
						
						<th>Options</th>
					</tr>
					</thead>
					<tbody>
					<? foreach($items as $index => $item):?> 
					<tr>	
						<td><?= $index+1?></td>
                                                <td><a href="<?=admin_url('visits/detail/'.$item->id)?>"><?= hdate($item->visit_from)?></a></td>
						<td><?=$item->recipient?></td>
						<td><?=implode(',', $item->services)?></td>
						<td><?=implode(',',$item->skills)?></td>
						<td><?= $item->status?></td>
						<td>	
                                                   <a href="<?=admin_url('visits/detail/'.$item->id)?>">Edit</a>
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
				
				<? $this->load->view("admin/pagination_view")?>

			</div>
		</div>
	</div>
</div>

