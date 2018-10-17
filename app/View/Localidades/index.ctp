<div class="ibox float-e-margins localidades index">
	
	<div class="ibox-content">
	<table class="table table-bordered" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
											<th><?php echo $this->Paginator->sort('provincia_id'); ?></th>
							<th><?php echo $this->Paginator->sort('localidad'); ?></th>
			<th class="actions"><?php echo __('Opciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($localidades as $localidade): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($localidade['Provincia']['id'], array('controller' => 'provincias', 'action' => 'view', $localidade['Provincia']['id'])); ?>
		</td>
		<td><?php echo h($localidade['Localidade']['localidad']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $localidade['Localidade']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $localidade['Localidade']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $localidade['Localidade']['id']), array('confirm' => __('Seguro que quiere borrar # %s?', $localidade['Localidade']['id']))); ?>
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
