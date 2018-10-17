<?php
App::uses('AppModel', 'Model');
/**
 * CuotaAgua Model
 *
 * @property Socio $Socio
 */
class CuotaAgua extends AppModel {

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

	public $tipo_pago = array(1 => 'Efectivo', 2 => 'Transferencia', 3 => 'Cheque', 4 => 'Tarjeta', 5 => 'Otro Medio de Pago');

/**
 * Validation rules
 *
 * @var array
 */

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
		)
	);
}
