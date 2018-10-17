<div class="row">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		
		<legend><?php echo __('Nuevo Usuario'); ?></legend>
	</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group' id="div-username">
	<?php
		echo $this->Form->input('username', array('class' => 'form-control', 'type' => 'text', 'required' => true, 'onblur' => 'comprobarUsername()'));
	?>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>
	<?php
		echo $this->Form->input('password', array('class' => 'form-control', 'type' => 'text', 'required' => true));
	?>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>
	<?php
		echo $this->Form->input('rol', array('class' => 'form-control', 'options' => $roles, 'empty' => ' - Seleccionar -', 'required' => true));
	?>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>
	<?php
		if($error){ ?>
		<div class="alert alert-danger alert-dismissable" id="alerta-usuario">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            Este nombre de usuario ya se encuentra utilizado.
        </div>
		<?php }
	?>
</div>
</div>
	</fieldset>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
			<button type="submit" class="btn btn-outline btn-primary pull-right" id="btn-guardar" disabled="disabled">Guardar</button>
	 

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
			      		$('#div-username').attr('class', 'form-group has-error');
			      		$('#btn-guardar').attr('disabled', 'disabled');
			      	} else {
			      		$('#div-username').attr('class', 'form-group has-success');
			      		$('#btn-guardar').removeAttr('disabled');
			      		$('#alerta-usuario').remove();
			      	}
			    }
			});
		}
	}
</script>