<?php
App::uses('AppController', 'Controller');
/**
 * Detalleentregas Controller
 *
 * @property Detalleentrega $Detalleentrega
 * @property PaginatorComponent $Paginator
 */
class DetalleentregasController extends AppController {

var $helpers = array('Paginator');
var $uses = array('Detalleentrega','Entrega','Facultad','Programa','Persona','TipoUsuario','Tiposestandar','PersonasProyecto','Area','Linea','Proyecto','PersonaProyecto','Documento');

	public function index() {

		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];
		$join=array(
            'table' => 'proyectos',
            'alias' => 'Proyecto',
            'type' => 'inner',
            'conditions' => 
	            array(
	                'Proyecto.id = PersonasProyecto.proyecto_id'
        	)
    	);
    	$join2=array(
            'table' => 'personas_proyectos',
            'alias' => 'PersonasProyecto',
            'type' => 'inner',
            'conditions' => 
	            array(
	                'PersonasProyecto.id = Detalleentrega.personas_proyecto_id'
        	)
	    );
    	$join3=array(
            'table' => 'entregas',
            'alias' => 'Entrega',
            'type' => 'inner',
            'conditions' => 
	            array(
	                'Entrega.id = Detalleentrega.entrega_id'
        	)
	    );
    	$join4=array(
            'table' => 'estados',
            'alias' => 'Estado',
            'type' => 'inner',
            'conditions' => 
	            array(
	                'Estado.id = Detalleentrega.estado_id'
        	)
	    );
		//Encontraremos en los que mi sessión se desempeña como jurado
		$this->paginate = array(
			'Detalleentrega' => array(
				'limit' => 999999999,
				'joins' => array($join3,$join2,$join,$join4),
				'fields'=>array(
					'Detalleentrega.*','Entrega.*','Proyecto.*','Estado.*'
				),
	            'order'=>
	            	array(
	            		'Entrega.fecha' =>'DESC'
	            	),
	            'conditions'=>array(
	            	'PersonasProyecto.persona_id'=>$id_persona,
	            	'Detalleentrega.estado_id!=3'
	            ),
	            'recursive' =>-1
			)
		);
		//print_r($this->Paginator->paginate());
		$detalleentrega = $this->paginate('Detalleentrega');
		$this->set('detalleentregas', $detalleentrega);

	}

	public function view($id = null) {
		if (!$this->Detalleentrega->exists($id)) {
			throw new NotFoundException(__('Invalid detalleentrega'));
		}
		$options = array('conditions' => array('Detalleentrega.' . $this->Detalleentrega->primaryKey => $id));
		$this->set('detalleentrega', $this->Detalleentrega->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Detalleentrega->create();
			if ($this->Detalleentrega->save($this->request->data)) {
				$this->Session->setFlash(__('The detalleentrega has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The detalleentrega could not be saved. Please, try again.'));
			}
		}
		$entregas = $this->Detalleentrega->Entrega->find('list');
		$personasProyectos = $this->Detalleentrega->PersonasProyecto->find('list');
		$estados = $this->Detalleentrega->Estado->find('list');
		$this->set(compact('entregas', 'personasProyectos', 'estados'));
	}

	public function edit($id = null) {

		if ($this->request->is(array('post', 'put'))) {
			print_r($this->request->data);
			if ($this->Detalleentrega->save($this->request->data)) {
				//$this->Session->setFlash(__('Se ha modificado el detalle de la entrega con exito'));

				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se ha podido actualizar el detalle de la entrega'));
			}
		} else {
			$options = array('conditions' => array('Detalleentrega.' . $this->Detalleentrega->primaryKey => $id));
			$this->request->data = $this->Detalleentrega->find('first', $options);
		}
		$entregas = $this->Detalleentrega->Entrega->find('list');
		$personasProyectos = $this->Detalleentrega->PersonasProyecto->find('list');
		$estados = $this->Detalleentrega->Estado->find('list');
		$this->set(compact('entregas', 'personasProyectos', 'estados'));
	}

	public function emitir_concepto() {
		$this->autoRender = false;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Detalleentrega->save($this->request->data)) {
				$opcionesDetalleEntrega=array(
					'conditions'=>array(
							'Detalleentrega.id'=>$this->request->data['Detalleentrega']['id']
						),
					'recursive'=>0
				);
				$detallesEntrega=$this->Detalleentrega->find('all',$opcionesDetalleEntrega);
				print_r($detallesEntrega);
				echo "</BR></BR>";
				$opcionesDocumentoTipoEstandar=array(
					'joins' => array(
			        	array(
				            'table' => 'estandares',
				            'alias' => 'Estandar',
				            'type' => 'INNER',
				            'conditions' => 
				            array(
				                'Tiposestandar.id = Estandar.tiposestandar_id'
			            	)
			            ),
			            array(
				            'table' => 'documentos',
				            'alias' => 'Documento',
				            'type' => 'INNER',
				            'conditions' => 
					            array(
					                'Estandar.id = Documento.estandar_id'
				            	)
				           )
			  	    ),
					'fields'=>array(
						'Tiposestandar.*'
					),
					'conditions'=>array(
							'Documento.id'=>$detallesEntrega[0]['Entrega']['documento_id']
						),
					'recursive'=>-1
				);
				$documentoTipoEstandar=$this->Tiposestandar->find('first',$opcionesDocumentoTipoEstandar);

				print_r($documentoTipoEstandar);
				$opcionesDetalleEntregas=array(
					'conditions'=>array(
							'Detalleentrega.entrega_id'=>$detallesEntrega[0]['Detalleentrega']['entrega_id']
						),
					'recursive'=>-1
				);
				$lstDetalleEntregas=$this->Detalleentrega->find('all',$opcionesDetalleEntregas);
				$banderaAprobado=true;
				foreach ($lstDetalleEntregas as $detalleEntregaItem) {
					if($detalleEntregaItem['Detalleentrega']['parametro_veredicto_id']!=1){
						$banderaAprobado=false;
					}
				}
				if($banderaAprobado)
				{
					$opcionesProyecto=array(
					'conditions'=>array(
							'PersonasProyecto.id'=>$detallesEntrega[0]['Detalleentrega']['personas_proyecto_id']
						),
					'recursive'=>-1
					);
					$personaProyecto=$this->PersonasProyecto->find('first',$opcionesProyecto);
					$opcionesProyecto=array(
					'conditions'=>array(
							'Proyecto.id'=>$personaProyecto['PersonasProyecto']['proyecto_id']
						),
					'recursive'=>-1
					);
					$proyectoActualizar=$this->Proyecto->find('first',$opcionesProyecto);
					$opcionesTipoEstandar=array(
					'conditions'=>array(
							'Tiposestandar.programa_id'=>$proyectoActualizar['Proyecto']['programa']
						),
					'order'=>array('Tiposestandar.orden desc'),
					'recursive'=>-1
					);
					$lstTiposEstandar=$this->Tiposestandar->find('all',$opcionesTipoEstandar);
					$estadoMaximoProyecto=$lstTiposEstandar[0]['Tiposestandar']['id'];
					if($documentoTipoEstandar['Tiposestandar']['id']+1<=$estadoMaximoProyecto)
					{
						$proyectoActualizar['Proyecto']['estado_id']=$documentoTipoEstandar['Tiposestandar']['id']+1;
						if($this->Proyecto->save($proyectoActualizar))
						{
							echo "El proyecto ha subido un estado";
						}
					}
				}


			$opciones = array(
				'joins' => array(
		        	array(
			            'table' => 'entregas',
			            'alias' => 'Entrega',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Entrega.id = Detalleentrega.entrega_id'
		            	)
		        	),array(
			            'table' => 'documentos',
			            'alias' => 'Documento',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Documento.id = Entrega.documento_id'
		            	)
		        	),
		        	array(
			            'table' => 'proyectos',
			            'alias' => 'Proyecto',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Proyecto.id = Documento.proyecto_id'
		            	)
		        	),
		        	array(
			            'table' => 'personas_proyectos',
			            'alias' => 'PersonaProyecto',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Proyecto.id = PersonaProyecto.proyecto_id'
		            	)
		        	)
		        ),
				'fields'=>array(
					'PersonaProyecto.*'
				),
		    	'conditions' => 
		            array(
		                'Detalleentrega.id' => $this->request->data['Detalleentrega']['id'],
		                'PersonaProyecto.rol_id'=>3
		           	),
	           	'recursive'=>-1
		   	);

			$personas = $this->Detalleentrega->find('all',$opciones);
			
			foreach ($personas as $persona) 
			{
				$this->Notificacion->create();
				$notificacion=array();
				$fecha = date_create();
				$fecha = date_format($fecha, 'Y-m-d H:i:s');
				$notificacion['Notificacion']['parametro_estado_id']=5;
				$notificacion['Notificacion']['fecha']=$fecha;
				$notificacion['Notificacion']['parametro_tipo_notificacion']=11;
				$notificacion['Notificacion']['url_action']='detalle_entrega';
				$notificacion['Notificacion']['url_controlador']='documentos';
				$notificacion['Notificacion']['url_valor']=$this->request->data['Detalleentrega']['id'];
				$notificacion['Notificacion']['persona_id']=$persona['PersonaProyecto']['persona_id'];
				if($this->Notificacion->save($notificacion)){

				}
			}
			$this->Session->setFlash(__('Concepto emitido exitosamente'));
			return $this->redirect(array('controller'=>'documentos','action' => 'detalle_entrega/'.$this->request->data['Detalleentrega']['id']));

			} else {
				$this->Session->setFlash(__('No se ha podido actualizar el detalle de la entrega'));
			}
		} else {
			$options = array('conditions' => array('Detalleentrega.' . $this->Detalleentrega->primaryKey => $id));
			$this->request->data = $this->Detalleentrega->find('first', $options);
		}
		$entregas = $this->Detalleentrega->Entrega->find('list');
		$personasProyectos = $this->Detalleentrega->PersonasProyecto->find('list');
		$estados = $this->Detalleentrega->Estado->find('list');
		$this->set(compact('entregas', 'personasProyectos', 'estados'));
	}

	public function delete($id = null) {
		$this->Detalleentrega->id = $id;
		if (!$this->Detalleentrega->exists()) {
			throw new NotFoundException(__('Invalid detalleentrega'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Detalleentrega->delete()) {
			$this->Session->setFlash(__('The detalleentrega has been deleted.'));
		} else {
			$this->Session->setFlash(__('The detalleentrega could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
