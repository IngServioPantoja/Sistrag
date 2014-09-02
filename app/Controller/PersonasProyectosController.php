<?php
App::uses('AppController', 'Controller');
class PersonasProyectosController extends AppController {
var $components = array("RequestHandler","Paginator");
var $uses = array('PersonasProyecto','Proyecto','Persona','Rol','Notificacion');

	public function add() {
		if ($this->request->is('post')) {
			$this->PersonasProyecto->create();
			if ($this->PersonasProyecto->save($this->request->data)) {
				echo "perfect";
				$this->Session->setFlash(__('La relación se ha establecido correctamente'));
				print_r($this->request->data);
				$this->Notificacion->create();
				$notificacion=array();
				$fecha = date_create();
				$fecha = date_format($fecha, 'Y-m-d H:i:s');
				$notificacion['Notificacion']['parametro_estado_id']=5;
				$notificacion['Notificacion']['fecha']=$fecha;
				if($this->request->data['PersonasProyecto']['rol_id']==1)
				{
				$notificacion['Notificacion']['parametro_tipo_notificacion']=7;
				}else if($this->request->data['PersonasProyecto']['rol_id']==2)
				{
				$notificacion['Notificacion']['parametro_tipo_notificacion']=8;
				}else if($this->request->data['PersonasProyecto']['rol_id']==3)
				{
				$notificacion['Notificacion']['parametro_tipo_notificacion']=10;
				}
				$notificacion['Notificacion']['url_action']='documentos';
				$notificacion['Notificacion']['url_controlador']='proyectos';
				$notificacion['Notificacion']['url_valor']=$this->request->data['PersonasProyecto']['proyecto_id'];
				$notificacion['Notificacion']['persona_id']=$this->request->data['PersonasProyecto']['persona_id'];
				if($this->Notificacion->save($notificacion))
				{

				}
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
