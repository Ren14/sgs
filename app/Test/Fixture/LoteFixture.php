<?php
/**
 * Lote Fixture
 */
class LoteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false),
		'fecha_adquisicion' => array('type' => 'date', 'null' => false, 'default' => null),
		'activo' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'socio_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'socio_id' => array('column' => 'socio_id', 'unique' => 0)
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
			'id' => '5a5e9502-bb7c-41b6-8257-22b881834945',
			'numero' => 1,
			'fecha_adquisicion' => '2018-01-17',
			'activo' => 1,
			'socio_id' => 'Lorem ipsum dolor sit amet',
			'created' => '2018-01-17 01:12:50',
			'modified' => '2018-01-17 01:12:50'
		),
	);

}
