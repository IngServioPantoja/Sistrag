<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function autores()
	{
		
	} 
	
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$niveles = $this->User->Nivel->find('list');
		$this->set(compact('niveles'));
		$personas = $this->User->Persona->find('list');
		$this->set(compact('personas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$niveles = $this->User->Nivel->find('list');
		$this->set(compact('niveles'));
		$personas = $this->User->Persona->find('list');
		$this->set(compact('personas'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            $this->Session->setFlash(__('Bienvenido'));
		   if ($this->Auth->user('nivel_id') == '1') {
            $this->redirect("/menus/mnuMain/");


			}else if ($this->Auth->user('nivel_id') == '2'){

				$this->redirect("/menus/mnuMain/");

			}
			else if ($this->Auth->user('nivel_id') == '3'){

				$this->redirect("/menus/mnuMain/");

			}
			else if ($this->Auth->user('nivel_id') == '4'){

				$this->redirect("/menus/mnuMain/");

			}
			else if ($this->Auth->user('nivel_id') == '5'){

				$this->redirect("/menus/mnuMain/");

			}

        } else {
            $this->Session->setFlash(__('intente de nuevo usuario invalido'));
        }
    }
}

   function logout(){
   	        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
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
