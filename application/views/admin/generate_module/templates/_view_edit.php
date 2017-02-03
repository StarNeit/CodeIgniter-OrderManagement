<div class="panel panel-inverse">
	<div class="panel-heading"> 
		<?= '<? $this->load->view("admin/panel_btns")?>' ?>
		<?= '<?=$title?>' ?>
	</div>
	<div class="panel-body">
		<?= '<?=form_open(admin_url("'.$controller_name.'/save"), \'onsubmit="return SendForm(this)"\' )?>' ?> 
<?foreach($fields as $field): $type = $field_types[$field];?>
			<div class="form-group">
<?if($type=='checkbox'):?>
				<div class="checkbox">
					<label> 
						<?= '<?=form_checkbox("'.$field.'", 1, $item->'.$field.'==1)?>' ?> 
						<?=ucfirst(str_replace('_', ' ', $field))?> 
					</label>
				</div>
<?else:?>
				<label><?=ucfirst(str_replace('_', ' ', $field))?> <b class="err err_<?=$field?>"></b></label>
<?endif?>
<?if($type=='input'):?>
				<input type="text" name="<?=$field?>" value="<?= '<?= $item->'.$field.'?>' ?>" class="form-control" <?=!isset($first) ? 'autofocus' : ''; $first=true?>/>
<?elseif($type=='textarea'):?>
				<textarea name="<?=$field?>" class="form-control autogrow"><?= '<?= $item->'.$field.'?>' ?></textarea>
<?elseif($type=='dropdown'):?>
				<?= '<?=form_dropdown("'.$field.'", array(), $item->'.$field.', \'class="form-control"\')?>' ?> 
<?endif?>
			</div>
<?endforeach?>

		    <div class="form-group">
				<input type="hidden" name="id" value="<?= '<?=$item->'.$key.' ?>' ?>" />
				<input type="hidden" name="page_redirect" value="<?= '<?=$this->input->server("HTTP_REFERER")?>' ?>" />			
				<button type="submit" id="submit"  class="btn btn-primary">Save</button> 		
				<a href="<?='<?=$this->input->server("HTTP_REFERER")?>'?>" class="btn" id="cancel"> Cancel </a>
			</div>
		<?= '<?=form_close()?>' ?> 
	</div>
</div>

