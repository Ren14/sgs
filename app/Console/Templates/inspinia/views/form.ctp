<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<div class="row">
<?php echo "<?php echo \$this->Form->create('{$modelClass}'); ?>\n"; ?>
	<fieldset>
	<?php 
	$legend = $action;

	if($legend === 'edit')
		$legend = "Editar";

	if($legend === 'add')
		$legend = "Nuevo";

	?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		
		<legend><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($legend), $singularHumanName); ?></legend>
	</div>
<?php
	
	foreach ($fields as $field) {
		if (strpos($action, 'add') !== false && $field === $primaryKey) {
			continue;
		} elseif (!in_array($field, array('created', 'modified', 'updated', 'activo'))) {
			if($field !== 'id'){					
				echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>\n";
				echo "<div class='form-group'>\n";
				echo "\t<?php\n";				
				echo "\t\techo \$this->Form->input('{$field}', array('class' => 'form-control'));\n";				
				echo "\t?>\n";
				echo "</div>\n";
				echo "</div>\n";
			} else if($field === 'id'){
				echo "\t<?php\n";
				echo "\t\techo \$this->Form->input('{$field}', array('type' => 'hidden'));\n";
				echo "\t?>\n";
			}
		}
	}
	if (!empty($associations['hasAndBelongsToMany']) ) {
		foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
			echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>\n";
			echo "<div class='form-group'>\n";
			echo "\t<?php\n";
			echo "\t\techo \$this->Form->input('{$assocName}');\n";
			echo "\t?>\n";
			echo "</div>\n";
			echo "</div>\n";
		}
	}
		
?>
	</fieldset>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	<?php if ($action === 'edit') { ?> 	
		<button type="submit" class="btn btn-outline btn-warning pull-right">Editar</button>	
	<?php } else { ?>
		<button type="submit" class="btn btn-outline btn-primary pull-right">Guardar</button>
	<?php } ?> 

		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo "<?php echo \$this->Html->url(array('action' => 'index')); ?>"; ?>">Volver</a>	
	</div>
<?php
	echo "<?php echo \$this->Form->end(); ?>\n";
?>
</div>
