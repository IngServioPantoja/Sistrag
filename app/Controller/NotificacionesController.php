<?php
App::uses('AppController', 'Controller');

class NotificacionesController extends AppController {
	var $uses = array(
	'Notificacion',
	'Persona',
	'Parametro'
	);

	public function index() 
	{
		//Recargamos la sessión del usuario
		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];
		//Encontraremos en los que mi sessión se desempeña como jurado
		$this->paginate = array(
			'Notificacion' => array(
				'limit' => 1000,
	            'order'=>
	            	array(
	            		'Notificacion.fecha' =>'DESC'
	            	),
				'conditions' => 
		            array(
		                'Notificacion.persona_id'=>$id_persona
	            	),
	            'recursive' =>0
			)
		);

		$notificaciones = $this->paginate('Notificacion');

		$this->set('notificaciones', $notificaciones);

	}

	public function view($id = null) {
		if (!$this->Notificacion->exists($id)) {
			throw new NotFoundException(__('Invalid notificacion'));
		}
		$options = array('conditions' => array('Notificacion.' . $this->Notificacion->primaryKey => $id));
		$this->set('notificacion', $this->Notificacion->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Notificacion->create();
			if ($this->Notificacion->save($this->request->data)) {
				$this->Session->setFlash(__('The notificacion has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notificacion could not be saved. Please, try again.'));
			}
		}
		$parametroEstados = $this->Notificacion->ParametroEstado->find('list');
		$parametroTipoNotificaciones = $this->Notificacion->ParametroNotificacion->find('list');
		$personas = $this->Notificacion->Persona->find('list');
		$this->set(compact('parametroEstados', 'parametroTipoNotificaciones','personas'));
	}

	public function actualizar_notificacion()
	{
		$this->autoRender = false;
		$notificacion=array();
		$notificacion['Notificacion']['id']=$this->request->data['id'];
		$notificacion['Notificacion']['parametro_estado_id']=4;
		print_r($this->request->data['id']);
		
		if($this->Notificacion->save($notificacion)){
			echo "guardado exitoso";
		}
		//Funcion para actualizar comentarios de manera asincrona



	}

	public function edit($id = null) {
		if (!$this->Notificacion->exists($id)) {
			throw new NotFoundException(__('Invalid notificacion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Notificacion->save($this->request->data)) {
				$this->Session->setFlash(__('The notificacion has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notificacion could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notificacion.' . $this->Notificacion->primaryKey => $id));
			$this->request->data = $this->Notificacion->find('first', $options);
		}
		$parametroEstados = $this->Notificacion->ParametroEstado->find('list');
		$parametroTipoNotificaciones = $this->Notificacion->ParametroNotificacion->find('list');
		$this->set(compact('parametroEstados', 'parametroTipoNotificaciones'));
	}

	public function delete($id = null) {
		$this->Notificacion->id = $id;
		if (!$this->Notificacion->exists()) {
			throw new NotFoundException(__('Invalid notificacion'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notificacion->delete()) {
			$this->Session->setFlash(__('The notificacion has been deleted.'));
		} else {
			$this->Session->setFlash(__('The notificacion could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
