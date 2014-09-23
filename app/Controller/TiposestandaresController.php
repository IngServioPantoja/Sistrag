<?php
App::uses('AppController', 'Controller');
/**
 * Tiposestandares Controller
 *
 * @property Tiposestandar $Tiposestandar
 */
class TiposestandaresController extends AppController {
var $uses = array('Tiposestandar','User','Facultad','Programa','Tipousuario','Nivel','Persona','Area','Linea');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tiposestandar->recursive = 0;
		$this->set('tiposestandares', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tiposestandar->exists($id)) {
			throw new NotFoundException(__('Invalid tiposestandar'));
		}
		$options = array('conditions' => array('Tiposestandar.' . $this->Tiposestandar->primaryKey => $id));
		$this->set('tiposestandar', $this->Tiposestandar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function pickList() {
		$this->Tiposestandar->create();
			$this->request->data['Tiposestandar']['orden']=10;
			if ($this->Tiposestandar->save($this->request->data)) {
			} else {
				$this->Session->setFlash(__('Ha ocurrido un error al agregar el estandar'));
			}
			$opciones = array(
				'conditions' => array(
					'Tiposestandar.programa_id'=> $this->request->data['Tiposestandar']['programa_id']
				),
				'order'=>array(
					'Tiposestandar.orden asc'
				)
			);
			$tiposestandares = $this->Tiposestandar->find('all',$opciones);

			//print_r($tiposestandares);
			$this->set('tiposestandares',$tiposestandares);

			$this->set('programa_padre',$this->request->data['Tiposestandar']['programa_id']);
	}
	public function componentesPrograma() {
		$this->Tiposestandar->create();
			$opciones = array(
				'conditions' => array(
					'Tiposestandar.programa_id'=> $this->request->data['Tiposestandar']['programa_id']
				),
				'order'=>array(
					'Tiposestandar.orden asc'
				)
			);
			$tiposestandares = $this->Tiposestandar->find('all',$opciones);

			//print_r($tiposestandares);
			$this->set('tiposestandares',$tiposestandares);

			$this->set('programa_padre',$this->request->data['Tiposestandar']['programa_id']);
			$this->render('/tiposestandares/pickList');
	}
	public function add() {
		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];	
		if ($this->request->is('post')) {
			//Agregaremos la jerarquiía correspondiente
			$o=1;
			foreach ($this->request->data['source'] as $tipoEstandar => $value) {
				print_r($value);
				$tipoEstandar=array();
				$tipoEstandar['Tiposestandar']['orden']=$o;
				$tipoEstandar['Tiposestandar']['id']=$value;
				$this->Tiposestandar->create();
				if ($this->Tiposestandar->save($tipoEstandar)) {
				}
				++$o;
			}
			$opciones = array(
				'conditions' => array(
					'Tiposestandar.programa_id'=> $this->request->data['Tiposestandar']['programa_id']
				),
				'order'=>array(
					'Tiposestandar.orden asc'
				)
			);
			$tiposestandares = $this->Tiposestandar->find('all',$opciones);
			$a=0;
			foreach ($tiposestandares as $tipoestandar)
			{

				foreach ($this->request->data['source'] as $tipoEstandar => $value) {
					echo $tipoEstandar;
					if($tipoestandar['Tiposestandar']['id']==$value)
					{	echo "entre";
						unset($tiposestandares[$a]);
						break;
					}

				}

				++$a;
			}
			foreach ($tiposestandares as $tipoestandar) {
				print_r($tipoestandar);
				$this->Tiposestandar->id = $tipoestandar['Tiposestandar']['id'];
				if ($this->Tiposestandar->delete()) {

				}
			}
			$this->redirect(array('action' => 'add'));
			$this->Session->setFlash(__('Estandar actualizado exitosamente'));
			
		}
		if($usuario['nivel_id']==1)
		{
			//Administrados institucional

			$programas = $this->Programa->find('list');

		}else if($usuario['nivel_id']==2)
		{

			//Adminsitrador facultad
			$id_facultad=$usuario['Persona']['facultad_id'];
			$opciones = array('conditions' => array('Facultad.id'=> $id_facultad));
			//Consultaremos listas
			$facultades = $this->Facultad->find('list',$opciones);

			$opciones = array('conditions' => array('Programa.facultad_id'=> $id_facultad));
			$programas = $this->Programa->find('list',$opciones);

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

		}
		$id_programa=0;
		$this->set('programas',$programas);
		foreach ($programas as $key => $value) {
			$opciones = array(
				'conditions' => array(
					'Tiposestandar.programa_id'=> $key
				),
				'order'=>array(
					'Tiposestandar.orden asc'
				)
			);
			$id_programa=$key;
			break;
		}
		
		$tiposestandares = $this->Tiposestandar->find('all',$opciones);
		$this->set('tiposestandares',$tiposestandares);
		$this->set('programa_padre',$id_programa);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tiposestandar->exists($id)) {
			throw new NotFoundException(__('Invalid tiposestandar'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tiposestandar->save($this->request->data)) {
				$this->Session->setFlash(__('The tiposestandar has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tiposestandar could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tiposestandar.' . $this->Tiposestandar->primaryKey => $id));
			$this->request->data = $this->Tiposestandar->find('first', $options);
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
		$this->Tiposestandar->id = $id;
		if (!$this->Tiposestandar->exists()) {
			throw new NotFoundException(__('Invalid tiposestandar'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tiposestandar->delete()) {
			$this->Session->setFlash(__('Tiposestandar deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tiposestandar was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
