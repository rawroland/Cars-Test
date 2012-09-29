<?php
/**
 * Model class for regions database
 *
 */
class Region extends AppModel {
	public $name = 'Region';
	public $cacheQueries = TRUE;//Cache for single request.
	public $actsAs = array('Containable');

	//Associations with other models
	public $belongsTo = array(
			'Country' => array(
					'className' => 'Country',
					'foreignKey' => 'country_id',
					'conditions' => array('Country.deleted' => 0),
					'order' => '',
					'type' => '',
					'fields' => ''
			)
	);

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