<?php
App::uses('AppController', 'Controller');
/**
 * Recibos Controller
 *
 * @property Recibo $Recibo
 * @property PaginatorComponent $Paginator
 */
class RecibosController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator','Session');

public function anularRecibo($id = null, $justificacion = null)
{
	$this->Recibo->id = $id;
	$dataSource = $this->Recibo->getDataSource();
	$error = 0;

	if (!$this->Recibo->exists()) {
		throw new NotFoundException(__('Recibo inválido'));
	}

	if(!$justificacion){
		return 0;
	}

		# BUSCO LA INFO DEL RECIBO PARA COLOCAR EN LOS MENSAJES DE BITACORA E INTERFAZ
	$recibo_aux = $this->Recibo->find('first', array('conditions' => array('Recibo.id' => $id), 'recursive' => -1));

		// DOY DE BAJA EL RECIBO
	$this->loadModel('Recibo');
	$recibo['Recibo']['id'] = $id;
	$recibo['Recibo']['activo'] = 0;

	# DOY DE BAJA ELRECIBO
	if($this->Recibo->save($recibo)){

		// DOY DE BAJA EL RECIBO DETALLE
		$this->loadModel('ReciboDetalle');
		if($this->ReciboDetalle->updateAll(array('ReciboDetalle.activo' => 0), array('ReciboDetalle.recibo_id' => $id))){

				# DOY DE BAJA LAS CUOTAS SOCIALES ASOCIADAS AL RECIBO
				$this->loadModel('Cuota');
				if($this->Cuota->updateAll(array('Cuota.estado' => 2, 'Cuota.justificacion' => "'$justificacion'", 'Cuota.activo' => 0), array('Cuota.recibo_id' => $id))){

					// AGREGO LA BITÁCORA
				$this->loadModel('Bitacora');
				$this->loadModel('Socio');
				$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $lote['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
				if($this->Bitacora->agregarBitacora('Anular Recibo #' . $recibo_aux['Recibo']['numero'] . ". Motivo:" . $justificacion." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre'])){
					$error = 0;		
				} else {
					$error = 4;
				}
			} else {
				$error = 3;
			}
		} else {
			$error = 2;
		}
	} else {
		$error = 1;
	}


	if (!$error) {
		$dataSource->commit();
		$this->Flash->success(__('El Recibo #'.$recibo_aux['Recibo']['numero'].' se anuló correctamente.'));	
	} else {
		$dataSource->rollback();
		$this->Flash->error(__('Ocurrió un error al anular el Recibo #'.$recibo_aux['Recibo']['numero'].'. Intente nuevamente. Error #' . $error));
	}

	return $this->redirect(array('action' => 'index'));
}

/**
 * index method
 *
 * @return void
 */
public function index($filtro_estado = 99, $filtro_tipo = 99, $filtro_socio = 99) {
	$this->Recibo->recursive = 2;
	if($this->Session->read('Auth.User.rol') == 1){
		$recibos = $this->Recibo->find('all',array(
			'conditions' => array(
				'Recibo.socio_id' => $this->Session->read('Auth.User.socio_id')
			)
		));
	}else{
		$options = array();
		if($filtro_estado != 99)
			$options['Recibo.activo'] = $filtro_estado;
		if($filtro_tipo != 99)
			$options['Recibo.tipo'] = $filtro_tipo;
		if($filtro_socio != 99)
			$options['Recibo.socio_id'] = $filtro_socio;
		$recibos = $this->Recibo->find('all', array('conditions' => $options));
	}

		/*$this->loadModel('Socio');
		foreach ($recibos as $key => $recibo) {
			$recibos[$key]['Socio']['nombre_completo'] = $this->Socio->getNombreCompleto($recibo['Lote']['socio_id']);
		}*/
		$this->loadModel('Socio');
		$socios = $this->Socio->find('list', array('conditions' => array('Socio.activo' => 1), 'recursive' => -1, 'fields' => array('Socio.id', 'Socio.nombre_completo')));	
		$tipo = $this->Recibo->tipo;
		$estados_label = $this->Recibo->estados_label;
		$estados = $this->Recibo->estados;
		$this->set(compact('estados_label', 'recibos', 'tipo', 'socios', 'filtro_estado', 'filtro_socio', 'filtro_tipo', 'estados'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null , $imprimir = null) {
	if (!$this->Recibo->exists($id)) {
		throw new NotFoundException(__('Invalid recibo'));
	}

	$options = array('conditions' => array('Recibo.' . $this->Recibo->primaryKey => $id), 'recursive' => 1);
	$recibo = $this->Recibo->find('first', $options);

	$this->loadModel('CuotaAgua');
	$estados_ca = $this->CuotaAgua->estados_label;
	$this->loadModel('Cuota');
	$estados_c = $this->Cuota->estados_label;
	$meses = $this->Cuota->mes_desde;
	$this->loadModel('Lote');
	foreach ($recibo['ReciboDetalle'] as $key => $detalle) {
			# CUOTA AGUA
		if($recibo['Recibo']['tipo'] == 1){
			$cuota_agua = $this->CuotaAgua->find('first', array('conditions' => array('CuotaAgua.id' => $detalle['cuota_agua_id']), 'recursive' => -1, 'fields' => array('CuotaAgua.numero', 'CuotaAgua.monto', 'CuotaAgua.cantidad', 'CuotaAgua.estado', 'CuotaAgua.fecha_pago')));
			$recibo['ReciboDetalle'][$key]['cuota_numero'] = $cuota_agua['CuotaAgua']['numero'];
			$recibo['ReciboDetalle'][$key]['cuota_monto'] = $cuota_agua['CuotaAgua']['monto'];
			$recibo['ReciboDetalle'][$key]['descripcion'] = $cuota_agua['CuotaAgua']['cantidad'] . " Cuotas";
			$recibo['ReciboDetalle'][$key]['estado'] = $estados_ca[$cuota_agua['CuotaAgua']['estado']];
			$recibo['ReciboDetalle'][$key]['fecha_pago'] = date('d-m-Y', strtotime($cuota_agua['CuotaAgua']['fecha_pago']));
		}

			# CUOTA
		if($recibo['Recibo']['tipo'] == 2){
			$cuota = $this->Cuota->find('first', array('conditions' => array('Cuota.id' => $detalle['cuota_id']), 'recursive' => -1, 'fields' => array('Cuota.numero', 'Cuota.monto', 'Cuota.anio_pago', 'Cuota.mes_desde', 'Cuota.mes_hasta', 'Cuota.fecha_pago', 'Cuota.estado', 'Cuota.observacion')));
			$recibo['ReciboDetalle'][$key]['cuota_numero'] = $cuota['Cuota']['numero'];
			$recibo['ReciboDetalle'][$key]['cuota_monto'] = $cuota['Cuota']['monto'];
			$recibo['ReciboDetalle'][$key]['descripcion'] = $cuota['Cuota']['anio_pago'] . " " . $meses[$cuota['Cuota']['mes_desde']] . "/" . $meses[$cuota['Cuota']['mes_hasta']];
			$recibo['ReciboDetalle'][$key]['estado'] = $estados_c[$cuota['Cuota']['estado']];
			$recibo['ReciboDetalle'][$key]['fecha_pago'] = date('d-m-Y', strtotime($cuota['Cuota']['fecha_pago']));
			$recibo['ReciboDetalle'][$key]['observacion'] = $cuota['Cuota']['observacion'];
		}

			# LOTE
		$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $detalle['lote_id']), 'recursive' => -1, 'fields' => array('Lote.numero')));
		$recibo['ReciboDetalle'][$key]['lote_numero'] = $lote['Lote']['numero'];
	}

	$this->loadModel('CuotaAgua');
	
	$estados_label = $this->Recibo->estados_label;
	$tipo = $this->Recibo->tipo;
	$monto = $recibo['Recibo']['monto'];
	$recibo_duplicado = $recibo;
	$monto_duplicado = $monto;
	$tipo_duplicado = $tipo;
	$this->set(compact('recibo', 'tipo', 'monto', 'recibo_duplicado', 'monto_duplicado', 'tipo_duplicado', 'estados_label'));


	if($imprimir){
		$this->loadModel('Parametro');
		$cuit = $this->Parametro->find('first' , array('conditions' => array('Parametro.nombre' => 'cuit')));
		$direccion = $this->Parametro->find('first' , array('conditions' => array('Parametro.nombre' => 'direccion')));
		$personeria_juridica = $this->Parametro->find('first' , array('conditions' => array('Parametro.nombre' => 'personeria_juridica')));
		$telefono = $this->Parametro->find('first' , array('conditions' => array('Parametro.nombre' => 'telefono')));
		$denominacion = $this->Parametro->find('first' , array('conditions' => array('Parametro.nombre' => 'denominacion')));
		$cuit_2 = $cuit;
		$direccion_2 = $direccion;
		$personeria_juridica_2 = $personeria_juridica;
		$denominacion_2 = $denominacion;
		$this->autoRender = false;
		$this->layout = 'imprimir';
		$this->set(compact('cuit', 'direccion', 'personeria_juridica', 'telefono', 'denominacion'));
		$this->render('/Elements/Recibos/imprimir');
	}
}

/**
 * add method
 *
 * @return void
 */
public function add() {
	if ($this->request->is('post')) {
		$this->Recibo->create();
		if ($this->Recibo->save($this->request->data)) {
			$this->Flash->success(__('The recibo has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('The recibo could not be saved. Please, try again.'));
		}
	}
	$lotes = $this->Recibo->Lote->find('list');
	$this->set(compact('lotes'));
}



	public function total_recaudado(){
		if($this->request->is('post')){
			$fecha_ini = $this->request->data['Recibo']['fecha_ini'];
			$fecha_fin = $this->request->data['Recibo']['fecha_fin'];
			$optionsTotal = array(
				'conditions' => array(
					'date(Cuota.fecha_pago) BETWEEN ? AND ?' => array($fecha_ini, $fecha_fin),
					'Cuota.recibo_id <>' => NULL
				),
				'fields' => array(
					'sum(Cuota.monto) AS monto'
				)
			);
			$this->loadModel('Cuota');
			$this->loadModel('CuotaAgua');
			

			$TotalSocial = $this->Cuota->find('all',$optionsTotal);

			$optionsTotal['conditions'] = array('date(CuotaAgua.fecha_pago) BETWEEN ? AND ?' => array($fecha_ini, $fecha_fin), 'CuotaAgua.recibo_id <>' => NULL ); 	
			$optionsTotal['fields'] = array('sum(CuotaAgua.monto) AS monto'); 	
			
			$TotalAgua = $this->CuotaAgua->find('all',$optionsTotal);

			$this->set('TOTAL',$TotalSocial[0][0]['monto']+$TotalAgua[0][0]['monto']);
			$this->set('TotalSocial',$TotalSocial[0][0]['monto']);
			$this->set('TotalAgua',$TotalAgua[0][0]['monto']);
			
		}

	}
}
