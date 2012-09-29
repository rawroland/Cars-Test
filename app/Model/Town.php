<?php
/**
 * Model class for regions database
 *
 */
class Town extends AppModel {
	public $name = 'Town';
	public $cacheQueries = TRUE;//Cache for single request.
	public $actsAs = array('Containable');

	//Associations with other models
	public $belongsTo = array(
			'Region' => array(
					'className' => 'Region',
					'foreignKey' => 'region_id',
					'conditions' => array('Region.deleted' => 0),
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