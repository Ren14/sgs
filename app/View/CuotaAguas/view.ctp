<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<h2>Ver Registro <?php echo __('Cuota Agua'); ?></h2>
	</div>
	
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Lote'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($cuotaAgua['Lote']['numero']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Estado'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($estados[$cuotaAgua['CuotaAgua']['estado']]); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Cantidad'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($cuotaAgua['CuotaAgua']['cantidad']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Monto'); ?></label>
			<input class='form-control' readonly='true' value='$<?php echo number_format($cuotaAgua['CuotaAgua']['monto'], 2, ",","."); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Fecha Pago'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo date("d-m-Y", strtotime($cuotaAgua['CuotaAgua']['fecha_pago'])); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Creado'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($cuotaAgua['CuotaAgua']['created'])); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Última Modificación'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($cuotaAgua['CuotaAgua']['modified'])); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Observación'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($cuotaAgua['CuotaAgua']['observacion']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Justificación por borrado'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($cuotaAgua['CuotaAgua']['justificacion']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
	<?php if(isset($cuotaAgua['CuotaAgua']['photo']) && $cuotaAgua['CuotaAgua']['photo'] != ''){ ?>								
		<?php echo $this->Html->link(
		    'Descargar Adjunto',
		    '../files/cuota_agua/photo/' . $cuotaAgua['CuotaAgua']['photo_dir'] . '/' . $cuotaAgua['CuotaAgua']['photo'],
		    array('class' => 'btn btn-outline btn-info btn-xs', 'target' => '_blank', 'Title' => 'Descargar Archivo Adjunto')
		); ?>
		
	<?php } ?>
	</div>
	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>		
	</div>	
</div>

		<!--<pre>
			<?php print_r($cuotaAgua); ?>
		</pre>-->