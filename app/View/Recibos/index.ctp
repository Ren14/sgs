<?php if(!isset($desde)){ ?>
	<?php $desde = date('Y-m-d') ?>
<?php } ?> 
<?php if(!isset($hasta)){ ?>
	<?php $hasta = date('Y-m-d') ?>
<?php } ?> 
<div class="ibox float-e-margins recibos index">
	<?php if(in_array($this->Session->read('Auth.User.rol'), array(2,3,4))){?>
	<div class="row">
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<div class="form-group">
				<div class="input text">
					<label for="">Fecha Inicio </label>
					<input name="fecha_ini" class="form-control" type="date" id="fecha_ini" required="required" value="<?php $d = explode(" ", $desde);echo $d[0] ?>">
				</div>			
			</div>
		</div>
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<div class="form-group">
				<div class="input text">
					<label for="">Fecha Hasta </label>
					<input name="fecha_fin" class="form-control" type="date" id="fecha_fin" required="required" value="<?php $h = explode(" ", $hasta);echo $h[0] ?>">
				</div>			
			</div>
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_estado', array('class' => 'form-control', 'label' => 'Filtar por Estado', 'div' => 'false', 'value' => $filtro_estado, 'options' => $estados, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_tipo', array('class' => 'form-control', 'label' => 'Filtar por Tipo', 'div' => 'false', 'value' => $filtro_tipo, 'options' => $tipo, 'empty' => 'Todos')) ?> 
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
			<?php echo $this->Form->input('filtro_socio', array('class' => 'form-control', 'label' => 'Filtar por Socio', 'div' => 'false', 'value' => $filtro_socio, 'options' => $socios, 'empty' => 'Todos')) ?> 
		</div>		
		<div class="col-md-2 col-sm-2 col-lg-2 col-xs-4">
			<button type="button" class="btn btn-outline btn-default" onclick="filtrarRecibos();" style="margin-top: 25px"> Filtrar</button>		
		</div>	
	</div>
	<hr>
	<?php } ?>
	<div class="ibox-content" style="overflow-x: overlay;">
		<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>Número Recibo</th>
					<th>Socio</th>					
					<th>Monto</th>
					<th>Tipo</th>
					
					<th>Estado</th>
					<th class="actions"><?php echo __('Opciones'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($recibos as $recibo): ?>
					<tr>
						<td><?php echo $recibo['Recibo']['numero']; ?></td>
						<td><?php echo $this->Html->link($recibo['Socio']['nombre_completo'], array('controller' => 'socios', 'action' => 'view', $recibo['Socio']['id'])); ?></td>						
						<td data-order="<?php echo $recibo['Recibo']['monto']?>">$<?php echo number_format($recibo['Recibo']['monto'], 2, ".", ","); ?></td>
						<td><?php echo $tipo[$recibo['Recibo']['tipo']]; ?></td>
						
						<td><?php echo $estados_label[$recibo['Recibo']['activo']]; ?>&nbsp;</td>
						<td class="actions">
							<a target="_blank" href="<?php echo $this->Html->url(array('action' => 'view', $recibo['Recibo']['id']	)); ?>" type="button" class="btn btn-outline btn-success btn-xs"><i class="fa fa-search"></i></a>
							
								<a target="_blank" href="<?php echo $this->Html->url(array('action' => 'view', $recibo['Recibo']['id'], 1)); ?>" type="button" class="btn btn-outline btn-default btn-xs"><i class="fa fa-print"></i></a>
							<?php
							# SI ES ROL ADMINISTRADOR O SUPER ADMINISTRADOR Y EL RECIBO ESTA ACTIVO Y ES TIPO CUOTA
							if(in_array($this->Session->read('Auth.User.rol'), array(2,3)) && $recibo['Recibo']['activo'] && $recibo['Recibo']['tipo'] == 2){ ?>
								<a href="#" onclick="anularRecibo('<?php echo $recibo['Recibo']['id'] ?>')" type="button" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash" title="ELIMINAR"></i></a>
							<?php }
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
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
				"order": [[ 0, "desc" ]],
			});
			

			$('#filtro_estado').select2();
			$('#filtro_tipo').select2();
			$('#filtro_socio').select2();
		});
		function filtrarRecibos() {
			// body...
			var desde = $('#fecha_ini').val();
			var hasta = $('#fecha_fin').val();
			var estado = $('#filtro_estado').val();
			var tipo = $('#filtro_tipo').val();
			var socio = $('#filtro_socio').val();
						
			if(estado == '')
				estado = 99;
			if(tipo == '')
				tipo = 99;
			if(socio == '')
				socio = 99;
			
			var direccion = "<?php echo $this->Html->url(array('controller' => 'Recibos')) ?>/index/" + estado+'/'+tipo+'/'+socio+'/'+ desde+'/'+hasta;
			
			window.location.replace(direccion);
		}

		function anularRecibo(recibo_id) {
			swal("Justifique la anulación del Recibo:", {
				content: "input",
			})
			.then((value) => {
				if(value){
					window.location.replace("<?php echo $this->Html->url(array('action' => 'anularRecibo')) ?>/" + recibo_id+"/"+`${value}`);
				}
			});
		}
	</script>
<!--<pre>
	<?php print_r($recibos) ?>
</pre>-->