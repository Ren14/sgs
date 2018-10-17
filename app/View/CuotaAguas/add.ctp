<div class="row">
	<?php echo $this->Form->create('CuotaAgua', array('type' => 'file')); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<legend><?php echo __('Nueva Cuota Agua'); ?></legend>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('lote_id', array('class' => 'form-control', 'label' => '# Lote', 'div' => false, 'options' => $lotes, 'empty' => '- Seleccionar - ', 'required' => true, 'value' => $lote_id));
				?>
			</div>
		</div>

		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('cantidad', array('class' => 'form-control', 'label' => 'Cantidad de cuotas', 'div' => false, 'required' => true, 'type' => 'number', 'value' => 1, 'onblur' => 'actualizarMonto();', 'onclick' => '$(this).select();'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('monto', array('class' => 'form-control', 'type' => 'number', 'required' => true, 'value' => $monto['Parametro']['valor'],  'onclick' => '$(this).select();'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class="form-group">
				<label for="CuotaFechaPago">Fecha de Pago</label>
				<input name="data[CuotaAgua][fecha_pago]" class="form-control" required="required" value="<?php echo date('Y-m-d') ?>"  type="date" id="CuotaAguaFechaPago">
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('tipo_pago', array('class' => 'form-control', 'options' => $tipo_pago, 'required' => true));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('observacion', array('class' => 'form-control', 'rows' => 5));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class='form-group'>
				<?php echo $this->Form->input('CuotaAgua.photo', array('type' => 'file', 'label' => 'Adjunto')); ?>
    			<?php echo $this->Form->input('CuotaAgua.photo_dir', array('type' => 'hidden')); ?>
			</div>
		</div>
	</fieldset>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<button type="button" onclick="validarMonto();" class="btn btn-outline btn-primary pull-right">Guardar</button>


		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
	</div>
	<?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
	$(function() {
		$('#CuotaAguaLoteId').select2();
	});
</script>

<script type="text/javascript">
	
	function actualizarMonto() {
		var cant_cuotas = $('#CuotaAguaCantidad').val();
		var monto_cuota = <?php echo $monto['Parametro']['valor']; ?>;
		
		$('#CuotaAguaMonto').val(cant_cuotas * monto_cuota);
	}

	function validarMonto() {
		var cant_cuotas = $('#CuotaAguaCantidad').val();
		var monto_cuota = <?php echo $monto['Parametro']['valor']; ?>;
		var monto_final = $('#CuotaAguaMonto').val();
		var monto_calculado = cant_cuotas * monto_cuota;
		var lote = $('#CuotaAguaLoteId').val();
		var observacion = $('#CuotaAguaObservacion').val();
		if(monto_final != monto_calculado && !observacion) {
			swal("Atención", 'El Monto Final no coincide con el Monto Calculado.\n\n Para continuar deberá cargar una observación que justifique la diferencia.', 'error');
		} else {

			if(!lote){
				swal("Atención", 'Debe elegir un Lote', 'warning');
				return false;
			}
			
			$( "form:first" ).submit();
		}

	}
</script>