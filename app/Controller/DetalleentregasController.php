<?php
App::uses('AppController', 'Controller');
/**
 * Detalleentregas Controller
 *
 * @property Detalleentrega $Detalleentrega
 * @property PaginatorComponent $Paginator
 */
class DetalleentregasController extends AppController {

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
		$this->Detalleentrega->recursive = 0;
		$this->set('detalleentregas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Detalleentrega->exists($id)) {
			throw new NotFoundException(__('Invalid detalleentrega'));
		}
		$options = array('conditions' => array('Detalleentrega.' . $this->Detalleentrega->primaryKey => $id));
		$this->set('detalleentrega', $this->Detalleentrega->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Detalleentrega->create();
			if ($this->Detalleentrega->save($this->request->data)) {
				$this->Session->setFlash(__('The detalleentrega has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The detalleentrega could not be saved. Please, try again.'));
			}
		}
		$entregas = $this->Detalleentrega->Entrega->find('list');
		$personasProyectos = $this->Detalleentrega->PersonasProyecto->find('list');
		$estados = $this->Detalleentrega->Estado->find('list');
		$this->set(compact('entregas', 'personasProyectos', 'estados'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Detalleentrega->exists($id)) {
			throw new NotFoundException(__('Invalid detalleentrega'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Detalleentrega->save($this->request->data)) {
				$this->Session->setFlash(__('The detalleentrega has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The detalleentrega could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Detalleentrega.' . $this->Detalleentrega->primaryKey => $id));
			$this->request->data = $this->Detalleentrega->find('first', $options);
		}
		$entregas = $this->Detalleentrega->Entrega->find('list');
		$personasProyectos = $this->Detalleentrega->PersonasProyecto->find('list');
		$estados = $this->Detalleentrega->Estado->find('list');
		$this->set(compact('entregas', 'personasProyectos', 'estados'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Detalleentrega->id = $id;
		if (!$this->Detalleentrega->exists()) {
			throw new NotFoundException(__('Invalid detalleentrega'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Detalleentrega->delete()) {
			$this->Session->setFlash(__('The detalleentrega has been deleted.'));
		} else {
			$this->Session->setFlash(__('The detalleentrega could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
