<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 * @property Programa $Programa
 */
class Area extends AppModel {

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
		)
	);
}
