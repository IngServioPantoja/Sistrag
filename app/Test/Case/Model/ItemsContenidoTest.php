<?php
App::uses('ItemsContenido', 'Model');

/**
 * ItemsContenido Test Case
 *
 */
class ItemsContenidoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.items_contenido',
		'app.items_documento',
		'app.documento',
		'app.estandar',
		'app.programa',
		'app.facultad',
		'app.tiposestandar',
		'app.control',
		'app.rol',
		'app.entrega',
		'app.estado',
		'app.personas_proyecto',
		'app.proyecto',
		'app.area',
		'app.linea',
		'app.persona',
		'app.tiposusuario',
		'app.user',
		'app.nivel',
		'app.menu',
		'app.menus_nivel',
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
		$this->ItemsContenido = ClassRegistry::init('ItemsContenido');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemsContenido);

		parent::tearDown();
	}

}
