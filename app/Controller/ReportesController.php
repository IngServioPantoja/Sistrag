<?php
App::uses('AppController', 'Controller');

class ReportesController extends AppController {
var $components = array("RequestHandler");
var $helpers = array('Form', 'Html', 'Js','Paginator');
var $uses = array('Facultad','Programa','Persona','TipoUsuario','TiposEstandar','PersonasProyecto');
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

	public function investigaciones() 
	{	
		//Paginación con Joins
		$join=array(
            'table' => 'facultades',
            'alias' => 'Facutad',
            'type' => 'inner',
            'conditions' => 
	            array(
	                'Facultad.id = Programa.facultad_id'
            	)
    	);
		$this->paginate = array(
			'Persona' => array(
				'limit' => 10000,
				'joins' => array($join),
				'conditions' => 
		            array(
		                'TipoUsuario.id !='=>5
	            	),
	            'fields'=>
	            	array(
	            		'Programa.id','Programa.nombre','Facultad.nombre'
	            	),
	            'recursive'=>-1
			)
		);
		$programas = $this->paginate('Programa');
		$this->set('programas',$programas);
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
		                'TipoUsuario.id !='=>5
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
		$options = array('conditions' => array('Persona.id'=> $this->request->data['Reporte']['id']));
		$persona_id=$this->request->data['Reporte']['id'];
		$persona=$this->Persona->find('first', $options);	
		$this->set('persona',$persona);
		
		$this->response->type('json');
	    $roles = json_encode(
	    	array(
	    		"Jurado",
	    		"Asesor"
	    	)
	    );
		$this->set('roles',$roles);
		//Obteniendo proyectos como Jurado
        $opcionesJurado = 
		array(
			'conditions'=>array('PersonasProyecto.persona_id'=>$persona_id,'PersonasProyecto.rol_id'=>1)
		);
		$cantidadJurado=$this->PersonasProyecto->find('count', $opcionesJurado );

		$opcionesAsesor = 
		array(
			'conditions'=>array('PersonasProyecto.persona_id'=>$persona_id,'PersonasProyecto.rol_id'=>2)
		);
		$cantidadAsesor=$this->PersonasProyecto->find('count', $opcionesAsesor);
		$reporte=array();
		$reporte[0]=$cantidadJurado;
		$reporte[1]=$cantidadAsesor;
		$reporte=json_encode($reporte);
		$this->set('reporte',$reporte);
	}

	public function detalleReportePrograma()
	{
		$options = array('conditions' => array('Persona.id'=> $this->request->data['Reporte']['id']));
		$persona_id=$this->request->data['Reporte']['id'];
		$persona=$this->Persona->find('first', $options);	
		$this->set('persona',$persona);
		
		$this->response->type('json');
	    $roles = json_encode(
	    	array(
	    		"Jurado",
	    		"Asesor"
	    	)
	    );
		$this->set('roles',$roles);
		//Obteniendo proyectos como Jurado
        $opcionesJurado = 
		array(
			'conditions'=>array('PersonasProyecto.persona_id'=>$persona_id,'PersonasProyecto.rol_id'=>1)
		);
		$cantidadJurado=$this->PersonasProyecto->find('count', $opcionesJurado );

		$opcionesAsesor = 
		array(
			'conditions'=>array('PersonasProyecto.persona_id'=>$persona_id,'PersonasProyecto.rol_id'=>2)
		);
		$cantidadAsesor=$this->PersonasProyecto->find('count', $opcionesAsesor);
		$reporte=array();
		$reporte[0]=$cantidadJurado;
		$reporte[1]=$cantidadAsesor;
		$reporte=json_encode($reporte);
		$this->set('reporte',$reporte);
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
//AHORA SI A SACAR EL RESTP DE REPORTES Y REVACIA LA VUELTA
		
	}

	public function index()
	{

	}
}
