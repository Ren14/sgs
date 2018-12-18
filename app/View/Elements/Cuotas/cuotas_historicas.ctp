<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2>Listado del cuotas del socio <b><?php echo $lote['Socio']['apellido']. " ". $lote['Socio']['nombre'] ?></b></h2>
		<p>Fecha de Adquisición del Lote: <b><?php echo date('d-m-Y', strtotime($lote['Lote']['fecha_adquisicion']));?></b></p>
	</div>
</div>
<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0" id="tabla-lotes">
	<thead>
		<tr>
			<th>Año</th>
			<th>Mes</th>
			<th>Monto</th>
			<th>Tipo Pago</th>
			<th>Fecha de Pago</th>
			<th>Observaciones</th>
			<th># Recibo</th>
			<th># R. Interno</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($aux as $key => $value) { 
			if(isset($value['Cuota'] )){ ?> 
				<?php if (in_array($this->Session->read('Auth.User.rol'), array(2,3)) && $value['Cuota']['mes_desde'] == $value['Cuota']['mes_hasta'] && $value['Cuota']['recibo_id'] == '') {?>
					<tr>					
						<td><?php echo date('Y', strtotime($value['Fecha'])); 
							echo $this->Form->input('Cuota.'.$key.'.anio_pago', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => date('Y', strtotime($value['Fecha']))));
							echo $this->Form->input('Cuota.'.$key.'.id', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $value['Cuota']['id']));
						?></td>
						<td><?php echo $nombre_mes[ (int) date('m', strtotime($value['Fecha'])) ]; 
							echo $this->Form->input('Cuota.'.$key.'.mes_pago', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => date('m', strtotime($value['Fecha']))));
						?></td>
						<td><?php echo $this->Form->input('Cuota.'.$key.'.monto', array('class' => 'form-control', 'label' => false, 'div' => false, 'value' => $value['Cuota']['monto'])); ?></td>
						<td><?php echo $this->Form->input('Cuota.'.$key.'.tipo_pago', array('class' => 'form-control', 'label' => false, 'div' => 'false', 'options' => $tipo_pago, 'empty' => '- Seleccionar', 'value' => $value['Cuota']['tipo_pago'])); ?></td>
						<td><input name="data[Cuota][<?php echo $key; ?>][fecha_pago]" class="form-control" type="date" id="Cuota<?php echo $key; ?>FechaPago" required="required" value="<?php echo date('Y-m-d', strtotime($value['Cuota']['fecha_pago'])) ?>"></td>
						<td><?php echo $this->Form->input('Cuota.'.$key.'.observacion', array('class' => 'form-control', 'label' => false, 'div' => false, 'rows' => 1, 'value' => $value['Cuota']['observacion'])); ?></td>
						<td><?php echo $this->Form->input('Cuota.'.$key.'.recibo', array('class' => 'form-control', 'label' => false, 'div' => false, 'value' => @$value['Cuota']['recibo'])); ?></td>
						<td></td>
						<td>
							<button style="display: none;" id="btn-<?php echo $key; ?>" type="button" onclick="guardarCuotaHistorica('<?php echo $key; ?>');" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-save"></i></button>
							<button type="button" id="btn-editar-<?php echo $key; ?>" onclick="editarCuotaHistorica('<?php echo $key; ?>');" class="btn btn-outline btn-warning btn-xs"><i class="fa fa-edit"></i></button>
							<?php if ($this->Session->read('Auth.User.rol') == 3 ){ ?>
							<button type="button" id="btn-eliminar-<?php echo $key; ?>" onclick="eliminarCuotaHistorica('<?php echo $key; ?>');" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash"></i></button>
							<?php } ?>
						</td>
					</tr>
				<?php } else { ?>
					<tr>
					<td><?php echo date('Y', strtotime($value['Fecha'])); ?></td>
					<td><?php echo $nombre_mes[ (int) date('m', strtotime($value['Fecha'])) ]; ?></td>
					<td><?php echo '$'. number_format($value['Cuota']['monto'] / ($value['Cuota']['mes_hasta'] +1 - $value['Cuota']['mes_desde']),2,",","."); ?></td>
					<td><?php echo $tipo_pago[$value['Cuota']['tipo_pago']]; ?></td>
					<td><?php echo date('d-m-Y', strtotime($value['Cuota']['fecha_pago'])); ?></td>
					<td><?php echo $value['Cuota']['observacion'] . " Período " .  $nombre_mes[$value['Cuota']['mes_desde']] . "/". $nombre_mes[$value['Cuota']['mes_hasta']]; ?></td>
					<td><?php echo @$value['Cuota']['recibo']; ?></td>
					<td><?php echo @$value['Recibo']['numero']; ?></td>
					<td></td>
				</tr>
				<?php } ?>
			<?php } else { ?>
				<tr>
					<td><?php echo date('Y', strtotime($value['Fecha'])); 
						echo $this->Form->input('Cuota.'.$key.'.anio_pago', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => date('Y', strtotime($value['Fecha']))));
					?></td>
					<td><?php echo $nombre_mes[ (int) date('m', strtotime($value['Fecha'])) ]; 
						echo $this->Form->input('Cuota.'.$key.'.mes_pago', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => date('m', strtotime($value['Fecha']))));
					?></td>
					<td><?php echo $this->Form->input('Cuota.'.$key.'.monto', array('class' => 'form-control', 'label' => false, 'div' => false)); ?></td>
					<td><?php echo $this->Form->input('Cuota.'.$key.'.tipo_pago', array('class' => 'form-control', 'label' => false, 'div' => 'false', 'options' => $tipo_pago, 'empty' => '- Seleccionar')); ?></td>
					<td><input name="data[Cuota][<?php echo $key; ?>][fecha_pago]" class="form-control" type="date" id="Cuota<?php echo $key; ?>FechaPago" required="required"></td>
					<td><?php echo $this->Form->input('Cuota.'.$key.'.observacion', array('class' => 'form-control', 'label' => false, 'div' => false, 'rows' => 1)); ?></td>
					<td><?php echo $this->Form->input('Cuota.'.$key.'.recibo', array('class' => 'form-control', 'label' => false, 'div' => false)); ?></td>
					<td></td>
					<td>
						<?php 
						# SI EL USUARIO NO ES UN AUDITOR, PUEDE CREAR
						if($this->Session->read('Auth.User.rol') != 4){ ?>
							<button id="btn-<?php echo $key; ?>" type="button" onclick="guardarCuotaHistorica('<?php echo $key; ?>');" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-save"></i></button></td>
						<?php }  ?>
				</tr>
			<?php } ?>
		<?php } ?>		
	</tbody>
</table>

<script type="text/javascript">
	function guardarCuotaHistorica(key) {
		console.log(key);
		var lote_id = $('#CuotaLoteId').val();
		var monto = $('#Cuota'+key+'Monto').val();
		var tipo_pago = $('#Cuota'+key+'TipoPago').val();
		var fecha_pago = $('#Cuota'+key+'FechaPago').val();
		var observacion = $('#Cuota'+key+'Observacion').val();
		var recibo = $('#Cuota'+key+'Recibo').val();
		var anio_pago = $('#Cuota'+key+'AnioPago').val();
		var mes_pago = $('#Cuota'+key+'MesPago').val();
		if(!monto){
			swal('Atención', 'Debe ingresar un monto.', 'error');
			return false;
		}

		if(!tipo_pago){
			swal('Atención', 'Debe elegir un tipo de pago.', 'error');
			return false;
		}		

		if(!fecha_pago){
			swal('Atención', 'Debe ingresar una fecha de pago.', 'error');
			return false;
		}

		if(!recibo){
			swal('Atención', 'Debe ingresar un numero de recibo.', 'error');
			return false;
		}

		$('#btn-'+key).attr('disabled', 'disabled');
		$.ajax({
			url: "<?php echo $this->Html->url(array('action' => 'addCuotaHistoricas', 'controller' => 'Cuotas')) ?>",
			type: 'POST',
			data: {
				lote_id : lote_id,
				monto : monto,
				tipo_pago : tipo_pago,
				fecha_pago : fecha_pago,
				observacion: observacion,
				recibo : recibo,
				anio_pago : anio_pago,
				mes_pago : mes_pago,
			},
			async: true,
		}).done(function(response){
			if(response == 1){
				$('#btn-'+key).remove();
				new PNotify({
				    title: 'Atención !',
				    text: 'La cuota se guardó correctamente.',
				    type: 'info'
				});
			}
			else{
				swal('Atención', 'Ocurrió un error al guardar la cuota. Intente nuevamente.', 'error');
			}
		}).fail(function(response){
			console.log(response);
		});
	}

	function editarCuotaHistorica(key) {
		console.log(key);
		var id = $('#Cuota'+key+'Id').val();
		var lote_id = $('#CuotaLoteId').val();
		var monto = $('#Cuota'+key+'Monto').val();
		var tipo_pago = $('#Cuota'+key+'TipoPago').val();
		var fecha_pago = $('#Cuota'+key+'FechaPago').val();
		var observacion = $('#Cuota'+key+'Observacion').val();
		var recibo = $('#Cuota'+key+'Recibo').val();
		var anio_pago = $('#Cuota'+key+'AnioPago').val();
		var mes_pago = $('#Cuota'+key+'MesPago').val();
		$('#btn-editar-'+key).attr('disabled', 'disabled');
		if(!monto){
			swal('Atención', 'Debe ingresar un monto.', 'error');
			return false;
		}

		if(!tipo_pago){
			swal('Atención', 'Debe elegir un tipo de pago.', 'error');
			return false;
		}		

		if(!fecha_pago){
			swal('Atención', 'Debe ingresar una fecha de pago.', 'error');
			return false;
		}

		
		$.ajax({
			url: "<?php echo $this->Html->url(array('action' => 'editCuotaHistoricas', 'controller' => 'Cuotas')) ?>",
			type: 'POST',
			data: {
				lote_id : lote_id,
				monto : monto,
				tipo_pago : tipo_pago,
				fecha_pago : fecha_pago,
				observacion: observacion,
				recibo : recibo,
				anio_pago : anio_pago,
				mes_pago : mes_pago,
				id : id,
			},
			async: true,
		}).done(function(response){
			if(response == 1){
				new PNotify({
				    title: 'Atención !',
				    text: 'La cuota se editó correctamente.',
				    type: 'info'
				});
				$('#btn-editar-'+key).removeAttr('disabled');
			}
			else{
				swal('Atención', 'Ocurrió un error al guardar la cuota. Intente nuevamente.', 'error');
			}
		}).fail(function(response){
			console.log(response);
		});
	}

	function eliminarCuotaHistorica(key){
		swal({
	        title: "ATENCIÓN",
	        text: "¿Está seguro de eliminar la Cuota Histórica?",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	        buttons: ["Cancelar", "Borrar"]
	    })
	    .then((willDelete) => {
	        if (willDelete) {
	        	$('#btn-eliminar-'+key).attr('disabled', 'disabled');
	            $.ajax({
					url: "<?php echo $this->Html->url(array('action' => 'desactivar', 'controller' => 'Cuotas')) ?>/"+$('#Cuota'+key+'Id').val(),
					type: 'GET',
					async: true,
				}).done(function(error){
					if(error == 0){
						
						$('#Cuota'+key+'Monto').val('');
						$('#Cuota'+key+'TipoPago').val('');
						$('#Cuota'+key+'FechaPago').val('');
						$('#Cuota'+key+'Observacion').val('');
						$('#Cuota'+key+'Recibo').val('');
						
						$('#btn-eliminar-'+key).remove();
						$('#btn-editar-'+key).remove();
						$('#btn-'+key).removeAttr('style');
						new PNotify({
						    title: 'Atención !',
						    text: 'La cuota se eliminó correctamente.',
						    type: 'info'
						});
					}
					else{
						swal('Atención', 'Ocurrió un error al eliminar la cuota. Error # '+error+'. Recargue la página e intente nuevamente.', 'error');
					}
				}).fail(function(response){
					swal('Atención', 'Ocurrió un error al eliminar la cuota. Error # '+error+'. Recargue la página e intente nuevamente.', 'error');
				});
	        }
	    });
		
		
	}

</script>
