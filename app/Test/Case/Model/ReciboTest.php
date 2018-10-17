<?php
App::uses('Recibo', 'Model');

/**
 * Recibo Test Case
 */
class ReciboTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Recibo = ClassRegistry::init('Recibo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recibo);

		parent::tearDown();
	}

}
