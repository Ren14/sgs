<?php
App::uses('AppModel', 'Model');
/**
 * Cuota Model
 *
 * @property Socio $Socio
 */
class Cuota extends AppModel {

	public $tipo_pago = array(1 => 'Efectivo', 2 => 'Transferencia', 3 => 'Cheque', 4 => 'Tarjeta', 5 => 'Otro Medio de Pago');

	 public $actsAs = array(
        'Upload.Upload' => array(
            'photo' => array(
                'fields' => array(
                    'dir' => 'photo_dir'
                )
            )
        )
    );

	

	public $estados = array(
		0 => 'Pendiente',
		1 => 'Cobrado',
		2 => 'Anulado',
		3 => 'Cobro Condicional'
		);
	public $estados_label = array(
		0 => '<span class="label label-warning">Pendiente</span>',
		1 => '<span class="label label-primary">Cobrado</span>',
		2 => '<span class="label label-danger">Anulado</span>',
		3 => '<span class="label label-info">Cobro Condicional</span>',
		);

	public $mes_desde = array(
		1 => 'Enero',
		2 => 'Febrero',
		3 => 'Marzo',
		4 => 'Abril',
		5 => 'Mayo',
		6 => 'Junio',
		7 => 'Julio',
		8 => 'Agosto',
		9 => 'Setiembre',
		10 => 'Octubre',
		11 => 'Noviembre',
		12 => 'Diciembre'
		);

	public $mes_hasta = array(
		1 => 'Enero',
		2 => 'Febrero',
		3 => 'Marzo',
		4 => 'Abril',
		5 => 'Mayo',
		6 => 'Junio',
		7 => 'Julio',
		8 => 'Agosto',
		9 => 'Setiembre',
		10 => 'Octubre',
		11 => 'Noviembre',
		12 => 'Diciembre'
		);
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'socio_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)		
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Lote' => array(
			'className' => 'Lote',
			'foreignKey' => 'lote_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Recibo' => array(
			'className' => 'Recibo',
			'foreignKey' => 'recibo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
