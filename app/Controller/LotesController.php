<?php
App::uses('AppController', 'Controller');
/**
 * Lotes Controller
 *
 * @property Lote $Lote
 * @property PaginatorComponent $Paginator
 */
class LotesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Session');

	public function getLotesBySocio()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$lotes = $this->Lote->find('all', array('conditions' => array('Lote.socio_id' => $this->request->data['socio'], 'Lote.activo' => 1), 'recursive' => -1)); 
		$this->loadModel('Cuota');
		$mes_desde = $this->Cuota->mes_desde;
		$mes_hasta = $this->Cuota->mes_hasta;

		$this->loadModel('Parametro');
		$monto = $this->Parametro->find('first', array('conditions' => array('Parametro.nombre' => 'cuota_mensual'), 'fields' => array('Parametro.valor')));

		$this->set(compact('lotes', 'mes_desde', 'mes_hasta', 'monto'));
		$this->render('/Elements/Lotes/lotes_by_socio');
	}

/**
 * index method
 *
 * @return void
 */
	public function index($filtro_estado = 1) {
		//$options = array();
		$options = array('conditions' => array());
		if($filtro_estado == 1)
			array_push($options['conditions'], array('Lote.activo' => 1));
		else if($filtro_estado == 0)
			array_push($options['conditions'], array('Lote.activo' => 0));

		$this->Lote->recursive = 0;
		if($this->Session->read('Auth.User.rol') == 1){
			array_push($options['conditions'], array('Lote.socio_id' => $this->Session->read('Auth.User.socio_id')));
		}
		$lotes = $this->Lote->find('all', $options);

		$estado = $this->Lote->estado;
		$filtro_estados = $this->Lote->filtro_estado;
		$this->set(compact('estado', 'lotes', 'filtro_estados', 'filtro_estado'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Lote->exists($id)) {
			throw new NotFoundException(__('Invalid lote'));
		}
		$options = array('conditions' => array('Lote.' . $this->Lote->primaryKey => $id));
		$this->set('lote', $this->Lote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if(!$this->Lote->validarNumeroLote($this->request->data['Lote']['numero'])){
				$this->Lote->create();
				if ($this->Lote->save($this->request->data)) {

					// AGREGO LA BITÁCORA
					$this->loadModel('Bitacora');
					$this->loadModel('Socio');
					$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $this->request->data['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
					$this->Bitacora->agregarBitacora('Crear nuevo Lote: #' . $this->request->data['Lote']['numero']." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre']);

					$this->Flash->success(__('El Lote se guardó correctamente.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('Ocurrió un error al guardar el Lote. Intente nuevamente.'));
				}				
			} else {
				$this->Flash->error(__('El Numero de Lote '.$this->request->data['Lote']['numero'].' ya existe en la base de datos.'));
				return $this->redirect(array('action' => 'add'));
			}
		}

		$socios = $this->Lote->Socio->find('list', array('fields' => array('Socio.id', 'Socio.nombre_completo'), 'conditions' => array('Socio.activo' => 1)));
		$this->set(compact('socios'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Lote->exists($id)) {
			throw new NotFoundException(__('Invalid lote'));
		}
		if ($this->request->is(array('post', 'put'))) {
			# Recupero el numero de lote de la BD.
			$numero_actual = $this->Lote->find('first', array('conditions' => array('Lote.id' => $this->request->data['Lote']['id']), 'recursive' => -1));
			# Bandera de control
			$flag = true;
			
			# Si el numero actual de la BD es igual al que viene por request
			if($numero_actual['Lote']['numero'] == $this->request->data['Lote']['numero']){
				$flag = false; # El numero NO existe o dejo pasar
			# Sino, verifico si existe el numero que viene por request
			} else if(!$this->Lote->validarNumeroLote($this->request->data['Lote']['numero'])){
				$flag = false; # El numero no existe
			}

			# Si el numero no existe
			if(!$flag){
				if ($this->Lote->save($this->request->data)) {

					// AGREGO LA BITÁCORA
					$this->loadModel('Bitacora');
					$this->loadModel('Socio');
					$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $this->request->data['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
					$this->Bitacora->agregarBitacora('Editar Lote: #' . $this->request->data['Lote']['numero']." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre']);

					$this->Flash->success(__('El Lote se editó correctamente.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('Ocurrió un error al editar el Lote. Intente nuevamente.'));
				}
			} else {
				$this->Flash->error(__('El Numero de Lote '.$this->request->data['Lote']['numero'].' ya existe en la base de datos.'));
				return $this->redirect(array('action' => 'edit', $this->request->data['Lote']['id']));
			}
		}

		$options = array('conditions' => array('Lote.' . $this->Lote->primaryKey => $id));
		$this->request->data = $this->Lote->find('first', $options);
		$estados = array(0 => 'Inactivo', 1 => 'Activo');
		$socios = $this->Lote->Socio->find('list', array('fields' => array('Socio.id', 'Socio.nombre_completo'), 'conditions' => array('Socio.activo' => 1)));
		$this->set(compact('socios', 'estados'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Lote->id = $id;
		if (!$this->Lote->exists()) {
			throw new NotFoundException(__('Invalid lote'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Lote->delete()) {
			$this->Flash->success(__('The lote has been deleted.'));
		} else {
			$this->Flash->error(__('The lote could not be deleted. Please, try again.'));
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
		$this->Lote->id = $id;
		if (!$this->Lote->exists()) {
			throw new NotFoundException(__('Invalid lote'));
		}
		
		if ($this->Lote->saveField('activo', 0)) {
			$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $id), 'recursive' => -1));

			// AGREGO LA BITÁCORA
			$this->loadModel('Bitacora');
			$this->loadModel('Socio');
			$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $lote['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
			$this->Bitacora->agregarBitacora('Eliminar Lote: #' . $lote['Lote']['numero']." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre']);

			$this->Flash->success(__('El Lote fue eliminado correctamente.'));
		} else {
			$this->Flash->error(__('Ocurrió un error al eliminar el Lote. Intente nuevamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function reporte_listado_socios_mora_agua(){
		//if ($this->request->is('post')) {
			$this->Lote->unbindModel(array('hasMany' => array('ReciboDetalle','Cuota')));
			$Lotes = $this->Lote->find('all',array(
				'conditions' => array(
					'Lote.activo' => 1
				),
				'fields' => array(
					'Lote.id',
					'Lote.numero',
					'Lote.fecha_adquisicion',
					'Lote.socio_id',
					'Socio.id',
					'Socio.nombre',
					'Socio.apellido',
				),

			));
			foreach ($Lotes as $key => $lote) {
				if(!empty($lote['CuotaAgua'])){
					unset($Lotes[$key]);
				}
			}
		//}
			$this->set(compact('Lotes'));
	}
}
