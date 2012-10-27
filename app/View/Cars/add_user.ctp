<?php 
echo $this->Html->tag('h3', __('Add Brands'), array());
echo $this->Html->tag('h4', __('Step 2: User details'), array());

echo $this->Form->create('Car', array(
    'url' => array(
        'controller' => 'cars',
        'action' => 'add_user',
        '?' => array('session_id' => $sessionId)
    ),
    'type' => 'POST',
    'inputDefaults' => array(
        'div' => FALSE,
        'label' => FALSE
    )
));
$loggedUser = AuthComponent::user();
if(empty($loggedUser)) {
  echo $this->Form->label('User.given_name');
  echo $this->Form->text('User.given_name') . '<br>';
  echo $this->Form->label('User.surname_name');
  echo $this->Form->text('User.surname_name') . '<br>';
  echo $this->Form->label('User.email');
  echo $this->Form->input('User.email') . '<br>';
  echo $this->Form->label('User.password');
  echo $this->Form->input('User.password') . '<br>';
  echo $this->Form->label('User.password_confirmation');
  echo $this->Form->input('User.password_confirmation', array('type' => 'password')) . '<br>';
  echo $this->Form->end('Register');
} else {
  foreach ($loggedUser as $key => $value) {
    if($key != 'id' && $key != 'group_id' && $key != 'deleted' && $key != 'password') {
      echo $key . ': ' . $value . '<br>';
    }
  }
  echo $this->Form->end('Confirm user');
}

?>