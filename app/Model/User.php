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
