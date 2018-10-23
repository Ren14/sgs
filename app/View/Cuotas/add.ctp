<div class="row">
	<?php echo $this->Form->create('Cuota', array('type' => 'file')); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<legend><?php echo __('Nuevo Cuota'); ?></legend>
		</div>
		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('socio_id', array('class' => 'form-control', 'label' => 'Socio', 'div' => false, 'options' => $socios, 'empty' => '- Seleccionar Socio- ', 'required' => true, 'value' => $socio_id, 'onchange' => 'getLotes();'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('tipo_pago', array('class' => 'form-control', 'options' => $tipo_pago, 'required' => true));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class="form-group">
				<label for="CuotaFechaPago">Fecha de Pago</label>
				<input name="data[Cuota][fecha_pago]" class="form-control" required="required" value="<?php echo date('Y-m-d') ?>" type="date" id="CuotaFechaPago">
			</div>
		</div>		
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('recibo', array('class' => 'form-control', 'div' => false, 'required' => true, 'label' => 'Número de Recibo', 'type' => 'number', 'title' => 'En este campo se debe ingresar el numero de recibo manual que corresponde a la cuota generada.'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('numero', array('class' => 'form-control', 'div' => false, 'readonly' => true, 'label' => 'Número de Recibo Interno', 'value' => $numero, 'title' => 'Es el numero de recibo interno que genera el sistema. Este numero es único para cada recibo generado.'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php echo $this->Form->input('Cuota.photo', array('type' => 'file', 'label' => 'Adjuntar archivo')); ?>
    			<?php echo $this->Form->input('Cuota.photo_dir', array('type' => 'hidden')); ?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
				<div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>ATENCIÓN!</strong><br><br> Recuerde que si elige el <strong>tipo de pago Transferencia-Cheque-Tarjeta-Otro </strong> deberá agregar una <strong>Observación</strong> que detalle la transacción seleccionada y <strong>adjuntar el archivo asociado</strong>.
				</div>
			</div>
	</fieldset>
	<hr>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="div-lotes" style="overflow-x: overlay">
		
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<button type="button" onclick="validarFormulario();" class="btn btn-outline btn-primary pull-right">Guardar</button>


		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
	</div>
	<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">

	$(function() {
		$('#CuotaSocioId').select2();
	});

	function validarFormulario() {
		var socio = $('#CuotaSocioId').val();
		var fecha_pago = $('#CuotaFechaPago').val();
		var error = 0;
		var cantidad_lotes = 0;

		if(!socio){
			swal('Atención!', 'Debe seleccionar un Socio', 'error');
			error = 1;
			return false;
		}

		if(!fecha_pago){
			swal('Atención', 'Debe seleccionar una fecha de pago', 'error');
			error = 1;
			return false;
		}

		// VERIFICO SI HAY ALGUN RENGLON CONFIRMADO Y LO EVALUO
		$("#tabla-lotes tbody tr").each(function (index) {			
			estado = $('#CuotaDetalle'+index+'Confirmar').prop('checked');
			console.log('Fila: ' + index + ' Estado: ' + estado);

			// Si esta checkeado, valido la fila
			if(estado){
				var montoCuota = "<?php echo $monto['Parametro']['valor'] ?>";
				var montoFila = $('#CuotaDetalle'+index+'Monto').val();
				var observacion = $('#CuotaDetalle'+index+'Observacion').val();
				var montoCalculado;
				var mes_inicio;
				var mes_fin;
				var meses;

				mes_inicio = $('#CuotaDetalle'+index+'MesDesde').val();
				mes_fin = $('#CuotaDetalle'+index+'MesHasta').val();
				meses = (mes_fin - mes_inicio) + 1;			
				montoCalculado = meses * montoCuota;
				console.log(montoCalculado +" " + montoFila + " " + observacion) 
				if(montoCalculado != montoFila && observacion == ""){
					console.log('V');
					swal('Atención', 'El Monto calculado $'+montoCalculado+' de la Fila #'+index+' es distinto al Monto ingresado $'+montoFila+'\n\n Para continuar deberá cargar una observación que justifique la diferencia.', 'error');
					error = 1;					
				} else {
					console.log('F');
					cantidad_lotes = cantidad_lotes + 1;
				}				
			}
		});

		if(cantidad_lotes < 1){			
			error = 1;
			return false;
		}

		if(!error)
			$('#CuotaAddForm').submit();
	}

	function getLotes() {
		var socio = $('#CuotaSocioId').val();

		$.ajax({
			url: "<?php echo $this->Html->url(array('action' => 'getLotesBySocio', 'controller' => 'Lotes')) ?>",
			type: 'POST',
			data: {socio:socio},
		}).done(function(response){
			$('#div-lotes').html('');
			$('#div-lotes').html(response);
		}).fail(function(response){
			console.log(response);
		});
		
	}
	function validarCuota(ck,i,lote_id,anio,mes_d,mes_h){
		if(anio != '' && mes_d != '' && mes_h != '' && lote_id != ''){

			$.ajax({
				url: '<?php echo $this->Html->url(array('controller'=> 'Cuotas','action' => 'validarCuota')) ?>',
				type: 'POST',
				//dataType: 'json',
				data: {
					lote_id: lote_id,
					anio: anio,
					mes_d:mes_d,
					mes_h:mes_h
				},
			})
			.done(function(res) {
				if(res == 1){
					$("#CuotaDetalle"+i+"AnioPago").val('')
					console.log('Existe Cuota')
					ck.prop('checked', false);
					new PNotify({
						title: 'Aviso',
						text: 'Ya existe una cuota pagada en ese rango. Para más información visite el Historico.',
						type: 'warning'
					});
				}else{
					console.log('No existe cuota')
				}
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}else{
			new PNotify({
				title: 'Aviso',
				text: 'Antes de confirmar debe completar todos los datos de la Cuota',
				type: 'info'
			});
			ck.prop('checked', false);
		}

	}
</script>