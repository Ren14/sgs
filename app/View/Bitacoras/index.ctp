<?php if(!isset($desde)){ ?>
	<?php $desde = date('Y-m-d') ?>
<?php } ?> 
<?php if(!isset($hasta)){ ?>
	<?php $hasta = date('Y-m-d') ?>
<?php } ?> 
<div class="ibox float-e-margins bitacoras index">
	<div class="row">
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<div class="form-group">
				<div class="input text">
					<label for="">Fecha Inicio </label>
					<input name="fecha_ini" class="form-control" type="date" id="fecha_ini" required="required" value="<?php if($desde){echo $desde;} ?>">
				</div>			
			</div>
		</div>
		<div class="col-md-2 col-sm-3 col-lg-2 col-xs-12">
			<div class="form-group">
				<div class="input text">
					<label for="">Fecha Hasta </label>
					<input name="fecha_fin" class="form-control" type="date" id="fecha_fin" required="required" value="<?php if($hasta){echo $hasta;} ?>">
				</div>			
			</div>
		</div>
		<div class="col-lg-1 col-md-4 col-sm-6  col-xs-4">
			<button type="button" class="btn btn-outline btn-default" onclick="filtrarBitacora();" style="margin-top: 25px"> Filtrar</button>		
		</div>
	</div>	
	<hr>
	<div class="ibox-content" style="overflow-x: overlay;">
		<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>#</th>
					<th>Usuario</th>
					<th>Acción</th>
					<th>Fecha</th>
					<th>IP</th>					
					<th class="actions"><?php echo __('Opciones'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($bitacoras as $bitacora): ?>
					<tr>
						<td><?php echo $bitacora['Bitacora']['numero']; ?></td>
						<td>
							<?php echo $this->Html->link($bitacora['User']['username'], array('controller' => 'users', 'action' => 'view', $bitacora['User']['id'])); ?>
						</td>
						<td><?php echo h($bitacora['Bitacora']['accion']); ?>&nbsp;</td>
						<td><?php echo date('d-m-Y H:i:s',strtotime($bitacora['Bitacora']['created'])); ?>&nbsp;</td>
						<td><?php echo h($bitacora['Bitacora']['ip']); ?>&nbsp;</td>
						<td class="actions">
							<a href="<?php echo $this->Html->url(array('action' => 'view', $bitacora['Bitacora']['id']	)); ?>" type="button" class="btn btn-outline btn-success btn-xs"><i class="fa fa-search"></i></a>
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
			"order": [[ 0, "desc" ]]								
		});
	});
	function filtrarBitacora() {
		// body...
		var desde = $('#fecha_ini').val();
		var hasta = $('#fecha_fin').val();
		
		var direccion = "<?php echo $this->Html->url(array('controller' => 'Bitacoras')) ?>/index/" + desde+'/'+hasta;
		
		window.location.replace(direccion);
	}
</script>
