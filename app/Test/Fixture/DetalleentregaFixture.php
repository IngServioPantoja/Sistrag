<?php
/**
 * DetalleentregaFixture
 *
 */
class DetalleentregaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'entrega_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'personas_proyecto_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'estado_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'fecha_estado' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'entrega_id' => array('column' => 'entrega_id', 'unique' => 0),
			'personas_proyecto_id' => array('column' => 'personas_proyecto_id', 'unique' => 0),
			'estado_id' => array('column' => 'estado_id', 'unique' => 0)
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
			'entrega_id' => 1,
			'personas_proyecto_id' => 1,
			'estado_id' => 1,
			'fecha_estado' => '2014-04-19 21:35:03'
		),
	);

}
