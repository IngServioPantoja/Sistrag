<?php
App::uses('AppModel', 'Model');
/**
 * MenusNivel Model
 *
 * @property Menu $Menu
 * @property Nivel $Nivel
 */
class MenusNivel extends AppModel {

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
		'Menu' => array(
			'className' => 'Menu',
			'foreignKey' => 'menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Nivel' => array(
			'className' => 'Nivel',
			'foreignKey' => 'nivel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
