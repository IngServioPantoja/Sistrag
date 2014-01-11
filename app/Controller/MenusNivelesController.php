<?php
App::uses('AppController', 'Controller');
/**
 * MenusNiveles Controller
 *
 * @property MenusNivel $MenusNivel
 */
class MenusNivelesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MenusNivel->recursive = 0;
		$this->set('menusNiveles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MenusNivel->exists($id)) {
			throw new NotFoundException(__('Invalid menus nivel'));
		}
		$options = array('conditions' => array('MenusNivel.' . $this->MenusNivel->primaryKey => $id));
		$this->set('menusNivel', $this->MenusNivel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MenusNivel->create();
			if ($this->MenusNivel->save($this->request->data)) {
				$this->Session->setFlash(__('The menus nivel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menus nivel could not be saved. Please, try again.'));
			}
		}
		$menus = $this->MenusNivel->Menu->find('list');
		$niveles = $this->MenusNivel->Nivel->find('list');
		$this->set(compact('menus', 'niveles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MenusNivel->exists($id)) {
			throw new NotFoundException(__('Invalid menus nivel'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MenusNivel->save($this->request->data)) {
				$this->Session->setFlash(__('The menus nivel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menus nivel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MenusNivel.' . $this->MenusNivel->primaryKey => $id));
			$this->request->data = $this->MenusNivel->find('first', $options);
		}
		$menus = $this->MenusNivel->Menu->find('list');
		$niveles = $this->MenusNivel->Nivel->find('list');
		$this->set(compact('menus', 'niveles'));
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
		$this->MenusNivel->id = $id;
		if (!$this->MenusNivel->exists()) {
			throw new NotFoundException(__('Invalid menus nivel'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MenusNivel->delete()) {
			$this->Session->setFlash(__('Menus nivel deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Menus nivel was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
