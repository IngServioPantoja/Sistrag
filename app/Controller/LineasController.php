<?php
App::uses('AppController', 'Controller');
/**
 * Lineas Controller
 *
 * @property Linea $Linea
 * @property PaginatorComponent $Paginator
 */
class LineasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Linea->recursive = 0;
		$this->set('lineas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Linea->exists($id)) {
			throw new NotFoundException(__('Invalid linea'));
		}
		$options = array('conditions' => array('Linea.' . $this->Linea->primaryKey => $id));
		$this->set('linea', $this->Linea->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Linea->create();
			if ($this->Linea->save($this->request->data)) {
				$this->Session->setFlash(__('The linea has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linea could not be saved. Please, try again.'));
			}
		}
		$areas = $this->Linea->Area->find('list');
		$this->set(compact('areas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Linea->exists($id)) {
			throw new NotFoundException(__('Invalid linea'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Linea->save($this->request->data)) {
				$this->Session->setFlash(__('The linea has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linea could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Linea.' . $this->Linea->primaryKey => $id));
			$this->request->data = $this->Linea->find('first', $options);
		}
		$areas = $this->Linea->Area->find('list');
		$this->set(compact('areas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Linea->id = $id;
		if (!$this->Linea->exists()) {
			throw new NotFoundException(__('Invalid linea'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Linea->delete()) {
			$this->Session->setFlash(__('The linea has been deleted.'));
		} else {
			$this->Session->setFlash(__('The linea could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
