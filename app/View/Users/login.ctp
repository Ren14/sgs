<?php echo $this->Form->create('User',array('class' => 'm-t','role' => 'form')); ?>
<fieldset>
    <div class="form-group">
        <?php echo $this->Form->input('username',array('class' => 'form-control','div' => false,'placeholder' => 'Usuario')); ?>
    </div>
    <div class="form-group">
        <?php echo $this->Form->input('password',array('class' => 'form-control','placeholder' => 'Contraseña','div' => false)); ?>
    </div>
    <?php echo $this->Form->button('Ingresar', array('class' => 'btn btn-primary block full-width m-b', 'type' => 'submit')); ?>
</fieldset>

<?php echo $this->Form->end(); ?>
<?php //echo $this->Form->input('role', array('options' => array('admin' => 'Admin', 'author' => 'Author'))); ?>
