<?php
/**
 * EntregaFixture
 *
 */
class EntregaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'fecha_entrega' => array('type' => 'date', 'null' => false, 'default' => null),
		'rol_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'documento_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'documento_id' => array('column' => 'documento_id', 'unique' => 0),
			'rol_id' => array('column' => 'rol_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'fecha_entrega' => '2014-04-19',
			'rol_id' => 1,
			'documento_id' => 1
		),
	);

}
