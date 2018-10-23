<?php
App::uses('AppController', 'Controller');
/**
 * Bitacoras Controller
 *
 * @property Bitacora $Bitacora
 * @property PaginatorComponent $Paginator
 */
class BitacorasController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
public function index($desde = null, $hasta = null) {

	if($this->Session->read('Auth.User.rol') == 3){
		if($desde == null && $hasta == null){
			$desde = date('Y-m-d')." 00:00:00";
			$hasta = date('Y-m-d')." 23:59:59";
		}
		if($desde != null && $hasta != null){
			$conditions = array(
				'Bitacora.created >=' => $desde." 00:00:00",
				'Bitacora.created <=' => $hasta." 23:59:59"
				//'Bitacora.created BETWEEN ? and ?' => array($desde, $hasta)
			);
		}else if($desde != null && $hasta == null){
			$conditions = array(
				'Bitacora.created >=' => $desde." 00:00:00"
			);
		}else if($hasta != null && $desde == null){
			$conditions = array(
				'Bitacora.created <=' => $hasta." 23:59:59"
			);
		}else{
			$conditions = array();
		}
		$bitacoras = $this->Bitacora->find('all',array(
			'conditions' => $conditions
		));
		$this->set(compact('desde','hasta','bitacoras'));
	} else {
		return $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
	}

}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	if (!$this->Bitacora->exists($id)) {
		throw new NotFoundException(__('Invalid bitacora'));
	}
	$options = array('conditions' => array('Bitacora.' . $this->Bitacora->primaryKey => $id));
	$this->set('bitacora', $this->Bitacora->find('first', $options));
}

/**
 * add method
 *
 * @return void
 */
public function add() {
	if ($this->request->is('post')) {
		$this->Bitacora->create();
		if ($this->Bitacora->save($this->request->data)) {
			$this->Flash->success(__('The bitacora has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('The bitacora could not be saved. Please, try again.'));
		}
	}
	$users = $this->Bitacora->User->find('list');
	$this->set(compact('users'));
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit($id = null) {
	if (!$this->Bitacora->exists($id)) {
		throw new NotFoundException(__('Invalid bitacora'));
	}
	if ($this->request->is(array('post', 'put'))) {
		if ($this->Bitacora->save($this->request->data)) {
			$this->Flash->success(__('The bitacora has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('The bitacora could not be saved. Please, try again.'));
		}
	} else {
		$options = array('conditions' => array('Bitacora.' . $this->Bitacora->primaryKey => $id));
		$this->request->data = $this->Bitacora->find('first', $options);
	}
	$users = $this->Bitacora->User->find('list');
	$this->set(compact('users'));
}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function delete($id = null) {
	$this->Bitacora->id = $id;
	if (!$this->Bitacora->exists()) {
		throw new NotFoundException(__('Invalid bitacora'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->Bitacora->delete()) {
		$this->Flash->success(__('The bitacora has been deleted.'));
	} else {
		$this->Flash->error(__('The bitacora could not be deleted. Please, try again.'));
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
	$this->Bitacora->id = $id;
	if (!$this->Bitacora->exists()) {
		throw new NotFoundException(__('Invalid bitacora'));
	}

	if ($this->Bitacora->saveField('activo', 0)) {
		$this->Flash->success(__('The bitacora has been deleted.'));
	} else {
		$this->Flash->error(__('The bitacora could not be deleted. Please, try again.'));
	}
	return $this->redirect(array('action' => 'index'));
}
}
