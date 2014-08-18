<?php
App::uses('AppController', 'Controller');

class ProyectosController extends AppController {
var $components = array("RequestHandler");
var $uses = array(
	'Proyecto',
	'Area',
	'Detalleentrega',
	'Documento',
	'Entrega',
	'Facultad',
	'Linea',
	'Persona',
	'PersonasProyecto',
	'Programa',
	'Rol'
	);
	
	public function getSesionPersona()
	{
		$usuario=$this->Session->read("Usuario");
		return $usuario['Persona'];
	}

	public function add() {
		//Metodo encargado de registrar proyectos
		//APROBADO 14-08-2014 CONTROLADOR
		//APROBADO 14-08-2014 VISTA
		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];

		if ($this->request->is('post')) 
		{
					$this->Proyecto->create();
					if ($this->Proyecto->save($this->request->data)) {
						$this->Session->setFlash(__('El proyecto ha sido registrado exitosamente'));
						$this->redirect(array('action' => 'editar_integrantes/'.$this->Proyecto->id));
					} else {
						$this->Session->setFlash(__('El proyecto no ha sido registrado'));
					}
		}

		if($usuario['nivel_id']==1)
		{
			//Administrados institucional
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
			foreach ($areas as $key => $value) 
			{
				$area=$key;
				break;
			}
			$opciones = array('conditions' => array('Linea.area_id'=> $area));
			$lineas = $this->Proyecto->Linea->find('list',$opciones);

		}else if($usuario['nivel_id']==2)
		{

			//Adminsitrador facultad
			$id_facultad=$usuario['Persona']['facultad_id'];
			$opciones = array('conditions' => array('Facultad.id'=> $id_facultad));
			//Consultaremos listas
			$facultades = $this->Facultad->find('list',$opciones);

			$opciones = array('conditions' => array('Programa.facultad_id'=> $id_facultad));
			$programas = $this->Programa->find('list',$opciones);
			foreach ($programas as $key => $value) 
			{
				$programa=$key;
				break;
			}
			$opciones = array('conditions' => array('Area.programa_id'=> $programa));
			$areas = $this->Proyecto->Area->find('list',$opciones);
			foreach ($areas as $key => $value) 
			{
				$area=$key;
				break;
			}
			$opciones = array('conditions' => array('Linea.area_id'=> $area));
			$lineas = $this->Proyecto->Linea->find('list',$opciones);

		}else if($usuario['nivel_id']==3)
		{
			//Adminsitrador programa
			$id_facultad=$usuario['Persona']['facultad_id'];
			$id_programa=$usuario['Persona']['programa_id'];
			$opciones = array('conditions' => array('Facultad.id'=> $id_facultad));
			//Consultaremos listas
			$facultades = $this->Facultad->find('list',$opciones);

			$opciones = array('conditions' => array('Programa.id'=> $id_programa));
			$programas = $this->Programa->find('list',$opciones);
			foreach ($programas as $key => $value) 
			{
				$programa=$key;
				break;
			}
			$opciones = array('conditions' => array('Area.programa_id'=> $programa));
			$areas = $this->Proyecto->Area->find('list',$opciones);
			foreach ($areas as $key => $value) 
			{
				$area=$key;
				break;
			}
			$opciones = array('conditions' => array('Linea.area_id'=> $area));
			$lineas = $this->Proyecto->Linea->find('list',$opciones);

		}

		$this->set(compact('facultades','programas','areas','lineas'));

	}

	public function index() 
	{
		//APROBADO 13-08-2014 Controlador
		//APROBADO 14-08-2014 Vista

		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];

		if($usuario['nivel_id']==1)
		{
			//Administrados institucional

		}else if($usuario['nivel_id']==2)
		{
			$id_facultad=$usuario['Persona']['facultad_id'];
			//Adminsitrador facultad
			//Encontraremos en los que mi sessión se desempeña como jurado
			$this->paginate = array(
				'Proyecto' => array(
					'limit' => 10000,
					'conditions' => 
			            array(
			                'Programa.facultad_id'=>$id_facultad,
			            	),'recursive'=>1
				)
				
			);

		}else if($usuario['nivel_id']==3)
		{
			//Adminsitrador programa
			$id_programa=$usuario['Persona']['programa_id'];
			//Encontraremos en los que mi sessión se desempeña como jurado
			$this->paginate = array(
				'Proyecto' => array(
					'limit' => 10000,
					'conditions' => 
			            array(
			                'Programa.id'=>$id_programa,
			            	),'recursive'=>1
				)
				
			);

		}else if($usuario['nivel_id']==4)
		{

			//Docente
			$id_programa=$usuario['Persona']['programa_id'];

			$this->paginate = array(
				'Proyecto' => array(
					'limit' => 10000,
					'conditions' => 
			            array(
			                'Programa.id'=>$id_programa,
			            	),'recursive'=>1
				)
				
			);

		}else if($usuario['nivel_id']==5)
		{
			
			
			$id_programa=$usuario['Persona']['programa_id'];
			//Econtraremos los proyectos en los que actuo de alguna manera

			$opciones=array(
            'table' => 'personas_proyectos',
            'alias' => 'PersonasProyecto',
            'type' => 'left',
            'conditions' => 
            array(
                'PersonasProyecto.proyecto_id = Proyecto.id'
            	)
	    	);
			//Encontraremos en los que mi sessión se desempeña como jurado
			$this->paginate = array(
				'Proyecto' => array(
					'limit' => 10000,
					'joins' => array($opciones),
					'conditions' => 
			            array(
			                'PersonasProyecto.persona_id'=>$id_persona,
			                'PersonasProyecto.rol_id'=>3
			            	)
				)
			);

		}

		$proyectos = $this->paginate('Proyecto');
		$this->set('proyectos', $this->paginate());

		
	}

	public function asesor() {
		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];
		$this->Proyecto->recursive = 1;
		//mEJORES CONSULTAS, OINS EN PAGINACIÓN
		$opciones=array(
            'table' => 'personas_proyectos',
            'alias' => 'PersonasProyecto',
            'type' => 'left',
            'conditions' => 
            array(
                'PersonasProyecto.proyecto_id = Proyecto.id'
            	)
    	);
		//Encontraremos en los que mi sessión se desempeña como jurado
		$this->paginate = array(
			'Proyecto' => array(
				'limit' => 10000,
				'joins' => array($opciones),
				'conditions' => 
		            array(
		                'PersonasProyecto.persona_id'=>$id_persona,
		                'PersonasProyecto.rol_id'=>2
		            	)
			)
		);
		$proyectos = $this->paginate('Proyecto');
		$this->set('proyectos',$proyectos);
	}

	public function Jurado() {
		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];
		$this->Proyecto->recursive = 1;
		//mEJORES CONSULTAS, OINS EN PAGINACIÓN
		$opciones=array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonasProyecto',
		            'type' => 'left',
		            'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id = Proyecto.id'
		            	)
	        	);
		//Encontraremos en los que mi sessión se desempeña como jurado
		$this->paginate = array(
			'Proyecto' => array(
				'limit' => 10000,
				'joins' => array($opciones),
				'conditions' => 
		            array(
		                'PersonasProyecto.persona_id'=>$id_persona,
		                'PersonasProyecto.rol_id'=>1
		            	)
			)
		);
		$proyectos = $this->paginate('Proyecto');
		$this->set('proyectos',$proyectos);
	}

	public function documentos($id = null) 
	{
		//Aqui se muestran los documentos subidos y dependiendo su estado las entregas de los mismos
		//$this->autoRender = false;
		if (!$this->Proyecto->exists($id)) {
			throw new NotFoundException(__('Invalid proyecto'));
		}
		$opciones = array(
			'joins' => array(
		        array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'left',
		            'conditions' => 
		            array(
		                'Documento.estandar_id = Estandar.id'
		            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'Tiposestandar',
		            'type' => 'inner',
		            'conditions' => 
		            array(
		                'Estandar.tiposestandar_id = Tiposestandar.id'
		            	)
	        	)		
    		),
			'fields'=>array('Documento.*','Tiposestandar.*'),
			'conditions' => 
		            array(
		                "Documento.proyecto_id = $id"
		            	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>-1,		
	   	);
		$documentos=$this->Documento->find('all',$opciones);
		$opciones = array(
	        'fields'=>array('Entrega.*'),
           	'order' => array('Entrega.fecha_entrega desc'),
           	'recursive'=>-1,		
	   	);
		$entregas=$this->Entrega->find('all',$opciones);
		$opciones = array(
			'joins' => array(
		        array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonasProyecto',
		            'type' => 'left',
		            'conditions' => 
		            array(
		                'Detalleentrega.personas_proyecto_id = PersonasProyecto.id'
		            	)
	        	),
	        	array(
		            'table' => 'personas',
		            'alias' => 'Persona',
		            'type' => 'left',
		            'conditions' => 
		            array(
		                'PersonasProyecto.persona_id = Persona.id'
		            	)
	        	)		
    		),
	        'fields'=>array('Detalleentrega.*','Persona.*'),
           	'order' => array('Detalleentrega.id asc'),
           	'recursive'=>-1,		
	   	);
		$detalleEntregas=$this->Detalleentrega->find('all',$opciones);
		$indiceDocumento=0;
		foreach ($documentos as $documento) 
		{
			
			$indiceEntrega=0;
			foreach ($entregas as $entrega) 
			{
				if($documento['Documento']['id']==$entrega['Entrega']['documento_id'])
				{
					$documentos[$indiceDocumento]['Documento']['Entregas'][$indiceEntrega]=$entrega['Entrega'];
					$indiceDetalleEntrega=0;
					foreach ($detalleEntregas as $detalleEntrega) 
					{	
						if($entrega['Entrega']['id']==$detalleEntrega['Detalleentrega']['entrega_id'])
						{
							$documentos[$indiceDocumento]['Documento']['Entregas'][$indiceEntrega]['Detalleentregas'][$indiceDetalleEntrega]=$detalleEntrega['Detalleentrega'];
							$documentos[$indiceDocumento]['Documento']['Entregas'][$indiceEntrega]['Detalleentregas'][$indiceDetalleEntrega]['persona']=$detalleEntrega['Persona']['nombre']." ".$detalleEntrega['Persona']['apellido'];
							++$indiceDetalleEntrega;
						}
					}
					++$indiceEntrega;
				}
			}
			++$indiceDocumento;
		}
		$this->set('documentos', $documentos);
		$options = array('conditions' => array('Proyecto.' . $this->Proyecto->primaryKey => $id));
		$this->set('proyecto', $this->Proyecto->find('first', $options));
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
		$roles=$this->Rol->find('list', $opciones);
		$this->set('roles', $roles);
	}


	public function documentosJurado($id = null) 
	{
		$persona=$this->requestAction('Proyectos/getSesionPersona');
		print_r($persona);
		//Aqui se muestran los documentos subidos y dependiendo su estado las entregas de los mismos
		//$this->autoRender = false;
		if (!$this->Proyecto->exists($id)) {
			throw new NotFoundException(__('No se ha encontrado del proyecto'));
		}
		//Opciones para incluir el estandar y el tipo de estandar de los documentos amostrar
		$opciones = array(
			'joins' => array(
		        array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'left',
		            'conditions' => 
		            array(
		                'Documento.estandar_id = Estandar.id'
		            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'Tiposestandar',
		            'type' => 'inner',
		            'conditions' => 
		            array(
		                'Estandar.tiposestandar_id = Tiposestandar.id'
		            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'inner',
		            'conditions' => 
		            array(
		                'Entrega.documento_id = Documento.id'
		            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'Detalleentrega',
		            'type' => 'inner',
		            'conditions' => 
		            array(
		                'Detalleentrega.entrega_id = Entrega.id'
		            	)
	        	),
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonasProyecto',
		            'type' => 'left',
		            'conditions' => 
		            array(
		                'Detalleentrega.personas_proyecto_id = PersonasProyecto.id'
		            	)
	        	)
    		),
			'fields'=>array('Documento.*','Tiposestandar.*'),
			'conditions' => 
		            array(
		                "Documento.proyecto_id = $id",
		                "PersonasProyecto.persona_id"=>$persona['id']
		            	),
           	'order' => array('Documento.fecha_guardado asc'),
           	'recursive'=>-1,		
	   	);



		$documentos=$this->Documento->find('all',$opciones);
		$opciones = array(
	        'fields'=>array('Entrega.*'),
           	'order' => array('Entrega.fecha_entrega asc'),
           	'recursive'=>-1,		
	   	);
		$entregas=$this->Entrega->find('all',$opciones);
		$opciones = array(
			'joins' => array(
		        array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonasProyecto',
		            'type' => 'left',
		            'conditions' => 
		            array(
		                'Detalleentrega.personas_proyecto_id = PersonasProyecto.id'
		            	)
	        	),
	        	array(
		            'table' => 'personas',
		            'alias' => 'Persona',
		            'type' => 'left',
		            'conditions' => 
		            array(
		                'PersonasProyecto.persona_id = Persona.id'
		            	)
	        	)		
    		),
	        'fields'=>array('Detalleentrega.*','Persona.*'),
	        'conditions' => 
		            array(
		                "PersonasProyecto.persona_id"=>$persona['id']
		            	),
           	'order' => array('Detalleentrega.id asc'),
           	'recursive'=>-1,		
	   	);
		$detalleEntregas=$this->Detalleentrega->find('all',$opciones);
		$indiceDocumento=0;
		foreach ($documentos as $documento) 
		{
			
			$indiceEntrega=0;
			foreach ($entregas as $entrega) 
			{
				if($documento['Documento']['id']==$entrega['Entrega']['documento_id'])
				{
					$documentos[$indiceDocumento]['Documento']['Entregas'][$indiceEntrega]=$entrega['Entrega'];
					$indiceDetalleEntrega=0;
					foreach ($detalleEntregas as $detalleEntrega) 
					{	
						if($entrega['Entrega']['id']==$detalleEntrega['Detalleentrega']['entrega_id'])
						{
							$documentos[$indiceDocumento]['Documento']['Entregas'][$indiceEntrega]['Detalleentregas'][$indiceDetalleEntrega]=$detalleEntrega['Detalleentrega'];
							$documentos[$indiceDocumento]['Documento']['Entregas'][$indiceEntrega]['Detalleentregas'][$indiceDetalleEntrega]['persona']=$detalleEntrega['Persona']['nombre']." ".$detalleEntrega['Persona']['apellido'];
							++$indiceDetalleEntrega;
						}
					}
					++$indiceEntrega;
				}
			}
			++$indiceDocumento;
		}
		$this->set('documentos', $documentos);
		$options = array('conditions' => array('Proyecto.' . $this->Proyecto->primaryKey => $id));
		$this->set('proyecto', $this->Proyecto->find('first', $options));
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
		$roles=$this->Rol->find('list', $opciones);
		$this->set('roles', $roles);
	}

	public function detallar_general($id = null) 
	{
		if (!$this->Proyecto->exists($id)) 
		{
			throw new NotFoundException(__('Invalid proyecto'));
		}else
		{
			$options = array(
				'joins' => array(
			        array(
			            'table' => 'programas',
			            'alias' => 'Programa',
			            'type' => 'left',
			            'conditions' => 
			            array(
			                'Proyecto.programa = Programa.id'
			            	)
			        	),
			        array(
			            'table' => 'facultades',
			            'alias' => 'Facultad',
			            'type' => 'inner',
			            'conditions' => 
			            array(
			                'Programa.facultad_id = Facultad.id'
			            	)
			        	),
			        array(
			            'table' => 'areas',
			            'alias' => 'Area',
			            'type' => 'left',
			            'conditions' => 
			            array(
			                'Proyecto.area_id = Area.id'
			            	)
			        	),
			        array(
			            'table' => 'lineas',
			            'alias' => 'Linea',
			            'type' => 'left',
			            'conditions' => 
			            array(
			                'Proyecto.linea_id = Linea.id'
			            	)
			        	)
			        ),
				'conditions' => array(
					'Proyecto.id' => $id
				),
				'fields'=>array('Proyecto.*','Programa.*','Facultad.*','Area.*','Linea.*'),
				'recursive'=>-1,
				'limit'=>1
			);
			$this->request->data = $this->Proyecto->find('first', $options);
			$this->set('proyecto',$this->request->data);
		}

	}

	public function editar_general($id = null) 
	{
		if (!$this->Proyecto->exists($id)) 
		{
			throw new NotFoundException(__('Invalid proyecto'));
		}
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			if ($this->Proyecto->save($this->request->data)) 
			{
				$this->Session->setFlash(__('The proyecto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else 
			{
				$this->Session->setFlash(__('The proyecto could not be saved. Please, try again.'));
			}
		} 
		else 
		{
			$usuario=$this->Session->read("Usuario");
			$id_persona=$usuario['Persona']['id'];

			$options = array('conditions' => array('Proyecto.' . $this->Proyecto->primaryKey => $id));
			$this->request->data = $this->Proyecto->find('first', $options);
			$this->set('proyecto',$this->request->data);

			if ($this->request->is('post')) 
			{
						$this->Proyecto->create();
						if ($this->Proyecto->save($this->request->data)) {
							$this->Session->setFlash(__('El proyecto ha sido registrado exitosamente'));
							$this->redirect(array('action' => 'editar_integrantes/'.$this->Proyecto->id));
						} else {
							$this->Session->setFlash(__('El proyecto no ha sido registrado'));
						}
			}

			if($usuario['nivel_id']==1)
			{
				//Administrados institucional
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
				foreach ($areas as $key => $value) 
				{
					$area=$key;
					break;
				}
				$opciones = array('conditions' => array('Linea.area_id'=> $area));
				$lineas = $this->Proyecto->Linea->find('list',$opciones);

			}else if($usuario['nivel_id']==2)
			{

				//Adminsitrador facultad
				$id_facultad=$usuario['Persona']['facultad_id'];
				$opciones = array('conditions' => array('Facultad.id'=> $id_facultad));
				//Consultaremos listas
				$facultades = $this->Facultad->find('list',$opciones);

				$opciones = array('conditions' => array('Programa.facultad_id'=> $id_facultad));
				$programas = $this->Programa->find('list',$opciones);
				foreach ($programas as $key => $value) 
				{
					$programa=$key;
					break;
				}
				$opciones = array('conditions' => array('Area.programa_id'=> $programa));
				$areas = $this->Proyecto->Area->find('list',$opciones);
				foreach ($areas as $key => $value) 
				{
					$area=$key;
					break;
				}
				$opciones = array('conditions' => array('Linea.area_id'=> $area));
				$lineas = $this->Proyecto->Linea->find('list',$opciones);

			}else if($usuario['nivel_id']==3)
			{
				//Adminsitrador programa
				$id_facultad=$usuario['Persona']['facultad_id'];
				$id_programa=$usuario['Persona']['programa_id'];
				$opciones = array('conditions' => array('Facultad.id'=> $id_facultad));
				//Consultaremos listas
				$facultades = $this->Facultad->find('list',$opciones);

				$opciones = array('conditions' => array('Programa.id'=> $id_programa));
				$programas = $this->Programa->find('list',$opciones);
				foreach ($programas as $key => $value) 
				{
					$programa=$key;
					break;
				}
				$opciones = array('conditions' => array('Area.programa_id'=> $programa));
				$areas = $this->Proyecto->Area->find('list',$opciones);
				foreach ($areas as $key => $value) 
				{
					$area=$key;
					break;
				}
				$opciones = array('conditions' => array('Linea.area_id'=> $area));
				$lineas = $this->Proyecto->Linea->find('list',$opciones);

			}




			$this->set(compact('facultades','programas','areas','lineas'));
		}

	}

	public function detallar_integrantes($id = null) 
	{
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
				            'type' => 'left',
				            'conditions' => 
				            array(
				                'Programa.id = Persona.programa_id'
				            	)
				        	),
				        array(
				            'table' => 'facultades',
				            'alias' => 'Facultad',
				            'type' => 'left',
				            'conditions' => 
				            array(
				                'Facultad.id = Persona.facultad_id'
				            	)
				        	)
		    		),
			    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','Persona.tiposusuario_id','PersonasProyecto.id','PersonasProyecto.rol_id','Programa.nombre','Facultad.nombre'),
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


	public function editar_integrantes($id = null) 
	{
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
				            'type' => 'left',
				            'conditions' => 
				            array(
				                'Programa.id = Persona.programa_id'
				            	)
				        	),
				        array(
				            'table' => 'facultades',
				            'alias' => 'Facultad',
				            'type' => 'left',
				            'conditions' => 
				            array(
				                'Facultad.id = Persona.facultad_id'
				            	)
				        	)
		    		),
			    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','Persona.tiposusuario_id','PersonasProyecto.id','PersonasProyecto.rol_id','Programa.nombre','Facultad.nombre'),
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

	public function lista_interventores() {
		$this->PersonasProyecto->recursive = -1;
		$proyecto=$this->request->data['Busqueda']['proyecto_id'];
		$valor=$this->request->data['Busqueda']['valor'];
		$atributo=$this->request->data['Busqueda']['atributo'];
		$ocupados=$this->PersonasProyecto->find('all', array('fields'=>array('PersonasProyecto.persona_id as id'),'conditions' => array('PersonasProyecto.proyecto_id'=>1)));
		$subqueryOptions = array('fields' => array('PersonasProyecto.persona_id as id'), 'conditions' => array('PersonasProyecto.proyecto_id'=>1));
		$subquery ="(SELECT  `PersonasProyecto`.`persona_id` AS  `id` FROM  `software`.`personas_proyectos` AS  `PersonasProyecto` WHERE  `PersonasProyecto`.`proyecto_id` =1)";	
			$this->Persona->recursive = -1;
			$opciones = array(
				'joins' => array(
				        array(
				            'table' => 'programas',
				            'alias' => 'Programa',
				            'type' => 'LEFT',
				            'conditions' => 
				            array(
				                'Programa.id = Persona.programa_id'
				            	)
				        	),
				         array(
				            'table' => 'facultades',
				            'alias' => 'Facultad',
				            'type' => 'LEFT',
				            'conditions' => 
				            array(
				                'Facultad.id = Persona.facultad_id'
				            	)
				        	)

		    		),
			    	'fields' => array('Persona.id','Persona.identificacion','Persona.nombre','Persona.apellido','Persona.tiposusuario_id','Programa.nombre','Facultad.nombre'),
			    	'conditions' => array(
			    		'Persona.id NOT IN '. $subquery,
			    		'Persona.'.$atributo.' LIKE' => '%'.$valor.'%'				  
					  ),
		           	'order' => array('Persona.id asc'),
		           	'limit' => 20		
		   	);
		   	$this->request->data['Interventores'] = $this->Persona->find('all', $opciones);
		   	
		   	$this->set('Interventores', $this->request->data['Interventores']);
			$this->set('Proyecto',$proyecto);
		   	//Aqui quedaron lo que no estan en el proyecto ahora dele...
			$this->render('/Proyectos/lista_interventores');
		}
}
