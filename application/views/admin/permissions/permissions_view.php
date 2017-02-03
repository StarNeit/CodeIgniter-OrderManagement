<div class="hint">
	Superuser administrators have all permissions, so here admins can set permissions to modules for other admin roles 
</div>

<ul class="list list-inline">
	<?foreach($roles as $url=>$label):?>
		<li><?= anchor($url, $label)?></li>
	<?endforeach?>
</ul>


<br/>

<? if(isset($funcs)):?>
<div class="panel panel-inverse">
	<div class="panel-heading">
		<? $this->load->view('admin/panel_btns')?>
		<i class="glyphicon glyphicon-wrench"></i> &nbsp;
		<?=$roles[conf('admin_path')."permissions/index/$role_code"]?> permissions 
	</div>
	<?=form_open(admin_url('permissions/save'), 'onsubmit="return SendForm(this)"')?>
		<div class="panel-body ">
			<div class="cnt">
			<?foreach($funcs as $controller => $func):?>
				<div class="col-md-3 item">
					<div class="panel panel-info">
						<div class="panel-heading"><?=$controller?></div>
						<div class="panel-body thumbnail" >
							<?foreach($func as $f):?>
								<?$id = $controller.'/'.$f?>
								<div class="checkbox">
									<label>
									 	<?=form_checkbox('perm[]', $id, isset($items[$controller.'/'.$f]), 'id="'.$id.'"')?>
										<?=$f?>
									</label>
								</div>
							<?endforeach?>
						</div>
					</div>
				</div>
				<?endforeach?>	
			</div>

			<div class="form-actions">
			
				<input type="hidden" name="role_code" value="<?=$role_code?>" />
				<input type="submit" class="btn btn-primary" value="Update Permissions" />
			</div>
			
		</div>
	<?=form_close()?>
<?endif?>


<script type="text/javascript" src="<?=asset_url('admin/js/jquery.masonry.min.js')?>"></script>

<script type="text/javascript">
	$(function(){		
		$('.cnt').masonry({
			itemSelector: '.item'
		});		
	});
</script>
