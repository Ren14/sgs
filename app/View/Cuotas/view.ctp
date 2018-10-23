<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	<h2>Ver Registro <?php echo __('Cuota'); ?></h2>
</div>
	
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Lote'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($cuota['Lote']['numero']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Fecha de Pago'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo date("d-m-Y", strtotime($cuota['Cuota']['fecha_pago'])); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Monto'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo number_format($cuota['Cuota']['monto'], 2, ",","."); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Número de Recibo'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($cuota['Recibo']['numero']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Número de Recibo Manual'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($cuota['Cuota']['recibo']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Estado'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($estados[$cuota['Cuota']['estado']]); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Año Pago'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($cuota['Cuota']['anio_pago']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
<div class='form-group'>		<label><?php echo __('Mes Desde'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($mes_desde[$cuota['Cuota']['mes_desde']]); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
<div class='form-group'>		<label><?php echo __('Mes Hasta'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($mes_hasta[$cuota['Cuota']['mes_hasta']]); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Observaciones'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo h($cuota['Cuota']['observacion']); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Creado'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($cuota['Cuota']['created'])); ?>'>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>		<label><?php echo __('Última Modificación'); ?></label>
		<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($cuota['Cuota']['modified'])); ?>'>
</div>
</div>
<?php if(isset($cuota['Cuota']['justificacion']) && $cuota['Cuota']['justificacion'] != ''){ ?>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
	<div class='form-group'>		<label><?php echo __('Justificación por anulación'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo $cuota['Cuota']['justificacion']; ?>'>
	</div>
	</div>
<?php } ?>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<?php if(isset($cuota['Cuota']['photo']) && $cuota['Cuota']['photo'] != ''){ ?>								
	<?php echo $this->Html->link(
	    'Descargar Adjunto',
	    '../files/cuota/photo/' . $cuota['Cuota']['photo_dir'] . '/' . $cuota['Cuota']['photo'],
	    array('class' => 'btn btn-outline btn-info btn-xs', 'target' => '_blank', 'Title' => 'Descargar Archivo Adjunto')
	); ?>
	
<?php } ?>
</div>
	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>		
	<div>	
</div>
