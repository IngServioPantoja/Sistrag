<?php
App::uses('AppController', 'Controller');

class ReportesController extends AppController {
var $components = array("RequestHandler");
var $helpers = array('Form', 'Html', 'Js','Paginator');
var $uses = array('Facultad','Programa','Persona','TipoUsuario','TiposEstandar');
var $paginate =array(
        'limit' => 10,
        );

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

	public function beforeFilter() 
	{
	    parent::beforeFilter();
	    $this->Auth->allow('add');
	}

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

	public function edit($id = null) {
			if (!$this->Facultad->exists($id)) {
				throw new NotFoundException(__('Facultad invalida'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Facultad->save($this->request->data)) {
					$this->Session->setFlash(__('La facultad ha sido registrada exitosamente'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se ha podido guardar la Facultad intente de nuevo.'));
				}
			} else {
				$options = array('conditions' => array('Facultad.' . $this->Facultad->primaryKey => $id));
				$this->request->data = $this->Facultad->find('first', $options);
				$facultad = $this->Facultad->find('first', $options);
				$this->set('facultad',$facultad);
			}
		}

	public function docentes() 
	{	
		//Paginación con Joins
		$join=array(
            'table' => 'tiposusuarios',
            'alias' => 'TipoUsuario',
            'type' => 'left',
            'conditions' => 
	            array(
	                'TipoUsuario.id = Persona.tiposusuario_id'
            	)
    	);
    	$join2=array(
            'table' => 'programas',
            'alias' => 'Programa',
            'type' => 'left',
            'conditions' => 
	            array(
	                'Programa.id = Persona.programa_id'
            	)
    	);
		$this->paginate = array(
			'Persona' => array(
				'limit' => 10000,
				'joins' => array($join,$join2),
				'conditions' => 
		            array(
		                'TipoUsuario.id'!=5
	            	),
	            'fields'=>
	            	array(
	            		'Persona.id','Persona.identificacion','Persona.nombre','Persona.apellido','Programa.nombre','TipoUsuario.nombre'
	            	),
	            'recursive'=>-1
			)
		);
		$personas = $this->paginate('Persona');
		$this->set('personas',$personas);
	}

	public function detalleReporteDocente()
	{
		$options = array('conditions' => array('Persona.' . $this->Persona->primaryKey => $this->request->data['Reporte']['id']));
		$persona=$this->Persona->find('first', $options);	
		$this->set('persona',$persona);
		$options = 
		array(
			'fields' => 
			array(
				'TiposEstandar.nombre'
			),
			'order'=>'TiposEstandar.nombre desc'
		);
		$estandares=$this->TiposEstandar->find('list', $options);
		$this->response->type('json');

	    $estandares = json_encode($estandares);
		$this->set('estandares',$estandares);
		print_r($estandares);
		





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

	public function programas_asociados($facultad_id=null,$atributo=null,$valor=null)
	{
		if (!$this->Facultad->exists($facultad_id))
		{
			throw new NotFoundException(__('Facultad invalida'));
		}
		$this->Facultad->recursive = 0;
		$options = array('conditions' => array('Facultad.' . $this->Facultad->primaryKey => $facultad_id));
		$facultad=$this->Facultad->find('first', $options);	
		$this->set('facultad',$facultad);
		if(isset($this->request->data['Busqueda']))
		{ 
			if($this->request->data['Busqueda']['atributo']!=NULL and $this->request->data['Busqueda']['valor']!=NULL)
			{	
				$opciones=array('Programa.'.$this->request->data['Busqueda']['atributo'].' LIKE' => '%'.$this->request->data['Busqueda']['valor'].'%','Programa.facultad_id'=>$this->request->data['Busqueda']['facultad_id']);
				$programas = $this->paginate('Programa',$opciones);
				if (empty($programas)) 
				{
					$this->set('encontrado',0);
				}
			}
			else
			{	
				$opciones=array('Programa.facultad_id'=>$this->request->data['Busqueda']['facultad_id']);
    			$programas = $this->paginate('Programa',$opciones);		
    		}
    		$busqueda=array();
    		$busqueda[0]['atributo']=$this->request->data['Busqueda']['atributo'];
    		$busqueda[0]['valor']=$this->request->data['Busqueda']['valor'];
    		$busqueda[0]['facultad_id']=$this->request->data['Busqueda']['facultad_id'];
    		$this->set('busqueda',$busqueda);
		}
		else
		{
			$opciones=array('Programa.facultad_id'=>$facultad_id);
			$programas = $this->paginate('Programa',$opciones);	
		}
		$this->set('programas',$programas);
		if($this->request->is('ajax'))    	
		{
			$this->render('/facultades/programas_asociados');
		}
	}

	public function view($id = null)
	{
		if (!$this->Facultad->exists($id))
		{
			throw new NotFoundException(__('Facultad invalida'));
		}

		$options = array('conditions' => array('Facultad.' . $this->Facultad->primaryKey => $id));
		$facultad=$this->Facultad->find('first', $options);
		$options = array('conditions' => array('Programa.facultad_id' => $facultad['Facultad']['id']));
		$facultad['Facultad']['programas']=$this->Programa->find('count', $options);
		$this->set('facultad',$facultad);
	}

	public function bienvenido()
	{

	}
}
