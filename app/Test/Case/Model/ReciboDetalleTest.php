<?php
App::uses('ReciboDetalle', 'Model');

/**
 * ReciboDetalle Test Case
 */
class ReciboDetalleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recibo_detalle',
		'app.recibo',
		'app.lote',
		'app.socio',
		'app.user',
		'app.bitacora',
		'app.cuota_agua',
		'app.cuota'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ReciboDetalle = ClassRegistry::init('ReciboDetalle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReciboDetalle);

		parent::tearDown();
	}

}
