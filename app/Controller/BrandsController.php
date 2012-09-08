<?php

/**
 * Brands Controller.
 *
 */
class BrandsController extends AppController {
	public $name = 'Brands';

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
	public function edit($id = NULL) {
		if(empty($this->request->data)) {
			if(!empty($id)) {
				$this->request->data = $this->Brand->findById($id);
			} else  {
				$this->Session->setFlash(__('Invalid id.'));
			}
		} else {
			$this->Brand->id = $id;
			if($this->Brand->save($this->request->data)){
				$this->Session->setFlash(__('Brand has been edited.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
			}
		}
		$this->request->data = $this->Brand->findById($id);
	}

	public function view() {

	}

	/**
	 * List of all brands.
	 */
	public function index() {
		$brands = $this->Brand->find('all');
		$this->set(compact('brands'));
	}

	public function delete() {

	}
}
?>