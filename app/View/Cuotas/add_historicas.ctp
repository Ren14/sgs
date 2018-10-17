<div class="row">
	<?php echo $this->Form->create('Cuota'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<legend><?php echo __('Ver Cuotas Historicas'); ?></legend>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('lote_id', array('class' => 'form-control', 'label' => '# Lote', 'div' => false, 'options' => $lotes, 'empty' => '- Seleccionar - ', 'required' => true, 'value' => $lote_id, 'onchange' => 'getCuotasHistoricas();'));
				?>
			</div>
		</div>	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="div-cuotas-historicas" style="overflow-x: overlay;">

			
		</div>	
	</fieldset>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
			<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Volver</a>	
	</div>
	<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
	$(function() {
		$('#CuotaLoteId').select2();
	});
	function getCuotasHistoricas() {
		var lote_id = $('#CuotaLoteId').val();
		if(lote_id != ''){

			$.ajax({
				url: "<?php echo $this->Html->url(array('action' => 'getCuotasHistoricas', 'controller' => 'Cuotas')) ?>",
				type: 'POST',
				data: {lote_id:lote_id},
			}).done(function(response){
				$('#div-cuotas-historicas').html('');
				$('#div-cuotas-historicas').html(response);
			}).fail(function(response){
				console.log(response);
			});
		}
	}
</script>