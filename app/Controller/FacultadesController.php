<?php
App::uses('AppController', 'Controller');
/**
 * Facultades Controller
 *
 * @property Facultad $Facultad
 */
class FacultadesController extends AppController {

/**
 * index method
 *
 * @return void
 */
public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('add'); // Letting users register themselves
}
	public function index() {
		$this->Facultad->recursive = 0;
		$this->set('facultades', $this->paginate());
	}

/**
 * view method
 *$this->set('facultades', $this->paginate());
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Facultad->exists($id)) {
			throw new NotFoundException(__('Invalid facultad'));
		}
		$options = array('conditions' => array('Facultad.' . $this->Facultad->primaryKey => $id));
		$this->set('facultad', $this->Facultad->find('first', $options));
		$this->Facultad->recursive = 0;
		$this->set('facultades', $this->paginate());

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Facultad->create();
			if ($this->Facultad->save($this->request->data)) {
				$this->Session->setFlash(__('The facultad has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The facultad could not be saved. Please, try again.'));
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
		if (!$this->Facultad->exists($id)) {
			throw new NotFoundException(__('Invalid facultad'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Facultad->save($this->request->data)) {
				$this->Session->setFlash(__('The facultad has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The facultad could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Facultad.' . $this->Facultad->primaryKey => $id));
			$this->request->data = $this->Facultad->find('first', $options);
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
		$this->Facultad->id = $id;
		if (!$this->Facultad->exists()) {
			throw new NotFoundException(__('Invalid facultad'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Facultad->delete()) {
			$this->Session->setFlash(__('Facultad deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Facultad was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	 public function isAuthorized($user){
	if($user['nivel_id'] == 1){
		return true;
		}
	if(in_array($this->action,array('edit','delete'))){
		if($user['id']!= $this->request->params['pass'][0]){
		return false;
		}
	}
	return true;
	}

}
