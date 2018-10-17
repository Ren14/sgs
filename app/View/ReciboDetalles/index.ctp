<div class="ibox float-e-margins reciboDetalles index">
	
	<div class="ibox-content">
	<table class="table table-bordered" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
											<th><?php echo $this->Paginator->sort('recibo_id'); ?></th>
							<th><?php echo $this->Paginator->sort('cuota_agua_id'); ?></th>
							<th><?php echo $this->Paginator->sort('cuota_id'); ?></th>
							<th><?php echo $this->Paginator->sort('activo'); ?></th>
							<th><?php echo $this->Paginator->sort('Fecha'); ?></th>
							<th><?php echo $this->Paginator->sort('Modificado'); ?></th>
			<th class="actions"><?php echo __('Opciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($reciboDetalles as $reciboDetalle): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($reciboDetalle['Recibo']['id'], array('controller' => 'recibos', 'action' => 'view', $reciboDetalle['Recibo']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($reciboDetalle['CuotaAgua']['id'], array('controller' => 'cuota_aguas', 'action' => 'view', $reciboDetalle['CuotaAgua']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($reciboDetalle['Cuota']['id'], array('controller' => 'cuotas', 'action' => 'view', $reciboDetalle['Cuota']['id'])); ?>
		</td>
		<td><?php echo h($reciboDetalle['ReciboDetalle']['activo']); ?>&nbsp;</td>
		<td><?php echo date('d-m-Y H:i',strtotime($reciboDetalle['ReciboDetalle']['created'])); ?>&nbsp;</td>
		<td><?php echo date('d-m-Y H:i',strtotime($reciboDetalle['ReciboDetalle']['modified'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $reciboDetalle['ReciboDetalle']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $reciboDetalle['ReciboDetalle']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $reciboDetalle['ReciboDetalle']['id']), array('confirm' => __('Seguro que quiere borrar # %s?', $reciboDetalle['ReciboDetalle']['id']))); ?>
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
