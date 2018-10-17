<?php echo $this->Html->script('plugins/chartJs/Chart.min'); ?>
<div class="row">
	<?php echo $this->Form->create('Recibo'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<legend><?php echo __('Reporte: Total Recaudado'); ?></legend>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class="form-group">
				<div class="input text required">
					<label for="">Fecha Inicio *</label>
					<input name="data[Recibo][fecha_ini]" class="form-control" type="date" id="fecha_ini" required="required" value="<?php if(isset($this->request->data['Recibo']['fecha_ini'])){echo $this->request->data['Recibo']['fecha_ini'];} ?>">
				</div>			
			</div>
		</div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class="form-group">
				<div class="input text required">
					<label for="">Fecha Fin *</label>
					<input name="data[Recibo][fecha_fin]" class="form-control" type="date" id="fecha_fin" required="required" value="<?php if(isset($this->request->data['Recibo']['fecha_fin'])){echo $this->request->data['Recibo']['fecha_fin'];} ?>">
				</div>			
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	

			<button type="submit" class="btn btn-outline btn-warning pull-right" id="btn-guardar">Generar reporte</button>	
			<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
		</div>
	</fieldset>
</div>
<br>
<div class="container-fluid">
	<?php if(isset($TOTAL)){ ?>

	<?php } ?>
	<div class="row">
		<?php if(isset($TOTAL)){
			$monto = number_format($TOTAL, 2, ',', '.');
		?>	
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					
					<h5>Total</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins"><?php echo "$ ".$monto; ?></h1>
					<div class="stat-percent font-bold text-success"> </div>
					<small>Recaudado</small>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(isset($TotalAgua)){
			$montoAgua = number_format($TotalAgua, 2, ',', '.');
		?>	
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-info pull-right">AGUA</span>
					<h5>Total</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins"><?php echo "$ ".$montoAgua; ?></h1>
					<div class="stat-percent font-bold text-info"><?php echo number_format((100*$TotalAgua)/$TOTAL,2) ?>% <i class="fa fa-pie-chart"></i></div>
					<small>Recaudado</small>
				</div>
			</div>
		</div>
		<?php } ?>
			<?php if(isset($TotalSocial)){
			$montoSocial = number_format($TotalSocial, 2, ',', '.');
		?>	
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-primary pull-right">SOCIAL</span>
					<h5>Total</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins"><?php echo "$ ".$montoSocial; ?></h1>
					<div class="stat-percent font-bold text-primary"><?php echo number_format((100*$TotalSocial)/$TOTAL,2) ?>% <i class="fa fa-pie-chart"></i></div>
					<small>Recaudado</small>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>