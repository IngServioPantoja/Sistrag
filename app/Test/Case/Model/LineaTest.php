<?php
App::uses('Linea', 'Model');

/**
 * Linea Test Case
 *
 */
class LineaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.linea',
		'app.area',
		'app.programa',
		'app.facultad',
		'app.estandar',
		'app.tiposestandar',
		'app.control',
		'app.rol',
		'app.entrega',
		'app.documento',
		'app.proyecto',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.personas_proyecto',
		'app.estado',
		'app.item',
		'app.items_estandar'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Linea = ClassRegistry::init('Linea');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Linea);

		parent::tearDown();
	}

}
