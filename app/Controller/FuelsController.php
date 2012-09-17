<?php

/**
 * Fuels Controller.
 *
 */
class FuelsController extends AppController {
	public $name = 'Fuels';
	public $components = array('Paginator');
	public $helpers = array('Paginator');
	public $paginate = array(
			'Brand' => array(
					'limit' => 10
			)
	);

	/**
	 * Add a fuel
	 */
	public function add() {
		if(!empty($this->request->data)) {
			if($this->Fuel->save($this->request->data)){
				$this->Session->setFlash(__('Fuel has been saved.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
			}
		}
	}

	/**
	 * Edit a fuel
	 * @param int $id The fuel's id
	 */
	public function edit($fuelId = 0) {

		if(empty($fuelId)) {
			$this->Session->setFlash(__('Invalid id.'));
		} else {
			if (empty($this->request->data)) {
				$this->request->data = $this->Fuel->findById($fuelId);
			} else {
				$this->Fuel->id = $fuelId;
				if($this->Fuel->save($this->request->data)){
					$this->Session->setFlash(__('Fuel has been edited.'));
				} else {
					$this->Session->setFlash(__('An error occurred.'));
				}
			}
		}
		$this->request->data = $this->Fuel->findById($fuelId);
	}

	/**
	 * View a fuel, with options to edit.
	 * @param int $fuelId The fuel to be viewed
	 */
	public function view($fuelId = NULL) {
		if(empty($fuelId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else {
			$fuel = $this->Fuel->findById($fuelId);
			$this->set(compact('fuel'));
		}
	}

	/**
	 * List of all fuels.
	 */
	public function index() {
		$fuels = $this->paginate('Fuel');
		$this->set(compact('fuels'));
	}

	/**
	 * Delete a fuel. Not functional yet, add a deleted field to the database table
	 * @param int $fuelId The fuel
	 */
	public function delete($fuelId) {
		if(empty($fuelId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else if (!$this->Fuel->find('count', array('conditions' => array('Fuel.id' => $fuelId)))) {
			$this->Session->setFlash(__('Fuel type does not exist!'));
		} else {
			$this->Fuel->id = $fuelId;
			if($this->Fuel->saveField('deleted', 1)) {
				$this->Session->setFlash(__('Fuel deleted.'));
			} else {
				$this->Session->setFlash(__('Error.'));
			}
		}
	}
}
?>