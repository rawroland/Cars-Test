<?php 
echo $this->Html->tag('h3', __('Edit Categories'), array());
echo $this->Session->flash();
echo $this->Form->create('Category', array(
		'url' => array(
				'controller' => 'categories',
				'action' => 'edit',
				$this->request->data['Category']['id']
		),
		'inputDefaults' => array('label' => FALSE, 'div' => FALSE)
));
echo $this->Form->input('name', array('label' => __('Name')));
echo $this->Form->end(__('Edit category'));
?>
