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
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	<h2><?php echo "Ver Registro <?php echo __('{$singularHumanName}'); ?>"; ?></h2>
</div>
	
<?php
foreach ($fields as $field) {
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>\n";
				echo "<div class='form-group'>";
				echo "\t\t<label><?php echo __('" . Inflector::humanize($field) . "'); ?></label>\n";
				echo "\t\t<input class='form-control' readonly='true' value='<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>'>\n";
				echo "</div>\n";
				echo "</div>\n";
				break;
			}
		}
	}

	if ($isKey !== true && $field !== 'id' && $field !== 'activo') {
		$label = $field; 

		if($label === 'created')
			$label = 'Creado';

		if($field === 'modified')
			$label = 'Última Modificación';

		echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>\n";
		echo "<div class='form-group'>";
		echo "\t\t<label><?php echo __('" . Inflector::humanize($label) . "'); ?></label>\n";
		echo "\t\t<input class='form-control' readonly='true' value='<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>'>\n";
		echo "</div>\n";
		echo "</div>\n";
	}
}
?>	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<a type="button" class="btn btn-outline btn-default pull-right" href="<?php echo "<?php echo \$this->Html->url(array('action' => 'index')); ?>"; ?>">Volver</a>		
	<div>	
</div>
