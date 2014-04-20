<?php
App::uses('AppController', 'Controller');
/**
 * ItemsDocumentos Controller
 *
 * @property ItemsDocumento $ItemsDocumento
 * @property PaginatorComponent $Paginator
 */
class ItemsDocumentosController extends AppController {

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
		$this->ItemsDocumento->recursive = 0;
		$this->set('itemsDocumentos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ItemsDocumento->exists($id)) {
			throw new NotFoundException(__('Invalid items documento'));
		}
		$options = array('conditions' => array('ItemsDocumento.' . $this->ItemsDocumento->primaryKey => $id));
		$this->set('itemsDocumento', $this->ItemsDocumento->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemsDocumento->create();
			if ($this->ItemsDocumento->save($this->request->data)) {
				$this->Session->setFlash(__('The items documento has been saved.'));
				print_r($this->request->data);
			} else {
				$this->Session->setFlash(__('The items documento could not be saved. Please, try again.'));
			}
		}
		$documentos = $this->ItemsDocumento->Documento->find('list');
		$itemsEstandares = $this->ItemsDocumento->ItemsEstandar->find('list');
		$this->set(compact('documentos', 'itemsEstandares'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ItemsDocumento->exists($id)) {
			throw new NotFoundException(__('Invalid items documento'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ItemsDocumento->save($this->request->data)) {
				$this->Session->setFlash(__('The items documento has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The items documento could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ItemsDocumento.' . $this->ItemsDocumento->primaryKey => $id));
			$this->request->data = $this->ItemsDocumento->find('first', $options);
		}
		$documentos = $this->ItemsDocumento->Documento->find('list');
		$itemsEstandares = $this->ItemsDocumento->ItemsEstandar->find('list');
		$this->set(compact('documentos', 'itemsEstandares'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ItemsDocumento->id = $id;
		if (!$this->ItemsDocumento->exists()) {
			throw new NotFoundException(__('Invalid items documento'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ItemsDocumento->delete()) {
			$this->Session->setFlash(__('The items documento has been deleted.'));
		} else {
			$this->Session->setFlash(__('The items documento could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
