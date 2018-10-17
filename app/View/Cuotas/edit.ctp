<div class="row">
	<?php echo $this->Form->create('Cuota'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<legend><?php echo __('Editar Cuota'); ?></legend>
		</div>
		<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		?>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('socio_id', array('class' => 'form-control', 'label' => 'Socio', 'div' => false, 'options' => $socios, 'empty' => '- Seleccionar - ', 'required' => true));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class="form-group">
				<label for="CuotaFechaPago">Fecha de Pago</label>
				<input name="data[Cuota][fecha_pago]" class="form-control" required="required" value="<?php echo $this->request->data['Cuota']['fecha_pago']; ?>" type="date" id="CuotaFechaPago">
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('monto', array('class' => 'form-control'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('recibo', array('class' => 'form-control', 'div' => false, 'required' => true, 'label' => 'Número de Recibo', 'type' => 'number'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('recibo_interno', array('class' => 'form-control', 'div' => false, 'readonly' => true, 'label' => 'Número de Recibo Interno'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('estado', array('class' => 'form-control', 'options' => $estados, 'value' => $this->request->data['Cuota']['estado']));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('anio_pago', array('class' => 'form-control', 'type' => 'text', 'required' => true, 'label' => 'Año de Pago', 'title' => 'Año al que corresponde el pago'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('mes_desde', array('class' => 'form-control', 'required' => true, 'label' => 'Mes Desde Pago', 'title' => 'Mes de inicio al que corresponde el pago', 'options' => $mes_desde));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('mes_hasta', array('class' => 'form-control', 'required' => true, 'label' => 'Mes Hasta Pago', 'title' => 'Mes de fin al que corresponde el pago', 'options' => $mes_hasta));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('observaciones', array('class' => 'form-control'));
				?>
			</div>
		</div>
	</fieldset>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	

		<button type="submit" class="btn btn-outline btn-warning pull-right">Editar</button>	


		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
	</div>
	<?php echo $this->Form->end(); ?>
</div>
