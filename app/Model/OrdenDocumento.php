<?php
App::uses('AppModel', 'Model');
/**
 * Programa Model
 *
 * @property Facultad $Facultad
 * @property Estandar $Estandar
 */
class OrdenDocumento extends AppModel {

	public $displayField = 'nombre';


	public $belongsTo = array(
		'Tiposestandar' => array(
			'className' => 'Tiposestandar',
			'foreignKey' => 'tiposestandar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Programa' => array(
			'className' => 'Programa',
			'foreignKey' => 'programa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



}
