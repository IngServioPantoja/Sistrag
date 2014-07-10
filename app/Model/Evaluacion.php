<?php
App::uses('AppModel', 'Model');
/**
 * Evaluacion Model
 *
 * @property Itemestandar $Itemestandar
 * @property Concepto $Concepto
 */
class Evaluacion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'comentarios';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ItemsDocumento' => array(
			'className' => 'ItemsDocumento',
			'foreignKey' => 'items_documento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Detalleentrega' => array(
			'className' => 'Detalleentrega',
			'foreignKey' => 'detalles_entrega_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Parametro' => array(
			'className' => 'Parametro',
			'foreignKey' => 'parametro_concepto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
