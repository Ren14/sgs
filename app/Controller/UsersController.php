<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator','Session','Auth' => array(
        'loginAction' => array(
            'controller'    => 'users',
            'action'        => 'login'
        ),
        'authError' => 'Ocurrió un error',
        'authenticate' => array(
            'Form' => array(
                'scope' => array('activo' => '1')
            ),

        )
    ));


public function beforeFilter() {
	parent::beforeFilter();
    	// Allow users to register and logout.
		$this->Auth->allow('add', 'logout', 'comprobarUsername');
		if($this->Session->read('Auth.User.rol') != 3){
			//$this->log($this->Auth->loggedIn(), 'debug');
			if($this->Session->read('Auth.User.rol') == 1){
				//$this->log($this->Auth->loggedIn(), 'debug');
				if(!in_array($this->request->params['action'], array('edit','logout','login'))){
					$this->redirect(array('controller' => 'pages', 'action' => 'home'));
				}
			}else{
				if(!in_array($this->request->params['action'], array('logout','login'))){
					$this->redirect(array('controller' => 'pages', 'action' => 'home'));
				}
			}
		}
}

public function login() {
	$this->loadModel('Socio');
	$this->layout = 'login';
	if($this->Auth->loggedIn() == 1){
		$this->Flash->success(__('Ya has iniciado sesion'));
		return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
	}
	if ($this->request->is('post')) {
		if ($this->Auth->login()) {
			$this->log($_SERVER, 'debug');
			if($this->Session->read('Auth.User.rol') == 1){
				$socio = $this->Socio->find('first',array(
					'conditions' => array(
						'Socio.user_id' => $this->Session->read('Auth.User.id')
					),
					'fields' => array(
						'Socio.id'
					)
				));
				// AGREGO A LA SESSION EL SOCIO_ID
				if(!empty($socio)){
					$this->Session->write('Auth.User.socio_id',$socio['Socio']['id']);
				}else{
					$this->Session->write('Auth.User.is_admin',true);
				}
			}
        	// AGREGO A LA BITACORA
			$this->loadModel('Bitacora');
			$this->Bitacora->agregarBitacora('Login');
			return $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
		}
		$this->Flash->error(__('Usuario/Contraseña incorrecto. Pruebe nuevamente'));
	}
}

public function logout() {
	$this->loadModel('Bitacora');
	$this->Bitacora->agregarBitacora('logout');
	return $this->redirect($this->Auth->logout());
}

public function comprobarUsername()
{
	$this->autoRender = false;
	$flag = 0;

	$username = $this->User->find('first', array('conditions' => array('User.username' => $this->request->data['username'])));

	if (isset($username) && sizeof($username) > 0) {
		$flag = 1;
	}

	return $flag;
}


/**
 * index method
 *
 * @return void
 */
public function index() {
	$users = $this->User->find('all');
	$roles = $this->User->roles;
	$estados_label = $this->User->estados_label;
	$this->set(compact('estados_label', 'users', 'roles'));	
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	if (!$this->User->exists($id)) {
		throw new NotFoundException(__('Invalid user'));
	}		

	$roles = $this->User->roles;
	$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
	$this->set('user', $this->User->find('first', $options));
	$this->set(compact('roles'));

}

/**
 * add method
 *
 * @return void
 */
public function add() {

	$error = 0;

	if ($this->request->is('post')) {

			// SI EL NOMBRE DE USUARIO NO EXISTE EN LA BD
		if (!$this->User->comprobarUsername($this->request->data['User']['username'])) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {

				// AGREGO LA BITÁCORA
				$this->loadModel('Bitacora');
				$this->Bitacora->agregarBitacora('Crear nuevo usuario: ' . $this->request->data['User']['username']);

				$this->Flash->success(__('El Usuario se grabó correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Ocurrió un problema al guardar el usuario. Intente nuevamente.'));
			}				
		} else {
			$error = 1;
		}
	}

	$roles = $this->User->roles;
	unset($roles[1]);
	$this->set(compact('roles', 'error'));

}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit($id = null) {
	if (!$this->User->exists($id)) {
		throw new NotFoundException(__('Invalid user'));
	}
	if ($this->request->is(array('post', 'put'))) {
		$user = $this->request->data['User']['username'];
		unset($this->request->data['User']['username']);

			// SI LA CONTRASEÑA VIENE VACIA, NO LA TENGO QUE MODIFICAR
		if($this->request->data['User']['password'] == '')
			unset($this->request->data['User']['password']);


		if ($this->User->save($this->request->data)) {

				// AGREGO LA BITÁCORA
			$this->loadModel('Bitacora');
			$this->Bitacora->agregarBitacora('Editar usuario: ' . $user);

			$this->Flash->success(__('El Usuario se editó correctamente.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('Ocurrió un problema al editar el usuario. Intente nuevamente.'));
		}
	} else {
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->request->data = $this->User->find('first', $options);

		$roles = $this->User->roles;
		$estados = array(0 => 'Inactivo', 1 => 'Activo');
		$this->set(compact('roles', 'estados'));

	}
}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function delete($id = null) {
	$this->User->id = $id;
	if (!$this->User->exists()) {
		throw new NotFoundException(__('Invalid user'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->User->delete()) {
		$this->Flash->success(__('The user has been deleted.'));
	} else {
		$this->Flash->error(__('The user could not be deleted. Please, try again.'));
	}
	return $this->redirect(array('action' => 'index'));
}

/**
 * desactivar method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function desactivar($id = null) {
	$this->User->id = $id;
	if (!$this->User->exists()) {
		throw new NotFoundException(__('Invalid user'));
	}

	if ($this->User->saveField('activo', 0)) {
		$user = $this->User->find('first', array('conditions' => array('User.id' => $id), 'recursive' => -1));

		// AGREGO LA BITÁCORA
		$this->loadModel('Bitacora');
		$this->Bitacora->agregarBitacora('Eliminar usuario: ' . $user['User']['username']);

		$this->Flash->success(__('El Usuario se eliminó correctamente.'));
	} else {
		$this->Flash->error(__('Ocurrió un problema al eliminar el usuario. Intente nuevamente.'));
	}
	return $this->redirect(array('action' => 'index'));
}
}
