<div class="row">
<?php echo $this->Form->create('Recibo'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		
		<legend><?php echo __('Editar Recibo'); ?></legend>
	</div>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
	?>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>
	<?php
		echo $this->Form->input('numero', array('class' => 'form-control'));
	?>
</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
<div class='form-group'>
	<?php
		echo $this->Form->input('lote_id', array('class' => 'form-control'));
	?>
</div>
</div>
	</fieldset>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	 	
		<button type="submit" class="btn btn-outline btn-warning pull-right">Editar</button>	
	 

		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
	</div>
<?php echo $this->Form->end(); ?>
</div>
