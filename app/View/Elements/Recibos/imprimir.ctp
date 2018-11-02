<div class="container-fluid">
	<div class="row">
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
			<h4>Unión Vecinal Adorable Puente </h4>
			<?php if (isset($personeria_juridica)) { ?>
				<p style="margin-bottom:1px;"><strong><?php echo $personeria_juridica['Parametro']['valor']; ?></strong></p>
			<?php } ?>

			<?php if (isset($cuit)) { ?>
				<p style="margin-bottom:1px;"><strong><?php echo $cuit['Parametro']['valor']; ?></strong></p>
			<?php } ?>

			<?php if (isset($direccion)) { ?>
				<p style="margin-bottom:1px;"><strong><?php echo $direccion['Parametro']['valor']; ?></strong></p>
			<?php } ?>

			<?php if (isset($telefono)) { ?>
				<p style="margin-bottom:1px;"><strong><?php echo $telefono['Parametro']['valor']; ?></strong></p>
			<?php } ?>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
			<h2>X</h2>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<br>
			<p style="margin-bottom:1px;">RECIBO <?php echo ($recibo['Recibo']['activo'] == 1 ? '' : '<b style="color:red;">ANULADO</b>'); ?><br>
			<span class="small">Documento No Válido como Factura</span>
			</p>
			<p style="margin-bottom:1px;"><strong>Nº</strong>: <?php echo "0001-" . str_pad($recibo['Recibo']['numero'],8,0, STR_PAD_LEFT); ?></p>
			<p style="margin-bottom:1px;"><strong>Fecha</strong>: <?php echo date('d/m/Y', strtotime($recibo['Recibo']['created'])); ?></p>			
			<p style="margin-bottom:1px;"><strong>Abona: </strong><?php echo $tipo[$recibo['Recibo']['tipo']]; ?></p>
			<p style="margin-bottom:1px;">ORIGINAL</p>
		</div>
	</div>
	<div class="row">		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">				
			
		</div>
		
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">			
			<p style="margin-bottom:1px;">Recibí de <?php echo h($recibo['Socio']['apellido'].", ".$recibo['Socio']['nombre']); ?> en concepto de</p>
			<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0" style="font-size: 9px;">
				<thead>
					<tr>
						<th>Cuota</th>
						<th>Lote</th>
						<th>Monto</th>
						<th>Periodo</th>											
						<th>Detalle</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($recibo['ReciboDetalle'] as $key => $recibo) { ?>
					<tr>
						<td><?php echo $recibo['cuota_numero']; ?> </td>
						<td><?php echo $recibo['lote_numero']; ?> </td>						
						<td>$<?php echo number_format($recibo['cuota_monto'],2,",","."); ?> </td>						
						<td><?php echo $recibo['descripcion']; ?> </td>						
						<td><?php echo @$recibo['observacion']; ?> </td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<p style="margin-bottom:1px;">La suma total de  $ <?php echo number_format($monto,2,",","."); ?> pesos argentinos</p>
		</div>
	</div>
	
</div>
<?php if($this->Session->read('Auth.User.rol') > 1) { ?>
<hr>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
			<h4>Unión Vecinal Adorable Puente </h4>
			<?php if (isset($personeria_juridica)) { ?>
				<p style="margin-bottom:1px;"><strong><?php echo $personeria_juridica['Parametro']['valor']; ?></strong></p>
			<?php } ?>

			<?php if (isset($cuit)) { ?>
				<p style="margin-bottom:1px;"><strong><?php echo $cuit['Parametro']['valor']; ?></strong></p>
			<?php } ?>

			<?php if (isset($direccion)) { ?>
				<p style="margin-bottom:1px;"><strong><?php echo $direccion['Parametro']['valor']; ?></strong></p>
			<?php } ?>

			<?php if (isset($telefono)) { ?>
				<p style="margin-bottom:1px;"><strong><?php echo $telefono['Parametro']['valor']; ?></strong></p>
			<?php } ?>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
			<h2>X</h2>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<br>
			<p style="margin-bottom:1px;">RECIBO <?php echo ($recibo_duplicado['Recibo']['activo'] == 1 ? '' : '<b style="color:red;">ANULADO</b>'); ?><br>
			<span class="small">Documento No Válido como Factura</span>
			</p>
			<p style="margin-bottom:1px;"><strong>Nº</strong>: <?php echo "0001-" . str_pad($recibo_duplicado['Recibo']['numero'],8,0, STR_PAD_LEFT); ?></p>
			<p style="margin-bottom:1px;"><strong>Fecha</strong>: <?php echo date('d/m/Y', strtotime($recibo_duplicado['Recibo']['created'])); ?></p>	
			<p style="margin-bottom:1px;"><strong>Abona: </strong><?php echo $tipo[$recibo_duplicado['Recibo']['tipo']]; ?></p>
			<p style="margin-bottom:1px;">DUPLICADO</p>
		</div>
	</div>
	<div class="row">		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">				
			
		</div>
		
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">			
			<p style="margin-bottom:1px;">Recibí de <?php echo h($recibo_duplicado['Socio']['apellido'].", ".$recibo_duplicado['Socio']['nombre']); ?> en concepto de</p>
			<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0" style="font-size: 9px;">
				<thead>
					<tr>
						<th>Cuota</th>
						<th>Lote</th>
						<th>Monto</th>
						<th>Periodo</th>											
						<th>Detalle</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($recibo_duplicado['ReciboDetalle'] as $key => $recibo_duplicado) { ?>
					<tr>
						<td><?php echo $recibo_duplicado['cuota_numero']; ?> </td>
						<td><?php echo $recibo_duplicado['lote_numero']; ?> </td>						
						<td>$<?php echo number_format($recibo_duplicado['cuota_monto'],2,",","."); ?> </td>						
						<td><?php echo $recibo_duplicado['descripcion']; ?> </td>						
						<td><?php echo @$recibo_duplicado['observacion']; ?> </td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<p style="margin-bottom:1px;">La suma total de  $ <?php echo number_format($monto_duplicado,2,",","."); ?> pesos argentinos</p>
		</div>
	</div>
	
</div>
<?php } ?>
<script type="text/javascript">
	$(function () {
		window.print();
	})
</script>

<style>
  p {
    margin-bottom: 1px;
  }
  </style>