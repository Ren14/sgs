<div class="row">
	<?php echo $this->Form->create('Socio'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
			<legend><?php echo __('Editar Socio'); ?></legend>
		</div>
		<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		?>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('apellido', array('class' => 'form-control', 'type' => 'text', 'required' => true, 'placeholder' => 'Juan José'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('nombre', array('class' => 'form-control', 'type' => 'text', 'required' => true, 'placeholder' => 'Perez'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('dni', array('class' => 'form-control', 'type' => 'text', 'required' => true, 'label' => 'DNI'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('provincia_id', array('class' => 'form-control','required' => true, 'options' => $provincias, 'onchange' => 'getLocalidades()'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group' id="div-localidades">
				<?php
				echo $this->Form->input('localidad_id', array('class' => 'form-control','required' => true, 'options' => $localidades));
				?>
			</div>
		</div>	
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('domicilio', array('class' => 'form-control', 'type' => 'text', 'required' => true, 'placeholder' => 'San Martín 222, Ciudad, Mendoza.'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('telefono', array('class' => 'form-control', 'type' => 'text', 'placeholder' => '261 4218233'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('celular', array('class' => 'form-control', 'type' => 'text', 'placeholder' => '261 5398997'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('email', array('class' => 'form-control', 'type' => 'email', 'placeholder' => 'juanperez@gmail.com'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('activo', array('class' => 'form-control', 'label' => 'Estado', 'options' => $estados));
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

<script type="text/javascript">
	function getLocalidades() {
		var provincia_id = $('#SocioProvinciaId').val();

		$.ajax({
			url: "<?php echo $this->Html->url(array('controller' => 'Localidades', 'action' => 'getLocalidades')) ?>/",
			type: 'POST',
			data: {provincia_id : provincia_id},
		}).done(function(respuesta){
			$('#div-localidades').html(respuesta);
		}).fail(function(respuesta) {
			swal("Atención!", "Ocurrió un error al obtener las localidades. Intente nuevamente.", "error");
		});
	}
</script>