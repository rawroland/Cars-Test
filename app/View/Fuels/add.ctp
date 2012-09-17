<?php 
echo $this->Html->tag('h3', __('Add Fuels'), array());
echo $this->Session->flash();
echo $this->Form->create('Fuel', array(
		'url' => array('controller' => 'fuels', 'action' => 'add'),
		'inputDefaults' => array('label' => FALSE, 'div' => FALSE)
));
echo $this->Form->input('name', array('label' => __('Name')));
echo $this->Form->end(__('Add fuel'));
?>
