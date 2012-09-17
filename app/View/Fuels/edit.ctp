<?php 
echo $this->Html->tag('h3', __('Edit Fuels'), array());
echo $this->Session->flash();
echo $this->Form->create('Fuel', array(
		'url' => array(
				'controller' => 'fuels',
				'action' => 'edit',
				$this->request->data['Fuel']['id']
		),
		'inputDefaults' => array('label' => FALSE, 'div' => FALSE)
));
echo $this->Form->input('name', array('label' => __('Name')));
echo $this->Form->end(__('Edit fuel'));
?>
