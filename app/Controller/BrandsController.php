<?php

/**
 * Brands Controller.
 *
 */
class BrandsController extends AppController {
	public $name = 'Brands';
	public $components = array('Paginator');
	public $helpers = array('Paginator');
	public $paginate = array(
			'Brand' => array(
					'limit' => 10
			)
	);

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
		$this->Brand->contain();
		if(empty($this->request->data)) {
			if(!empty($brandId)) {
				$this->request->data = $this->Brand->findById($brandId);
			} else  {
				$this->Session->setFlash(__('Invalid id.'));
			}
		} else {
			$this->Brand->id = $brandId;
			if($this->Brand->save($this->request->data)){
				$this->Session->setFlash(__('Brand has been edited.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
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
		} else {
			$this->Brand->id = $brandId;
			if($this->Brand->saveField('deleted', 1)) {
				$this->Session->setFlash(__('Brand deleted.'));
			} else {
				$this->Session->setFlash(__('Error.'));
			}
		}
	}
}
?>