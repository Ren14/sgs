<?php
App::uses('AppController', 'Controller');
/**
 * ReciboDetalles Controller
 *
 * @property ReciboDetalle $ReciboDetalle
 * @property PaginatorComponent $Paginator
 */
class ReciboDetallesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ReciboDetalle->recursive = 0;
		$this->set('reciboDetalles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ReciboDetalle->exists($id)) {
			throw new NotFoundException(__('Invalid recibo detalle'));
		}
		$options = array('conditions' => array('ReciboDetalle.' . $this->ReciboDetalle->primaryKey => $id));
		$this->set('reciboDetalle', $this->ReciboDetalle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ReciboDetalle->create();
			if ($this->ReciboDetalle->save($this->request->data)) {
				$this->Flash->success(__('The recibo detalle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The recibo detalle could not be saved. Please, try again.'));
			}
		}
		$recibos = $this->ReciboDetalle->Recibo->find('list');
		$cuotaAguas = $this->ReciboDetalle->CuotaAgua->find('list');
		$cuotas = $this->ReciboDetalle->Cuotum->find('list');
		$this->set(compact('recibos', 'cuotaAguas', 'cuotas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ReciboDetalle->exists($id)) {
			throw new NotFoundException(__('Invalid recibo detalle'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ReciboDetalle->save($this->request->data)) {
				$this->Flash->success(__('The recibo detalle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The recibo detalle could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ReciboDetalle.' . $this->ReciboDetalle->primaryKey => $id));
			$this->request->data = $this->ReciboDetalle->find('first', $options);
		}
		$recibos = $this->ReciboDetalle->Recibo->find('list');
		$cuotaAguas = $this->ReciboDetalle->CuotaAgua->find('list');
		$cuotas = $this->ReciboDetalle->Cuotum->find('list');
		$this->set(compact('recibos', 'cuotaAguas', 'cuotas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ReciboDetalle->id = $id;
		if (!$this->ReciboDetalle->exists()) {
			throw new NotFoundException(__('Invalid recibo detalle'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ReciboDetalle->delete()) {
			$this->Flash->success(__('The recibo detalle has been deleted.'));
		} else {
			$this->Flash->error(__('The recibo detalle could not be deleted. Please, try again.'));
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
		$this->ReciboDetalle->id = $id;
		if (!$this->ReciboDetalle->exists()) {
			throw new NotFoundException(__('Invalid recibo detalle'));
		}
		
		if ($this->ReciboDetalle->saveField('activo', 0)) {
			$this->Flash->success(__('The recibo detalle has been deleted.'));
		} else {
			$this->Flash->error(__('The recibo detalle could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
