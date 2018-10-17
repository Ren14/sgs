<?php
App::uses('AppModel', 'Model');

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * @property Bitacora $Bitacora
 * @property Socio $Socio
 */
class User extends AppModel {



	public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new BlowfishPasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
    return true;
}

public $roles = array(
	1 => 'Socio',
	2 => 'Administrador',
	3 => 'SuperAdmin'
	);

public $estados_label = array(
		0 => '<span class="label label-danger">Inactivo</span>',
		1 => '<span class="label label-primary">Activo</span>'
		);

public function comprobarUsername($username)
{
	$flag = 0;
		
	$username = $this->find('first', array('conditions' => array('User.username' => $username)));

	if (isset($username) && sizeof($username) > 0) {
		$flag = 1;
	}

	return $flag;
}

	// The Associations below have been created with all possible keys, those that are not needed can be removed
public $displayField  = 'username';

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Bitacora' => array(
			'className' => 'Bitacora',
			'foreignKey' => 'user_id',
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
		'Socio' => array(
			'className' => 'Socio',
			'foreignKey' => 'user_id',
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
