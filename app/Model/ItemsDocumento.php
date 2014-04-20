<?php
App::uses('AppModel', 'Model');
/**
 * ItemsDocumento Model
 *
 * @property Documento $Documento
 * @property ItemsEstandar $ItemsEstandar
 */
class ItemsDocumento extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'items_documento';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'documento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ItemsEstandar' => array(
			'className' => 'ItemsEstandar',
			'foreignKey' => 'items_estandar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
