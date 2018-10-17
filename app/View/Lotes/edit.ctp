<?php echo $this->Form->create('Lote'); ?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<legend><?php echo __('Editar Lote'); ?></legend>
	</div>
	<?php
	echo $this->Form->input('id', array('type' => 'hidden'));
	?>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>
			<?php
			echo $this->Form->input('numero', array('class' => 'form-control', 'required' => true, 'div' => false, 'label' => 'Número Lote'));
			?>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='form-group'>
			<?php
			echo $this->Form->input('socio_id', array('class' => 'form-control', 'empty' => '- Seleccionar Socio -'));
			?>
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class="form-group">
			<div class="input text required">
				<label for="LoteFechaAdquisicion">Fecha Adquisicion</label>
				<input name="data[Lote][fecha_adquisicion]" class="form-control" type="date" id="LoteFechaAdquisicion" required="required" value="<?php echo date('Y-m-d', strtotime($this->request->data['Lote']['fecha_adquisicion'])); ?>">
			</div>			
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class="form-group">
			<?php
			echo $this->Form->input('fraccion', array('class' => 'form-control', 'required' => true, 'div' => false, 'label' => 'Fracción *', 'type' => 'number'));
			?>			
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class="form-group">
			<?php
			echo $this->Form->input('padron_rentas', array('class' => 'form-control', 'required' => false, 'div' => false, 'label' => 'Padrón Rentas', 'type' => 'text'));
			?>			
		</div>
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class="form-group">
			<?php
			echo $this->Form->input('calle', array('class' => 'form-control', 'required' => true, 'div' => false, 'label' => 'Calle Lote *', 'type' => 'text'));
			?>			
		</div>		
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class="form-group">
			<?php
			echo $this->Form->input('entre_calle_1', array('class' => 'form-control', 'required' => false, 'div' => false, 'label' => 'Entre Calle 1', 'type' => 'text'));
			?>			
		</div>		
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class="form-group">
			<?php
			echo $this->Form->input('entre_calle_2', array('class' => 'form-control', 'required' => false, 'div' => false, 'label' => 'Entre Calle 2', 'type' => 'text'));
			?>			
		</div>		
	</div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class="form-group">
			<?php
			echo $this->Form->input('activo', array('class' => 'form-control', 'required' => false, 'div' => false, 'label' => 'Estado', 'options' => $estados));
			?>			
		</div>		
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	

		<button type="submit" class="btn btn-outline btn-warning pull-right">Editar</button>	


		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
	</div>
</div>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">
	$(function() {
		$('#LoteSocioId').select2();
	});
</script>