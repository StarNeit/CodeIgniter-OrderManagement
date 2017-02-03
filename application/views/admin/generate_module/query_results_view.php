<?if($sql):?>
	<div class="row">
		<div class="col-md-12">

			<div class="alert alert-info">
				<?=$sql?>
				<span class="pull-right">Rows: <?=$affected_rows?></span>
			</div>
				
				<?if(isset($error)):?>
					<div class="alert alert-danger"><?=$error?></div>
				<?endif?>

				
				<?if($insert_id):?>
					<div class="alert alert-info">InsertId: <?=$insert_id?></div>
				<?endif?>
				
				<?if(isset($results) && $results):?>
				<div class="table-responsive">
						<? $cols = current($results);?>
						<table class="table table-condensed table-striped">
							<thead>
								<tr>
									<?foreach($cols as $col => $value):?>
										<th><?=$col?></th>	
									<?endforeach?>
								</tr>
							</thead>
							<tbody>
								<?foreach($results as $row):?>
									<tr>
										<?foreach($row as $field => $value):?>
											<td>
												<?if($field =='Create Table'):?>
													<pre><?=$value?></pre>
												<?else:?>
													<?=get_substr($value, 32)?>
												<?endif?>
											</td>
										<?endforeach?>
									</tr>
								<?endforeach?>
							</tbody>
						</table>	
				</div>
				<?endif?>			
				
			</div>
		</div>
	</div>
<?endif?>