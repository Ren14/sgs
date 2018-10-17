<?php
App::uses('AppModel', 'Model');
/**
 * Bitacora Model
 *
 * @property User $User
 */
class Bitacora extends AppModel {

	public $components = array('Session');

	public function agregarBitacora($accion = null)
	{
		if (!$accion) {
			throw new NotFoundException(__('Debe especificar la acción de la Bitácora'));
		}

		$user_id = CakeSession::read('Auth.User.id');

		if ($user_id == '') {
			throw new NotFoundException(__('No está seteado el usuario'));
		}

		$bitacora = array();
		$bitacora['Bitacora']['accion'] = $accion;
		$bitacora['Bitacora']['user_id'] = $user_id;
		$bitacora['Bitacora']['ip'] = $_SERVER['REMOTE_ADDR'];
		$bitacora['Bitacora']['browser'] = $_SERVER['HTTP_USER_AGENT'];		

		try{
			$this->create();
			$this->save($bitacora);
			return 1;
		} catch (Exception $e){
			return 0;
		}
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'accion' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
