<?php
App::uses('AppController', 'Controller');
/**
 * ItemsContenidos Controller
 *
 * @property ItemsContenido $ItemsContenido
 * @property PaginatorComponent $Paginator
 */
class ItemsContenidosController extends AppController {

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
		$this->ItemsContenido->recursive = 0;
		$this->set('itemsContenidos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ItemsContenido->exists($id)) {
			throw new NotFoundException(__('Invalid items contenido'));
		}
		$options = array('conditions' => array('ItemsContenido.' . $this->ItemsContenido->primaryKey => $id));
		$this->set('itemsContenido', $this->ItemsContenido->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemsContenido->create();
			print_r($this->request->data);
			if ($this->ItemsContenido->save($this->request->data)) {
				$this->Session->setFlash(__('The items contenido has been saved.'));
				print_r($this->request->data);
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The items contenido could not be saved. Please, try again.'));
			}
		}
		$itemsDocumentos = $this->ItemsContenido->ItemsDocumento->find('list');
		$this->set(compact('itemsDocumentos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ItemsContenido->exists($id)) {
			throw new NotFoundException(__('Invalid items contenido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ItemsContenido->save($this->request->data)) {
				$this->Session->setFlash(__('The items contenido has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The items contenido could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ItemsContenido.' . $this->ItemsContenido->primaryKey => $id));
			$this->request->data = $this->ItemsContenido->find('first', $options);
		}
		$itemsDocumentos = $this->ItemsContenido->ItemsDocumento->find('list');
		$this->set(compact('itemsDocumentos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ItemsContenido->id = $id;
		if (!$this->ItemsContenido->exists()) {
			throw new NotFoundException(__('Invalid items contenido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ItemsContenido->delete()) {
			$this->Session->setFlash(__('The items contenido has been deleted.'));
		} else {
			$this->Session->setFlash(__('The items contenido could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
