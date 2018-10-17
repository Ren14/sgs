<div class="ibox float-e-margins parametros index">
	
	<a type="button" class="btn btn-outline btn-success pull-right" href="<?php echo $this->Html->url(array('action' => 'add')); ?>"> Nuevo Parametro</a>	
	<div class="ibox-content" style="overflow-x: overlay;">
		<table class="table table-bordered" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Valor</th>
					<th>Estado</th>
					
					<th class="actions"><?php echo __('Opciones'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($parametros as $parametro): ?>
					<tr>
						<td><?php echo h($parametro['Parametro']['nombre']); ?>&nbsp;</td>
						<td><?php echo h($parametro['Parametro']['valor']); ?>&nbsp;</td>
						<td><?php echo $estados_label[$parametro['Parametro']['activo']]; ?>&nbsp;</td>
						
						<td class="actions">
							<a href="<?php echo $this->Html->url(array('action' => 'view', $parametro['Parametro']['id']	)); ?>" type="button" class="btn btn-outline btn-success btn-xs"><i class="fa fa-search"></i></a>
							<a href="<?php echo $this->Html->url(array('action' => 'edit', $parametro['Parametro']['id']	)); ?>" type="button" class="btn btn-outline btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							
							<a href="#" onclick="borrar('<?php echo $parametro['Parametro']['id'] ?>')" type="button" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash" title="ELIMINAR"></i>
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
			dom: 'B<"clear">lfrtip',
		    buttons: [
		        'copy', 'excel', 'pdf'
		    ]									
		});
	});
</script>
