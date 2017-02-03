<div class="err err_skill"></div>
<?foreach(array_chunk($this->common->services_and_skills(), 3) as $services):?>
	<ul class="clearfix update-profile-care">
		<?foreach($services as $service):?>
		<li id="li-<?=$service->id?>">
			<input type="checkbox" name="service[]" value="<?=$service->id?>"/>
			<div>
				<img src="assets/images/<?=$service->icon?>" alt="<?=$service->service?>">
				<div><?=$service->service?></div>
			</div>
		</li>
		<?endforeach?>
	</ul>

	<?foreach($services as $service):?>
		<div class="description" id="service-<?=$service->id?>" data-service="<?=$service->id?>">
			<h4><?=$service->service?></h4>
			<p><?=$service->description?></p>
			<div class="clearfix"></div>
			<fieldset>
				<ul>
					<?foreach($service->skills as $skill):?>
					<li>
						<label>
							<?=form_checkbox('skill[]', $skill->id, in_array($skill->id, $skills));?>
							<span></span> 
							<?=$skill->skill?>
						</label>
					</li>
					<?endforeach?>
				</ul>
			</fieldset>
		</div>
	<?endforeach?>

<?endforeach?>
<?if(isset($readonly) && $readonly===true):?>
<script>
    $('.description input:checkbox').attr('disabled', 'disabled');
</script>
<?endif?>