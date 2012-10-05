<?php
/**
 * Model class for cars database
 * Uses Containable behaviour.
 */
class Car extends AppModel {
	public $name = 'Car';
	public $cacheQueries = TRUE;//Cache for single request.
	public $actsAs = array('Containable');

	//Associations with other models
	public $belongsTo = array(
			'Brand' => array(
					'className' => 'Brand',
					'foreignKey' => 'brand_id',
					'conditions' => array('Brand.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			),
			'BrandModel' => array(
					'className' => 'BrandModel',
					'foreignKey' => 'brand_model_id',
					'conditions' => array('BrandModel.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			),
			'Category' => array(
					'className' => 'Category',
					'foreignKey' => 'category_id',
					'conditions' => array('Category.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			),
			'Country' => array(
					'className' => 'Country',
					'foreignKey' => 'country_id',
					'conditions' => array('Country.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			),
			'Region' => array(
					'className' => 'Region',
					'foreignKey' => 'region_id',
					'conditions' => array('Region.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			),
			'Town' => array(
					'className' => 'Town',
					'foreignKey' => 'town_id',
					'conditions' => array('Town.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			),
			'Fuel' => array(
					'className' => 'Fuel',
					'foreignKey' => 'fuel_id',
					'conditions' => array('Fuel.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			)
	);


	//Validation rules
}
?>