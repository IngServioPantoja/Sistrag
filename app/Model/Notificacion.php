<?php
App::uses('AppModel', 'Model');
/**
 * Notificacion Model
 *
 * @property ParametroEstado $ParametroEstado
 * @property Parametro $ParametroTipoNotificacion
 */
class Notificacion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'fecha';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ParametroEstado' => array(
			'className' => 'Parametro',
			'foreignKey' => 'parametro_estado_id',
			'conditions' => array('ParametroEstado.tiposparametro_id' => '2'),
			'fields' => '',
			'order' => ''
		),
		'ParametroNotificacion' => array(
			'className' => 'Parametro',
			'foreignKey' => 'parametro_tipo_notificacion',
			'conditions' =>  array('ParametroNotificacion.tiposparametro_id' => '3'),
			'fields' => '',
			'order' => ''
		)
	);
}
