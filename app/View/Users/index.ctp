<div class="row">
	<div class="col-xs-12 col-md-12">	
		<?php if(in_array($this->Session->read('Auth.User.rol'), array(3))){ ?>
			<a type="button" class="btn btn-outline btn-success pull-right" href="<?php echo $this->Html->url(array('action' => 'add')); ?>"> Nuevo Usuario</a>
		<?php } ?>	
		
	</div>
	<div class="col-xs-12 col-md-12" style="overflow-x: overlay;">
			<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th>Usuario</th>
						<th>Rol</th>
						<th>Estado</th>					
						<th class="actions"><?php echo __('Opciones'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
							<td><?php echo h($roles[$user['User']['rol']]); ?>&nbsp;</td>
							<td><?php echo $estados_label[$user['User']['activo']]; ?>&nbsp;</td>
							
							<td class="actions">
								<a href="<?php echo $this->Html->url(array('action' => 'view', $user['User']['id']	)); ?>" type="button" class="btn btn-outline btn-success btn-xs"><i class="fa fa-search"></i></a>
								<?php if(in_array($this->Session->read('Auth.User.rol'), array(3))){ ?>
									<a href="<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id']	)); ?>" type="button" class="btn btn-outline btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
									
								<?php } ?>
								<!--<a href="#" onclick="borrar('<?php echo $user['User']['id'] ?>')" type="button" class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash" title="BORRAR USUARIO"></i>-->
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
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
		    ]									
		});
	});
</script>
