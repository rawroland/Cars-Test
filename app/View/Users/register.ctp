<?php 
echo $this->Html->tag('h3', __('Registration'), array());

echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'register'
    ),
    'type' => 'POST',
    'inputDefaults' => array(
        'div' => FALSE,
        'label' => FALSE
    )
));

echo $this->Form->label('User.given_name');
echo $this->Form->input('User.given_name') . '<br>';
echo $this->Form->label('User.surname_name');
echo $this->Form->input('User.surname_name') . '<br>';
echo $this->Form->label('User.email');
echo $this->Form->input('User.email') . '<br>';
echo $this->Form->label('User.password');
echo $this->Form->input('User.password') . '<br>';
echo $this->Form->label('User.password_confirmation');
echo $this->Form->input('User.password_confirmation', array('type' => 'password')) . '<br>';
echo $this->Form->end('Register')

?>