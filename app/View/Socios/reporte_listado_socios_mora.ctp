<div class="ibox float-e-margins cuotaAguas index">	
	<div class="ibox-content" style="overflow-x: overlay;">
		<h2>Reporte de cuotas adedudas por Lotes</h2>
		<hr class="hidden-xs">
		<div class="alert alert-warning alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Información!</strong><br><br> El cálculo de la cantidad de cuotas adeudadas se realiza de la siguiente manera. <br> A partir de la fecha de adquisición del Lote, se evalúa mes a mes si el cliente registra un pago. En caso de que para el mes evaluado, no se registre un pago, se cuenta como Cuota Adeudada.<br> Al final se obtiene el total y se muestra el siguiente listado.
		</div>
		<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>#</th>
					<th>Lote</th>
					<th>Fecha Adquisición</th>
					<th>Socio</th>
					<th>Cant. cuotas sociales adeudadas</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 1;
				foreach ($aux_lotes as $lote): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $lote['Cabecera']['numero_lote']?></td>
						<td><?php echo date('d-m-Y', strtotime($lote['Cabecera']['fecha_adq']));?></td>
						<td><?php echo $lote['Cabecera']['Socio']['nombre_completo']?></td>
						<td><?php echo $lote['Cabecera']['cantidad_total']?></td>						
					</tr>
				<?php 
				$i++;
				endforeach; ?>
			</tbody>
		</table>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
			<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'getReportesIndex', 'controller' => 'Socios')); ?>">Volver</a>	
		</div>
	</div>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
		$('table.table-bordered').DataTable({
			"language": dataTableEs,
			dom: 'B<"clear">lfrtip',
		    buttons: [
		        'copy', 'excel', 'pdf'
		    ]	,			
		});
	});

</script>