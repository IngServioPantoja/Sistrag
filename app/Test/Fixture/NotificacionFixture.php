<?php
/**
 * NotificacionFixture
 *
 */
class NotificacionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => null),
		'parametro_estado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'parametro_tipo_notificacion' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'url' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'parametro_estado_id' => array('column' => 'parametro_estado_id', 'unique' => 0),
			'parametro_tipo_notificacion' => array('column' => 'parametro_tipo_notificacion', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'fecha' => '2014-08-08',
			'parametro_estado_id' => 1,
			'parametro_tipo_notificacion' => 1,
			'url' => 'Lorem ipsum dolor sit amet'
		),
	);

}
