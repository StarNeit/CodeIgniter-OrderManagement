<?if(isset($this->pagination)):?>	
	<div>
		<?php echo $this->pagination->create_links();?>		
		<div class="pull-right">Total rows: <? echo ($this->pagination->total_rows)?></div>
		<div class="clearfix"></div>
	</div>
<?endif?>