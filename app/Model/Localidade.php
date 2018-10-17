<?php
App::uses('AppModel', 'Model');
/**
 * Localidade Model
 *
 * @property Provincia $Provincia
 */
class Localidade extends AppModel {

	public function getLocalidades($provincia_id)
	{
		return $this->find('list', array('conditions' => array('Localidade.provincia_id' => $provincia_id), 'fields' => array('Localidade.id', 'Localidade.localidad' )));
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'provincia_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'localidad' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Provincia' => array(
			'className' => 'Provincia',
			'foreignKey' => 'provincia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
