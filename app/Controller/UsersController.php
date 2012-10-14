<?php

/**
 * Users Controller.
 *
 */
class UsersController extends AppController {
  public $name = 'Users';
  public $components = array('Paginator');
  public $helpers = array('Paginator');
  public $paginate = array(
      'User' => array(
          'limit' => 10
      )
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('login', 'register');
  }

  public function edit() {}
  public function view($user) {
    if (empty($user)) {
      $this->Session-setFlash('Invalid user.');
      $this->redirect('/');
    }
  }
  public function delete() {}
  
  public function login() {
    if ($this->request->is('post') && !empty($this->request->data)) {
      if ($this->Auth->login()) {
        $this->redirect($this->Auth->redirect());
      } else {
        $this->Session->setFlash(__('Invalid username or password, try again'));
      }
    }
  }
  
  public function logout() {
    $this->redirect($this->Auth->logout());
  }
  
  public function register() {
    if($this->request->is('post') && !empty($this->request->data)) {
      if ($this->User->register($this->request->data)) {
        $this->Session->setFlash('Registration successful!');
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
      } else {
        $this->Session->setFlash('Registration error!');
      }
    }
  }
  
  public function isAuthorized($user) {
    //Delivered id.
    $car = $this->request->params['pass'][0];
    if ($this->User->belongsTo($user, $user['id'])) {
      return TRUE;
    }
    return parent::isAuthorized($user);
  }
}
?>