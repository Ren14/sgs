<div class="row">
	<?php echo $this->Form->create('CuotaAgua'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<legend><?php echo __('Editar Cuota Agua'); ?></legend>
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
			<div class='form-group'>
				<?php
				echo $this->Form->input('estado', array('class' => 'form-control', 'options' => $estados, 'value' => $this->request->data['CuotaAgua']['estado']));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('cantidad', array('class' => 'form-control'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('monto', array('class' => 'form-control'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class="form-group">
				<label for="CuotaFechaPago">Fecha de Pago</label>
				<input name="data[CuotaAgua][fecha_pago]" class="form-control" required="required" value="<?php echo $this->request->data['CuotaAgua']['fecha_pago']; ?>" type="date" id="CuotaAguaFechaPago">
			</div>
		</div>
	</fieldset>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	

		<button type="submit" class="btn btn-outline btn-warning pull-right">Editar</button>	


		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
	</div>
	<?php echo $this->Form->end(); ?>
</div>
