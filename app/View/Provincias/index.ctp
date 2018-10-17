<div class="ibox float-e-margins provincias index">
	
	<div class="ibox-content">
	<table class="table table-bordered" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
											<th><?php echo $this->Paginator->sort('provincia'); ?></th>
			<th class="actions"><?php echo __('Opciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($provincias as $provincia): ?>
	<tr>
		<td><?php echo h($provincia['Provincia']['provincia']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $provincia['Provincia']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $provincia['Provincia']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $provincia['Provincia']['id']), array('confirm' => __('Seguro que quiere borrar # %s?', $provincia['Provincia']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	</div>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
    	$('table.table-bordered').DataTable({
    		"language": dataTableEs,
    		"sDom": '<"top"<"#a.col-md-4"l><"#r.col-md-4"><"#e.col-md-4"f>>rt<"bottom"ip><"clear">'
    	})
	});
</script>
