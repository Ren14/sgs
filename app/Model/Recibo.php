<?php
App::uses('AppModel', 'Model');
/**
 * Recibo Model
 *
 * @property Lote $Lote
 * @property CuotaAgua $CuotaAgua
 * @property Cuota $Cuota
 */
class Recibo extends AppModel {

	public $estados_label = array(
		0 => '<span class="label label-danger">Anulado</span>',
		1 => '<span class="label label-primary">Activo</span>'
		);

	public $estados = array(0 => 'Anulado', 1=>'Activo');

	public $tipo = array(1 => 'Cuota Agua', 2 => 'Cuota Social');

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

public $hasMany = array(
	'ReciboDetalle' => array(
			'className' => 'ReciboDetalle',
			'foreignKey' => 'recibo_id',
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
