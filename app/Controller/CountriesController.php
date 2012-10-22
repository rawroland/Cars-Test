<?php

/**
 * Countries Controller.
 *
 */
class CountriesController extends AppController {
	public $name = 'Countries';
	public $components = array('Paginator');
	public $helpers = array('Paginator');
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
	 * Add a country
	 */
	public function add() {
		if(!empty($this->request->data)) {
			if($this->Country->save($this->request->data)){
				$this->Session->setFlash(__('Country has been saved.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
			}
		}
	}

	/**
	 * Edit a country
	 * @param int $id The country's id
	 */
	public function edit($countryId = 0) {

		if(empty($countryId)) {
			$this->Session->setFlash(__('Invalid id.'));
		} else {
			if (empty($this->request->data)) {
				$this->request->data = $this->Country->findById($countryId);
			} else {
				$this->Country->id = $countryId;
				if($this->Country->save($this->request->data)){
					$this->Session->setFlash(__('Country has been edited.'));
				} else {
					$this->Session->setFlash(__('An error occurred.'));
				}
			}
		}
		$this->request->data = $this->Country->findById($countryId);
	}

	/**
	 * View a country, with options to edit.
	 * @param int $countryId The country to be viewed
	 */
	public function view($countryId = NULL) {
		if(empty($countryId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else {
			$country = $this->Country->findById($countryId);
			$this->set(compact('country'));
		}
	}

	/**
	 * List of all countries.
	 */
	public function index() {
		$countries = $this->paginate('Country');
		$this->set(compact('countries'));
	}

	/**
	 * Delete a country. Not functional yet, add a deleted field to the database table
	 * @param int $countryId The country
	 */
	public function delete($countryId) {
		if(empty($countryId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else if (!$this->Country->find('count', array('conditions' => array('Country.id' => $countryId)))) {
			$this->Session->setFlash(__('Country does not exist!'));
		} else {
			$this->Country->id = $countryId;
			if($this->Country->saveField('deleted', 1)) {
				$this->Session->setFlash(__('Country deleted.'));
			} else {
				$this->Session->setFlash(__('Error.'));
			}
		}
	}
}
?>