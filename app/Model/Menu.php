<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 * @property Nivel $Nivel
 */
class Menu extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'texto';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Nivel' => array(
			'className' => 'Nivel',
			'joinTable' => 'menus_niveles',
			'foreignKey' => 'menu_id',
			'associationForeignKey' => 'nivel_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
