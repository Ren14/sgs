<div class="ibox float-e-margins socios index">	
	<div class="row">
		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-6">
			<?php echo $this->Form->input('filtro_estado', array('class' => 'form-control', 'label' => 'Filtar por Estado', 'div' => 'false', 'value' => $filtro_estado, 'options' => $filtro_estados)) ?> 
		</div>
		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-2">
			<button type="button" class="btn btn-outline btn-default" onclick="filtrarSocios();" style="margin-top: 25px"> Filtrar</button>		
		</div>
		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-3">
			<a type="button" class="btn btn-outline btn-success" href="<?php echo $this->Html->url(array('action' => 'add')); ?>" style="margin-top: 25px"> Nuevo Socio</a>		
		</div>	
	</div>
	<hr class="hidden-xs">
	<div class="ibox-content" style="overflow-x: overlay;">
		<table class="table table-bordered table-hover table-responsive" id="table-list" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th title="NUMERO DE SOCIO">#</th>
					<th>Apellido</th>
					<th>Nombre</th>
					<!--<th>Domicilio</th>-->
					<th class="hidden-xs hidden-sm">Teléfono</th>
					<th class="hidden-xs hidden-sm">Celular</th>
					<th class="hidden-xs hidden-sm">Email</th>					
					<th>Usuario</th>
					
					<!--<th>Modificado</th>-->
					<th>Estado</th>
					<th class="actions" style="width: 120px !important"><?php echo __('Opciones'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($socios as $socio): ?>
					<tr>
						<td><?php echo $socio['Socio']['numero']; ?></td>
						<td><?php echo h($socio['Socio']['apellido']); ?>&nbsp;</td>
						<td><?php echo h($socio['Socio']['nombre']); ?>&nbsp;</td>
						<!--<td><?php echo h($socio['Socio']['domicilio']); ?>&nbsp;</td>-->
						<td class="hidden-xs hidden-sm"><?php echo h($socio['Socio']['telefono']); ?>&nbsp;</td>
						<td class="hidden-xs hidden-sm"><?php echo h($socio['Socio']['celular']); ?>&nbsp;</td>
						<td class="hidden-xs hidden-sm"><?php echo h($socio['Socio']['email']); ?>&nbsp;</td>						
						<td>
							<?php echo $this->Html->link($socio['User']['username'], array('controller' => 'users', 'action' => 'view', $socio['User']['id'])); ?>
						</td>
						
						<td><?php echo $estado[$socio['Socio']['activo']]; ?>&nbsp;</td>
						<!--<td><?php echo date('d-m-Y H:i',strtotime($socio['Socio']['modified'])); ?>&nbsp;</td>-->
						<td class="actions">
							<a href="<?php echo $this->Html->url(array('action' => 'view', $socio['Socio']['id']	)); ?>" type="button" class="btn btn-outline btn-success btn-xs"><i class="fa fa-search"></i></a>
							<a href="<?php echo $this->Html->url(array('action' => 'edit', $socio['Socio']['id']	)); ?>" type="button" class="btn btn-outline btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							
							<a href="#" onclick="borrar('<?php echo $socio['Socio']['id'] ?>', '<?php echo $this->Html->url(array('action' => 'desactivar')); ?>/')" type="button" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash" title="ELIMINAR"></i></a>
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

	function filtrarSocios() {
		// body...
		var estado = $('#filtro_estado').val();
		
		var direccion = "<?php echo $this->Html->url(array('controller' => 'Socios')) ?>/index/" + estado;
		console.log(direccion);
		window.location.replace(direccion);
	}
</script>
