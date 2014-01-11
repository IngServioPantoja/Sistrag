<?php
App::uses('AppController', 'Controller');
/**
 * Evaluaciones Controller
 *
 * @property Evaluacion $Evaluacion
 */
class EvaluacionesController extends AppController {
    var $name = "Evaluaciones";
    var $helpers = array("Html", "Form");
    var $uses = array('Evaluacion','Rol','Concepto','ItemsEstandar');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Evaluacion->recursive = 0;
		$this->set('evaluaciones', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Evaluacion->exists($id)) {
			throw new NotFoundException(__('Invalid evaluacion'));
		}
		$options = array('conditions' => array('Evaluacion.' . $this->Evaluacion->primaryKey => $id));
		$this->set('evaluacion', $this->Evaluacion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Evaluacion->create();
			if ($this->Evaluacion->save($this->request->data)) {
				$this->Session->setFlash(__('The evaluacion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluacion could not be saved. Please, try again.'));
			}
		}
		$itemestandares = $this->Evaluacion->Itemsestandar->find('list');
		$conceptos = $this->Evaluacion->Concepto->find('list');
		$this->set(compact('itemestandares', 'conceptos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Evaluacion->exists($id)) {
			throw new NotFoundException(__('Invalid evaluacion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Evaluacion->save($this->request->data)) {
				$this->Session->setFlash(__('The evaluacion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluacion could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evaluacion.' . $this->Evaluacion->primaryKey => $id));
			$this->request->data = $this->Evaluacion->find('first', $options);
		}
		$itemestandares = $this->Evaluacion->Itemestandar->find('list');
		$conceptos = $this->Evaluacion->Concepto->find('list');
		$this->set(compact('itemestandares', 'conceptos'));
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
		$this->Evaluacion->id = $id;
		if (!$this->Evaluacion->exists()) {
			throw new NotFoundException(__('Invalid evaluacion'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evaluacion->delete()) {
			$this->Session->setFlash(__('Evaluacion deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Evaluacion was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
