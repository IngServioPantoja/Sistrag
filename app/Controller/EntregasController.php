<?php
App::uses('AppController', 'Controller');

class EntregasController extends AppController {

	public $components = array('Paginator');
	var $uses = array('Entrega','Documento','Detalleentrega','PersonasProyecto','Rol');

	public function index() {
		$this->Entrega->recursive = 0;
		$this->set('entregas', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->Entrega->exists($id)) {
			throw new NotFoundException(__('Invalid entrega'));
		}
		$options = array('conditions' => array('Entrega.' . $this->Entrega->primaryKey => $id));
		$this->set('entrega', $this->Entrega->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Entrega->create();
			$fecha = date_create();
			$fecha = date_format($fecha, 'Y-m-d');
			$this->request->data['Entrega']['fecha_entrega']=$fecha;
			$documento['Documento']['id']=$this->request->data['Entrega']['documento_id'];
			$documento['Documento']['enviado']=1;
			if ($this->Entrega->save($this->request->data)) 
			{	
				if($this->request->data['Entrega']['rol_id']==1)
				{
					if($this->Documento->save($documento))
					{
					
					}
				}
				$opciones = array(
			    	'conditions' => 
			            array(
			                'PersonasProyecto.rol_id' => $this->request->data['Entrega']['rol_id'],
			                'PersonasProyecto.proyecto_id' => $this->request->data['Entrega']['proyecto_id']
			           	),
		           	'recursive'=>-1		
		   		);
				$receptores = $this->PersonasProyecto->find('all',$opciones);
				foreach ($receptores as $receptor) {
					$this->Detalleentrega->create();
					$detalleentrega['Detalleentrega']['entrega_id']=$this->Entrega->id;
					$detalleentrega['Detalleentrega']['personas_proyecto_id']=$receptor['PersonasProyecto']['id'];
					$detalleentrega['Detalleentrega']['estado_id']=1;
					$detalleentrega['Detalleentrega']['fecha_estado']=$fecha;
					if($this->Detalleentrega->save($detalleentrega))
					{
					}

				}
				$this->Session->setFlash(__('El documento fue enviado exitosamente'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('El documento no se ha podido enviar'));
			}
		}
		$roles = $this->Entrega->Rol->find('list');
		$documentos = $this->Entrega->Documento->find('list');
		$this->set(compact('roles', 'documentos'));
	}

	public function edit($id = null) {
		if (!$this->Entrega->exists($id)) {
			throw new NotFoundException(__('Invalid entrega'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Entrega->save($this->request->data)) {
				$this->Session->setFlash(__('The entrega has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entrega could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Entrega.' . $this->Entrega->primaryKey => $id));
			$this->request->data = $this->Entrega->find('first', $options);
		}
		$roles = $this->Entrega->Rol->find('list');
		$documentos = $this->Entrega->Documento->find('list');
		$this->set(compact('roles', 'documentos'));
	}

	public function delete($id = null) {
		$this->Entrega->id = $id;
		if (!$this->Entrega->exists()) {
			throw new NotFoundException(__('Invalid entrega'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Entrega->delete()) {
			$this->Session->setFlash(__('The entrega has been deleted.'));
		} else {
			$this->Session->setFlash(__('The entrega could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
