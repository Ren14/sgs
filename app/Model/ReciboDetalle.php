<?php
App::uses('AppModel', 'Model');
/**
 * ReciboDetalle Model
 *
 * @property Recibo $Recibo
 * @property CuotaAgua $CuotaAgua
 * @property Cuota $Cuota
 */
class ReciboDetalle extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'recibo_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
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
		'Recibo' => array(
			'className' => 'Recibo',
			'foreignKey' => 'recibo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CuotaAgua' => array(
			'className' => 'CuotaAgua',
			'foreignKey' => 'cuota_agua_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cuota' => array(
			'className' => 'Cuota',
			'foreignKey' => 'cuota_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
