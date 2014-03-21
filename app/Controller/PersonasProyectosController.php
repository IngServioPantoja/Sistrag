<?php
App::uses('AppController', 'Controller');
class PersonasProyectosController extends AppController {
var $components = array("RequestHandler","Paginator");
var $uses = array('PersonasProyecto','Proyecto','Persona','Rol');

	public function add() {
		if ($this->request->is('post')) {
			$this->PersonasProyecto->create();
			if ($this->PersonasProyecto->save($this->request->data)) {
				$this->Session->setFlash(__('La relación se ha establecido correctamente'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('No se ha podido realizar la opreación'));
			}
		}
		$proyectos = $this->PersonasProyecto->Proyecto->find('list');
		$personas = $this->PersonasProyecto->Persona->find('list');
		$roles = $this->PersonasProyecto->Rol->find('list');
		$this->set(compact('proyectos', 'personas', 'roles'));
		$this->autoRender = false;
	}

	public function delete($id = null) {
		if (isset($this->request->data)) 
		{
			print_r($this->request->data);
		}
		$this->PersonasProyecto->id = $id;
		if (!$this->PersonasProyecto->exists()) {
			throw new NotFoundException(__('Invalid personas proyecto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PersonasProyecto->delete()) {
			$this->Session->setFlash(__('La relación se ha borrado exitosamente'));
			$this->redirect($this->referer());	
		} else {
			$this->Session->setFlash(__('La relación no se ha borrado intente de nuevo'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function edit($id = null) 
	{
		print_r($this->request->data);
		if (!$this->PersonasProyecto->exists($id)) {
			throw new NotFoundException(__('Invalid personas proyecto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PersonasProyecto->save($this->request->data)) {
				$this->Session->setFlash(__('La relacion ha sido actualizada exitosamente'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('La operación no se ha podido completar intente de nuevo'));
			}
		} else {
			$options = array('conditions' => array('PersonasProyecto.' . $this->PersonasProyecto->primaryKey => $id));
			$this->request->data = $this->PersonasProyecto->find('first', $options);
		}
		$proyectos = $this->PersonasProyecto->Proyecto->find('list');
		$personas = $this->PersonasProyecto->Persona->find('list');
		$roles = $this->PersonasProyecto->Rol->find('list');
		$this->set(compact('proyectos', 'personas', 'roles'));
	}

	public function index() {
		$this->PersonasProyecto->recursive = 0;
		$this->set('personasProyectos', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->PersonasProyecto->exists($id)) {
			throw new NotFoundException(__('Invalid personas proyecto'));
		}
		$options = array('conditions' => array('PersonasProyecto.' . $this->PersonasProyecto->primaryKey => $id));
		$this->set('personasProyecto', $this->PersonasProyecto->find('first', $options));
	}
}
