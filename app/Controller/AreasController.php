<?php
App::uses('AppController', 'Controller');

class AreasController extends AppController {
var $components = array("RequestHandler");
var $uses = array('Area','Linea','Programa','Facultad');
var $usuario=array();
var $paginate =array('limit' => 10,);
	
	public function add() {
			if ($this->request->is('post')) {
				$this->Area->create();
				if ($this->Area->save($this->request->data)) {
					$this->Session->setFlash(__('The area has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
				}
			}
			$programas = $this->Area->Programa->find('list');
			$this->set(compact('programas'));
		}

	public function index($atributo=null,$valor=null) {
		
		$this->Area->recursive = 0;
		if(isset($this->request->data['Busqueda']))
		{ 
			if($this->request->data['Busqueda']['atributo']!=NULL and $this->request->data['Busqueda']['valor']!=NULL)
			{
				$opciones=array('Area.'.$this->request->data['Busqueda']['atributo'].' LIKE' => '%'.$this->request->data['Busqueda']['valor'].'%');
				$areas = $this->paginate('Area',$opciones);
				if (empty($areas)) 
				{
					$this->set('encontrado',0);
				}
			}
			else
			{
    			$areas = $this->paginate('Area');		
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
				$opciones=array('Area.'.$atributo.' LIKE' => '%'.$valor.'%');
	    		$areas = $this->paginate('Area',$opciones);
	    		$busqueda[0]['atributo']=$atributo;
    			$busqueda[0]['valor']=$valor;	
    			$this->set('busqueda',$busqueda);	
    		}
    		else
    		{
	    		$areas = $this->paginate('Area');			
    		}
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
			$areas[$p]['Area']['areas'] = $contador;
			++$p;
			$contador=0;
		}
		$this->set('areas',$areas);
		if($this->request->is('ajax'))    	
		{

			$this->render('/areas/index');
		}	

	}

	public function view($id = null) {
		if (!$this->Area->exists($id)) {
			throw new NotFoundException(__('Invalid area'));
		}
		$options = array('conditions' => array('Area.' . $this->Area->primaryKey => $id));
		$area=$this->Area->find('first', $options);
		$this->set('area',$area);
		$options = array('conditions' => array('Linea.area_id' => $area['Area']['id']));
		$area['Area']['lineas']=$this->Linea->find('count', $options);
		$this->set('area',$area);	
	}

	public function edit($id = null) {
		if (!$this->Area->exists($id)) {
			throw new NotFoundException(__('Invalid area'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Area.' . $this->Area->primaryKey => $id));
			$this->request->data = $this->Area->find('first', $options);
			$area=$this->Area->find('first', $options);
			$this->set('area',$area);
		}
		$programas = $this->Area->Programa->find('list');
		$this->set(compact('programas'));
	}

	public function delete($id = null) {
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Invalid area'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Area->delete()) {
			$this->Session->setFlash(__('The area has been deleted.'));
		} else {
			$this->Session->setFlash(__('The area could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
