 <?php
App::uses('AppController', 'Controller');
/**
 * Cuotas Controller
 *
 * @property Cuota $Cuota
 * @property PaginatorComponent $Paginator
 */
class CuotasController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator','Session');

	public function getCuotasHistoricas()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->loadModel('Lote');
		$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $this->request->data['lote_id']), 'recursive' => 0));
		
		/**
		 * Cuando la fecha de adquisición del lote es entre los días 29 y 31 del mes, al querer generar más adelante
		 * el mes de febrero con esa fecha, no se puede por lo tanto, el mes de febrero no figura en el listado.
		 * Con esto se soluciona el problema.
		 */
		if(substr($lote['Lote']['fecha_adquisicion'], 8,2) > 28){
			$lote['Lote']['fecha_adquisicion'] = substr($lote['Lote']['fecha_adquisicion'], 0,8) . "28";
		}

		$inicio= date('Y-m', strtotime($lote['Lote']['fecha_adquisicion'])) ;
		$fin=date('Y-m');
		 
		$datetime1=new DateTime($inicio);
		$datetime2=new DateTime($fin);
		 
		# obtenemos la diferencia entre las dos fechas
		$interval=$datetime2->diff($datetime1);
		 
		# obtenemos la diferencia en meses
		$intervalMeses=$interval->format("%m");
		# obtenemos la diferencia en años y la multiplicamos por 12 para tener los meses
		$intervalAnos = $interval->format("%y")*12;
		 
		$diferencia = ($intervalMeses+$intervalAnos);

		$f1 = new DateTime(date('Y-m-d', strtotime($lote['Lote']['fecha_adquisicion'])));
	    $f2 = new DateTime(date('Y-m-d'));

	    $cant_meses = $f2->diff($f1);
	    $cant_meses = $cant_meses->format('%m'); //devuelve el numero de meses entre ambas fechas.
	    $listaMeses = array($f1->format('Y-m-d'));

	    for ($i = 1; $i <= $diferencia; $i++) {

	    	$ultimaFecha = end($listaMeses);
	    	$ultimaFecha = new DateTime($ultimaFecha);
	    	$nuevaFecha = $ultimaFecha->add(new DateInterval("P1M"));
	    	$nuevaFecha = $nuevaFecha->format('Y-m-d');
	    	
	    	array_push($listaMeses, $nuevaFecha) ;

	    }
	    $aux = array();
	    $this->loadModel('Recibo');
	    foreach ($listaMeses as $key => $value) {
	    	$aux[$key]['Fecha'] = $value;
	    	$cuota = $this->Cuota->find('first', array('conditions' => array(
	    		'Cuota.activo' => 1,
	    		'Cuota.anio_pago' => date('Y', strtotime($value)),
	    		'Cuota.mes_desde <=' => date('m', strtotime($value)),
	    		'Cuota.mes_hasta >=' => date('m', strtotime($value)),
	    		'Cuota.lote_id' => $this->request->data['lote_id'],
	    	)));

	    	if(sizeof($cuota)>0){
	    		$recibo = $this->Recibo->find('first', array('conditions' => array('Recibo.id' => $cuota['Cuota']['recibo_id']), 'recursive' => -1, 'fields' => array('Recibo.numero')));
	    		$aux[$key]['Cuota'] = $cuota['Cuota'];
	    		$aux[$key]['Recibo'] = @$recibo['Recibo'];
	    	}
	    }

		$nombre_mes = $this->Cuota->mes_desde;
		$tipo_pago = $this->Cuota->tipo_pago;
		$this->set(compact('lote', 'diferencia', 'nombre_mes', 'listaMeses', 'aux', 'tipo_pago'));
		$this->render('/Elements/Cuotas/cuotas_historicas');
	}	

	public function addCuotaHistoricas()
	{

		$this->autoRender = false;
		$cuota = array();
		$cuota['Cuota']['lote_id'] = $this->request->data['lote_id'];
		$cuota['Cuota']['monto'] = $this->request->data['monto'];
		$cuota['Cuota']['estado'] = 1;
		$cuota['Cuota']['anio_pago'] = $this->request->data['anio_pago'];
		$cuota['Cuota']['mes_desde'] = $this->request->data['mes_pago'];
		$cuota['Cuota']['mes_hasta'] = $this->request->data['mes_pago'];
		$cuota['Cuota']['activo'] = 1;
		$cuota['Cuota']['observacion'] = $this->request->data['observacion'] . " [Cobro Histórico]";
		$cuota['Cuota']['tipo_pago'] = $this->request->data['tipo_pago'];
		$cuota['Cuota']['fecha_pago'] = $this->request->data['fecha_pago'];
		$cuota['Cuota']['recibo'] = $this->request->data['recibo'];

		$this->Cuota->create();
		if($this->Cuota->save($cuota)){
			$cuotaAux = $this->Cuota->find('first', array('conditions' => array('Cuota.id' => $this->Cuota->id), 'recursive' => -1, 'fields' => array('Cuota.numero')));
			// AGREGO LA BITÁCORA
			$this->loadModel('Bitacora');
			$this->loadModel('Lote');
			$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $this->request->data['lote_id']), 'fields' => array('Lote.socio_id', 'Lote.numero'), 'recursive' => -1));
			$this->loadModel('Socio');
			$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $lote['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
			$this->Bitacora->agregarBitacora('Nueva Cuota Historica #' . $cuotaAux['Cuota']['numero']. ' // Lote #'.$lote['Lote']['numero']." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre']);
			return 1;
		} else {
			return 0;
		}
	}

	public function editCuotaHistoricas()
	{

		$this->autoRender = false;
		$cuota = array();
		$cuota['Cuota']['id'] = $this->request->data['id'];
		$cuota['Cuota']['lote_id'] = $this->request->data['lote_id'];
		$cuota['Cuota']['monto'] = $this->request->data['monto'];
		$cuota['Cuota']['estado'] = 1;
		$cuota['Cuota']['anio_pago'] = $this->request->data['anio_pago'];
		$cuota['Cuota']['mes_desde'] = $this->request->data['mes_pago'];
		$cuota['Cuota']['mes_hasta'] = $this->request->data['mes_pago'];
		$cuota['Cuota']['activo'] = 1;
		$cuota['Cuota']['observacion'] = $this->request->data['observacion'] . " [Cobro Histórico]";
		$cuota['Cuota']['tipo_pago'] = $this->request->data['tipo_pago'];
		$cuota['Cuota']['fecha_pago'] = $this->request->data['fecha_pago'];
		$cuota['Cuota']['recibo'] = $this->request->data['recibo'];

		if($this->Cuota->save($cuota)){
			$cuotaAux = $this->Cuota->find('first', array('conditions' => array('Cuota.id' => $this->request->data['id']), 'recursive' => -1, 'fields' => array('Cuota.numero')));
			// AGREGO LA BITÁCORA
			$this->loadModel('Bitacora');
			$this->loadModel('Lote');
			$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $this->request->data['lote_id']), 'fields' => array('Lote.socio_id', 'Lote.numero'), 'recursive' => -1));
			$this->loadModel('Socio');
			$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $lote['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
			$this->Bitacora->agregarBitacora('Editar Cuota Historica #' . $cuotaAux['Cuota']['numero']. ' // Lote #'.$lote['Lote']['numero']." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre']);


			if($this->Cuota->save($cuota)){
				return 1;
			} else {
				return 0;
			}
		}
	}

	/**
	 * Metodo que renderiza la vista incial
	 */
	public function add_historicas($lote_id = null)
	{
		$this->loadModel('Lote');
		$lotes = $this->Lote->getListaLotes();

		
		$tipo_pago = $this->Cuota->tipo_pago;
		$this->set(compact('lotes', 'lote_id', 'tipo_pago'));
	}

/**
 * index method
 *
 * @return void
 */
public function index($filtro_estado = 99, $filtro_lote = 99, $filtro_socio = 99, $filtro_numero_recibo = 99,$desde = null, $hasta = null) {
	$rol = $this->Session->read('Auth.User.rol');
	if($rol == 1){  # Para el Rol 1 (Socio)
		$options = array(
				//'Cuota.activo' => 1,
				'Lote.socio_id' => $this->Session->read('Auth.User.socio_id'),
				'Cuota.estado' => array(0,1,3), # Solicito las cuotas con estado Pendiente, Cobrado o Cobro Condicional
			);
	}else{
		$options = array();
		//$limit = 10;
		//$options['Cuota.activo'] = 1;
		if($filtro_estado != 99){
			$options['Cuota.estado'] = $filtro_estado;			
		}
		if($filtro_lote != 99){
			$options['Cuota.lote_id'] = $filtro_lote;			
		}
		if($filtro_numero_recibo != 99){
			$options['Cuota.recibo_id'] = $filtro_numero_recibo;			
		}
		if($desde == null && $hasta == null){
			$desde = date('Y-m-d')." 00:00:00";
			$hasta = date('Y-m-d')." 23:59:59";
		}
		if($desde != null && $hasta != null){
			$options['Cuota.fecha_pago >='] = $desde." 00:00:00";
			$options['Cuota.fecha_pago <='] = $hasta." 23:59:59";
		}else if($desde != null && $hasta == null){
			$options['Cuota.fecha_pago >='] = $desde." 00:00:00";
		}else if($hasta != null && $desde == null){
			$options['Cuota.fecha_pago <='] = $hasta." 23:59:59";
		}
	}
	
	$cuotas = $this->Cuota->find('all', array('conditions' => $options, 'order' => array('Cuota.created' => 'desc')));	

	$this->loadModel('Lote');
	foreach ($cuotas as $key => $cuota) {
		$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $cuota['Cuota']['lote_id']), 'fields' => array('Socio.id', 'Socio.nombre', 'Socio.apellido'), 'recursive' => 0));
		
		if($filtro_socio != 99){
			if($filtro_socio == $lote['Socio']['id']){
				$cuotas[$key]['Socio'] = $lote['Socio'];		
			} else {
				unset($cuotas[$key]);
			}
		} else {
			$cuotas[$key]['Socio'] = $lote['Socio'];			
		}
	}
	$lotes = $this->Lote->find('list', array('conditions' => array('Lote.activo' => 1), 'recursive' => -1, 'fields' => array('Lote.id', 'Lote.numero'))); 
	$this->loadModel('Socio');
	$socios = $this->Socio->find('list', array('conditions' => array('Socio.activo' => 1), 'recursive' => -1, 'fields' => array('Socio.id', 'Socio.nombre_completo')));
	$this->loadModel('Recibo');
	$recibos = $this->Recibo->find('list', array('conditions' => array('Recibo.activo' => 1, 'Recibo.tipo' => 2), 'recursive' => -1, 'fields' => array('Recibo.id', 'Recibo.numero')));
	$estados = $this->Cuota->estados;
	$estados_label = $this->Cuota->estados_label;
	$mes_desde = $this->Cuota->mes_desde;
	$mes_hasta = $this->Cuota->mes_hasta;

	$this->set(compact('estados', 'estados_label', 'mes_desde', 'mes_hasta', 'cuotas', 'filtro_estado', 'filtro_socio', 'filtro_lote', 'lotes', 'socios', 'filtro_numero_recibo', 'recibos','desde','hasta'));
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	if (!$this->Cuota->exists($id)) {
		throw new NotFoundException(__('Invalid cuota'));
	}
	$options = array('conditions' => array('Cuota.' . $this->Cuota->primaryKey => $id));
	$this->set('cuota', $this->Cuota->find('first', $options));

	$this->loadModel('Socio');
	$socios = $this->Socio->getListaSocios();
	$estados_label = $this->Cuota->estados_label;
	$estados = $this->Cuota->estados;
	$mes_desde = $this->Cuota->mes_desde;
	$mes_hasta = $this->Cuota->mes_hasta;
	$this->set(compact('socios', 'estados', 'mes_desde', 'mes_hasta', 'estados_label'));
}

/**
 * add method
 *
 * @return void
 */
public function add($socio_id = null) {
	$this->loadModel('Parametro');
	$monto = $this->Parametro->find('first', array('conditions' => array('Parametro.nombre' => 'cuota_mensual'), 'fields' => array('Parametro.valor')));
	$error = 0;
	if ($this->request->is('post')) {

		$this->log($this->request->data, 'debug');

		$dataSource = $this->Cuota->getDataSource();
		$dataSource->begin();

			// GENERO EL RECIBO
		$this->loadModel('Recibo');
		$this->loadModel('ReciboDetalle');
		$monto_total = 0;
			# Calculo el Total para el recibo, a partir del detalle
		foreach ($this->request->data['Cuota']['detalle'] as $key => $value) {				
			if($value['confirmar'])
				$monto_total += $value['monto'];
		}
		$data = array();
		$data['Recibo']['socio_id']	= $this->request->data['Cuota']['socio_id'];
		$data['Recibo']['monto'] = $monto_total;
		$data['Recibo']['tipo'] = 2; # 1 es para las cuotas menuales
		
		if($monto_total > 0){
			$this->Recibo->create();			
			if($this->Recibo->save($data)){
				
				// GENERO LA CUOTA
				foreach ($this->request->data['Cuota']['detalle'] as $key => $value) {
					// SI EL CHECKBOX ESTABA EN CONFIRMAR OK
					if($value['confirmar']){
						$cuota = array();
						$cuota['Cuota']['lote_id'] = $value['lote_id'];
						$cuota['Cuota']['recibo_id'] = $this->Recibo->id;
						$cuota['Cuota']['fecha_pago'] = $this->request->data['Cuota']['fecha_pago'];
						$cuota['Cuota']['monto'] = $value['monto'];
						$cuota['Cuota']['recibo'] = @$this->request->data['Cuota']['recibo'];
						# CALCULO EL ESTADO DE LA CUOTA
						$meses = $value['mes_hasta'] - $value['mes_desde'];
						$meses++;
						$monto_calculado = $monto['Parametro']['valor'] * $meses;
						$cuota['Cuota']['estado'] = 1;
						if($monto_calculado != $value['monto']){
							$cuota['Cuota']['estado'] = 3; # si los valores son distintos, es por que a proposito se cambio el valor de la cuota. se le coloca el estado 3 condicional
						}					
						$cuota['Cuota']['anio_pago'] = $value['anio_pago'];	
						$cuota['Cuota']['mes_desde'] = $value['mes_desde'];
						$cuota['Cuota']['mes_hasta'] = $value['mes_hasta'];
						$cuota['Cuota']['observacion'] = @$value['observacion'];
						$cuota['Cuota']['tipo_pago'] = $this->request->data['Cuota']['tipo_pago'];

						# Si viene el adjunto, lo guardo
						if(isset($this->request->data['Cuota']['photo']) && $this->request->data['Cuota']['photo'] != ''){
							$cuota['Cuota']['photo'] = $this->request->data['Cuota']['photo'];
							$cuota['Cuota']['photo_dir'] = $this->request->data['Cuota']['photo_dir'];	
						}

						$this->Cuota->create();
						if($this->Cuota->save($cuota)){
							
							// GENERO EL RECIBO DETALLE
							$data = array();
							$data['ReciboDetalle']['recibo_id'] = $this->Recibo->id;
							$data['ReciboDetalle']['cuota_id'] = $this->Cuota->id;
							$data['ReciboDetalle']['lote_id'] = $value['lote_id'];

							$this->ReciboDetalle->create();
							if($this->ReciboDetalle->save($data)){
								$cuotaAux = $this->Cuota->find('first', array('conditions' => array('Cuota.id' => $this->Cuota->id), 'recursive' => -1, 'fields' => array('Cuota.numero')));
								// AGREGO LA BITÁCORA
								$this->loadModel('Bitacora');
								$this->loadModel('Lote');
								$lote = $this->Lote->find('first', array('conditions' => array('Lote.id' => $value['lote_id']), 'fields' => array('Lote.socio_id', 'Lote.numero'), 'recursive' => -1));
								$this->loadModel('Socio');
								$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $lote['Lote']['socio_id']), 'fields' => array('Socio.apellido', 'Socio.nombre'), 'recursive' => -1));
								$this->Bitacora->agregarBitacora('Nueva Cuota Mensual #' . $cuotaAux['Cuota']['numero']. ' // Lote #'.$lote['Lote']['numero']." // Socio ".$socio['Socio']['apellido'].", ".$socio['Socio']['nombre']);
							} else {							
								$error = 3;
							}

						} else {
							$error = 2;
						}
					}
				}
				
			} else {
				$error = 1;
			}

			if(!$error){				
				$this->Flash->success(__('La Cuota se guardó correctamente.'));
				$dataSource->commit();
			} else {
				$dataSource->rollback();
			}	
		}

		return $this->redirect(array('action' => 'index'));
	}

	$this->loadModel('Socio');
	$socios = $this->Socio->getListaSocios();

	$this->loadModel('Recibo');
	$numero = $this->Recibo->find('first', array('conditions' => array('Recibo.activo' => 1), 'fields' => array('MAX(Recibo.numero) as numero')));

	

	if($numero == null)
		$numero = 1;
	else
		$numero = $numero[0]['numero'] + 1;

	$mes_desde = $this->Cuota->mes_desde;
	$mes_hasta = $this->Cuota->mes_hasta;
	$tipo_pago = $this->Cuota->tipo_pago;
	$this->set(compact('socios', 'numero', 'mes_desde', 'mes_hasta', 'socio_id', 'monto', 'tipo_pago'));
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit($id = null) {
	if (!$this->Cuota->exists($id)) {
		throw new NotFoundException(__('Invalid cuota'));
	}
	if ($this->request->is(array('post', 'put'))) {
		$this->request->data['Cuota']['fecha_pago'] = date('Y-m-d', strtotime($this->request->data['Cuota']['fecha_pago']));
		if ($this->Cuota->save($this->request->data)) {
			$cuota = $this->Cuota->find('first', array('conditions' => array('Cuota.id' => $this->request->data['Cuota']['id']), 'recursive' => -1));

				// AGREGO LA BITÁCORA
			$this->loadModel('Bitacora');
			$this->Bitacora->agregarBitacora('Editar Cuota #' . $cuota['Cuota']['recibo_interno']);

			$this->Flash->success(__('La Cuota se editó correctamente.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('Ocurrió un error al editar la Cuota. Intente nuevamente.'));
		}
	} else {
		$options = array('conditions' => array('Cuota.' . $this->Cuota->primaryKey => $id));
		$this->request->data = $this->Cuota->find('first', $options);

		$this->loadModel('Socio');
		$socios = $this->Socio->getListaSocios();
		$estados = $this->Cuota->estados;
		$mes_desde = $this->Cuota->mes_desde;
		$mes_hasta = $this->Cuota->mes_hasta;
		$this->set(compact('socios', 'estados', 'mes_desde', 'mes_hasta'));
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
	$this->Cuota->id = $id;
	if (!$this->Cuota->exists()) {
		throw new NotFoundException(__('Invalid cuota'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->Cuota->delete()) {
		$this->Flash->success(__('The cuota has been deleted.'));
	} else {
		$this->Flash->error(__('The cuota could not be deleted. Please, try again.'));
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
	$this->Cuota->id = $id;
	if (!$this->Cuota->exists()) {
		throw new NotFoundException(__('Invalid cuota'));
	}

	if ($this->Cuota->saveField('activo', 0)) {
		$cuota = $this->Cuota->find('first', array('conditions' => array('Cuota.id' => $id), 'recursive' => -1));

			// AGREGO LA BITÁCORA
		$this->loadModel('Bitacora');
		$this->Bitacora->agregarBitacora('Eliminar cuota #' . $cuota['Cuota']['recibo_interno']);

		$this->Flash->success(__('La Cuota se eliminó correctamente.'));
	} else {
		$this->Flash->error(__('Ocurrió un error al eliminar la Cuota. Intente nuevamente.'));
	}
	return $this->redirect(array('action' => 'index'));
}


public function total(){
	$this->loadModel('CuotaAgua');
	if ($this->request->is('post')) {
		$this->log($this->request->data, 'debug');
		$fechaIni = $this->request->data['Cuota']['fecha_ini'];
		$fechaFin = $this->request->data['Cuota']['fecha_fin'];
		$auxTotal = array();
		$modelos = array(0 => 'Cuota', 1 => 'CuotaAgua');
		foreach ($modelos as $key => $modelo) {
			$conditions = array(
				'conditions' => array(
					'date('.$modelo.'.fecha_pago) BETWEEN ? AND ?' => array($fechaIni, $fechaFin), 
				),
				'fields' => array(
					'SUM('.$modelo.'.monto) AS total'
				)
			);
			if($modelo == 'Cuota'){
				array_push($auxTotal, $this->Cuota->find('all',$conditions));
			}else{
				array_push($auxTotal, $this->CuotaAgua->find('all',$conditions));
			}
		}
		$TOTAL_C = 0;
		$total_social = $auxTotal[0][0][0]['total'];
		$total_agua = $auxTotal[1][0][0]['total'];
		foreach ($auxTotal as $key => $total) {
			$TOTAL_C += $total[0][0]['total'];
		}
		$this->log($auxTotal, 'debug');
		$this->set(compact('auxTotal','TOTAL_C','total_social','total_agua'));
	}
}
public function validarCuota(){
	$this->autoRender = false;
	if ($this->request->is('post')) {
		//$this->log($this->request->data,'debug');
		$lote_id = $this->request->data['lote_id'];
		$año = $this->request->data['anio'];
		$mes_d = $this->request->data['mes_d'];
		$mes_h = $this->request->data['mes_h'];
		$range = range($mes_d, $mes_h);
		if(count($range) > 1){
			$type = 'all';
		}else{
			$conditions = array(
				'Cuota.lote_id' => $lote_id,
				'Cuota.anio_pago' => $año,
				'Cuota.mes_desde' => $mes_d,
				'Cuota.mes_hasta' => $mes_h
			);
			$type = 'first';
		}
		$flag = false;
		if($type == 'all'){
			foreach ($range as $k => $r) {
				$cuota = $this->Cuota->find($type,array(
					'conditions' => array(
						'Cuota.lote_id' => $lote_id,
						'Cuota.anio_pago' => $año,
						'AND' => array(
							array('Cuota.mes_desde <=' => $r),
							array('Cuota.mes_hasta >=' => $r)
						)
					),
					'recursive' => -1,
					'fields' => array(
						'Cuota.id',
						'Cuota.mes_desde',
						'Cuota.mes_hasta'
					)
				));
				if(!empty($cuota)){
					$flag = true;
					break;
				}else{
					$flag = false;
				}
			}
		}else{
			$this->log('llego','debug');
			$cuota = $this->Cuota->find($type,array(
				'conditions' => $conditions,
				'recursive' => -1,
				'fields' => array(
					'Cuota.id',
					'Cuota.mes_desde',
					'Cuota.mes_hasta'
				)
			));
			if(!empty($cuota)){
				$flag = true;
			}else{
				$flag = false;
			}
		}
		return $flag;
	}else{
		//GET 
	}
}	

}