<?php 
echo $this->Html->tag('h3', __('Login'), array());

echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'login'
    ),
    'type' => 'POST',
    'inputDefaults' => array(
        'div' => FALSE,
        'label' => FALSE
    )
));

echo $this->Session->flash('auth');
echo $this->Form->label('User.email');
echo $this->Form->input('User.email') . '<br>';
echo $this->Form->label('User.password');
echo $this->Form->input('User.password') . '<br>';
echo $this->Form->end('Login')

?>