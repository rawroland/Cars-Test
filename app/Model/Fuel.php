<?php
/**
 * Model class for fuels database
 * Uses Containable behaviour.
 */
class Fuel extends AppModel {
	public $name = 'Fuel';
	public $cacheQueries = TRUE;//Cache for single request.
	public $actsAs = array('Containable');

	//Associations with other models

	//Validation rules
	public $validate = array(
			'name' => array(
					'not_empty' => array(
							'rule' => 'notEmpty',
							'required' => FALSE,
							'allowEmpty' => FALSE,
							'on' => NULL,
							'message' => 'Please provide a name!'
					),
					'maximum' => array(
							'rule' => array('maxLength', 50),
							'required' => FALSE,
							'allowEmpty' => FALSE,
							'on' => NULL,
							'message' => 'The name cannot be longer than 50!'
					)
			)
	);
}
?>