<?php
App::uses('AppModel', 'Model');
/**
 * ItemsEstandar Model
 *
 * @property Item $Item
 * @property Estandar $Estandar
 * @property ItemsEstandar $ItemsEstandar
 */
class ItemsEstandar extends AppModel {

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
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		'ItemsEstandar' => array(
			'className' => 'ItemsEstandar',
			'foreignKey' => 'items_estandar_id',
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
