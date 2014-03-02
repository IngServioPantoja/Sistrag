<?php
/**
 * PersonaFixture
 *
 */
class PersonaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'avatar' => array('type' => 'string', 'null' => false, 'default' => 'recursos/escudo400.png', 'length' => 30, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'identificacion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 15, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'apellido' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'programa_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'facultad_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'tiposusuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'tiposusuario_id' => array('column' => 'tiposusuario_id', 'unique' => 0),
			'programa_Id' => array('column' => 'programa_id', 'unique' => 0),
			'facultad_id' => array('column' => 'facultad_id', 'unique' => 0)
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
			'avatar' => 'Lorem ipsum dolor sit amet',
			'identificacion' => 'Lorem ipsum d',
			'nombre' => 'Lorem ipsum dolor sit amet',
			'apellido' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'programa_id' => 1,
			'facultad_id' => 1,
			'tiposusuario_id' => 1
		),
	);

}
