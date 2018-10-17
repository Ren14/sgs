<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<h2>Ver <?php echo __('Recibo'); ?></h2>
	</div>
	
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Numero Recibo'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo h($recibo['Recibo']['numero']); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Socio'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo $recibo['Socio']['apellido']." ".$recibo['Socio']['nombre']; ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Monto'); ?></label>
			<input class='form-control' readonly='true' value='$<?php echo number_format($recibo['Recibo']['monto'],2,",","."); ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Tipo'); ?></label>
			<input class='form-control' readonly='true' value='<?php echo $tipo[$recibo['Recibo']['tipo']]; ?>'>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>		<label><?php echo __('Estado'); ?></label><br>
			<?php echo $estados_label[$recibo['Recibo']['activo']]; ?>
		</div>
	</div>
	
	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h2>Detalle</h2>
		<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th># Cuota</th>
					<th>Lote</th>
					<th>Monto</th>
					<th>Periodo/Cant Cuotas</th>					
					<th>F. Pago</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($recibo['ReciboDetalle'] as $key => $recibo) { ?>
					<tr>
						<td><?php echo $recibo['cuota_numero']; ?> </td>
						<td><?php echo $recibo['lote_numero']; ?> </td>						
						<td>$<?php echo number_format($recibo['cuota_monto'],2,",","."); ?> </td>						
						<td><?php echo $recibo['descripcion']; ?> </td>
						<td><?php echo $recibo['fecha_pago']; ?> </td>
						<td><?php echo $recibo['estado']; ?> </td>
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
