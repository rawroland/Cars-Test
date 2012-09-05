<?php

/**
 * Brands Controller.
 *
 */
class BrandsController extends AppController {
	public $name = 'Brands';
	
	public function add() {
		
	}
	
	public function edit() {
	
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