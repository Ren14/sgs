<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			
			<?php echo $this->fetch('title'); ?>
		</title>
		<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('font-awesome/css/font-awesome.css');



		echo $this->Html->script('jquery-2.1.1');		
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('plugins/dataTables/jquery.dataTables');
		echo $this->Html->script('sgs');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
	</head>
	<body>
		<?php echo $this->fetch('content'); ?>
		
	</body>
</html>