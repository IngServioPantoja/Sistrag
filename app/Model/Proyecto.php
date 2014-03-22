<?php
App::uses('AppModel', 'Model');
/**
 * Proyecto Model
 *
 * @property Area $Area
 * @property Linea $Linea
 * @property Documento $Documento
 * @property Persona $Persona
 */
class Proyecto extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Linea' => array(
			'className' => 'Linea',
			'foreignKey' => 'linea_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Programa' => array(
			'className' => 'Programa',
			'foreignKey' => 'programa',
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
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'proyecto_id',
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
		'Persona' => array(
			'className' => 'Persona',
			'joinTable' => 'personas_proyectos',
			'foreignKey' => 'proyecto_id',
			'associationForeignKey' => 'persona_id',
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
