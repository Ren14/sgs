

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
	echo $this->Html->css('font-awesome/css/font-awesome.css');
	echo $this->Html->css('animate');
	echo $this->Html->css('style');

	echo $this->Html->script('jquery-2.1.1');
	echo $this->Html->script('bootstrap.min');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<style type="text/css">
	body {
	   background-image: url('../img/image1.jpeg');
	   background-color: #cccccc;
	}
</style>
<body class="login-content img-responsive" style="background-image: url('../img/image1.jpeg');background-position: center;background-repeat: no-repeat;background-attachment: fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: contain;background-size: cover;width: 100%;height: 100%;" >
	<div id="wrapper">
		<div class="middle-box text-center loginscreen animated fadeInDown">
			<div class="ibox-content" style="margin-top: 110px;">            
				<h3>Bienvenido al Sistema de Gestión de Socios de la Unión Vecinal Adorable Puente</h3>				
				<p>Ingresar</p>

				<?php echo $this->Flash->render(); ?>

				<?php echo $this->fetch('content'); ?>

			</div>
		</div>
	</div>
	
</body>
</html>
