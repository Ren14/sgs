<div class="row">
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<legend><?php echo __('Editar Usuario'); ?></legend>
		</div>
		<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		?>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group' id="div-username">
				<?php
				echo $this->Form->input('username', array('class' => 'form-control', 'required' => true, 'type' => 'text', 'required' => true, 'readonly' => true,'label' => 'Nombre de usuario'));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('password', array('class' => 'form-control', 'type' => 'text', 'value' => '', 'placeholder' => 'Dejar en blanco para NO modificar. Escribe la nueva contraseña para modificar.','label' => 'Contraseña'));
				?>
			</div>
		</div>
		<?php $rol = $this->Session->read('Auth.User.rol'); ?>
		<?php if($rol != 1){ ?>

		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('rol', array('class' => 'form-control', 'options' => $roles, 'empty' => ' - Seleccionar -', 'required' => true));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class="form-group">
				<?php
				echo $this->Form->input('activo', array('class' => 'form-control', 'required' => false, 'div' => false, 'label' => 'Estado', 'options' => $estados));
				?>			
			</div>		
		</div>
		<?php } ?>
	</fieldset>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	

		<button type="submit" class="btn btn-outline btn-warning pull-right" id="btn-guardar">Editar</button>	


		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
	</div>
	<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
	function comprobarUsername() {
		var username = $('#UserUsername').val();
		if(username){			
			var direccion = "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'comprobarUsername')); ?>";
			$.ajax({
				url: direccion,
				data: {username: username},
				type: 'POST',
				success: function(html){
					console.log(html);
					if(html == 1){
						username_actual = "<?php echo $this->request->data['User']['username']; ?>";
						console.log(username_actual);
						console.log(username);
						if(username_actual != username){
							$('#div-username').attr('class', 'form-group has-error');
							$('#btn-guardar').attr('disabled', 'disabled');
						} else {
							$('#div-username').attr('class', 'form-group has-success');
							$('#btn-guardar').removeAttr('disabled');	
						}
					} else {
						$('#div-username').attr('class', 'form-group has-success');
						$('#btn-guardar').removeAttr('disabled');
					}
				}
			});
		}
	}

</script>