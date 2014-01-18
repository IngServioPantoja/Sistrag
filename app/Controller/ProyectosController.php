<?php
App::uses('AppController', 'Controller');
/**
 * Proyectos Controller
 *
 * @property Proyecto $Proyecto
 */
class ProyectosController extends AppController {
var $components = array("RequestHandler");
var $uses = array('Proyecto','Persona','Rol','PersonasProyecto');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Proyecto->recursive = 0;
		$this->set('proyectos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Proyecto->exists($id)) {
			throw new NotFoundException(__('Invalid proyecto'));
		}
		$options = array('conditions' => array('Proyecto.' . $this->Proyecto->primaryKey => $id));
		$this->set('proyecto', $this->Proyecto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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
			$this->Proyecto->recursive = 2;
			$options = array('conditions' => array('Proyecto.' . $this->Proyecto->primaryKey => $id));
			$this->request->data = $this->Proyecto->find('first', $options);
			echo print_r($this->request->data);
			$this->set('proyecto', $this->request->data);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
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
}
