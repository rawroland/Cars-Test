<?php 
echo $this->Html->tag('h3', __('Add Country'), array());
echo $this->Session->flash();
echo $this->Form->create('Country', array(
		'url' => array('controller' => 'countries', 'action' => 'add'),
		'inputDefaults' => array('label' => FALSE, 'div' => FALSE)
));
echo $this->Form->input('name', array('label' => __('Name')));
echo $this->Form->end(__('Add country'));
?>
