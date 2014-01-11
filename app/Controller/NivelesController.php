<?php
App::uses('AppController', 'Controller');
/**
 * Niveles Controller
 *
 * @property Nivel $Nivel
 */
class NivelesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Nivel->recursive = 0;
		$this->set('niveles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Nivel->exists($id)) {
			throw new NotFoundException(__('Invalid nivel'));
		}
		$options = array('conditions' => array('Nivel.' . $this->Nivel->primaryKey => $id));
		$this->set('nivel', $this->Nivel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Nivel->create();
			if ($this->Nivel->save($this->request->data)) {
				$this->Session->setFlash(__('The nivel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nivel could not be saved. Please, try again.'));
			}
		}
		//$menus = $this->Nivel->Menu->find('list');
		//$this->set(compact('menus'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Nivel->exists($id)) {
			throw new NotFoundException(__('Invalid nivel'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Nivel->save($this->request->data)) {
				$this->Session->setFlash(__('The nivel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nivel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Nivel.' . $this->Nivel->primaryKey => $id));
			$this->request->data = $this->Nivel->find('first', $options);
		}
		$menus = $this->Nivel->Menu->find('list');
		$this->set(compact('menus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Nivel->id = $id;
		if (!$this->Nivel->exists()) {
			throw new NotFoundException(__('Invalid nivel'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Nivel->delete()) {
			$this->Session->setFlash(__('Nivel deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Nivel was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
