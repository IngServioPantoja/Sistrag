<?php
App::uses('AppController', 'Controller');
/**
 * Proyectos Controller
 *
 * @property Proyecto $Proyecto
 */
class ProyectosController extends AppController {
var $components = array("RequestHandler");
var $uses = array('Proyecto','Persona','Rol','PersonasProyecto','Linea','Area','Programa','Facultad');

	public function index() {
		$this->Proyecto->recursive = 0;
		$this->set('proyectos', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->Proyecto->exists($id)) {
			throw new NotFoundException(__('Invalid proyecto'));
		}
		$options = array('conditions' => array('Proyecto.' . $this->Proyecto->primaryKey => $id));
		$this->set('proyecto', $this->Proyecto->find('first', $options));
	}

	public function add() {
		
		if ($this->request->is('post')) {
			print_r($this->request->data);
					$this->Proyecto->create();
					if ($this->Proyecto->save($this->request->data)) {
						$this->Session->setFlash(__('The proyecto has been saved'));
						echo $this->Proyecto->id;
						$this->redirect(array('action' => 'editar_integrantes/'.$this->Proyecto->id));
					} else {
						$this->Session->setFlash(__('The proyecto could not be saved. Please, try again.'));
					}
		}
		$facultades = $this->Facultad->find('list');
		foreach ($facultades as $key => $value) 
		{
			$facultad=$key;
			break;
		}
		$opciones = array('conditions' => array('Programa.facultad_id'=> $facultad));
		$programas = $this->Programa->find('list',$opciones);
		foreach ($programas as $key => $value) 
		{
			$programa=$key;
			break;
		}
		$opciones = array('conditions' => array('Area.programa_id'=> $programa));
		$areas = $this->Proyecto->Area->find('list',$opciones);
		$lineas = $this->Proyecto->Linea->find('list');
		$this->set(compact('facultades','programas','areas','lineas'));

	}

	function lista_estudiantes() {
		print_r($this->request->data);
	    $this->set('estudiantes',
		    $this->paginate(
			    'Persona',
				    array(
				        'PersonasProyecto.proyecto_id'!=$this->request->data['Integrante']['proyecto_id']),
				        array(
					        'joins'=>array(
					            array('table'=>'personas_proyectos',
					                  'alias'=>'PersonasProyectos',
					                  'type'=>'left',
					                  'conditions'=>array('Persona.id=PersonasProyectos.persona_id'
					                  )
					            )
					        ),
			    		)
			    	
		  	)
		);
		//queda pendiente solo toca cnsulta rla spersonas que not in personasproyectos y ya..
	    $this->render('/proyectos/lista_estudiantes');

	}

	public function lista_areas() 
	{	
		if(isset($this->request->data['Proyecto']['programa']))
		{
			$programa=$this->request->data['Proyecto']['programa'];
		}else if(isset($this->request->data['programa']))
		{
			$programa=$this->request->data['programa'];
		}
		$opciones = array('conditions' => array('Area.programa_id'=> $programa));
		$select_areas = $this->Area->find('list',$opciones);
		$this->set('select_areas',$select_areas);
		$area=0;
		foreach ($select_areas as $key => $value) 
		{
			$area=$key;
			break;
		}
		$opciones = array('conditions' => array('Linea.area_id'=> $area));
		$select_lineas = $this->Linea->find('list',$opciones);
		$this->set('select_lineas',$select_lineas);
		$this->render('/Proyectos/lista_areas');
	}

	public function lista_lineas() 
	{	
		if(isset($this->request->data['Proyecto']['area_id']))
		{
			$area=$this->request->data['Proyecto']['area_id'];
		}else if(isset($this->request->data['area_id']))
		{
			$area=$this->request->data['area_id'];
		}
		$opciones = array('conditions' => array('Linea.area_id'=> $area));
		$select_lineas = $this->Linea->find('list',$opciones);
		$this->set('select_lineas',$select_lineas);
		$this->render('/proyectos/lista_lineas');
	}

	public function lista_programas() 
	{
		if(isset($this->request->data['Proyecto']['facultad']))
		{
			$facultad=$this->request->data['Proyecto']['facultad'];
		}else if(isset($this->request->data['facultad']))
		{
			$facultad=$this->request->data['facultad'];
		}
		$select_programas=$this->Programa->find('list', 
			array('conditions' => 
				array('facultad_id'=> $facultad
				)
			)
		);
		$this->set('select_programas',$select_programas);
		foreach ($select_programas as $key => $value) 
		{
			$programa=$key;
			break;
		}
		$opciones = array('conditions' => array('Area.programa_id'=> $programa));
		$select_areas = $this->Area->find('list',$opciones);
		$this->set('select_areas',$select_areas);
		$area=0;
		foreach ($select_areas as $key => $value) 
		{
			$area=$key;
			break;
		}
		$opciones = array('conditions' => array('Linea.area_id'=> $area));
		$select_lineas = $this->Linea->find('list',$opciones);
		$this->set('select_lineas',$select_lineas);
		$this->render('/Proyectos/lista_programas');
	}

	public function edit($id = null) {
		if (!$this->Proyecto->exists($id)) {
			throw new NotFoundException(__('Invalid proyecto'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Proyecto->save($this->request->data)) {
				$this->Session->setFlash(__('The proyecto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The proyecto could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Proyecto.' . $this->Proyecto->primaryKey => $id));
			$this->request->data = $this->Proyecto->find('first', $options);
		}
	}

	public function editar_integrantes($id = null) {
		if (!$this->Proyecto->exists($id)) {
			throw new NotFoundException(__('Invalid proyecto'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Proyecto->save($this->request->data)) {
				$this->Session->setFlash(__('The proyecto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The proyecto could not be saved. Please, try again.'));
			}
		} else {
			$this->Proyecto->recursive = -1;
			$options = array('conditions' => array('Proyecto.id' => $id));
			$this->request->data = $this->Proyecto->find('first', $options);
			$this->PersonasProyecto->recursive = -1;
			$opciones = array(
			    	'joins' => array(
				        array(
				            'table' => 'personas',
				            'alias' => 'Persona',
				            'type' => 'INNER',
				            'conditions' => 
				            array(
				                'Persona.id = PersonasProyecto.persona_id'
				            	)
				        	),
				        array(
				            'table' => 'programas',
				            'alias' => 'Programa',
				            'type' => 'INNER',
				            'conditions' => 
				            array(
				                'Programa.id = Persona.programa_id'
				            	)
				        	)
		    		),
			    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id','Programa.nombre'),
			    	'conditions' => 
			            array(
			                'PersonasProyecto.proyecto_id' => $id,
			           	),
		           	'order' => array('PersonasProyecto.rol_id asc'),		

		   	);
		   	$this->request->data['Integrantes'] = $this->PersonasProyecto->find('all', $opciones);
			$this->set('proyecto', $this->request->data);
		}
	}

	public function delete($id = null) {
		$this->Proyecto->id = $id;
		if (!$this->Proyecto->exists()) {
			throw new NotFoundException(__('Invalid proyecto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Proyecto->delete()) {
			$this->Session->setFlash(__('Proyecto deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Proyecto was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function lista_interventores() {
		$this->PersonasProyecto->recursive = -1;
		print_r($this->request->data);
		echo "--".$proyecto=$this->request->data['Busqueda']['proyecto_id'];
		$valor=$this->request->data['Busqueda']['valor'];
		$atributo=$this->request->data['Busqueda']['atributo'];
		$ocupados=$this->PersonasProyecto->find('all', array('fields'=>array('PersonasProyecto.persona_id as id'),'conditions' => array('PersonasProyecto.proyecto_id'=>1)));
		//print_r($ocupados);
		$subqueryOptions = array('fields' => array('PersonasProyecto.persona_id as id'), 'conditions' => array('PersonasProyecto.proyecto_id'=>1));
		echo $subquery ="(SELECT  `PersonasProyecto`.`persona_id` AS  `id` FROM  `software`.`personas_proyectos` AS  `PersonasProyecto` WHERE  `PersonasProyecto`.`proyecto_id` =1)";	
			//print_r($subquery);
			$this->Persona->recursive = -1;
			$opciones = array(
			    	'fields' => array('Perso2na.id','Persona.nombre','Persona.apellido'),
			    	'conditions' => array(
			    		'id NOT IN '. $subquery				  
					  ),
		           	'order' => array('Persona.id asc')		
		   	);
		   	$this->request->data['interventores'] = $this->Persona->find('all', $opciones);
		   	//print_r($this->request->data['interventores']);
		   	//Aqui quedaron lo que no estan en el proyecto ahora dele...
			$this->render('/Proyectos/lista_interventores');
		}
}
