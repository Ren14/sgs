<?php
App::uses('AppModel', 'Model');
/**
 * Socio Model
 *
 * @property User $User
 * @property CuotaAgua $CuotaAgua
 * @property Cuota $Cuota
 */
class Socio extends AppModel {

	public function getNombreCompleto($id){
		$socio = $this->find('first', array('conditions' => array('Socio.id' => $id), 'fields' => array('Socio.nombre_completo'), 'recursive' => -1));

		return $socio['Socio']['nombre_completo'];
	}


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Provincia' => array(
			'className' => 'Provincia',
			'foreignKey' => 'provincia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Localidade' => array(
			'className' => 'Localidade',
			'foreignKey' => 'localidad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $order = 'apellido';

	public $virtualFields = array(
	    'nombre_completo' => 'CONCAT(Socio.apellido, " ", Socio.nombre)'
	);

	public $estado = array(
		0 => '<span class="label label-danger">Inactivo</span>',
		1 => '<span class="label label-primary">Activo</span>'
		);

	public $filtro_estado = array( 
		2 => 'Todos',
		1 => 'Activos', 
		0 => 'Inactivos',
		);

	public function getListaSocios(){
		$socios = $this->find('list', array(
			'conditions' => array(
				'Socio.activo' => 1,
				),
			'fields' => array(
				'Socio.id', 'Socio.nombre_completo'
				)
			)
		);

		return $socios;
	}


}
