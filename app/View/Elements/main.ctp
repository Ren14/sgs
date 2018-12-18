<?php  
$rol = $this->Session->read('Auth.User.rol');
$id = $this->Session->read('Auth.User.id');
?>
<div id="page-wrapper" class="gray-bg dashbard-1" >
    <div class="row border-bottom hidden-lg hidden-md hidden-sm">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">            
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'homeMovil', 'controller' => 'Pages')); ?>"><i class="fa fa-home"></i> inicio</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'logout', 'controller' => 'Users')); ?>"><i class="fa fa-sign-out"></i> Cerrar Sesion</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row white-bg">
        <div class="col-lg-10">

            <h2><?php 
            if(Inflector::classify( $this->params['controller']) == 'Page'){
                echo "Inicio";
            } else if(Inflector::classify( $this->params['controller']) == 'User'){
                echo "Usuarios";
            } else {
                echo Inflector::classify( $this->params['controller']); 
            }
                ?>
                
            
           </h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <div class="row">
                    <?php echo $this->Flash->render(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>

            </div>
            <div class="footer" style="position: fixed;">
                <div class="pull-right">

                </div>
                <div>
                    <strong>Copyright</strong> SGS © <?php echo date('Y') ?>
                </div>
                <?php //echo $this->element('sql_dump'); ?>
            </div>

        </div>
    </div>

</div>