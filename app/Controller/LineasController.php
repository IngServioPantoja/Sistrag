<?php
App::uses('AppController', 'Controller');

class LineasController extends AppController {
var $uses = array('Linea','Area','Facultad','Programa');

	public function add() {
		if ($this->request->is('post')) {
			$this->Linea->create();
			if ($this->Linea->save($this->request->data)) {
				$this->Session->setFlash(__('The linea has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linea could not be saved. Please, try again.'));
			}
		}
		$areas = $this->Linea->Area->find('list');
		$this->set(compact('areas'));
	}
	
	public function delete($id = null) {
		$this->Linea->id = $id;
		if (!$this->Linea->exists()) {
			throw new NotFoundException(__('Invalid linea'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Linea->delete()) {
			$this->Session->setFlash(__('The linea has been deleted.'));
		} else {
			$this->Session->setFlash(__('The linea could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function edit($id = null) {
		if (!$this->Linea->exists($id)) {
			throw new NotFoundException(__('Invalid linea'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Linea->save($this->request->data)) {
				$this->Session->setFlash(__('The linea has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linea could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Linea.' . $this->Linea->primaryKey => $id));
			$this->request->data = $this->Linea->find('first', $options);
			$linea = $this->Linea->find('first', $options);
			$this->set('linea',$linea);
		}
		$areas = $this->Linea->Area->find('list');
		$this->set(compact('areas'));

	}

	public function index() {
		$this->Linea->recursive = 0;
		if(isset($this->request->data['Busqueda']))
		{ 
			if($this->request->data['Busqueda']['atributo']!=NULL and $this->request->data['Busqueda']['valor']!=NULL)
			{
				$opciones=array('Linea.'.$this->request->data['Busqueda']['atributo'].' LIKE' => '%'.$this->request->data['Busqueda']['valor'].'%');
				$lineas = $this->paginate('Linea',$opciones);
				if (empty($lineas)) 
				{
					$this->set('encontrado',0);
				}
			}
			else
			{
    			$lineas = $this->paginate('Linea');		
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
				$opciones=array('Linea.'.$atributo.' LIKE' => '%'.$valor.'%');
	    		$lineas = $this->paginate('Linea',$opciones);
	    		$busqueda[0]['atributo']=$atributo;
    			$busqueda[0]['valor']=$valor;	
    			$this->set('busqueda',$busqueda);	
    		}
    		else
    		{
	    		$lineas = $this->paginate('Linea');			
    		}
    	}
   		$this->set('lineas',$lineas);
		if($this->request->is('ajax'))    	
		{
			$this->render('/lineas/index');
		}

	}

	public function view($id = null) {
		if (!$this->Linea->exists($id)) {
			throw new NotFoundException(__('Invalid linea'));
		}
		$options = array('conditions' => array('Linea.' . $this->Linea->primaryKey => $id));
		$this->set('linea', $this->Linea->find('first', $options));
	}
}
