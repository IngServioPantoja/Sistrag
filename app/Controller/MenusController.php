<?php
App::uses('AppController', 'Controller');

class MenusController extends AppController {
    var $name = "Menus";
    var $helpers = array("Html", "Form");
    var $uses = array('Menu','Nivel','MenusNivel');

	public function index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		}
		$menus = $this->Menu->find('list');
		$niveles = $this->Menu->Nivel->find('list');
		$this->set(compact('menus', 'niveles'));
	}

	public function edit($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
		}
		$menus = $this->Menu->find('list');
		$niveles = $this->Menu->Nivel->find('list');
		$this->set(compact('menus', 'niveles'));
	}

	public function delete($id = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Menu->delete()) {
			$this->Session->setFlash(__('Menu deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Menu was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	    function mnuMain(){ //La vista queda mnu_main.ctp
	    $this->MenusNivel->recursive = 0;
	    $Usuario=$this->Session->read("Usuario");
        $r = $this->MenusNivel->find('all',array('conditions' => array('nivel_id'=> $Usuario['nivel_id']),"fields" => array('Menu.icono','Menu.vinculo','Menu.texto','Menu.id'),'order' => array('MenusNivel.orden' => 'asc')));
        $menu = array(); 
		$p=0;
		foreach ($r as $key):
		$menu [$p]['titulo']=$key['Menu']['texto'];
		$menu [$p]['vinculo']=$key['Menu']['vinculo'];
		$menu [$p]['icono']=$key['Menu']['icono'];
		$menu [$p]['id']=$key['Menu']['id'];
		++$p;
		endforeach;
        $this->Session->write("Menu",$menu);
        $this->redirect("/administracion/bienvenido");
    }
    
    /**
     * delMnu permite destruir las variables de Session 
     */
    function delMnu(){
        $this->Session->destroy();
        $this->redirect("/users/login/");
    }
}
