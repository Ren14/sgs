<?php
App::uses('AppModel', 'Model');
/**
 * Provincia Model
 *
 * @property Localidade $Localidade
 */
class Provincia extends AppModel {

	public function getProvincias()
	{
		return $this->find('list', array('fields' => array('Provincia.id', 'Provincia.provincia')));
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'provincia' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Localidade' => array(
			'className' => 'Localidade',
			'foreignKey' => 'provincia_id',
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
