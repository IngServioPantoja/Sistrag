<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
var $helpers = array('Html', 'Form', 'Js' => array('Jquery'));
var $paginate =array('limit' => 10,);
var $uses = array(
    'Notificacion'
    );

	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'menus', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authError'=> 'no puedes acceder a esa pagina',
			'authorize' => array('Controller') 
        ),"RequestHandler"
    );

    
	public function isAuthorized($user) {
        $this->Session->write("Usuario",$user);
        $Usuario=$this->Session->read("Usuario");
        $this->set('miUsuario', $Usuario); 
       // print_r( $Usuario); 
      return true;
    }

    public function beforeFilter() 
    {
        $this->Auth->allow('index', 'view','autores');
        $this->set('logged_in',$this->Auth->loggedin());
		$this->set('current_user',$this->Auth->user());
					
    }

    public function beforeRender() 
    {
    $this->set('referer',$this->referer());
    $usuario=$this->Session->read("Usuario");
    $id_persona=$usuario['Persona']['id'];
    $opcionesConteo = 
        array(
            'conditions'=>
                array(
                    'Notificacion.persona_id'=>$id_persona,
                    'Notificacion.parametro_estado_id' => 5
                ),
            'recursive'=>0
        );
    $nuevasNotificaciones=$this->Notificacion->find('count', $opcionesConteo);  
    $this->set('nuevasNotificaciones', $nuevasNotificaciones);  
    }
		

}