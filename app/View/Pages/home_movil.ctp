<?php  
$rol = $this->Session->read('Auth.User.rol');
$id = $this->Session->read('Auth.User.id');
?>
<ul class="nav nav-pills nav-stacked">
    <li>
        <a href="<?php echo $this->Html->url(array('action' => 'display', 'controller' => 'Pages')); ?>"><i class="fa fa-rss"></i> <span class="nav-label">Noticias</span></a>
    </li>
    <?php if($rol != 1){ ?>
        <li role="presentation">
            <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Socios')); ?>"><i class="fa fa-group"></i> Socios</a>
        </li>
    <?php } ?>
    <li>
        <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Lotes')); ?>"><i class="fa fa-home"></i> Lotes</a>
    </li>
    <li>
        <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Cuotas')); ?>"><i class="fa fa-file-text"></i> Cuotas</a>
    </li>
    <li>
        <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'CuotaAguas')); ?>"><i class="fa fa-file-text-o"></i> Cuota de Agua</a>
    </li>  
    <li>
        <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Recibos')); ?>"><i class="fa fa-file-excel-o"></i> Recibos</a>
    </li>
    <?php if($rol == 1){ ?>
        <li>
            <a href="<?php echo $this->Html->url(array('action' => 'edit', 'controller' => 'users',$id)); ?>"><i class="fa fa-user"></i> Perfil</a>
        </li>
    <?php } 

    if($rol >= 3){ ?>
        <li>
            <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Users')); ?>"><i class="fa fa-user"></i> Usuarios</a>
        </li>
        <?php 
        # SOLO EL SUPERADMIN TIENE ACCESO A PARAMETROS Y BITACORA
        if($rol == 3) {?>
            <li>
                <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Parametros')); ?>"><i class="fa fa-cog"></i> Parámetros</a>
            </li>            
            <li>
                <a href="<?php echo $this->Html->url(array('action' => 'index', 'controller' => 'Bitacoras')); ?>"><i class="fa fa-hdd-o"></i> Bitácora</a>
            </li>
        <?php } ?>
        <li>
            <a href="<?php echo $this->Html->url(array('action' => 'getReportesIndex', 'controller' => 'Socios')); ?>"><i class="fa fa-bar-chart"></i> Reportes</a>
        </li>   
    <?php } ?>
    <?php if($rol > 1) {?>
        <li>
            <a href="https://docs.google.com/document/d/1W_etoQojeJ8RCpOcJo4TcI8zD8YZar2obpRYtBCHxSM/edit?usp=sharing" target="_blank"><i class="fa fa-book"></i> Manual de Usuario</a>
        </li>
    <?php }?>
</ul>
