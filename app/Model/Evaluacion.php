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
		'Itemsestandar' => array(
			'className' => 'Itemsestandar',
			'foreignKey' => 'itemestandar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Concepto' => array(
			'className' => 'Concepto',
			'foreignKey' => 'concepto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
