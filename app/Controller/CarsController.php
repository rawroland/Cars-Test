<?php

/**
 * Cars Controller.
 *
 */
class CarsController extends AppController {
  public $name = 'Cars';
  public $components = array('Paginator', 'RequestHandler');
  public $helpers = array('Paginator');
  public $uses = array('Car', 'Brand', 'BrandModel', 'Category', 'Country', 'Fuel', 'Region', 'Town', 'User', 'Image');
  public $paginate = array(
      'Car' => array(
          'limit' => 10
      )
  );

  public function beforeFilter() {
    $this->Auth->allow('view', 'add_details', 'add_user', 'add_images');
  }

  public function edit() {
    
  }
  
  public function index() {

  }

  public function view($id = NULL) {
    $this->Car->recursive = 1;
    $car = $this->Car->find('first', array('conditions' => array('Car.id' => $id)));
    if(!empty($car)) {
      $this->set(compact('car'));
    } else {
      $this->Session->setFlash('Invalid car!');
    }
    
  }
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

  /**
   * Second step, add user and create folders for images
   */
  public function add_user() {
    $currentSession = !empty($this->request->query['session_id']) ? $this->request->query['session_id'] : NULL;
    $this->set('sessionId', $currentSession);
    $savedSession = $this->Session->read('session_id');
    $carInfo = $this->Session->read('Car');
    $loggedUser = $this->Auth->user();

    if(!empty($currentSession) && !empty($savedSession) && $currentSession === $savedSession) {
      //       $this->Session->setFlash('Valid Session');
      if($this->request->is('post')) {
        if(!empty($this->request->data)) {
          if($this->User->register($this->request->data)) {
            $userId = $this->User->getLastInsertID();
          } else {
            $this->Session->setFlash('The user could not be saved!');
            return;
          }
        } else if(!empty($loggedUser)) {
          $userId = $loggedUser['id'];
        } else {
          $this->Session->setFlash('The user could not processed!');
          return;
        }
        $carInfo['Car']['user_id'] = $userId;
        if($this->Car->save($carInfo)) {
          $this->Session->write('Car', $carInfo);
          $this->Session->write('session_id', $currentSession);
          $carId = $this->Car->getLastInsertID();

          $this->Session->write('car_id', $carId);
          $thumbPath = IMAGES . DS . 'cars' . DS . $carId . DS . 'thumbs';
          $imagesPath = IMAGES . DS . 'cars' . DS . $carId . DS . 'images';
          mkdir($thumbPath, 0755, TRUE);
          mkdir($imagesPath, 0755, TRUE);
          $this->Session->setFlash('Car has been saved!');
          $this->redirect(array('controller' => 'cars', 'action' => 'add_images', '?' => array('session_id' => $currentSession)));
        } else {
          $this->Session->setFlash('Car could not be saved!');
        }
      }
    } else {
      $this->Session->setFlash('The session has expired');
      $this->redirect(array('controller' => 'cars', 'action' => 'add_details'));
    }
  }

  /**
   * Final step, upload images
   */
  public function add_images() {
    $currentSession = !empty($this->request->query['session_id']) ? $this->request->query['session_id'] : NULL;
    $this->set('sessionId', $currentSession);
    $savedSession = $this->Session->read('session_id');
    $carInfo = $this->Session->read('Car');
    $carId = $this->Session->read('car_id');

    if (!empty($currentSession) && !empty($savedSession) && $currentSession === $savedSession) {
      $this->Session->setFlash('Can now add images!');
      if($this->request->is('post')) {
        if(!empty($this->request->data)) {
        $thumbs = $this->request->data['Image'];
        $images = array();
        for($ctr = 0; $ctr < count($thumbs); $ctr++) {
          $thumbs[$ctr]['location'] = str_replace('/img/', '', $thumbs[$ctr]['location']);
          $thumbs[$ctr]['location'] = trim($thumbs[$ctr]['location'], '/');
          $thumbs[$ctr] =array_merge($thumbs[$ctr] ,
              array('position' => $ctr + 1),
              array('car_id' => $carId),
              array('type' => 'thumb')
          );
          $imgLocation = str_replace('thumbs', 'images', $thumbs[$ctr]['location']);
          $images[] = array(
              'location' => $imgLocation,
              'position' => $ctr + 1,
              'car_id' => $carId,
              'type' => 'image'
          );
        }
        $imgToSave = array_merge($thumbs, $images);
        $this->Image->saveMany($imgToSave);
        $this->Session->setFlash('Car has been saved with images!');
        } else {
        $this->Session->setFlash('Car has been saved without images!');
        }
        $this->redirect(array('controller' => 'cars', 'action' => 'view', $carId));
      }
    } else {
      $this->Session->setFlash('The session has expired');
      $this->redirect(array('controller' => 'cars', 'action' => 'add_details'));
    }
  }

  public function isAuthorized($user) {
    //Delivered id.
    $car = $this->request->params['pass'][0];
    if ($this->Car->belongsTo($car, $user['id'])) {
      return  TRUE;
    }
    return parent::isAuthorized($user);
  }

}
?>