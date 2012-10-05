<?php
/**
 * Model class for users database
 * Uses Containable behaviour.
 */
class User extends AppModel {
  public $name = 'User';
  public $cacheQueries = TRUE;//Cache for single request.
  public $actsAs = array('Containable');

  //Associations with other models
  public $hasMany = array(
      'Car' => array(
          'className' => 'Car',
          'foreignKey' => 'user_id',
          'conditions' => array('User.deleted' => 0),
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
      'given_name' => array(
          'rule' => 'notEmpty',
          'required' => FALSE,
          'allowEmpty' => FALSE,
          'on' => NULL,
          'message' => 'Please provide a given name!'
      ),
      'surname_name' => array(
          'rule' => 'notEmpty',
          'required' => FALSE,
          'allowEmpty' => FALSE,
          'on' => NULL,
          'message' => 'Please provide a surname!'
      ),
      'password' => array(
          'provided' => array(
              'rule' => 'notEmpty',
              'required' => FALSE,
              'allowEmpty' => FALSE,
              'on' => NULL,
              'message' => 'Please provide a password!'
          ),
          'matches' => array(
              'rule' => array('fieldsMatch', 'password_confirmation'),
              'required' => FALSE,
              'allowEmpty' => FALSE,
              'on' => NULL,
              'message' => 'Passwords do not match!'
          )
      )
  );
  
  public function fieldsMatch($check = array(), $fieldName = NULL) {
    return $check['password'] === $this->data[$this->name][$fieldName];
  }
  
  public function register($user = NULL) { 
    if(!empty($user)) {
      $this->save($user, TRUE);
    }
  }
}
?>