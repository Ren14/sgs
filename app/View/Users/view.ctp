<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<h2>Ver Registro <?php echo __('User'); ?></h2>
	</div>
	
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Username'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($user['User']['username']); ?>'>
		</div>
	</div>
	
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Rol'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($roles[$user['User']['rol']]); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Creado'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($user['User']['created']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Última Modificación'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($user['User']['modified']); ?>'>
		</div>
	</div>
	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>		
		<div>	
		</div>
