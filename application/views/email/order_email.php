<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">

		.text-right{
			text-align: right;
		}
		.text-center{
			text-align: left
		}
	</style>
</head>
<body>

	<h3>New order was placed here are details:</h3>
	
	<h4>Custoner information:</h4>
	<div>Name: <?=$fields['name']?></div>
	<div>Company: <?=$fields['company_name']?> </div>
	<div>Email: <?=$fields['email']?></div> 
	<div>Phone: <?=$fields['phone']?> </div>

	<h4>Delivery Address:</h4>
	<div>City: <?=$fields['region']?> </div>
	<div>Address: <?=$fields['address']?></div>

	<?if($fields['notes']):?>
		<div>Notes: <?=$fields['notes']?></div>
	<?endif?>

	<h4>Items Ordered:</h4>
	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th class="text-right">Price</th>
			<th class="text-center">Qty</th>
			<th class="text-right">Total</th>
		</tr>
		<?foreach($items as $item):?>
		<tr>
			<td><?=$item['id']?></td>
			<td><?=$item['name']?></td>
			<td class="text-right"><?=price($item['price'])?></td>
			<td class="text-center"><?=$item['qty']?></td>
			<td class="text-right"><?=price($item['subtotal'])?></td>
		</tr>	
		<?endforeach?>
		<tr>
			<td colspan="5" class="text-right"><strong>Total: <?=$total?></strong></td>
		</tr>	
	</table>


	
	
</body>
</html>
