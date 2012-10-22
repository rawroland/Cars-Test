<?php

/**
 * Cars Controller.
 *
 */
class CarsController extends AppController {
  public $name = 'Cars';
  public $components = array('RequestHandler');
//   public $helpers = array('Paginator');
  public $uses = array('Car', 'Brand', 'BrandModel', 'Category', 'Country', 'Fuel', 'Region', 'Town', 'User', 'Image');
  public $paginate = array(
      'Car' => array(
          'limit' => 10
      )
  );

  public function beforeFilter() {
    $this->Auth->allow('dummy_images', 'dummies', 'view', 'add_details', 'add_user', 'add_images', 'search', 'search_results');
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

  public function search() {

    $brands = $this->Brand->find('list');
    $countries = $this->Country->find('list');
    $regions= $this->Region->find('list');
    $towns = $this->Town->find('list');
    $fuels = $this->Fuel->find('list');
    $this->set(compact('brands', 'fuels', 'countries', 'regions', 'towns'));
  }

  public function search_results() {

    $conditions = array(1);
    if (!empty($this->request->query['text'])) {
      $conditions[] = array( 'OR' => array(
          'Car.brand_name LIKE' => '%' . $this->request->query['text'] . '%',
          'Car.brand_model_name LIKE' => '%' . $this->request->query['text'] . '%',
          'Car.category_name LIKE' => '%' . $this->request->query['text'] . '%',
          'Car.country_name LIKE' => '%' . $this->request->query['text'] . '%',
          'Car.description LIKE' => '%' . $this->request->query['text'] . '%',
          'Car.region_name LIKE' => '%' . $this->request->query['text'] . '%',
          'Car.town_name LIKE' => '%' . $this->request->query['text'] . '%',
          'Car.fuel_name LIKE' => '%' . $this->request->query['text'] . '%'
      ));
    }

    if (!empty($this->request->query['brand'])) {
      $brands = array();
      foreach ($this->request->query['brand'] as $key => $brand) {
        if (!empty($brand)) {
          $brands[] = $brand;
        };
      }
      if (!empty($brands)) {
        $conditions[] = array('Car.brand_id' => $brands);
      }
    }

    if (!empty($this->request->query['country'])) {
      $conditions[] = array('Car.country_id' => $this->request->query['country']);
    }

    if (!empty($this->request->query['region'])) {
      $conditions[] = array('Car.region_id' => $this->request->query['region']);
    }

    if (!empty($this->request->query['town']) ) {
      $conditions[] = array('Car.town_id' => $this->request->query['town']);
    }

    if (!empty($this->request->query['power_min'])) {
      $conditions[] = array('Car.power >' => $this->request->query['power_min']);
    }

    if (!empty($this->request->query['power_max'])) {
      $conditions[] = array('Car.power <' => $this->request->query['power_max']);
    }

    if (!empty($this->request->query['km_min'])) {
      $conditions[] = array('Car.mileage >' => $this->request->query['km_min']);
    }

    if (!empty($this->request->query['km_max'])) {
      $conditions[] = array('Car.mileage <' => $this->request->query['km_max']);
    }

    if (!empty($this->request->query['seats_min'])) {
      $conditions[] = array('Car.seats >' => $this->request->query['seats_min']);
    }

    if (!empty($this->request->query['seats_max'])) {
      $conditions[] = array('Car.seats <' => $this->request->query['seats_max']);
    }

    $this->paginate = array(
        'Car' => array(
            'limit' => 10,
            'order' => array(
                'Car.created' => 'ASC'
            ),
            'conditions' => $conditions,
            'contain' => array(
                'Brand' => array('name'),
                'BrandModel' => array('name'),
                'Image' => array(
                    'conditions' => array('Image.type' => 'thumb', 'Image.position' => 1)
                )
            )
        )
    );
    $cars = $this->paginate('Car', $conditions);
    $this->set(compact('cars'));
  }

  public function isAuthorized($user) {
    //Delivered id.
    $car = $this->request->params['pass'][0];
    if ($this->Car->belongsTo($car, $user['id'])) {
      return  TRUE;
    }
    return parent::isAuthorized($user);
  }

  public function dummies() {
    $years = range(1990, date('Y'));
    $seats = range(1, 12);
    $doors = range(1, 12);
    $mileage = range(100, 500);
    $tank = range(100, 500);
    $power = range(100, 500);
    $transmission = array('Manual', 'Automatic', 'Both');
    $colours = array('black', 'blue', 'red', 'silver', 'white');
    $innerColours = array('black', 'blue', 'red', 'silver', 'white');
    $description = "My money's in that office, right? If she start giving me some bullshit about it ain't there, and we got to go someplace else and get it, I'm gonna shoot you in the head then and there. Then I'm gonna shoot that bitch in the kneecaps, find out where my goddamn money is. She gonna tell me too. Hey, look at me when I'm talking to you, motherfucker. You listen: we go in there, and that nigga Winston or anybody else is in there, you the first motherfucker to get shot. You understand?";
    $users = range(1, 10);

    $insertArray = array();
    for ($ctr = 1; $ctr <= 50; $ctr++) {
      $brands = $this->Brand->find('list');
      $insertBrand = array_rand($brands);
      $models = $this->BrandModel->find('list', array(
          'conditions' => array('BrandModel.brand_id' => $insertBrand)
      ));
      $insertModel = array_rand($models);
      $countries = $this->Country->find('list');
      $insertCtr = array_rand($countries);
      $regions = $this->Region->find('list', array(
          'conditions' => array('Region.country_id' => $insertCtr)
      ));
      $insertRegion = array_rand($regions);
      $towns = $this->Town->find('list', array(
          'conditions' => array('Town.region_id' => $insertRegion)
      ));
      $insertTown = array_rand($towns);
      $cats = $this->Category->find('list');
      $insertCat = array_rand($cats);
      $fuels = $this->Fuel->find('list');
      $insertFuels = array_rand($fuels);

      $insertArray[] =  array(
          'produced' => $years[array_rand($years)],
          'seats' => $seats[array_rand($seats)],
          'doors' => $doors[array_rand($doors)],
          'mileage' => $mileage[array_rand($mileage)],
          'tank_capacity' => $tank[array_rand($tank)],
          'power' => $power[array_rand($power)],
          'transmission' => $transmission[array_rand($transmission)],
          'colour' => $colours[array_rand($colours)],
          'inner_colour' => $innerColours[array_rand($innerColours)],
          'description' => $description,
          'brand_id' => $insertBrand,
          'brand_name' => $brands[$insertBrand],
          'brand_model_id' => $insertModel,
          'brand_model_name' => $models[$insertModel],
          'country_id' => $insertCtr,
          'country_name' => $countries[$insertCtr],
          'fuel_id' => $insertFuels,
          'fuel_name' => $fuels[$insertFuels],
          'category_id' => $insertCat,
          'category_name' => $cats[$insertCat],
          'region_id' => $insertRegion,
          'region_name' => $regions[$insertRegion],
          'town_id' => $insertTown,
          'town_name' => $towns[$insertTown],
          'user_id' => $users[array_rand($users)]

      );
      var_dump($insertArray, $ctr);
    }
    //     $this->Car->saveMany($insertArray);
  }

  public function dummy_images() {
    $cars = $this->Car->find('list');
    $images = array();
    foreach ($cars as $id => $car) {
      $images[] = array(
          'car_id' => $id,
          'location' => 'cars/' . $id . '/thumbs/car1.jpg',
          'type' => 'thumb',
          'position' => 1
      );
      $images[] = array(
          'car_id' => $id,
          'location' => 'cars/' . $id . '/thumbs/car2.jpg',
          'type' => 'thumb',
          'position' => 2
      );
      $images[] = array(
          'car_id' => $id,
          'location' => 'cars/' . $id . '/images/car1.jpg',
          'type' => 'image',
          'position' => 1
      );
      $images[] = array(
          'car_id' => $id,
          'location' => 'cars/' . $id . '/images/car1.jpg',
          'type' => 'image',
          'position' => 2
      );
    }
    //     $this->Image->saveMany($images);
  }

}
?>