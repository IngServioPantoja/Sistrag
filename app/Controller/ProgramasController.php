<?php
App::uses('AppController', 'Controller');

class ProgramasController extends AppController {
var $components = array("RequestHandler");
var $uses = array('Programa','Facultad','Area','Linea');
var $usuario=array();
	
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

	public function agregar_area($programa_id=null)
	{
		if (!$this->Programa->exists($programa_id)) {
				throw new NotFoundException(__('Programa invalido'));
			}
		if ($this->request->is('post')) {
			$this->Area->create();
			print_r($this->request->data);
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('El Área ha sido registrada exitosamente'));
				$this->redirect(array('controller'=>'programas','action' => 'areas_asociadas',$this->request->data['Area']['programa_id']));
			} else {
				$this->Session->setFlash(__('No se ha podido guardar el Área intente de nuevo'));
			}
		}
		else
		{
			$options = array('conditions' => array('Programa.' . $this->Programa->primaryKey => $programa_id));
			$programa = $this->Programa->find('first', $options);
			$programas = $this->Area->Programa->find('list',$options);
			$this->set(compact('programas'));
			$this->set('programa',$programa);
		}
	}

	public function areas_asociadas($programa_id=null,$atributo=null,$valor=null)
	{	
		$this->Area->recursive = -1;
		if (!$this->Programa->exists($programa_id))
		{
			$this->redirect(array('action' => 'index'));

		}
		$this->Programa->recursive = 0;
		$options = array('conditions' => array('Programa.' . $this->Programa->primaryKey => $programa_id));
		$programa=$this->Programa->find('first', $options);	
		$this->set('programa',$programa);
		if(isset($this->request->data['Busqueda']))
		{ 			
			if($this->request->data['Busqueda']['atributo']!=NULL and $this->request->data['Busqueda']['valor']!=NULL)
			{

				$opciones=array('Area.'.$this->request->data['Busqueda']['atributo'].' LIKE' => '%'.$this->request->data['Busqueda']['valor'].'%','Area.programa_id'=>$this->request->data['Busqueda']['programa_id']);
				$areas = $this->paginate('Area',$opciones);
				if (empty($areas)) 
				{
					$this->set('encontrado',0);
				}
			}
			else
			{	
				$opciones=array('Area.programa_id'=>$this->request->data['Busqueda']['programa_id']);
    			$areas = $this->paginate('Area',$opciones);		
    		}
    		$busqueda=array();
    		$busqueda[0]['atributo']=$this->request->data['Busqueda']['atributo'];
    		$busqueda[0]['valor']=$this->request->data['Busqueda']['valor'];
    		$busqueda[0]['programa_id']=$this->request->data['Busqueda']['programa_id'];
    		$this->set('busqueda',$busqueda);
		}
		else
		{
			$opciones=array('Area.programa_id'=>$programa_id);
			$areas = $this->paginate('Area',$opciones);	
		}
		$p=0;
		$opciones = array(
			    	'fields' => 
			            array(
			                'Linea.id','Linea.area_id'
			           	)
		   	);
		$lineas = $this->Linea->find('list',$opciones);
		$contador=0;
		foreach ($areas as $area) {
			foreach ($lineas as $id => $area_id) {
				if($area['Area']['id']==$area_id)
				{
					++$contador;	
				}
			}
			$areas[$p]['Area']['lineas'] = $contador;
			++$p;
			$contador=0;
		}
		$this->set('areas',$areas);
		if($this->request->is('ajax'))    	
		{
			$this->render('/programas/areas_asociadas');
		}
	}


	public function index($atributo=null,$valor=null) 
	{
		$usuario=$this->Session->read("Usuario");
		if($usuario['Nivel']['id']==1)
		{

		}else if($usuario['Nivel']['id']==2)
		{
			$this->redirect(array('controller'=>'facultades','action' => 'programas_asociados/'.$usuario['Persona']['facultad_id']));
		}else if($usuario['Nivel']['id']==3)
		{
			$this->redirect(array('controller'=>'programas','action' => 'areas_asociadas/'.$usuario['Persona']['programa_id']));
		}
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
	if(isset($this->request->data['Item']['facultad']))
	{
		$facultad_id=$this->request->data['Item']['facultad'];
	}else if(isset($this->request->data['Proyecto']['facultad']))
	{
		$facultad_id=$this->request->data['Proyecto']['facultad'];
	}
	$select_entrada=$this->Programa->find('list', 
		array('conditions' => 
			array('facultad_id'=> $facultad_id
			)
		)
	);
	$this->set(compact('select_entrada'));
	$this->render('/Programas/lista_programas');
}

	public function delete($id = null) {
		$this->Programa->id = $id;
		if (!$this->Programa->exists()) {
			$this->redirect(array('action' => 'index'));
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
			$this->redirect(array('action' => 'index'));
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
			$this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Programa.' . $this->Programa->primaryKey => $id));
		$programa=$this->Programa->find('first', $options);
		$options = array('conditions' => array('Area.programa_id' => $programa['Programa']['id']));
		$programa['Programa']['areas']=$this->Area->find('count', $options);
		$this->set('programa',$programa);
	}
}
