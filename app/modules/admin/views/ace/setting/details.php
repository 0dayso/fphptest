<table class="table">
	<thead>
		<tr>
			<th>参数项</th>
			<td>参数值</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($item->metadata as $key => $value) { ?>
		<tr>
			<th><?php echo $value->key; ?></th>
			<td><?php echo $value->value; ?></td>
		</tr>
	<?php }?>
	</tbody>
</table>