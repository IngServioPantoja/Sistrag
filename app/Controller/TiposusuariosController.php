<?php
App::uses('AppController', 'Controller');
/**
 * Tiposusuarios Controller
 *
 * @property Tiposusuario $Tiposusuario
 */
class TiposusuariosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tiposusuario->recursive = 0;
		$this->set('tiposusuarios', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tiposusuario->exists($id)) {
			throw new NotFoundException(__('Invalid tiposusuario'));
		}
		$options = array('conditions' => array('Tiposusuario.' . $this->Tiposusuario->primaryKey => $id));
		$this->set('tiposusuario', $this->Tiposusuario->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tiposusuario->create();
			if ($this->Tiposusuario->save($this->request->data)) {
				$this->Session->setFlash(__('The tiposusuario has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tiposusuario could not be saved. Please, try again.'));
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
		if (!$this->Tiposusuario->exists($id)) {
			throw new NotFoundException(__('Invalid tiposusuario'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tiposusuario->save($this->request->data)) {
				$this->Session->setFlash(__('The tiposusuario has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tiposusuario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tiposusuario.' . $this->Tiposusuario->primaryKey => $id));
			$this->request->data = $this->Tiposusuario->find('first', $options);
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
		$this->Tiposusuario->id = $id;
		if (!$this->Tiposusuario->exists()) {
			throw new NotFoundException(__('Invalid tiposusuario'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tiposusuario->delete()) {
			$this->Session->setFlash(__('Tiposusuario deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tiposusuario was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
