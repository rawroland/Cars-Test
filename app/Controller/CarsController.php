<?php

/**
 * Cars Controller.
 *
 */
class CarsController extends AppController {
  public $name = 'Cars';
  public $components = array('Paginator');
  public $helpers = array('Paginator');
  public $uses = array('Car', 'Brand', 'BrandModel', 'Category', 'Country', 'Fuel', 'Region', 'Town', 'User');
  public $paginate = array(
      'Car' => array(
          'limit' => 10
      )
  );

  /**
   * First step for adding a car. Save car details to the session and
   * generate a unique session id
   */
  public function add_details() {
    $oldData = $this->Session->read('Car');
    if(!empty($this->request->data) && $this->request->is('post')) {
      $sessionId = substr(md5(uniqid(rand(), TRUE)), 16, 16);
      $this->Session->write('Car', $this->request->data);
      $this->Session->write('session_id', $sessionId);
      $this->redirect(array('controller' => 'cars', 'action' => 'add_user', '?' => array('session_id' => $sessionId)));
    } else if(!empty($oldData)) {
      $this->request->data = $oldData;
    }
    $brands = $this->Brand->find('list');
    $brand_models = $this->BrandModel->find('list');
    $categories = $this->Category->find('list');
    $countries = $this->Country->find('list');
    $fuels = $this->Fuel->find('list');
    $regions = $this->Region->find('list');
    $towns = $this->Town->find('list');

    $this->set(compact('brands', 'brand_models', 'categories', 'countries', 'fuels', 'regions', 'towns'));
  }

  public function add_user() {
    $currentSession = !empty($this->request->query['session_id']) ? $this->request->query['session_id'] : NULL;
    $this->set('sessionId', $currentSession);
    $savedSession = $this->Session->read('session_id');
    $carInfo = $this->Session->read('Car');

    if(!empty($currentSession) && !empty($savedSession) && $currentSession === $savedSession) {
//       $this->Session->setFlash('Valid Session');
      if($this->request->is('post') && !empty($this->request->data)) {
        $this->User->register($this->request->data);
      }
    } else {
      $this->Session->setFlash('The session has expired');
      $this->redirect(array('controller' => 'cars', 'action' => 'add_details'));
    }
  }

}
?>