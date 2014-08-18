<?php
App::uses('AppController', 'Controller');
/**
 * Conceptos Controller
 *
 * @property Concepto $Concepto
 */
class OrdenDocumentosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Concepto->recursive = 0;
		$this->set('conceptos', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->Concepto->exists($id)) {
			throw new NotFoundException(__('Invalid concepto'));
		}
		$options = array('conditions' => array('Concepto.' . $this->Concepto->primaryKey => $id));
		$this->set('concepto', $this->Concepto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Concepto->create();
			if ($this->Concepto->save($this->request->data)) {
				$this->Session->setFlash(__('The concepto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The concepto could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Concepto->exists($id)) {
			throw new NotFoundException(__('Invalid concepto'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Concepto->save($this->request->data)) {
				$this->Session->setFlash(__('The concepto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The concepto could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Concepto.' . $this->Concepto->primaryKey => $id));
			$this->request->data = $this->Concepto->find('first', $options);
		}
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
		$this->Concepto->id = $id;
		if (!$this->Concepto->exists()) {
			throw new NotFoundException(__('Invalid concepto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Concepto->delete()) {
			$this->Session->setFlash(__('Concepto deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Concepto was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
