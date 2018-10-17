<div class="ibox float-e-margins cuotas index">
	<?php if(in_array($this->Session->read('Auth.User.rol'), array(2,3))){?>
	<div class="row">
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_estado', array('class' => 'form-control', 'label' => 'Filtar por Estado', 'div' => 'false', 'value' => $filtro_estado, 'options' => $estados, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_lote', array('class' => 'form-control', 'label' => 'Filtar por Lote', 'div' => 'false', 'value' => $filtro_lote, 'options' => $lotes, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_socio', array('class' => 'form-control', 'label' => 'Filtar por Socio', 'div' => 'false', 'value' => $filtro_socio, 'options' => $socios, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_numero_recibo', array('class' => 'form-control', 'label' => 'Filtar por # Recibo', 'div' => 'false', 'value' => $filtro_numero_recibo, 'options' => $recibos, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-lg-1 col-md-4 col-sm-6  col-xs-4">
			<button type="button" class="btn btn-outline btn-default" onclick="filtrarCuotas();" style="margin-top: 25px"> Filtrar</button>		
		</div>	
		<div class="col-lg-1 col-md-4 col-sm-6  col-xs-4">
			<a type="button" class="btn btn-outline btn-success pull-right" href="<?php echo $this->Html->url(array('action' => 'add')); ?>" style="margin-top: 25px"> Nueva C.</a>						
		</div>		
		<div class="col-lg-1 col-md-4 col-sm-6  col-xs-4">
			<a type="button" class="btn btn-outline btn-primary pull-right" href="<?php echo $this->Html->url(array('action' => 'add_historicas')); ?>" style="margin-top: 25px"> C. Historicas</a>
		</div>
	</div>
	<hr>
	<?php } ?>
	<div class="ibox-content" style="overflow-x: overlay;">
		<table class="table table-bordered" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>#</th>
					<th>Lote</th>
					<th>Socio</th>
					<th>Monto</th>
					<th class="hidden-xs" title="Número de Recibo Interno"># R.</th>
					<th class="hidden-xs" title="Número de Recibo Manual"># RM.</th>
					<th>Período</th>
					<th class="hidden-xs">Observaciones</th>					
					<th style="min-width: 100px" title="Fecha de pago">F. Pago</th>
					<th>Estado</th>
					<th class="actions">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($cuotas as $cuota): ?>
					<tr>
						<td><?php echo $cuota['Cuota']['numero']; ?></td>
						<td data-order="<?php echo $cuota['Lote']['numero'];?>">
							<?php echo $this->Html->link($cuota['Lote']['numero'], array('controller' => 'lotes', 'action' => 'view', $cuota['Lote']['id'])); ?>
						</td>
						<td data-order="<?php echo $cuota['Socio']['apellido'];?>">
							<?php echo $this->Html->link($cuota['Socio']['apellido']. " ". $cuota['Socio']['nombre'], array('controller' => 'socios', 'action' => 'view', $cuota['Socio']['id'])); ?>
						</td>
						<td data-order="<?php echo $cuota['Cuota']['monto'];?>">$<?php echo number_format($cuota['Cuota']['monto'], 2, ",", "."); ?></td>
						<td data-order="<?php echo $cuota['Recibo']['numero'];?>" class="hidden-xs"><?php echo $this->Html->link($cuota['Recibo']['numero'], array('controller' => 'recibos', 'action' => 'view', $cuota['Recibo']['id'])); ?></td>
						<td data-order="<?php echo $cuota['Cuota']['recibo'];?>" class="hidden-xs"><?php echo h($cuota['Cuota']['recibo']); ?></td>
						<td><?php echo $cuota['Cuota']['anio_pago'] . " ". $mes_desde[$cuota['Cuota']['mes_desde']] . "/". $mes_hasta[$cuota['Cuota']['mes_hasta']]; ?></td>
						<td class="hidden-xs"><?php echo h($cuota['Cuota']['observacion']); ?></td>						
						<td data-order="<?php echo $cuota['Cuota']['fecha_pago']; ?>"><?php echo  date('d-m-Y', strtotime($cuota['Cuota']['fecha_pago'])); ?></td>
						<td><?php echo $estados_label[$cuota['Cuota']['estado']]; ?></td>
						<td class="actions">							
							<a href="<?php echo $this->Html->url(array('action' => 'view', $cuota['Cuota']['id']	)); ?>" type="button" class="btn btn-outline btn-success btn-xs"><i class="fa fa-search"></i></a>
							<?php if(isset($cuota['Cuota']['photo']) && $cuota['Cuota']['photo'] != ''){ ?>								
								<?php echo $this->Html->link(
								    'Adjunto',
								    '../files/cuota/photo/' . $cuota['Cuota']['photo_dir'] . '/' . $cuota['Cuota']['photo'],
								    array('class' => 'btn btn-outline btn-info btn-xs', 'target' => '_blank', 'Title' => 'Descargar Archivo Adjunto')
								); ?>
								
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
		    ]	,
			"order": [[ 0, "desc" ]]
		})

		$('#filtro_estado').select2();
		$('#filtro_lote').select2();
		$('#filtro_socio').select2();
		$('#filtro_numero_recibo').select2();
	});

	function filtrarCuotas() {
		// body...
		var estado = $('#filtro_estado').val();
		var lote = $('#filtro_lote').val();
		var socio = $('#filtro_socio').val();
		var numero_recibo = $('#filtro_numero_recibo').val();
		
		if(estado == '')
			estado = 99;
		if(lote == '')
			lote = 99;
		if(socio == '')
			socio = 99;
		if(numero_recibo == '')
			numero_recibo = 99
		var direccion = "<?php echo $this->Html->url(array('controller' => 'Cuotas')) ?>/index/" + estado+'/'+lote+'/'+socio+'/'+numero_recibo;
		
		window.location.replace(direccion);
	}
</script>
<!--<pre>
	<?php print_r($cuotas) ?>
</pre>-->