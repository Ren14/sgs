<div class="row">
	<?php echo $this->Form->create('Socio'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
			<legend><?php echo __('Nuevo Socio'); ?></legend>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('apellido', array('class' => 'form-control', 'type' => 'text', 'required' => true, 'placeholder' => 'Perez'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('nombre', array('class' => 'form-control', 'type' => 'text', 'required' => true, 'placeholder' => 'Juan'));
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
			<div class='form-group' id="div-username">
				<?php
				echo $this->Form->input('username', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Por ejemplo el DNI', 'required' => 'true', 'onblur' => 'comprobarUsername()'));
				?>
			</div>
		</div>
		<!--<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<button type="button" class="btn btn-outline btn-info pull-right" onkeypress="comprobarUsername();">Verificar</button>
		</div>-->
		
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('password', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Por ejemplo el DNI', 'required' => 'true'));
				?>
			</div>
		</div>

		<?php
		if($error){ ?>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<div class="alert alert-danger alert-dismissable" id="alerta-usuario">
		            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		            Este nombre de usuario ya se encuentra utilizado.
		        </div>
		    </div>
		</div>
			<?php }
		?>
		</fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
			<button type="submit" class="btn btn-outline btn-primary pull-right" id="btn-guardar" disabled="disabled">Guardar</button>
			

			<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
		</div>
		<?php echo $this->Form->end(); ?>
	</div>

<script type="text/javascript">
	function comprobarUsername() {
		var username = $('#SocioUsername').val();
		if(username){			
			var direccion = "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'comprobarUsername')); ?>";
			$.ajax({
			    url: direccion,
			    data: {username: username},
			    type: 'POST',
			    success: function(html){
			    	console.log(html);
			      	if(html == 1){
			      		$('#div-username').attr('class', 'form-group has-error');
			      		$('#btn-guardar').attr('disabled', 'disabled');
			      	} else {
			      		$('#div-username').attr('class', 'form-group has-success');
			      		$('#btn-guardar').removeAttr('disabled');
			      	}
			    }
			});
		}
	}

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