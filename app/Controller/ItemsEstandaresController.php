<?php
App::uses('AppController', 'Controller');
/**
 * ItemsEstandares Controller
 *
 * @property ItemsEstandar $ItemsEstandar
 */
class ItemsEstandaresController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemsEstandar->recursive = 0;
		$this->set('itemsEstandares', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ItemsEstandar->exists($id)) {
			throw new NotFoundException(__('Invalid items estandar'));
		}
		$options = array('conditions' => array('ItemsEstandar.' . $this->ItemsEstandar->primaryKey => $id));
		$this->set('itemsEstandar', $this->ItemsEstandar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemsEstandar->create();
			if ($this->ItemsEstandar->save($this->request->data)) {
				$this->Session->setFlash(__('The items estandar has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The items estandar could not be saved. Please, try again.'));
			}
		}
		
		$itemsEstandares = $this->ItemsEstandar->ItemsEstandar->find('list');
		$items = $this->ItemsEstandar->Item->find('list');
		$estandares = $this->ItemsEstandar->Estandares->find('list');
		$this->set(compact('itemsEstandares', 'items', 'estandares'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ItemsEstandar->exists($id)) {
			throw new NotFoundException(__('Invalid items estandar'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ItemsEstandar->save($this->request->data)) {
				$this->Session->setFlash(__('The items estandar has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The items estandar could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ItemsEstandar.' . $this->ItemsEstandar->primaryKey => $id));
			$this->request->data = $this->ItemsEstandar->find('first', $options);
		}
		$itemsEstandares = $this->ItemsEstandar->ItemsEstandar->find('list');
		$items = $this->ItemsEstandar->Item->find('list');
		$estandares = $this->ItemsEstandar->Estandar->find('list');
		$this->set(compact('itemsEstandares', 'items', 'estandares'));
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
		$this->ItemsEstandar->id = $id;
		if (!$this->ItemsEstandar->exists()) {
			throw new NotFoundException(__('Invalid items estandar'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ItemsEstandar->delete()) {
			$this->Session->setFlash(__('Items estandar deleted'));
			$this->redirect(array('controller'=>'estandares','action' => 'index'));
		}
		$this->Session->setFlash(__('Items estandar was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
