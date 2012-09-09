<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	public $defaultConditions = array('deleted' => 0);

	/**
	 * Add default find conditions.
	 * @see Model::beforeFind()
	 */
	public function beforeFind($queryData) {
		if(!empty($this->defaultConditions)) {
			$this->prependAlias();
			$queryData['conditions'] = array_merge((array) $this->defaultConditions, (array)$queryData['conditions']);
		}

		return $queryData;
	}

	/**
	 * Prepend the conditions' fields with their models if not already done.
	 */
	private function prependAlias() {
		foreach ($this->defaultConditions as $key => $value) {
			$position = strpos($key, '.');
			if($position === FALSE) {
				$this->defaultConditions[$this->alias . '.' . $key] = $this->defaultConditions[$key];
				unset($this->defaultConditions[$key]);
			}
		}
	}
}
