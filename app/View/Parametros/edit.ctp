<div class="row">
	<?php echo $this->Form->create('Parametro'); ?>
	<fieldset>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<legend><?php echo __('Editar Parametro'); ?></legend>
		</div>
		<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		?>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('nombre', array('class' => 'form-control', 'readonly' => true));
				?>
			</div>
		</div>
		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
			<div class='form-group'>
				<?php
				echo $this->Form->input('valor', array('class' => 'form-control'));
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
<script type="text/javascript">
	$('#ParametroValor').summernote({
	  height: 300,                 // set editor height
	  minHeight: null,             // set minimum height of editor
	  maxHeight: null,             // set maximum height of editor
	  focus: true                  // set focus to editable area after initializing summernote
	});
	//$('#ParametroValor').summernote('insertText', "<?php echo $this->request->data['Parametro']['valor']?>");
</script>