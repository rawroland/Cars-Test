<?php

/**
 * Categories Controller.
 *
 */
class CategoriesController extends AppController {
	public $name = 'Categories';
	public $components = array('Paginator');
	public $helpers = array('Paginator');
	public $paginate = array(
			'Brand' => array(
					'limit' => 10
			)
	);

	/**
	 * Add a category
	 */
	public function add() {
		if(!empty($this->request->data)) {
			if($this->Category->save($this->request->data)){
				$this->Session->setFlash(__('Category has been saved.'));
			} else {
				$this->Session->setFlash(__('An error occurred.'));
			}
		}
	}

	/**
	 * Edit a category
	 * @param int $id The category's id
	 */
	public function edit($categoryId = 0) {

		if(empty($categoryId)) {
			$this->Session->setFlash(__('Invalid id.'));
		} else {
			if (empty($this->request->data)) {
				$this->request->data = $this->Category->findById($categoryId);
			} else {
				$this->Category->id = $categoryId;
				if($this->Category->save($this->request->data)){
					$this->Session->setFlash(__('Category has been edited.'));
				} else {
					$this->Session->setFlash(__('An error occurred.'));
				}
			}
		}
		$this->request->data = $this->Category->findById($categoryId);
	}

	/**
	 * View a category, with options to edit.
	 * @param int $categoryId The category to be viewed
	 */
	public function view($categoryId = NULL) {
		if(empty($categoryId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else {
			$category = $this->Category->findById($categoryId);
			$this->set(compact('category'));
		}
	}

	/**
	 * List of all categories.
	 */
	public function index() {
		$categories = $this->paginate('Category');
		$this->set(compact('categories'));
	}

	/**
	 * Delete a category. Not functional yet, add a deleted field to the database table
	 * @param int $categoryId The category
	 */
	public function delete($categoryId) {
		if(empty($categoryId)) {
			$this->Session->setFlash(__('Invalid id!'));
		} else if (!$this->Category->find('count', array('conditions' => array('Category.id' => $categoryId)))) {
			$this->Session->setFlash(__('Category type does not exist!'));
		} else {
			$this->Category->id = $categoryId;
			if($this->Category->saveField('deleted', 1)) {
				$this->Session->setFlash(__('Category deleted.'));
			} else {
				$this->Session->setFlash(__('Error.'));
			}
		}
	}
}
?>