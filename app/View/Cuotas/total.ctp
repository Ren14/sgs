<div class="ibox float-e-margins cuotaAguas index">
	<div class="ibox-content">
		<legend>
			Reporte total recaudado
		</legend>
		<?php echo $this->Form->create('CuotaAgua',array('class' => 'form-inline')) ?>
			<div class="form-group">
				<label class="sr-only">Fecha Inicio</label>
				<?php //echo $this->Form->input('fechaIni',array('type' => 'date','label' => false,'div' => false,'class' => 'form-control datepicker','value' => date('d-m-Y'))) ?>
				<input name="data[Cuota][fecha_ini]" class="form-control" type="date" id="CuotaFechaAdquisicion" required="required" value="<?php echo date('d-m-Y') ?>">
			</div>
			<div class="form-group">
				<label class="sr-only">Fecha Fin</label>
				<?php //echo $this->Form->input('fechaIni',array('type' => 'date','label' => false,'div' => false,'class' => 'form-control datepicker','value' => date('d-m-Y'))) ?>
				<input name="data[Cuota][fecha_fin]" class="form-control" type="date" id="CuotaFechaAdquisicion" required="required" value="<?php echo date('d-m-Y') ?>">
			</div>

			<!--<button class="btn btn-primary" type="submit">Generar Reporte</button>-->
			<?php echo $this->Form->submit('Generar Reporte',array('class' => 'btn btn-primary','div' => false)) ?>
		<?php echo $this->Form->end() ?>
		<br>
		<?php if(!empty($auxTotal)){ ?>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<h1>Total Cuota Sociales: <span><b>$ <?php echo number_format($total_social, 2, ',', '.'); ?></b></span></h1>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<h1>Total Cuota Agua: <span><b>$<?php echo number_format($total_agua, 2, ',', '.'); ?></b></span></h1>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<h1>Total: <span><b>$ <?php echo number_format($TOTAL_C, 2, ',', '.');   ?></b></span></h1>
			</div>
		</div>
		<?php } ?>
	</div>
</div>