<?php
App::uses('AppModel', 'Model');
/**
 * Persona Model
 *
 * @property Programa $Programa
 * @property Facultad $Facultad
 * @property Tiposusuario $Tiposusuario
 * @property User $User
 * @property Proyecto $Proyecto
 */
class Persona extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Programa' => array(
			'className' => 'Programa',
			'foreignKey' => 'programa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Facultad' => array(
			'className' => 'Facultad',
			'foreignKey' => 'facultad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tiposusuario' => array(
			'className' => 'Tiposusuario',
			'foreignKey' => 'tiposusuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'persona_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Proyecto' => array(
			'className' => 'Proyecto',
			'joinTable' => 'personas_proyectos',
			'foreignKey' => 'persona_id',
			'associationForeignKey' => 'proyecto_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
