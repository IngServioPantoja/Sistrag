<?php
App::uses('AppController', 'Controller');
/**
 * Controles Controller
 *
 * @property Control $Control
 */
class ControlesController extends AppController {
var $uses = array('Control','Estandar','Programa','Tiposestandar','Roles');

	public function index() {
		$this->Control->recursive = 2;
		$this->set('controles', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->Control->exists($id)) {
			throw new NotFoundException(__('Invalid control'));
		}
		$options = array('conditions' => array('Control.' . $this->Control->primaryKey => $id),'limit'=>1,'recursive'=>'2');
		$control= $this->Control->find('first', $options);
		$this->set('control',$control);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Control->create();
			if ($this->Control->save($this->request->data)) {
				$this->Session->setFlash(__('Ñunto de control registrado exitosamente'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Error intente nuevamente'));
			}
		}
		$roles = $this->Control->Rol->find('list');
		$opciones = array(
           	'order' => array('Programa.nombre asc'),
	   	);
		$programas = $this->Programa->find('list',$opciones);$opciones=null;
		$id_programa=key($programas);
		$opciones = array(
			
	    	'fields' => array('Estandar.id','Tiposestandar.nombre'),
	    	'conditions' => array(
	    		'Estandar.programa_id' => $id_programa		  
			  ),
           	'order' => array('Tiposestandar.nombre asc'),
           	'recursive' => 0
	   	);
		$estandares = $this->Estandar->find('list',$opciones);$opciones=null;
		$this->set('roles',$roles);
		$this->set('programas',$programas);
		$this->set('estandares',$estandares);
	}

	public function edit($id = null) {
		



		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Control->save($this->request->data)) {
				$this->Session->setFlash(__('The control has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The control could not be saved. Please, try again.'));
			}
		}else {
			$options = array('conditions' => array('Control.' . $this->Control->primaryKey => $id));
			$this->request->data = $this->Control->find('first', $options);
			
		
		$roles = $this->Control->Rol->find('list');
		$opciones = array(
			'conditions' => array('Programa.id'=> $this->request->data['Estandar']['programa_id']),
           	'order' => array('Programa.nombre asc'),
           	'limit'=>-1
	   	);
		$programas = $this->Programa->find('all',$opciones);$opciones=null;
		$this->request->data['Programa']=$programas;
		$id_programa=key($programas);
		$opciones = array(
			
	    	'fields' => array('Estandar.id','Tiposestandar.nombre'),
	    	'conditions' => array(
	    		'Estandar.programa_id' => $id_programa		  
			  ),
           	'order' => array('Tiposestandar.nombre asc'),
           	'recursive' => 0
	   	);
		$estandares = $this->Estandar->find('list',$opciones);$opciones=null;
		$this->set('roles',$roles);
		$this->set('programas',$programas);
		$this->set('estandares',$estandares);
		}






	}

	public function cronogramas()
	{
		$this->Control->recursive = 2;
		$this->set('controles', $this->paginate());
	}

	public function estandar_programa()
	{
		$id_programa=$this->request->data['Control']['programa'];
		$opciones = array(
			
	    	'fields' => array('Estandar.id','Tiposestandar.nombre'),
	    	'conditions' => array(
	    		'Estandar.programa_id' => $id_programa		  
			  ),
           	'order' => array('Tiposestandar.nombre asc'),
           	'recursive' => 0
	   	);
		$estandares = $this->Estandar->find('list',$opciones);$opciones=null;
		$this->set('estandares',$estandares);
		$this->render('/Controles/estandar_programa');
	}
	
	public function delete($id = null) {
		$this->Control->id = $id;
		if (!$this->Control->exists()) {
			throw new NotFoundException(__('Invalid control'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Control->delete()) {
			$this->Session->setFlash(__('Control deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Control was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
