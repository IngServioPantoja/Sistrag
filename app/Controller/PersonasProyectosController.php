<?php
App::uses('AppController', 'Controller');
/**
 * PersonasProyectos Controller
 *
 * @property PersonasProyecto $PersonasProyecto
 */
class PersonasProyectosController extends AppController {
var $components = array("RequestHandler");
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PersonasProyecto->recursive = 0;
		$this->set('personasProyectos', $this->paginate());
	}
/**
 * index method
 *
 * @return void
 */
	public function render_agregar_index() {

		$this->PersonasProyecto->recursive = 0;
		$this->set('personasProyectos', $this->paginate());
		$this->render('/personasproyectos/render_agregar_index');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PersonasProyecto->exists($id)) {
			throw new NotFoundException(__('Invalid personas proyecto'));
		}
		$options = array('conditions' => array('PersonasProyecto.' . $this->PersonasProyecto->primaryKey => $id));
		$this->set('personasProyecto', $this->PersonasProyecto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		print_r($this->request->data);
		if ($this->request->is('post')) {
			$this->PersonasProyecto->create();
			if ($this->PersonasProyecto->save($this->request->data)) {
				$this->flash(__('Personasproyecto saved.'), array('action' => 'index'));
				$this->PersonasProyecto->recursive = 0;

				
			} else {
			}
		}
		$personas = $this->PersonasProyecto->Persona->find('list');
		$documentos = $this->PersonasProyecto->Proyecto->find('list');
		$roles = $this->PersonasProyecto->Rol->find('list');
		$this->set(compact('personas', 'documentos', 'roles'));
	}

/**
 * add method
 *
 * @return void
 */
	public function pre_render_agregar($var1,$var2) {
		echo $var1;
		echo "</br></br>";
		echo $var2;
		echo print_r($renderizado=$this->request->data);
		$this->render('/personasproyectos/pre_render_agregar');
		/*
		print_r($this->request->data);

			$this->PersonasProyecto->create();
			if ($this->PersonasProyecto->save($this->request->data)) {
				$this->flash(__('Personasproyecto saved.'), array('action' => 'index'));
				$this->PersonasProyecto->recursive = 0;
				$this->set('personasProyectos', $this->paginate());
				$this->render('/personasproyectos/pre_render_agregar');
				$this->flash(__('agregado!!'));
			} else {
			}

		$personas = $this->PersonasProyecto->Persona->find('list');
		$documentos = $this->PersonasProyecto->Documento->find('list');
		$roles = $this->PersonasProyecto->Rol->find('list');
		$this->set(compact('personas', 'documentos', 'roles'));*/
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PersonasProyecto->exists($id)) {
			throw new NotFoundException(__('Invalid personas proyecto'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PersonasProyecto->save($this->request->data)) {
				$this->flash(__('The personas proyecto has been saved.'), array('action' => 'index'));
			} else {
			}
		} else {
			$options = array('conditions' => array('PersonasProyecto.' . $this->PersonasProyecto->primaryKey => $id));
			$this->request->data = $this->PersonasProyecto->find('first', $options);
		}
		$personas = $this->PersonasProyecto->Persona->find('list');
		$documentos = $this->PersonasProyecto->Documento->find('list');
		$roles = $this->PersonasProyecto->Rol->find('list');
		$this->set(compact('personas', 'documentos', 'roles'));
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
		$this->PersonasProyecto->id = $id;
		if (!$this->PersonasProyecto->exists()) {
			throw new NotFoundException(__('Invalid personas proyecto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PersonasProyecto->delete()) {
			$this->flash(__('Personas proyecto deleted'), array('action' => 'index'));
		}
		$this->flash(__('Personas proyecto was not deleted'), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
