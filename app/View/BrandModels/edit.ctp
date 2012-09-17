<?php 
echo $this->Html->tag('h3', __('Edit Models'), array());
echo $this->Session->flash();
echo $this->Form->create('BrandModel', array(
		'url' => array(
				'controller' => 'brand_models',
				'action' => 'edit',
				$this->request->data['BrandModel']['id']
		),
		'inputDefaults' => array('label' => FALSE, 'div' => FALSE)
));
echo $this->Form->input('name', array('label' => __('Name'))) . '<br><br>';
echo $this->Form->label('brand_id');
$attributes = array('empty' => 'Choose a Brand');
echo $this->Form->select('brand_id', $brands, $attributes);
echo $this->Form->end(__('Edit model'));
?>
