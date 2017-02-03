<div class="page-content">
	<div class="page-body">
		<div class="panel panel-inverse">

			<div class="panel-heading">
				<?=$title?>
			</div>
		
			<?=form_open(admin_url('generate_module/create_module'), 'onsubmit="return SendForm(this);"')?>
			
			<div class="panel-body">	
				<?if($error):?>	<div class="alert alert-danger"><?=$error?></div><?endif?>
				
				<div class="form-inline">
					<label>Table Name <b class="err err_table_name"></b></label><br/>
					<div class="form-group">
						<input type="text" name="table_name"  class="form-control typeahead" autofocus autocomplete="off"  value="<?=$table_name?>" />
					</div>
					<input type="button" id="check_table" class="btn btn-primary" value="Check and show fields" />
				</div>
				
				<?if($table_name):?>
					<br />
					<div>
						<table class="table form-inline">
							<tr>
								<th></th>
								<th>Field Name</th>							
								<th>Key</th>
								<th>List</th>
								<th>Form</th>
								<th>Validation</th>
								<th>Type</th>
							</tr>	
							<tbody id="sortable">
							<?foreach($fields as $field):?>
								<tr>
									<td class="handle"><i class="glyphicon glyphicon-move"></i></td>
									<td><?=$field->Field?></td>								
									<td>
										<label>
											<?=form_radio('key', $field->Field, $field->Key=='PRI')?>
											<span class="text"></span>
										</label>
									</td>
									<td>
										<label>
											<?=form_checkbox('list[]', $field->Field, 1)?>
											<span class="text"></span>
										</label>
									</td>
									
									<td>
										<label>
											<?=form_checkbox('fields[]', $field->Field, $field->Key!='PRI')?>
											<span class="text"></span>	
										</label>		

									</td>
									
									<td>
										<div class="validation" <?= $field->Key=="PRI" ? 'style="display:none"' : ''; ?> >									
										<?=form_input("validations[$field->Field]", 'trim|required', 'class="form-control validation"')?>						
										</div>
									</td>
									<td >
										<div class="type" <?= $field->Key=="PRI" ? 'style="display:none"' : ''; ?>>	
										<?=form_dropdown("types[$field->Field]", array('input'=>'input', 'textarea'=>'textarea', 'dropdown'=>'dropdown', 'checkbox'=>'checkbox'), '', 'class="form-control"')?>
										</div>
									</td>
								</tr>
							<?endforeach?>
							</tbody>
						</table>				
					</div>

					<div>
						<label>Controller Name <b class="err err_alias"></b></label>
						<input type="text" name="alias" value="<?=$table_name?>" class="form-control" />
					</div>

					<div class="form-group">
						<label>Model Name<b class="err err_model_name"></b></label>
						<input type="text" name="model_name" value="<?=$table_name?>_m" class="form-control" />
					</div>

					<div>
						<label>
							<input type="checkbox" value="1" name="only_model"/>
							<span class="text">Show Only Model</span> 
						</label>
					</div>
					
					
					<br />
					<div class="form-actions">			
						<input type="submit"  class="btn btn-primary" value="Generate Module" />
						<input type="reset"  class="btn" value="Reset" />
					</div>

				<?endif?>
			</div>

		<?=form_close()?>

	</div>
</div>
<script type="text/javascript" src="<?=asset_url("admin/js/typeahead.min.js")?>"></script>
<script type="text/javascript">
	
	
	$(function(){

		var tables = <?=$tables?>;
		$('.typeahead').typeahead({local: tables});
		
		$("#check_table").on('click', function(){
			var table = $("[name=table_name]").val();
			location.href= admin_url+"generate_module/index/" + table;
		});

		$("[name='fields[]']").on('change', function(){
			var validation_box = $(this).closest('tr').find(".validation");
			var type_box = $(this).closest('tr').find('.type');

			if($(this).is(":checked")){
				validation_box.show();
				type_box.show();
			}
			else{
				validation_box.hide();
				type_box.hide();
			}
		});
		

	});
	
</script>


<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script>
  $(function() {
    $( "#sortable" ).sortable({
      placeholder: "ui-state-highlight",
      items: "> tr",
      handle: ".handle",
      cursor: "move" 
    });
    $( "#sortable" ).disableSelection();
  });
 </script>