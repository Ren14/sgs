<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<h2>Ver Registro <?php echo __('Socio'); ?> <a href="<?php echo $this->Html->url(array('controller' => 'users','action' => 'edit',$socio['User']['id'])) ?>" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Editar Perfil</a></h2>
	</div>
	
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Apellido'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Socio']['apellido']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Nombre'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Socio']['nombre']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('DNI'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Socio']['dni']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Provincia'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Provincia']['provincia']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Localidad'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Localidade']['localidad']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Domicilio'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Socio']['domicilio']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Telefono'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Socio']['telefono']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Celular'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Socio']['celular']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Email'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['Socio']['email']); ?>'>
		</div>
	</div>
	
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Ususario'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($socio['User']['username']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Creado'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($socio['Socio']['created'])); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Última Modificación'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo date('d-m-Y h:i:s', strtotime($socio['Socio']['modified'])); ?>'>
		</div>
	</div>
	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6">
	<h2>Lotes Adquiridos</h2>
		<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>Numero</th>
					<th>Fecha Adquisición</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lotes as $key => $lote) { ?>
					<tr>
						<td><?php echo $lote['Lote']['numero']; ?> </td>
						<td><?php echo $lote['Lote']['fecha_adquisicion']; ?> </td>
						<td><?php echo $estado[$lote['Lote']['activo']]; ?> </td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>		

	</div>
</div>

<!--<pre>
	<?php print_r($lotes); ?>
</pre>-->