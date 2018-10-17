<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	<h2>Ver Registro <?php echo __('Recibo Detalle'); ?></h2>
</div>
	
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Recibo Id'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($reciboDetalle['ReciboDetalle']['recibo_id']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Cuota Agua Id'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($reciboDetalle['ReciboDetalle']['cuota_agua_id']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Cuota Id'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($reciboDetalle['ReciboDetalle']['cuota_id']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Creado'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($reciboDetalle['ReciboDetalle']['created']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Última Modificación'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($reciboDetalle['ReciboDetalle']['modified']); ?>'>
</div>
</div>
	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>		
	<div>	
</div>
