<?php
App::uses('AppController', 'Controller');
/**
 * Tiposestandares Controller
 *
 * @property Tiposestandar $Tiposestandar
 */
class TiposestandaresController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tiposestandar->recursive = 0;
		$this->set('tiposestandares', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tiposestandar->exists($id)) {
			throw new NotFoundException(__('Invalid tiposestandar'));
		}
		$options = array('conditions' => array('Tiposestandar.' . $this->Tiposestandar->primaryKey => $id));
		$this->set('tiposestandar', $this->Tiposestandar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tiposestandar->create();
			if ($this->Tiposestandar->save($this->request->data)) {
				$this->Session->setFlash(__('The tiposestandar has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tiposestandar could not be saved. Please, try again.'));
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
		if (!$this->Tiposestandar->exists($id)) {
			throw new NotFoundException(__('Invalid tiposestandar'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tiposestandar->save($this->request->data)) {
				$this->Session->setFlash(__('The tiposestandar has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tiposestandar could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tiposestandar.' . $this->Tiposestandar->primaryKey => $id));
			$this->request->data = $this->Tiposestandar->find('first', $options);
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
		$this->Tiposestandar->id = $id;
		if (!$this->Tiposestandar->exists()) {
			throw new NotFoundException(__('Invalid tiposestandar'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tiposestandar->delete()) {
			$this->Session->setFlash(__('Tiposestandar deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tiposestandar was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
