<?php

/**
 * Towns Controller.
 *
 */
class TownsController extends AppController {
	public $name = 'Towns';
	public $components = array('Paginator');
	public $helpers = array('Paginator');
	public $paginate = array(
			'Town' => array(
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
	 * Add a town.
	 */
	public function add() {
		if(!empty($this->request->data)) {
			if($this->Town->save($this->request->data)){
				$this->Session->setFlash(__('Town has been saved.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
			}
		}
		$regions = $this->Town->Region->find('list');
		$this->set(compact('regions'));
	}

	/**
	 * Edit the town.
	 * @param int $townId The town id
	 */
	public function edit($townId = NULL) {

		if(empty($townId)) {
			$this->Session->setFlash(__('Invalid id.'));
		} else {
			if(empty($this->request->data)) {
				$this->request->data = $this->Town->findById($townId);
			} else {
				$this->Town->id = $townId;
				if($this->Town->save($this->request->data)){
					$this->Session->setFlash(__('Town has been edited.'));
				} else {
					$this->Session->setFlash(__('An error occurred.'));
				}
			}
		}
		$this->request->data = $this->Town->findById($townId);
		$regions = $this->Town->Region->find('list');
		$this->set(compact('regions'));
	}

	public function view($townId) {
		if(empty($townId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else {
			$town = $this->Town->findById($townId);
			$this->set(compact('town'));
		}
	}

	/**
	 * List of all towns.
	 */
	public function index() {
		$towns = $this->paginate('Town');
		$this->set(compact('towns'));
	}

	/**
	 * Delete a town. Not functional yet, add a deleted field to the database table
	 * @param int $townId The brand
	 */
	public function delete($townId) {
		if(empty($townId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else if (!$this->Town->find('count', array('conditions' => array('Town.id' => $townId)))) {
			$this->Session->setFlash(__('Town does not exist!'));
		} else {
			$this->Town->id = $townId;
			if($this->Town->saveField('deleted', 1)) {
				$this->Session->setFlash(__('Town deleted.'));
			} else {
				$this->Session->setFlash(__('Error.'));
			}
		}
	}
}
?>