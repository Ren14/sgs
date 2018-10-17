<?php
App::uses('AppModel', 'Model');
/**
 * Lote Model
 *
 * @property Socio $Socio
 * @property CuotaAgua $CuotaAgua
 * @property Cuota $Cuota
 * @property Recibo $Recibo
 */
class Lote extends AppModel {

	public $filtro_estado = array( 
		2 => 'Todos',
		1 => 'Activos', 
		0 => 'Inactivos',
		);

	public function validarNumeroLote($numero_lote)
	{
		$existe = $this->find('first', array('conditions' => array('Lote.numero' => $numero_lote, 'Lote.activo' => 1), 'recursive' => -1));

		if(sizeof($existe) > 0)
			return 1;
		else
			return 0;
	}

	public function getListaLotes(){
		$lotes = $this->find('list', array(
			'conditions' => array(
				'Lote.activo' => 1,
				),
			'fields' => array(
				'Lote.id', 'Lote.numero'
				),
			'order' => array(
				'Lote.numero' => 'asc'
				)
			)
		);

		return $lotes;
	}

	public $estado = array(
		0 => '<span class="label label-danger">Inactivo</span>',
		1 => '<span class="label label-primary">Activo</span>'
		);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'numero' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'fecha_adquisicion' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'activo' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'socio_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Socio' => array(
			'className' => 'Socio',
			'foreignKey' => 'socio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CuotaAgua' => array(
			'className' => 'CuotaAgua',
			'foreignKey' => 'lote_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Cuota' => array(
			'className' => 'Cuota',
			'foreignKey' => 'lote_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ReciboDetalle' => array(
			'className' => 'ReciboDetalle',
			'foreignKey' => 'lote_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
