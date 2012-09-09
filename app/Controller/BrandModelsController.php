<?php

/**
 * Brands Controller.
 *
 */
class BrandModelsController extends AppController {
	public $name = 'BrandModels';
	public $components = array('Paginator');
	public $helpers = array('Paginator');
	public $paginate = array(
			'BrandModel' => array(
					'limit' => 10
			)
	);
	
	public function add() {
		if(!empty($this->request->data)) {
			if($this->BrandModel->save($this->request->data)){
				$this->Session->setFlash(__('Brand has been saved.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
			}
		}
		$brands = $this->BrandModel->Brand->find('list');
		$this->set(compact('brands'));
	}
	
	public function edit() {
	
	}
	
	public function view() {
	
	}
	
	/**
	 * List of all brand models.
	 */
	public function index() {
		$models = $this->BrandModel->find('all');
		$this->set(compact('models'));
	}
	
	public function delete() {
	
	}
}
?>