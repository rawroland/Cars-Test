<?php
/**
 * Model class for users database
 * Uses Containable behaviour.
 */

APP::uses('AuthComponent', 'Controller/Component');

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
      ),
      'email' =>  array(
          'validEmail' => array(
              'rule' => 'email',
              'required' => FALSE,
              'allowEmpty' => FALSE,
              'on' => NULL,
              'message' => 'Please provide a valid email address!'
          ),
          'uniqueEmail' => array(
              'rule' => 'isUnique',
              'required' => FALSE,
              'allowEmpty' => FALSE,
              'on' => NULL,
              'message' => 'This email exists already!'
          )
      )
  );

  /**
   * Hash passwords
   * @see Model::beforeSave()
   */
  public function beforeSave($options = array()) {
    if (!empty($this->data[$this->alias]['password'])) {
      $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }

    return TRUE;
  }

  /**
   * Custom validation rule for matching fields.
   * @param array $check the value of the field to be checked. array('field' => 'value')
   * @param String $fieldName The field to be checked against.
   * @return True if they match and false otherwise
   */
  public function fieldsMatch($check = array(), $fieldName = NULL) {
    return $check['password'] === $this->data[$this->alias][$fieldName];
  }

  public function register($user = NULL) {
    if(!empty($user)) {
      if($this->save($user, TRUE)) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }

  /**
   * Check if the profile belongs to the user
   * @param int $user The requesting user.
   * @param int $user The logged user.
   * @return True or false.
   */
  public function belongsTo($requester, $loggedUser) {
    return $this->field('id', array('id' => $requester)) === $loggedUser;
  }

}
?>