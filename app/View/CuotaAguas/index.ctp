<?php if(!isset($desde)){ ?>
	<?php $desde = date('Y-m-d') ?>
<?php } ?> 
<?php if(!isset($hasta)){ ?>
	<?php $hasta = date('Y-m-d') ?>
<?php } ?> 
<div class="ibox float-e-margins cuotaAguas index">
	<?php if(in_array($this->Session->read('Auth.User.rol'), array(2,3))){?>
	<div class="row">
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<div class="form-group">
				<div class="input text">
					<label for="">Fecha Inicio </label>
					<input name="fecha_ini" class="form-control" type="date" id="fecha_ini" required="required" value="<?php $d = explode(" ", $desde);echo $d[0] ?>">
				</div>			
			</div>
		</div>
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<div class="form-group">
				<div class="input text">
					<label for="">Fecha Hasta </label>
					<input name="fecha_fin" class="form-control" type="date" id="fecha_fin" required="required" value="<?php $h = explode(" ", $hasta);echo $h[0] ?>">
				</div>			
			</div>
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_estado', array('class' => 'form-control', 'label' => 'Filtar por Estado', 'div' => 'false', 'value' => $filtro_estado, 'options' => $estados, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_lote', array('class' => 'form-control', 'label' => 'Filtar por Lote', 'div' => 'false', 'value' => $filtro_lote, 'options' => $lotes, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_socio', array('class' => 'form-control', 'label' => 'Filtar por Socio', 'div' => 'false', 'value' => $filtro_socio, 'options' => $socios, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_numero_recibo', array('class' => 'form-control', 'label' => 'Filtar por Número de Recibo', 'div' => 'false', 'value' => $filtro_numero_recibo, 'options' => $recibos, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-6">
			<button type="button" class="btn btn-outline btn-default" onclick="filtrarCuotas();" style="margin-top: 25px"> Filtrar</button>		
		</div>	
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-6">
			<a type="button" class="btn btn-outline btn-success pull-right" href="<?php echo $this->Html->url(array('action' => 'add')); ?>" style="margin-top: 25px"> Nueva Cuota</a>			
		</div>		
	</div>
	<hr>
	<?php } ?>
	<div class="ibox-content" style="overflow-x: overlay;">
		<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th title="NUMERO DE CUOTA DE AGUA (REGISTRO) INTERNO">#</th>
					<th>Lote</th>
					<th>Socio</th>
					<th>Monto</th>
					<th>Recibo #</th>
					<th>Cant. Cuotas</th>
					<th style="min-width: 100px">F. Pago</th>
					
					<th>Estado</th>
					<th class="actions"><?php echo __('Opciones'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($cuotaAguas as $cuotaAgua): ?>
					<tr>
						<td><?php echo $cuotaAgua['CuotaAgua']['numero']; ?></td>
						<td data-order="<?php echo $cuotaAgua['Lote']['numero']?>">
							<?php echo $this->Html->link($cuotaAgua['Lote']['numero'], array('controller' => 'lotes', 'action' => 'view', $cuotaAgua['Lote']['id'])); ?>
						</td>
						<td data-order="<?php echo $cuotaAgua['Socio']['nombre_completo']?>">
							<?php echo $this->Html->link($cuotaAgua['Socio']['nombre_completo'], array('controller' => 'socios', 'action' => 'view', $cuotaAgua['Socio']['id'])); ?>
						</td>
						<td data-order="<?php echo $cuotaAgua['CuotaAgua']['monto'] ?>">$<?php echo number_format($cuotaAgua['CuotaAgua']['monto'], 2, ",", "."); ?></td>
						<td data-order="<?php echo $cuotaAgua['Recibo']['numero'] ?>"><?php echo $this->Html->link($cuotaAgua['Recibo']['numero'], array('controller' => 'recibos', 'action' => 'view', $cuotaAgua['Recibo']['id'])); ?></td>
						<td><?php echo $cuotaAgua['CuotaAgua']['cantidad']; ?></td>
						<td data-order="<?php echo $cuotaAgua['CuotaAgua']['fecha_pago'] ?>"><?php echo date('d-m-Y', strtotime($cuotaAgua['CuotaAgua']['fecha_pago'])); ?></td>
						
						<td><?php echo $estados_label[$cuotaAgua['CuotaAgua']['estado']]; ?></td>
						<td class="actions">
							<a href="<?php echo $this->Html->url(array('action' => 'view', $cuotaAgua['CuotaAgua']['id']	)); ?>" type="button" class="btn btn-outline btn-success btn-xs"><i class="fa fa-search"></i></a>
							<!--<a href="<?php echo $this->Html->url(array('action' => 'edit', $cuotaAgua['CuotaAgua']['id']	)); ?>" type="button" class="btn btn-outline btn-warning btn-xs"><i class="fa fa-pencil"></i></a>-->
							<?php if($cuotaAgua['CuotaAgua']['estado'] != 2 && in_array($this->Session->read('Auth.User.rol'), array(2,3))){ ?>
							<a href="#" onclick="anularCuotaAgua('<?php echo $cuotaAgua['CuotaAgua']['id'] ?>')" type="button" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash" title="ELIMINAR"></i></a>

							<?php } ?>
							<?php if(isset($cuotaAgua['CuotaAgua']['photo']) && $cuotaAgua['CuotaAgua']['photo'] != ''){ ?>								
								<?php echo $this->Html->link(
								    'Adjunto',
								    '../files/cuota_agua/photo/' . $cuotaAgua['CuotaAgua']['photo_dir'] . '/' . $cuotaAgua['CuotaAgua']['photo'],
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
<!--<pre>
	<?php print_r($cuotaAguas); ?>
</pre>-->
<script type="text/javascript">
	$( document ).ready(function() {
		$('table.table-bordered').DataTable({
			"language": dataTableEs,
			dom: 'B<"clear">lfrtip',
		    buttons: [
		        'copy', 'excel', 'pdf'
		    ]	,
			"order": [[ 0, "desc" ]],
			
		})

		$('#filtro_estado').select2();
		$('#filtro_lote').select2();
		$('#filtro_socio').select2();
		$('#filtro_numero_recibo').select2();
	});

	function anularCuotaAgua(cuota_agua_id) {
		swal("Justifique la anulación de la cuota:", {
			content: "input",
		})
		.then((value) => {
			if(value){
				window.location.replace("<?php echo $this->Html->url(array('action' => 'anularCuotaAgua')) ?>/" + cuota_agua_id+"/"+`${value}`);
			}
		});
	}

	function filtrarCuotas() {
		// body...
		var desde = $('#fecha_ini').val();
		var hasta = $('#fecha_fin').val();
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
		var direccion = "<?php echo $this->Html->url(array('controller' => 'CuotaAguas')) ?>/index/" + estado+'/'+lote+'/'+socio+'/'+numero_recibo+'/'+ desde+'/'+hasta;
		
		window.location.replace(direccion);
	}
</script>
