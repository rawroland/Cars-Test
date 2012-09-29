<?php 
echo $this->Html->tag('h3', __('Add Region'), array());
echo $this->Session->flash();
echo $this->Form->create('Region', array(
		'url' => array('controller' => 'regions', 'action' => 'add'),
		'inputDefaults' => array('label' => FALSE, 'div' => FALSE)
));
echo $this->Form->input('name', array('label' => __('Name'))) . '<br><br>';
echo $this->Form->label('country_id');
$attributes = array('empty' => 'Choose a Country');
echo $this->Form->select('country_id', $countries, $attributes);
echo $this->Form->end(__('Add region'));
?>
