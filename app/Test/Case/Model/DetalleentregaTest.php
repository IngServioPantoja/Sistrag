<?php
App::uses('Detalleentrega', 'Model');

/**
 * Detalleentrega Test Case
 *
 */
class DetalleentregaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.detalleentrega',
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
		'app.estado'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Detalleentrega = ClassRegistry::init('Detalleentrega');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Detalleentrega);

		parent::tearDown();
	}

}
