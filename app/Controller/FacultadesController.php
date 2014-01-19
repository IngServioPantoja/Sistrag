<?php
App::uses('AppController', 'Controller');

class FacultadesController extends AppController {
var $components = array("RequestHandler");
var $helpers = array('Form', 'Html', 'Js','Paginator');
var $uses = array('Facultad','Programa');
var $paginate =array(
        'limit' => 10,
        );
	public function beforeFilter() 
	{
	    parent::beforeFilter();
	    $this->Auth->allow('add');
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

	public function view($id = null) {
		if (!$this->Facultad->exists($id)) {
			throw new NotFoundException(__('Invalid facultad'));
		}
		$options = array('conditions' => array('Facultad.' . $this->Facultad->primaryKey => $id));
		$facultad=$this->Facultad->find('first', $options);
		$options = array('conditions' => array('Programa.facultad_id' => $facultad['Facultad']['id']));
		$facultad['Facultad']['programas']=$this->Programa->find('count', $options);
		$this->set('facultad',$facultad);
	}

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

	public function edit($id = null) {
		if (!$this->Facultad->exists($id)) {
			throw new NotFoundException(__('Invalid facultad'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Facultad->save($this->request->data)) {
				$this->Session->setFlash(__('The facultad has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The facultad could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Facultad.' . $this->Facultad->primaryKey => $id));
			$this->request->data = $this->Facultad->find('first', $options);
		}
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
}
