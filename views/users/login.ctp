<h1>Login</h1>
<?php $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array('action' => 'login')); ?>
<?php echo $this->Form->input('username', array('label' => 'Username')); ?>
<?php echo $this->Form->input('password', array('label' => 'Password')); ?>
<?php echo $this->Form->end(array('label' => 'Login')); ?>
