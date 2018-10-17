

<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'SGS');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php
		echo $this->Html->meta('icon');	
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('summernote');
		echo $this->Html->css('font-awesome/css/font-awesome.css');
		echo $this->Html->css('datatables.min');		
		echo $this->Html->css('style');
		echo $this->Html->css('select2.min');
		echo $this->Html->css('animate');
		echo $this->Html->css('pnotify.custom.min');
		
		echo $this->Html->script('jquery-2.1.1');		
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('pdfmake.min.js');
		echo $this->Html->script('vfs_fonts.js');
		echo $this->Html->script('datatables.min');		
		echo $this->Html->script('sgs');
		echo $this->Html->script('summernote');
		echo $this->Html->script('sweetalert.min');
		echo $this->Html->script('select2.min');
		echo $this->Html->script('pnotify.custom.min');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>	
</head>
<body>
	<div id="wrapper">
		<?php echo $this->element('sidebar'); ?>
		<?php echo $this->element('main'); ?>
	</div>

	<?php #echo $this->element('sql_dump'); ?>

</body>
</html>
