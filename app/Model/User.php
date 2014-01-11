<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Persona $Persona
 * @property Nivel $Nivel
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';


	//The Associations below have been created with all possible keys, those that are not needed can be removed


public function matchPasswords($data){
	if($data['password']==$this->data['User']['password_confirmation']){
		return true;
		}
		$this->invalidate('password_confirmation','tus password no coinciden');
		return false;
	}
	public function beforeSave($options = Array()){
		if(isset($this->data['User']['password'])){
		$this->data['User']['password']=AuthComponent::password($this->data['User']['password']);
					}
					return true;
		
		
		}

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Nivel' => array(
			'className' => 'Nivel',
			'foreignKey' => 'nivel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
