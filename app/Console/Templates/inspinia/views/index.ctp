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
<div class="ibox float-e-margins <?php echo $pluralVar; ?> index">
	<h2>Listado</h2>
	<div class="ibox-content">
	<table class="table table-bordered" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
	<?php foreach ($fields as $field): ?>
		<?php
			switch ($field) {
				case 'created':
					$field = 'Fecha';
					break;
				case 'modified':
					$field = 'Modificado';
					break;
				case 'user_id':
					$field = 'Usuario';
					break;
			}
		?>
		<?php if($field == 'id'){
			continue;
		}
		if($field == 'password'){
				continue;
			}
			 ?>
		<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
	<?php endforeach; ?>
		<th class="actions"><?php echo "<?php echo __('Opciones'); ?>"; ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
	echo "\t<tr>\n";
		foreach ($fields as $field) {
			if($field == 'id'){
				continue;
			}
			if($field == 'password'){
				continue;
			}
		
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				switch ($field) {
					case 'created':
						echo "\t\t<td><?php echo date('d-m-Y H:i',strtotime(\${$singularVar}['{$modelClass}']['{$field}'])); ?>&nbsp;</td>\n";
						break;
					case 'modified':
						echo "\t\t<td><?php echo date('d-m-Y H:i',strtotime(\${$singularVar}['{$modelClass}']['{$field}'])); ?>&nbsp;</td>\n";
						break;
					default:
						echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
					break;
				}
			}
		}

		echo "\t\t<td class=\"actions\">\n";
		echo "\t\t\t<?php echo \$this->Html->link(__('Ver'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		echo "\t\t\t<?php echo \$this->Html->link(__('Editar'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		echo "\t\t\t<?php echo \$this->Form->postLink(__('Borrar'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('confirm' => __('Seguro que quiere borrar # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}']))); ?>\n";
		echo "\t\t</td>\n";
	echo "\t</tr>\n";

	echo "<?php endforeach; ?>\n";
	?>
	</tbody>
	</table>
	</div>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
    	$('table.table-bordered').DataTable({
    		"language": dataTableEs,
    		"sDom": '<"top"<"#a.col-md-4"l><"#r.col-md-4"><"#e.col-md-4"f>>rt<"bottom"ip><"clear">'
    	})
	});
</script>
