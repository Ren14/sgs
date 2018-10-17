<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<h2>Ver Registro <?php echo __('Lote'); ?></h2>
	</div>
	
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Numero'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($lote['Lote']['numero']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Socio'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($lote['Socio']['nombre_completo']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Fecha Adquisición'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($lote['Lote']['fecha_adquisicion'])); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Fracción'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($lote['Lote']['fraccion']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Padrón Rentas'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($lote['Lote']['padron_rentas']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Calle'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($lote['Lote']['calle']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Entre Calle 1'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($lote['Lote']['entre_calle_1']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Entre Calle 2'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($lote['Lote']['entre_calle_2']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Creado'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($lote['Lote']['created'])); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Última Modificación'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($lote['Lote']['modified'])); ?>'>
		</div>
	</div>
	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>		
		<div>	
		</div>
