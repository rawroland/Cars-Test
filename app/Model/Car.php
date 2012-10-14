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
          'type' => 'left',
          'fields' => ''
      ),
      'BrandModel' => array(
          'className' => 'BrandModel',
          'foreignKey' => 'brand_model_id',
          'conditions' => array('BrandModel.deleted' => 0),
          'order' => '',
          'type' => 'left',
          'fields' => ''
      ),
      'Category' => array(
          'className' => 'Category',
          'foreignKey' => 'category_id',
          'conditions' => array('Category.deleted' => 0),
          'order' => '',
          'type' => 'left',
          'fields' => ''
      ),
      'Country' => array(
          'className' => 'Country',
          'foreignKey' => 'country_id',
          'conditions' => array('Country.deleted' => 0),
          'order' => '',
          'type' => 'left',
          'fields' => ''
      ),
      'Region' => array(
          'className' => 'Region',
          'foreignKey' => 'region_id',
          'conditions' => array('Region.deleted' => 0),
          'order' => '',
          'type' => 'left',
          'fields' => ''
      ),
      'Town' => array(
          'className' => 'Town',
          'foreignKey' => 'town_id',
          'conditions' => array('Town.deleted' => 0),
          'order' => '',
          'type' => 'left',
          'fields' => ''
      ),
      'Fuel' => array(
          'className' => 'Fuel',
          'foreignKey' => 'fuel_id',
          'conditions' => array('Fuel.deleted' => 0),
          'order' => '',
          'type' => 'left',
          'fields' => ''
      )
  );

  public $hasMany = array(
      'Image' => array(
          'className' => 'Image',
          'foreignKey' => 'car_id',
          'conditions' => array('Image.deleted' => 0),
          'order' => '',
          'limit' => '',
          'offset' => '',
          'dependent' =>FALSE, //Do not delete related models.
          'exclusive' => FALSE,
          'finderQuery' => ''
      )
  );


  //Validation rules

  /**
   * Update name fields for saving.
   * @see Model::beforeSave()
   */
  public function beforeSave($options) {
    $names = array(
        array('model' => 'Brand', 'field' => 'brand_id', 'update' => 'brand_name'),
        array('model' => 'BrandModel', 'field' => 'brand_model_id', 'update' => 'brand_model_name'),
        array('model' => 'Category', 'field' => 'category_id', 'update' => 'category_name'),
        array('model' => 'Country', 'field' => 'country_id', 'update' => 'country_name'),
        array('model' => 'Fuel', 'field' => 'fuel_id', 'update' => 'fuel_name'),
        array('model' => 'Region', 'field' => 'region_id', 'update' => 'region_name'),
        array('model' => 'Town', 'field' => 'town_id', 'update' => 'town_name')
    );
    foreach ($names as $name) {
      $value = $this->$name['model']->field('name', array('id' => $this->data[$this->alias][$name['field']])) ;
      $this->data[$this->alias][$name['update']] = $value;
    }

    return TRUE;
  }

  /**
   * Check if the car belongs to the user
   * @param int $car The car id.
   * @param int $user The user id.
   * @return True or false.
   */
  public function belongsTo($car, $user) {
    return $this->field('id', array('id' => $car, 'user_id' => $user)) === $car;
  }
}
?>