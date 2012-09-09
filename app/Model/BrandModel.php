<?php
/**
 * Model class for brand_models database
 *
 */
class BrandModel extends AppModel {
	public $name = 'BrandModel';
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