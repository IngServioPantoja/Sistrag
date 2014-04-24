<?php
/**
 * ItemsDocumentoFixture
 *
 */
class ItemsDocumentoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'items_documento';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'documento_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'items_estandar_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'documento_id' => array('column' => 'documento_id', 'unique' => 0),
			'items_estandar_id' => array('column' => 'items_estandar_id', 'unique' => 0)
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
			'documento_id' => 1,
			'items_estandar_id' => 1
		),
	);

}
