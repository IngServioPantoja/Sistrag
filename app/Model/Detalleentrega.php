<?php
App::uses('AppModel', 'Model');
/**
 * Detalleentrega Model
 *
 * @property Entrega $Entrega
 * @property PersonasProyecto $PersonasProyecto
 * @property Estado $Estado
 */
class Detalleentrega extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'entrega_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Entrega' => array(
			'className' => 'Entrega',
			'foreignKey' => 'entrega_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PersonasProyecto' => array(
			'className' => 'PersonasProyecto',
			'foreignKey' => 'personas_proyecto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
