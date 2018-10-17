<?php  
$rol = $this->Session->read('Auth.User.rol');
$id = $this->Session->read('Auth.User.id');
?>
<div id="page-wrapper" class="gray-bg dashbard-1" >
    <div class="row border-bottom hidden-lg hidden-md hidden-sm">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'display', 'controller' => 'Pages')); ?>"><i class="fa fa-rss"></i></a>
                </li>
                <?php if($rol != 1){ ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Socios')); ?>"><i class="fa fa-group"></i></a>
                </li>
                <?php } ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Lotes')); ?>"><i class="fa fa-home"></i></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Cuotas')); ?>"><i class="fa fa-file-text"></i></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'CuotaAguas')); ?>"><i class="fa fa-file-text-o"></i></a>
                </li>  
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Recibos')); ?>"><i class="fa fa-file-excel-o"></i></a>
                </li>
                <?php if($rol == 1){ ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'edit', 'controller' => 'users',$id)); ?>"><i class="fa fa-user"></i></a>
                </li>
                <?php } 

                if($rol == 3){ ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Users')); ?>"><i class="fa fa-user"></i></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Parametros')); ?>"><i class="fa fa-cog"></i></a>
                </li>            
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Bitacoras')); ?>"><i class="fa fa-hdd-o"></i></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'getReportesIndex', 'controller' => 'Socios')); ?>"><i class="fa fa-bar-chart"></i></a>
                </li>                    
                
                <?php } ?>
                <?php if($rol > 1) {?>
                <li>
                    <a href="https://docs.google.com/document/d/1W_etoQojeJ8RCpOcJo4TcI8zD8YZar2obpRYtBCHxSM/edit?usp=sharing" target="_blank"><i class="fa fa-book"></i></a>
                </li>
                <?php }?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'logout', 'controller' => 'Users')); ?>"><i class="fa fa-sign-out"></i></a>
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