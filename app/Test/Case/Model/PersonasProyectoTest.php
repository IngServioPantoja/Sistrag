<?php
App::uses('PersonasProyecto', 'Model');

/**
 * PersonasProyecto Test Case
 *
 */
class PersonasProyectoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.personas_proyecto',
		'app.proyecto',
		'app.area',
		'app.programa',
		'app.facultad',
		'app.estandar',
		'app.tiposestandar',
		'app.control',
		'app.rol',
		'app.entrega',
		'app.documento',
		'app.estado',
		'app.item',
		'app.items_estandar',
		'app.linea',
		'app.persona',
		'app.tiposusuario',
		'app.user',
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
		$this->PersonasProyecto = ClassRegistry::init('PersonasProyecto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PersonasProyecto);

		parent::tearDown();
	}

}
