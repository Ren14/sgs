<div class="row">
		
</div>
<div class="ibox float-e-margins cuotaAguas index">	
	<div class="ibox-content" style="overflow-x: overlay;">
		<h5>Listado de reportes del Sistema <br><small>Click para acceder</small></h5>
		<div class="row">
			<div class="col-md-4">
				<ul class="list-group">
				  <a class="list-group-item" href="<?php echo $this->Html->url(array('action' => 'total_recaudado', 'controller' => 'Recibos')) ?>">Total Recaudado</a>
				  <a class="list-group-item" href="<?php echo $this->Html->url(array('action' => 'reporteListadoSociosMora', 'controller' => 'Socios')) ?>">Deuda de cuotas sociales</a>
				  <a class="list-group-item" href="<?php echo $this->Html->url(array('action' => 'reporteListadoSociosMora', 'controller' => 'Socios', 1)) ?>">Deuda de cuotas sociales (Detalle)</a>
				  <a class="list-group-item" href="<?php echo $this->Html->url(array('action' => 'reporte_listado_socios_mora_agua', 'controller' => 'Lotes')) ?>">Deuda de cuotas agua</a>
				</ul>				
			</div>
			<div class="col-md-8">
				<div class="alert alert-warning alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>ATENCIÓN!</strong><br><br> Los reportes deben realizar muchos cálculos para poder mostrar la información. Por favor sea paciente para poder leer los mismos. Elija la opción deseada y aguarde que finalice su proceso.
				</div>
			</div>
		</div>
	</div>
</div>