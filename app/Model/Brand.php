<?php
/**
 * Model class for brands database
 *
 */
class Brand extends AppModel {
	public $name = 'Brand';
	public $cacheQueries = TRUE;//Cache for single request.

	//Associations with other models
	public $hasMany = array(
			'BrandModel' => array(
					'className' => 'BrandModel',
					'foreignKey' => 'brand_id',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'dependent' =>FALSE, //Do not delete related models.
					'exclusive' => FALSE,
					'finderQuery' => ''
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