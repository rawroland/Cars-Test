<?php 
echo $this->Html->tag('h3', __('Add Brands'), array());
echo $this->Session->flash();
echo $this->Form->create('Brand', array(
		'url' => array('controller' => 'brands', 'action' => 'add'),
		'inputDefaults' => array('label' => FALSE, 'div' => FALSE)
));
echo $this->Form->input('name', array('label' => __('Name')));
echo $this->Form->end(__('Add brand'));
?>
