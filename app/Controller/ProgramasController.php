<?php
App::uses('AppController', 'Controller');

class ProgramasController extends AppController {
var $components = array("RequestHandler");
var $uses = array('Programa','Facultad','Area','Linea');
var $usuario=array();
var $paginate =array('limit' => 10,);

	public function index($atributo=null,$valor=null) 
	{
		$this->Programa->recursive = 0;
		if(isset($this->request->data['Busqueda']))
		{ 
			if($this->request->data['Busqueda']['atributo']!=NULL and $this->request->data['Busqueda']['valor']!=NULL)
			{
				$opciones=array('Programa.'.$this->request->data['Busqueda']['atributo'].' LIKE' => '%'.$this->request->data['Busqueda']['valor'].'%');
				$programas = $this->paginate('Programa',$opciones);
				if (empty($programas)) 
				{
					$this->set('encontrado',0);
				}
			}
			else
			{
    			$programas = $this->paginate('Programa');		
    		}
    		$busqueda=array();
    		$busqueda[0]['atributo']=$this->request->data['Busqueda']['atributo'];
    		$busqueda[0]['valor']=$this->request->data['Busqueda']['valor'];
    		$this->set('busqueda',$busqueda);
		}
		else
		{	
			if(isset($atributo) and isset($valor))
			{
				$opciones=array('Programa.'.$atributo.' LIKE' => '%'.$valor.'%');
	    		$programas = $this->paginate('Programa',$opciones);
	    		$busqueda[0]['atributo']=$atributo;
    			$busqueda[0]['valor']=$valor;	
    			$this->set('busqueda',$busqueda);	
    		}
    		else
    		{
	    		$programas = $this->paginate('Programa');			
    		}
    	}
    	$p=0;
		$opciones = array(
			    	'fields' => 
			            array(
			                'Area.id','Area.programa_id'
			           	)
		   	);
		$areas = $this->Area->find('list',$opciones);
		$contador=0;
		foreach ($programas as $programa) {
			foreach ($areas as $id => $programa_id) {
				if($programa['Programa']['id']==$programa_id)
				{
					++$contador;	
				}
			}
			$programas[$p]['Programa']['areas'] = $contador;
			++$p;
			$contador=0;
		}
		$this->set('programas',$programas);
		if($this->request->is('ajax'))    	
		{

			$this->render('/programas/index');
		}	
	}

function lista_programas() {
	print_r($this->request->data);
	$select_entrada=$this->Programa->find('list', 
		array('conditions' => 
			array('facultad_id'=> $this->request->data['Item']['facultad']
			)
		)
	);
	$this->set(compact('select_entrada'));
	$this->render('/Programas/lista_programas');
}

	public function add() {
		if ($this->request->is('post')) {
			$this->Programa->create();
			if ($this->Programa->save($this->request->data)) {
				$this->Session->setFlash(__('El programa ha sido registrado exitosamente'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se ha podido guardar el programa intente de nuevo'));
			}
		}
		$facultades = $this->Programa->Facultad->find('list');
		$this->set(compact('facultades'));
	}

	public function delete($id = null) {
		$this->Programa->id = $id;
		if (!$this->Programa->exists()) {
			throw new NotFoundException(__('Programa invalido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Programa->delete()) {
			$this->Session->setFlash(__('Programa borrado exitosamente'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('El programa no se ha podido borrar intente de nuevo'));
			$this->redirect($this->referer());
	}

	public function edit($id = null) {
		global $usuario;
		$usuario=$this->Session->read("Usuario");
		if (!$this->Programa->exists($id)) {
			throw new NotFoundException(__('Invalid programa'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Programa->save($this->request->data)) {
				$this->Session->setFlash(__('El programa ha sido registrado exitosamente'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se ha podido guardar el programa intente de nuevo'));
			}
		} else {
			$options = array('conditions' => array('Programa.' . $this->Programa->primaryKey => $id));
			$this->request->data = $this->Programa->find('first', $options);
			$programa = $this->Programa->find('first', $options);
			$this->set('programa',$programa);
		}
		if($usuario['nivel_id']==1)
		{
		$facultades = $this->Programa->Facultad->find('list');
		}
		else
		{
		$opciones = array('conditions' => array('Facultad.id'=>$programa['Programa']['facultad_id']));
		$facultades = $this->Programa->Facultad->find('list',$opciones);	
		}
		$this->set(compact('facultades'));
	}

	public function view($id = null) {
		if (!$this->Programa->exists($id)) {
			throw new NotFoundException(__('Invalid programa'));
		}
		$options = array('conditions' => array('Programa.' . $this->Programa->primaryKey => $id));
		$programa=$this->Programa->find('first', $options);
		$options = array('conditions' => array('Area.programa_id' => $programa['Programa']['id']));
		$programa['Programa']['areas']=$this->Area->find('count', $options);
		$this->set('programa',$programa);
	}
}
