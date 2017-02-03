<div class="row">
	<div class="col-md-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<b>Tables - <?=count($tables)?></b>
				<div class="pull-right">
					<a href="javascript:Popup('admin/generate_module/export_options')" title="Export with options">
						Export <i class="glyphicon glyphicon-cog"></i>
					<a>
				</div>
			</div>
			<ul class="list-group database-tables">			
				<?foreach($tables as $table):?>
					<li class="list-group-item">
						<a href="javascript: BrowseTable('<?=$table?>');"><?=$table?></a>
						<div class="opt">
							<a href="javascript:StructureTable('<?=$table?>');" title="Structure"><i class="glyphicon glyphicon-info-sign"></i></a>
							<a href="javascript:CreateTable('<?=$table?>');" title="Create Table Sql"><i class="glyphicon glyphicon-floppy-open"></i></a>
						</div>
					</li>
				<?endforeach?>
			</ul>		
		</div>
	</div>

<div class="col-md-9">
		<div class="panel panel-default">

			<?=form_open('', 'onsubmit="return ExecuteQuery()"')?>
				<div class="panel-body">	
					<textarea name="sql" placeholder="Type your query..." id="sql" rows="10" class="form-control autogrow" autofocus></textarea>
				</div>
				<div class="panel-footer">
					<span class="d">Only one query is allowed</span>
					<div class="pull-right">
						<button type="submit" class="btn btn-primary btn-sm">Execute Query</button>
					</div>
					<div class="clearfix"></div>
				</div>
			<?=form_close()?>

		</div>
	</div>	
</div>

<div id="list">
<!-- here will be displayed query results -->
</div>

<script type="text/javascript" src="<?=asset_url("admin/js/jquery.tablesorter.min.js")?>"></script>
<script type="text/javascript">

	function ExecuteQuery(sql)
	{
		if(!sql){
			sql =$("#sql").val();
		}
		$.ajax({
			type: "POST",
			url: admin_url+'generate_module/execute_query',
			data: {sql:sql, csrf:csrf},
			success: function(data){
				$("#list").html(data);
				$("table").tablesorter(); 
			},
            error: function(data, status){
            	$("#list").html(data.responseText)
            },
		});

		return false;
	}

	function BrowseTable(table_name){
		var sql = 'SELECT * FROM '+table_name+' LIMIT 200';
		ExecuteQuery(sql);
	}

	function StructureTable(table_name){
		var sql = 'EXPLAIN ' + table_name;
		ExecuteQuery(sql);
	}

	function CreateTable(table_name){
		var sql = "SHOW CREATE TABLE " + table_name;
		ExecuteQuery(sql);
	}

</script>