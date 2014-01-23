<?php
App::uses('AppController', 'Controller');

class FacultadesController extends AppController {
var $helpers = array('Form', 'Html', 'Js','Paginator');
var $uses = array('Facultad','Programa','Area','Linea');

	public function add() {
		if ($this->request->is('post')) {
			$this->Facultad->create();
			if ($this->Facultad->save($this->request->data)) {
				$this->Session->setFlash(__('La facultad ha sido registrada exitosamente'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se ha podido registrar la facultad intente de nuevo'));
			}
		}
	}

	public function agregar_programa($facultad_id=null) 
	{
		if (!$this->Facultad->exists($facultad_id)) {
				throw new NotFoundException(__('Facultad invalida'));
			}
		if ($this->request->is('post')) {
			$this->Programa->create();
			print_r($this->request->data);
			if ($this->Programa->save($this->request->data)) {
				$this->Session->setFlash(__('El programa ha sido registrado exitosamente'));
				$this->redirect(array('controller'=>'facultades','action' => 'programas_asociados',$this->request->data['Programa']['facultad_id']));
			} else {
				$this->Session->setFlash(__('No se ha podido guardar el programa intente de nuevo'));
			}
		}
		else
		{
			$options = array('conditions' => array('Facultad.' . $this->Facultad->primaryKey => $facultad_id));
			$facultad = $this->Facultad->find('first', $options);
			$facultades = $this->Programa->Facultad->find('list',$options);
			$this->set(compact('facultades'));
			$this->set('facultad',$facultad);
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
			$this->Session->setFlash(__('Facultad borrada exitosamente'));
			$this->redirect($this->referer());
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

	public function index($atributo=null,$valor=null) 
	{	
		$this->Facultad->recursive = 0;
		if(isset($this->request->data['Busqueda']))
		{ 
			if($this->request->data['Busqueda']['atributo']!=NULL and $this->request->data['Busqueda']['valor']!=NULL)
			{
				$opciones=array('Facultad.'.$this->request->data['Busqueda']['atributo'].' LIKE' => '%'.$this->request->data['Busqueda']['valor'].'%');
				$facultades = $this->paginate('Facultad',$opciones);
				if (empty($facultades)) 
				{
					$this->set('encontrado',0);
				}
			}
			else
			{
    			$facultades = $this->paginate('Facultad');		
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
				$opciones=array('Facultad.'.$atributo.' LIKE' => '%'.$valor.'%');
	    		$facultades = $this->paginate('Facultad',$opciones);
	    		$busqueda[0]['atributo']=$atributo;
    			$busqueda[0]['valor']=$valor;	
    			$this->set('busqueda',$busqueda);	
    		}
    		else
    		{
	    		$facultades = $this->paginate('Facultad');			
    		}
    	}
    	$p=0;
		$opciones = array(
			    	'fields' => 
			            array(
			                'Programa.id','Programa.facultad_id'
			           	)
		   	);
		$programas = $this->Programa->find('list',$opciones);
		$contador=0;
		foreach ($facultades as $facultad) {
			foreach ($programas as $id => $facultad_id) {
				if($facultad['Facultad']['id']==$facultad_id)
				{
					++$contador;	
				}
			}
			$facultades[$p]['Facultad']['programas'] = $contador;
			++$p;
			$contador=0;
		}
   		$this->set('facultades',$facultades);
		if($this->request->is('ajax'))    	
		{

			$this->render('/facultades/index');
		}
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
		$this->Programa->recursive = -1;
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
}
