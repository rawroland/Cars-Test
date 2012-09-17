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

	/**
	 * Edit the model.
	 * @param int $modelId The model id
	 */
	public function edit($modelId = NULL) {

		if(empty($modelId)) {
			$this->Session->setFlash(__('Invalid id.'));
		} else {
			if(empty($this->request->data)) {
				$this->request->data = $this->BrandModel->findById($modelId);
			} else {
				$this->BrandModel->id = $modelId;
				if($this->BrandModel->save($this->request->data)){
					$this->Session->setFlash(__('Model has been edited.'));
				} else {
					$this->Session->setFlash(__('An error occurred.'));
				}
			}
		}
		$this->request->data = $this->BrandModel->findById($modelId);
		$brands = $this->BrandModel->Brand->find('list');
		$this->set(compact('brands'));
	}

	public function view($modelId) {
		if(empty($modelId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else {
			$model = $this->BrandModel->findById($modelId);
			$this->set(compact('model'));
		}
	}

	/**
	 * List of all brand models.
	 */
	public function index() {
		$models = $this->paginate('BrandModel');
		$this->set(compact('models'));
	}

	/**
	 * Delete a model. Not functional yet, add a deleted field to the database table
	 * @param int $modelId The brand
	 */
	public function delete($modelId) {
		if(empty($modelId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else if (!$this->BrandModel->find('count', array('conditions' => array('BrandModel.id' => $fuelId)))) {
			$this->Session->setFlash(__('Model does not exist!'));
		} else {
			$this->BrandModel->id = $modelId;
			if($this->BrandModel->saveField('deleted', 1)) {
				$this->Session->setFlash(__('Model deleted.'));
			} else {
				$this->Session->setFlash(__('Error.'));
			}
		}
	}
}
?>