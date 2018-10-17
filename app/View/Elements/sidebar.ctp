<?php  
$rol = $this->Session->read('Auth.User.rol');
$id = $this->Session->read('Auth.User.id');
$socio_id = $this->Session->read('Auth.User.socio_id');
switch ($rol) {
    case 1:
    $rolText = 'Socio';
    break;
    case 2:
    $rolText = 'Administrador';
    break;
    case 3:
    $rolText = 'Super Admin';
    break;
    
    default:
        # code...
    break;
}
?>
<nav class="navbar-default navbar-static-side hidden-xs" role="navigation " >
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>                            
                    <a href="<?php echo $this->Html->url(array('action' => 'display', 'controller' => 'Pages')); ?>">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->Session->read('Auth.User.username') ?></strong>
                            <br><small><?php echo $rolText ?></small>
                        </span> </a>
                    </div>                        
                </li>

                <?php if($rol != 1){ ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Socios')); ?>"><i class="fa fa-group"></i> <span class="nav-label">Socios</span></a>
                </li>
                <?php } ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Lotes')); ?>"><i class="fa fa-home"></i> <span class="nav-label">Lotes</span></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Cuotas')); ?>"><i class="fa fa-file-text"></i> <span class="nav-label">Cuotas</span></a>
                </li>
                <?php if($rol != 1) {?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'add_historicas', 'controller' => 'Cuotas')); ?>"><i class="fa fa-file-text"></i> <span class="nav-label">Cuotas Históricas</span></a>
                </li>    
                <?php } ?>    
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'CuotaAguas')); ?>"><i class="fa fa-file-text-o"></i> <span class="nav-label">Canon Agua</span></a>
                </li>  
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Recibos')); ?>"><i class="fa fa-file-excel-o"></i> <span class="nav-label">Recibos</span></a>
                </li>
                <?php if($rol == 1){ ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'view', 'controller' => 'socios',$socio_id)); ?>"><i class="fa fa-user"></i> <span class="nav-label">Perfil</span></a>
                </li>
                <?php } 

                if($rol == 3){ ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Users')); ?>"><i class="fa fa-user"></i> <span class="nav-label">Usuarios</span></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Parametros')); ?>"><i class="fa fa-cog"></i> <span class="nav-label">Parametros</span></a>
                </li>            
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Bitacoras')); ?>"><i class="fa fa-hdd-o"></i> <span class="nav-label">Bitácora</span></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'getReportesIndex', 'controller' => 'Socios')); ?>"><i class="fa fa-bar-chart"></i> <span class="nav-label">Reportes</span></a>
                </li>                    
                
                <?php } ?>
                <?php if($rol != 1) {?>
                <li>
                    <a href="https://docs.google.com/document/d/1W_etoQojeJ8RCpOcJo4TcI8zD8YZar2obpRYtBCHxSM/edit?usp=sharing" target="_blank"><i class="fa fa-book"></i> <span class="nav-label">Manual de Usuario</span></a>
                </li>
                <?php }?>
                <li>
                    <a href="<?php echo $this->Html->url(array('action' => 'logout', 'controller' => 'Users')); ?>"><i class="fa fa-sign-out"></i> <span class="nav-label">Cerrar Sesión</span></a>
                </li>                               
            </ul>

        </div>
    </nav>