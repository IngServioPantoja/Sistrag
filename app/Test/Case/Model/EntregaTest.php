<?php
App::uses('Entrega', 'Model');

/**
 * Entrega Test Case
 *
 */
class EntregaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.entrega',
		'app.rol',
		'app.control',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.tiposestandar',
		'app.documento',
		'app.proyecto',
		'app.area',
		'app.linea',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
		'app.personas_proyecto',
		'app.item',
		'app.items_estandar',
		'app.detalleentrega'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Entrega = ClassRegistry::init('Entrega');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Entrega);

		parent::tearDown();
	}

}
