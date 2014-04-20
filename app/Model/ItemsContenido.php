<?php
App::uses('AppModel', 'Model');
/**
 * ItemsContenido Model
 *
 * @property ItemsDocumento $ItemsDocumento
 */
class ItemsContenido extends AppModel {

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
		'ItemsDocumento' => array(
			'className' => 'ItemsDocumento',
			'foreignKey' => 'items_documento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
