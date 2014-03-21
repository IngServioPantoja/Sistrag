<?php
/**
 * PersonasProyectoFixture
 *
 */
class PersonasProyectoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'proyecto_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'persona_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'rol_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'proyecto_id' => array('column' => 'proyecto_id', 'unique' => 0),
			'persona_id' => array('column' => 'persona_id', 'unique' => 0),
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
			'proyecto_id' => 1,
			'persona_id' => 1,
			'rol_id' => 1
		),
	);

}
