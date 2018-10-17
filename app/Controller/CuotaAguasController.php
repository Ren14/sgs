<?php
App::uses('AppController', 'Controller');
/**
 * CuotaAguas Controller
 *
 * @property CuotaAgua $CuotaAgua
 * @property PaginatorComponent $Paginator
 */
class CuotaAguasController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator','Session');

/**
 * index method
 *
 * @return void
 */
public function index($filtro_estado = 99, $filtro_lote = 99, $filtro_socio = 99, $filtro_numero_recibo = 99) {
	$options = array('conditions' => array('CuotaAgua.activo' => 1), 'recursive' => 1);

	if($this->Session->read('Auth.User.rol') == 1){
		array_push($options['conditions'], array('Lote.socio_id' => $this->Session->read('Auth.User.socio_id')));
	} else {
		if($filtro_estado != 99)
			array_push($options['conditions'], array('CuotaAgua.estado' => $filtro_estado));
		if($filtro_lote != 99)
			array_push($options['conditions'], array('CuotaAgua.lote_id' => $filtro_lote));
		if($filtro_numero_recibo != 99)
			array_push($options['conditions'], array('CuotaAgua.recibo_id' => $filtro_numero_recibo));
	}

	$cuotaAguas = $this->CuotaAgua->find('all', $options);

	$this->loadModel('Socio');
	$this->loadModel('Recibo');
	foreach ($cuotaAguas as $key => $cuota) {
		$recibo = $this->Recibo->find('first', array('conditions' => array('Recibo.id' => $cuota['CuotaAgua']['recibo_id']), 'recursive' => -1, 'fields' => array('Recibo.numero', 'Recibo.id')));
		$cuotaAguas[$key]['Recibo'] = $recibo['Recibo'];
		$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $cuota['Lote']['socio_id']), 'fields' => array('Socio.nombre_completo', 'Socio.id'), 'recursive' => -1));
		if($filtro_socio != 99){
			if($filtro_socio == $socio['Socio']['id']){
				$cuotaAguas[$key]['Socio'] = $socio['Socio'];		
			} else {
				unset($cuotaAguas[$key]);
			}
		} else {
			$cuotaAguas[$key]['Socio'] = $socio['Socio'];	
		}
		
	}
	$this->loadModel('Lote');
	$lotes = $this->Lote->find('list', array('conditions' => array('Lote.activo' => 1), 'recursive' => -1, 'fields' => array('Lote.id', 'Lote.numero'))); 	
	$socios = $this->Socio->find('list', array('conditions' => array('Socio.activo' => 1), 'recursive' => -1, 'fields' => array('Socio.id', 'Socio.nombre_completo')));	
	$recibos = $this->Recibo->find('list', array('conditions' => array('Recibo.activo' => 1, 'Recibo.tipo' => 1), 'recursive' => -1, 'fields' => array('Recibo.id', 'Recibo.numero')));
	$estados = $this->CuotaAgua->estados;
	$estados_label = $this->CuotaAgua->estados_label;
	$tipo_pago = $this->CuotaAgua->tipo_pago;
	$this->set(compact('estados', 'estados_label', 'cuotaAguas', 'tipo_pago', 'lotes', 'socios', 'recibos', 'filtro_numero_recibo', 'filtro_socio', 'filtro_lote', 'filtro_estado'));
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	if (!$this->CuotaAgua->exists($id)) {
		throw new NotFoundException(__('Invalid cuota agua'));
	}
	
	$estados = $this->CuotaAgua->estados;

	$this->set(compact('estados'));

	$options = array('conditions' => array('CuotaAgua.' . $this->CuotaAgua->primaryKey => $id));
	$this->set('cuotaAgua', $this->CuotaAgua->find('first', $options));
}

/**
 * add method
 *
 * @return void
 */
public function add($lote_id = null) {
	$this->loadModel('Parametro');
	$monto = $this->Parametro->find('first', array('conditions' => array('Parametro.nombre' => 'cuota_agua'), 'fields' => array('Parametro.valor')));

	if ($this->request->is('post')) {
		$dataSource = $this->CuotaAgua->getDataSource();
		$dataSource->begin();
		$error = 0;
		// Obtengo el ID del socio
		$this->loadModel('Lote');
		$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $this->request->data['CuotaAgua']['lote_id']), 'fields' => array('Lote.socio_id', 'Lote.numero'), 'recursive' => -1));
		// GENERO EL RECIBO
		$this->loadModel('Recibo');
		$data = array();
		$data['Recibo']['socio_id']	= $lote['Lote']['socio_id'];
		$data['Recibo']['monto'] = $this->request->data['CuotaAgua']['monto'];
		$data['Recibo']['tipo'] = 1; # 1 es para las cuotas agua
		$this->Recibo->create();
		
		if($this->Recibo->save($data)){
			$this->CuotaAgua->create();
			$this->request->data['CuotaAgua']['recibo_id'] = $this->Recibo->id;

			# CALCULO EL MONTO A PARTIR DE LA CANTIDAD DE CUOTAS Y EL PARAMETRO, PARA SABER EL ESTADO
			$valor_calculado = $monto['Parametro']['valor'] * $this->request->data['CuotaAgua']['cantidad'];

			if($this->request->data['CuotaAgua']['monto'] != $valor_calculado){
				$this->request->data['CuotaAgua']['estado'] = 3; # si los valores son distintos, es por que a proposito se cambio el valor de la cuota. se le coloca el estado 3 condicional
			}
			$this->log($this->request->data, 'debug');
			if ($this->CuotaAgua->save($this->request->data)) {
				
				// GENERO EL DETALLE DEL RECIBO
				$this->loadModel('ReciboDetalle');
				$data = array();
				$data['ReciboDetalle']['lote_id'] = $this->request->data['CuotaAgua']['lote_id'];
				$data['ReciboDetalle']['recibo_id'] = $this->Recibo->id;
				$data['ReciboDetalle']['cuota_agua_id'] = $this->CuotaAgua->id;
				$this->ReciboDetalle->create();

				if($this->ReciboDetalle->save($data)){
					
					$cuotaAgua = $this->CuotaAgua->find('first', array('conditions' => array('CuotaAgua.id' => $this->CuotaAgua->id), 'recursive' => -1));
					$this->loadModel('Socio');
					$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $lote['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
					// AGREGO LA BITÁCORA
					$this->loadModel('Bitacora');
					if(!$this->Bitacora->agregarBitacora('Agregar Cuota Agua #' . $cuotaAgua['CuotaAgua']['numero']." // Lote #". $lote['Lote']['numero']." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre'])){
						$error = 1;
					}					
				} else {
					$error = 1;
				}
			} else {
				$error = 2;
			}
		} else {
			$error = 1;
		}

		if(!$error){
			$dataSource->commit();
			$this->Flash->success(__('La Cuota del Agua se guardó correctamente.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('Ocurrió un error al guardar la cuota del agua. Intente nuevamente.'));
			return $this->redirect(array('action' => 'add'));
			$dataSource->rollback();
		}
	}

	$this->loadModel('Lote');
	$lotes = $this->Lote->getListaLotes();

	
	$tipo_pago = $this->CuotaAgua->tipo_pago;
	$this->set(compact('lotes', 'lote_id', 'monto', 'tipo_pago'));
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit($id = null) {
	return $this->redirect(array('controller' => 'CuotaAguas' , 'action' => 'index'));
	/*if (!$this->CuotaAgua->exists($id)) {
		throw new NotFoundException(__('Invalid cuota agua'));
	}
	if ($this->request->is(array('post', 'put'))) {
		if ($this->CuotaAgua->save($this->request->data)) {

			$cuotaAgua = $this->CuotaAgua->find('first', array('conditions' => array('CuotaAgua.id' => $this->request->data['CuotaAgua']['id']), 'recursive' => -1));

			// AGREGO LA BITÁCORA
			$this->loadModel('Bitacora');
			$this->Bitacora->agregarBitacora('Editar Cuota Agua #' . $cuotaAgua['CuotaAgua']['numero']);

			$this->Flash->success(__('La Cuota del Agua se editó correctamente.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('Ocurrió un error al editar la cuota del agua. Intente nuevamente.'));
		}
	} else {
		$options = array('conditions' => array('CuotaAgua.' . $this->CuotaAgua->primaryKey => $id));
		$this->request->data = $this->CuotaAgua->find('first', $options);
	}

	$this->loadModel('Socio');
	$socios = $this->Socio->getListaSocios();
	$estados = $this->CuotaAgua->estados;
	$this->set(compact('socios', 'estados'));
	*/
}

/**
 * anularCuotaAgua method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function anularCuotaAgua($id = null, $justificacion = null) {
	$this->CuotaAgua->id = $id;
	$dataSource = $this->CuotaAgua->getDataSource();
	$error = 0;

	if (!$this->CuotaAgua->exists()) {
		throw new NotFoundException(__('Invalid cuota agua'));
	}

	if(!$justificacion){
		return 0;
	}

	$cuotaAgua['CuotaAgua']['id'] = $id;
	$cuotaAgua['CuotaAgua']['justificacion'] = $justificacion;
	$cuotaAgua['CuotaAgua']['estado'] = 2;
	$dataSource->begin();

	if ($this->CuotaAgua->save($cuotaAgua)) {
		$cuotaAgua = $this->CuotaAgua->find('first', array('conditions' => array('CuotaAgua.id' => $id), 'recursive' => -1));

		// DOY DE BAJA EL RECIBO
		$this->loadModel('Recibo');
		$recibo['Recibo']['id'] = $cuotaAgua['CuotaAgua']['recibo_id'];
		$recibo['Recibo']['activo'] = 0;

		if($this->Recibo->save($recibo)){

			// AGREGO LA BITÁCORA
			$this->loadModel('Bitacora');
			$this->loadModel('Lote');
			$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $cuotaAgua['CuotaAgua']['lote_id']), 'fields' => array('Lote.socio_id', 'Lote.numero'), 'recursive' => -1));
			$this->loadModel('Socio');
			$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $lote['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
			if($this->Bitacora->agregarBitacora('Anular Cuota Agua #' . $cuotaAgua['CuotaAgua']['numero'] . " // Motivo: " . $justificacion. ' // Lote #'.$lote['Lote']['numero']." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre'])){
				$error = 0;		
			} else {
				$error = 1;
			}
		} else {
			$error = 2;
		}
	} else {
		$error = 3;
	}

	if (!$error) {
		$dataSource->commit();
		$this->Flash->success(__('La Cuota del Agua #'.$cuotaAgua['CuotaAgua']['numero'].' se anuló correctamente.'));	
	} else {
		$dataSource->rollback();
		$this->Flash->error(__('Ocurrió un error al anular la cuota del agua #'.$cuotaAgua['CuotaAgua']['numero'].'. Intente nuevamente.'));
	}

	return $this->redirect(array('action' => 'index'));
}

public function total(){
	if ($this->request->is('post')) {
		$fechaIni = $this->request->data['CuotaAgua']['fechaIni'];
		$fechaFin = $this->request->data['CuotaAgua']['fechaFin'];
		$conditions = array(
			'conditions' => array(
				'date(CuotaAgua.fecha_pago) BETWEEN ? AND ?' => array($fechaIni, $fechaFin), 
			),
			'fields' => array(
				'SUM(CuotaAgua.monto) AS total'
			)
		);
		$total = $this->CuotaAgua->find('all',$conditions);
		$this->set(compact('total'));
	}
}
}

