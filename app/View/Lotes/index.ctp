<div class="ibox float-e-margins lotes index">
	<?php if(in_array($this->Session->read('Auth.User.rol'), array(2,3))){?>
	<div class="row">
		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-6">
			<?php echo $this->Form->input('filtro_estado', array('class' => 'form-control', 'label' => 'Filtar por Estado', 'div' => 'false', 'value' => $filtro_estado, 'options' => $filtro_estados)) ?> 
		</div>
		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-2">
			<button type="button" class="btn btn-outline btn-default" onclick="filtrarLotes();" style="margin-top: 25px"> Filtrar</button>		
		</div>	
		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-3">
			<a type="button" class="btn btn-outline btn-success" href="<?php echo $this->Html->url(array('action' => 'add')); ?>" style="margin-top: 25px"> Nuevo Lote</a>		
		</div>		
	</div>
	<hr class="hidden-xs">
	<?php } ?>
	<div class="ibox-content" style="overflow-x: overlay;">
		<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>Número Lote</th>
					<th>Socio</th>
					<th>Fecha Adquisición</th>
					<th>Estado</th>
					
					
					<th class="actions"><?php echo __('Opciones'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lotes as $lote): ?>
					<tr>
						<td><?php echo $lote['Lote']['numero']; ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($lote['Socio']['nombre_completo'], array('controller' => 'socios', 'action' => 'view', $lote['Socio']['id'])); ?>
						</td>
						<td><?php echo date('d-m-Y',strtotime($lote['Lote']['fecha_adquisicion'])); ?>&nbsp;</td>
						<td><?php echo $estado[$lote['Lote']['activo']]; ?>&nbsp;</td>
						
						<td class="actions">
							<a target="_blank" href="<?php echo $this->Html->url(array('action' => 'view', $lote['Lote']['id']	)); ?>" type="button" class="btn btn-outline btn-success btn-xs"><i class="fa fa-search"></i></a>
							<?php if(in_array($this->Session->read('Auth.User.rol'), array(2,3))){ ?>

								<a target="_blank" href="<?php echo $this->Html->url(array('action' => 'edit', $lote['Lote']['id']	)); ?>" type="button" class="btn btn-outline btn-warning btn-xs"><i /class="fa fa-pencil"></i></a>

							<?php } ?>
							<?php if ($lote['Lote']['activo'] && in_array($this->Session->read('Auth.User.rol'), array(2,3))) { ?>
								<a href="<?php echo $this->Html->url(array('action' => 'add', 'controller' => 'CuotaAguas', $lote['Lote']['id']	)); ?>" type="button" class="btn btn-outline btn-info btn-xs"><i class="fa fa-money" title="PAGAR CUOTA AGUA"></i></a>
								<a href="#" onclick="borrar('<?php echo $lote['Lote']['id'] ?>', '<?php echo $this->Html->url(array('action' => 'desactivar')) ?>/')" type="button" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash" title="BORRAR LOTE"></i></a>
								
							<?php } ?>
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

	function filtrarLotes() {
		// body...
		var estado = $('#filtro_estado').val();
		
		var direccion = "<?php echo $this->Html->url(array('controller' => 'Lotes')) ?>/index/" + estado;
		console.log(direccion);
		window.location.replace(direccion);
	}

</script>
