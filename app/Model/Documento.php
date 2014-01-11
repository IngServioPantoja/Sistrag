<?php
App::uses('AppModel', 'Model');
/**
 * Documento Model
 *
 * @property Estandar $Estandar
 * @property Entrega $Entrega
 * @property PersonasProyecto $PersonasProyecto
 */
class Documento extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'fecha_guardado';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Estandar' => array(
			'className' => 'Estandar',
			'foreignKey' => 'estandar_id',
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
		'Entrega' => array(
			'className' => 'Entrega',
			'foreignKey' => 'documento_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonasProyecto' => array(
			'className' => 'PersonasProyecto',
			'foreignKey' => 'documento_id',
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

}
