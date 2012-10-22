<?php

/**
 * Regions Controller.
 *
 */
class RegionsController extends AppController {
	public $name = 'Regions';
	public $components = array('Paginator');
	public $helpers = array('Paginator');
	public $paginate = array(
			'Region' => array(
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
	
	public function add() {
		if(!empty($this->request->data)) {
			if($this->Region->save($this->request->data)){
				$this->Session->setFlash(__('Region has been saved.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
			}
		}
		$countries = $this->Region->Country->find('list');
		$this->set(compact('countries'));
	}

	/**
	 * Edit the region.
	 * @param int $regionId The region id
	 */
	public function edit($regionId = NULL) {

		if(empty($regionId)) {
			$this->Session->setFlash(__('Invalid id.'));
		} else {
			if(empty($this->request->data)) {
				$this->request->data = $this->Region->findById($regionId);
			} else {
				$this->Region->id = $regionId;
				if($this->Region->save($this->request->data)){
					$this->Session->setFlash(__('Region has been edited.'));
				} else {
					$this->Session->setFlash(__('An error occurred.'));
				}
			}
		}
		$this->request->data = $this->Region->findById($regionId);
		$countries = $this->Region->Country->find('list');
		$this->set(compact('countries'));
	}

	public function view($regionId) {
		if(empty($regionId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else {
			$region = $this->Region->findById($regionId);
			$this->set(compact('region'));
		}
	}

	/**
	 * List of all regions.
	 */
	public function index() {
		$regions = $this->paginate('Region');
		$this->set(compact('regions'));
	}

	/**
	 * Delete a region. Not functional yet, add a deleted field to the database table
	 * @param int $regionId The brand
	 */
	public function delete($regionId) {
		if(empty($regionId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else if (!$this->Region->find('count', array('conditions' => array('Region.id' => $regionId)))) {
			$this->Session->setFlash(__('Region does not exist!'));
		} else {
			$this->Region->id = $regionId;
			if($this->Region->saveField('deleted', 1)) {
				$this->Session->setFlash(__('Region deleted.'));
			} else {
				$this->Session->setFlash(__('Error.'));
			}
		}
	}
}
?>