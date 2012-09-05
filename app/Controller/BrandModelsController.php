<?php

/**
 * Brands Controller.
 *
 */
class BrandModelsController extends AppController {
	public $name = 'BrandModels';
	
	public function add() {
		
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