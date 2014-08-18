<?php
App::uses('Notificacion', 'Model');

/**
 * Notificacion Test Case
 *
 */
class NotificacionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notificacion',
		'app.parametro_estado',
		'app.parametro',
		'app.tipo_parametro'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notificacion = ClassRegistry::init('Notificacion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notificacion);

		parent::tearDown();
	}

}
