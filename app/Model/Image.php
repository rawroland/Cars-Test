<?php
/**
 * Model class for regions database
 *
 */
class Image extends AppModel {
	public $name = 'Image';
	public $cacheQueries = TRUE;//Cache for single request.
	public $actsAs = array('Containable');

	//Associations with other models
	public $belongsTo = array(
			'Car' => array(
					'className' => 'Car',
					'foreignKey' => 'car_id',
					'conditions' => array('Car.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			)
	);

	//Validation rules
	
}
?>