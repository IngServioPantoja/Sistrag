<?php
App::uses('AppModel', 'Model');
/**
 * Evaluacion Model
 *
 * @property Itemestandar $Itemestandar
 * @property Concepto $Concepto
 */
class Parametro extends AppModel {

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
		'TipoParametro' => array(
			'className' => 'TipoParametro',
			'foreignKey' => 'tiposparametro_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
