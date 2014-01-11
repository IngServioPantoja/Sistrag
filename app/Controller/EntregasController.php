<?php
App::uses('AppController', 'Controller');
/**
 * Entregas Controller
 *
 * @property Entrega $Entrega
 */
class EntregasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Entrega->recursive = 0;
		$this->set('entregas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Entrega->exists($id)) {
			throw new NotFoundException(__('Invalid entrega'));
		}
		$options = array('conditions' => array('Entrega.' . $this->Entrega->primaryKey => $id));
		$this->set('entrega', $this->Entrega->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Entrega->create();
			if ($this->Entrega->save($this->request->data)) {
				$this->Session->setFlash(__('The entrega has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entrega could not be saved. Please, try again.'));
			}
		}
		$roles = $this->Entrega->Rol->find('list');
		$estados = $this->Entrega->Estado->find('list');
		$this->set(compact('roles', 'estados'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Entrega->exists($id)) {
			throw new NotFoundException(__('Invalid entrega'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Entrega->save($this->request->data)) {
				$this->Session->setFlash(__('The entrega has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entrega could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Entrega.' . $this->Entrega->primaryKey => $id));
			$this->request->data = $this->Entrega->find('first', $options);
		}
		$roles = $this->Entrega->Rol->find('list');
		$estados = $this->Entrega->Estado->find('list');
		$this->set(compact('roles', 'estados'));
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
		$this->Entrega->id = $id;
		if (!$this->Entrega->exists()) {
			throw new NotFoundException(__('Invalid entrega'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Entrega->delete()) {
			$this->Session->setFlash(__('Entrega deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Entrega was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
