<?php

/**
 * Brands Controller.
 *
 */
class BrandsController extends AppController {
	public $name = 'Brands';
	public $paginate = array(
			'Brand' => array(
					'limit' => 10
			)
	);

	/**
	 * (non-PHPdoc)
	 * @see Controller::beforeFilter()
	 */
	public function beforeFilter() {
	  $this->Auth->allow();
	}
	
	/**
	 * Add a brand
	 */
	public function add() {
		if(!empty($this->request->data)) {
			if($this->Brand->save($this->request->data)){
				$this->Session->setFlash(__('Brand has been saved.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
			}
		}
	}

	/**
	 * Edit a brand
	 * @param int $id The brand's id
	 */
	public function edit($brandId = NULL) {
		if(empty($brandId)) {
			$this->Session->setFlash(__('Invalid id.'));
		} else {
			if(empty($this->request->data)) {
				$this->request->data = $this->Brand->findById($brandId);
			} else {
				$this->Brand->id = $brandId;
				if($this->Brand->save($this->request->data)){
					$this->Session->setFlash(__('Brand has been edited.'));
				} else {
					$this->Session->setFlash(__('An error occurred.'));
				}
			}
		}
		$this->request->data = $this->Brand->findById($brandId);
	}

	/**
	 * View a brand, with options to edit.
	 * @param int $brandId The brand to be viewed
	 */
	public function view($brandId = NULL) {
		if(empty($brandId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else {
			$brand = $this->Brand->findById($brandId);
			$this->set(compact('brand'));
		}
	}

	/**
	 * List of all brands.
	 */
	public function index() {
		$brands = $this->paginate('Brand');
		$this->set(compact('brands'));
	}

	/**
	 * Delete a brand. Not functional yet, add a deleted field to the database table
	 * @param int $brandId The brand
	 */
	public function delete($brandId) {
		if(empty($brandId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else if (!$this->Brand->find('count', array('conditions' => array('Brand.id' => $brandId)))) {
			$this->Session->setFlash(__('Brand type does not exist!'));
		} else {
			$this->Brand->id = $brandId;
			if($this->Brand->saveField('deleted', 1)) {
				$this->Session->setFlash(__('Brand deleted.'));
			} else {
				$this->Session->setFlash(__('Error.'));
			}
		}
	}
	
	public function isAuthorized($user) {
    $permitted = parent::isAuthorized($user);
    return $permitted;
	}
}
?>