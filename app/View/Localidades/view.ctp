<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	<h2>Ver Registro <?php echo __('Localidade'); ?></h2>
</div>
	
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Provincia Id'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($localidade['Localidade']['provincia_id']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Localidad'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($localidade['Localidade']['localidad']); ?>'>
</div>
</div>
	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>		
	<div>	
</div>
