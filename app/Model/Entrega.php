<?php
App::uses('AppModel', 'Model');
/**
 * Entrega Model
 *
 * @property Rol $Rol
 * @property Documento $Documento
 * @property Detalleentrega $Detalleentrega
 */
class Entrega extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'fecha_entrega';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Rol' => array(
			'className' => 'Rol',
			'foreignKey' => 'rol_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'documento_id',
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
		'Detalleentrega' => array(
			'className' => 'Detalleentrega',
			'foreignKey' => 'entrega_id',
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
