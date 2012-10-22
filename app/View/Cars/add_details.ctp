<?php 
$seats = range(0, 9);
$doors = range(0, 9);
$years = range((int) date('Y'), 1990);
$years = array_combine($years, $years);

echo $this->Html->tag('h3', __('Add Brands'), array());
echo $this->Html->tag('h4', __('Step 1: Car Details'), array());

echo $this->Form->create('Car', array(
		'url' => array(
				'controller' => 'cars',
				'action' => 'add_details'
		),
		'type' => 'POST',
		'inputDefaults' => array(
				'div' => FALSE,
				'label' => FALSE
		)
));

echo $this->Form->label('year', 'Production year');
echo $this->Form->select('produced', $years, array('empty' => 'Unknown')) . '<br>';
echo $this->Form->label('seats', 'Number of seats');
echo $this->Form->select('seats', $seats, array('empty' => 'Unknown')) . '<br>';
echo $this->Form->label('doors', 'Number of doors');
echo $this->Form->select('doors', $doors, array('empty' => 'Unknown')) . '<br>';
echo $this->Form->label('power');
echo $this->Form->text('power', array('type' => 'numeric')) . '<br>';
echo $this->Form->label('mileage');
echo $this->Form->text('mileage', array('type' => 'numeric')) . '<br>';
echo $this->Form->label('tank_capacity');
echo $this->Form->text('tank_capacity', array('type' => 'numeric')) . '<br>';
echo $this->Form->label('colour');
echo $this->Form->text('colour') . '<br>';
echo $this->Form->label('inner_colour');
echo $this->Form->text('inner_colour') . '<br>';
echo $this->Form->label('brands');
echo $this->Form->select('brand_id', $brands, array('empty' => '...')) . '<br>';
echo $this->Form->label('brand_models');
echo $this->Form->select('brand_model_id', $brand_models, array('empty' => '...')) . '<br>';
echo $this->Form->label('categories');
echo $this->Form->select('category_id', $categories, array('empty' => '...')) . '<br>';
echo $this->Form->label('countries');
echo $this->Form->select('country_id', $countries, array('empty' => '...')) . '<br>';
echo $this->Form->label('fuels');
echo $this->Form->select('fuel_id', $fuels, array('empty' => '...')) . '<br>';
echo $this->Form->label('regions');
echo $this->Form->select('region_id', $regions, array('empty' => '...')) . '<br>';
echo $this->Form->label('towns');
echo $this->Form->select('town_id', $towns, array('empty' => '...')) . '<br>';
echo $this->Form->label('description');
echo $this->Form->textarea('description') . '<br>';
echo $this->Form->end(__('Next step'));
?>