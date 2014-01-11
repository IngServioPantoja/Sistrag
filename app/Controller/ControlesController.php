<?php
App::uses('AppController', 'Controller');
/**
 * Controles Controller
 *
 * @property Control $Control
 */
class ControlesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Control->recursive = 0;
		$this->set('controles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Control->exists($id)) {
			throw new NotFoundException(__('Invalid control'));
		}
		$options = array('conditions' => array('Control.' . $this->Control->primaryKey => $id));
		$this->set('control', $this->Control->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Control->create();
			if ($this->Control->save($this->request->data)) {
				$this->Session->setFlash(__('The control has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The control could not be saved. Please, try again.'));
			}
		}
		$roles = $this->Control->Rol->find('list');
		$estandares = $this->Control->Estandar->find('list');
		$this->set(compact('roles', 'estandares'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Control->exists($id)) {
			throw new NotFoundException(__('Invalid control'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Control->save($this->request->data)) {
				$this->Session->setFlash(__('The control has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The control could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Control.' . $this->Control->primaryKey => $id));
			$this->request->data = $this->Control->find('first', $options);
		}
		$roles = $this->Control->Roles->find('list');
		$estandares = $this->Control->Estandares->find('list');
		$this->set(compact('roles', 'estandares'));
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
		$this->Control->id = $id;
		if (!$this->Control->exists()) {
			throw new NotFoundException(__('Invalid control'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Control->delete()) {
			$this->Session->setFlash(__('Control deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Control was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
