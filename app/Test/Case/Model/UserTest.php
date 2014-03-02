<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.persona',
		'app.programa',
		'app.facultad',
		'app.estandar',
		'app.tiposestandar',
		'app.control',
		'app.rol',
		'app.entrega',
		'app.documento',
		'app.proyecto',
		'app.personas_proyecto',
		'app.estado',
		'app.item',
		'app.items_estandar',
		'app.tiposusuario',
		'app.nivel',
		'app.menu',
		'app.menus_nivel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
