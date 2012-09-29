<?php 
echo $this->Html->tag('h3', __('Add Town'), array());
echo $this->Session->flash();
echo $this->Form->create('Town', array(
		'url' => array('controller' => 'towns', 'action' => 'add'),
		'inputDefaults' => array('label' => FALSE, 'div' => FALSE)
));
echo $this->Form->input('name', array('label' => __('Name'))) . '<br><br>';
echo $this->Form->label('region_id');
$attributes = array('empty' => 'Choose a Region');
echo $this->Form->select('region_id', $regions, $attributes);
echo $this->Form->end(__('Add town'));
?>
