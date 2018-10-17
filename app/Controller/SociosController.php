<?php
App::uses('AppController', 'Controller');
/**
 * Socios Controller
 *
 * @property Socio $Socio
 * @property PaginatorComponent $Paginator
 */
class SociosController extends AppController {

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
	public function index($filtro_estado = 1) {

		$options = array();
		if($filtro_estado == 1)
			$options['Socio.activo'] = 1;
		else if($filtro_estado == 0)
			$options['Socio.activo'] = 0;

		
		$socios = $this->Socio->find('all', array('conditions' => $options));
		$estado = $this->Socio->estado;
		$filtro_estados = $this->Socio->filtro_estado;
		$this->set(compact('socios', 'estado', 'filtro_estados', 'filtro_estado'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Socio->exists($id)) {
			throw new NotFoundException(__('Invalid socio'));
		}
		$options = array('conditions' => array('Socio.' . $this->Socio->primaryKey => $id));
		$socio = $this->Socio->find('first', $options);

		$this->loadModel('Lote');
		$lotes = $this->Lote->find('all', array('conditions' => array('Lote.socio_id' => $socio['Socio']['id']), 'recursive'=>-1));
		$estado = $this->Lote->estado;
		$this->set(compact('socio', 'lotes', 'estado'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$error = 0;

		if ($this->request->is('post')) {
			# Primero creo el Usuario asociado al cliente
			$data['User']['username'] = $this->request->data['Socio']['username'];
			$data['User']['password'] = $this->request->data['Socio']['password'];
			$data['User']['rol'] = 1;

			$this->loadModel('User');

			// SI EL NOMBRE DE USUARIO NO EXISTE EN LA BD
			if (!$this->User->comprobarUsername($data['User']['username'])) {
				$this->User->create();
				if ($this->User->save($data)) {
					$user_id = $this->User->id;
					$this->request->data['Socio']['user_id'] = $user_id;				

					$this->Socio->create();
					if ($this->Socio->save($this->request->data)) {

						// AGREGO LA BITÁCORA
						$this->loadModel('Bitacora');
						$this->Bitacora->agregarBitacora('Crear nuevo Usuario: ' . $data['User']['username'] . '. Crear nuevo Socio: ' . $this->request->data['Socio']['apellido'] . ", " . $this->request->data['Socio']['nombre']);

						$this->Flash->success(__('El socio y el usuario se grabaron correctamente.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Flash->error(__('Ocurrió un error al grabar el Socio. Intente nuevamente.'));
					}
				} else {
					$this->Flash->error(__('Ocurrió un error al grabar el Usuario. Intente nuevamente.'));
				}
			} else {
				$error = 1;
			}
		}

		$this->loadModel('Provincia');
		$provincias = $this->Provincia->getProvincias();

		$users = $this->Socio->User->find('list');
		$this->set(compact('users','error', 'provincias'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Socio->exists($id)) {
			throw new NotFoundException(__('Invalid socio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			if ($this->Socio->save($this->request->data)) {

				// AGREGO LA BITÁCORA
				$this->loadModel('Bitacora');
				$this->Bitacora->agregarBitacora('Editar Socio: ' . $this->request->data['Socio']['apellido'] . ", " . $this->request->data['Socio']['nombre']);

				$this->Flash->success(__('El Socio se editó correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Ocurrió un error al editar el Socio. Intente nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Socio.' . $this->Socio->primaryKey => $id));
			$this->request->data = $this->Socio->find('first', $options);
		}
		$this->loadModel('Provincia');
		$provincias = $this->Provincia->getProvincias();

		$this->loadModel('Localidade');
		$localidades = $this->Localidade->getLocalidades($this->request->data['Socio']['provincia_id']);

		$users = $this->Socio->User->find('list');
		$estados = array(0 => 'Inactivo', 1 => 'Activo');
		$this->set(compact('users', 'provincias', 'localidades', 'estados'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Socio->id = $id;
		if (!$this->Socio->exists()) {
			throw new NotFoundException(__('Invalid socio'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Socio->delete()) {
			$this->Flash->success(__('The socio has been deleted.'));
		} else {
			$this->Flash->error(__('The socio could not be deleted. Please, try again.'));
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
		$this->Socio->id = $id;
		$error = 0;
		$dataSource = $this->Socio->getDataSource();
		$this->loadModel('Bitacora');

		if (!$this->Socio->exists()) {
			throw new NotFoundException(__('Invalid socio'));
		}
		$dataSource->begin();

		// DOY DE BAJA EL SOCIO
		if ($this->Socio->saveField('activo', 0)) {
			$socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $id), 'recursive' => -1));

			// DOY DE BAJA EL USUARIO
			$this->loadModel('User');
			$user = array();
			$user['User']['id'] = $socio['Socio']['user_id'];
			$user['User']['activo'] = 0;

			if($this->User->save($user)){

				// DOY DE BAJA LOS LOTES ASOCIADOS AL SOCIO
				$this->loadModel('Lote');
				$lotes = $this->Lote->find('all', array('conditions' => array('Lote.socio_id' => $socio['Socio']['id']), 'recursive' => -1, 'fields' => array('Lote.id')));

				foreach ($lotes as $key => $lote) {
					$data = array();
					$data['Lote']['id'] = $lote['Lote']['id'];
					$data['Lote']['activo'] = 0;

					if(!$this->Lote->save($data)){
						$error = 1;
					}

				}

				if(!$error){
					// AGREGO LA BITÁCORA				
					if(!$this->Bitacora->agregarBitacora('Eliminar el Socio, Usuario y lotes Asociados: ' . $socio['Socio']['nombre_completo'])){
						$error = 2;
					}					
				}

			} else {
				$error = 3;
			}
			
		} else {
			$error = 4;
		}
		

		if (!$error) {
    	$dataSource->commit();
	    	$this->Flash->success(__('El Socio se eliminó correctamente.'));
		} else {
		    $dataSource->rollback();
		   $this->Flash->error(__('Ocurrió un error al borrar el Socio. Intente nuevamente.'));
		}

		return $this->redirect(array('action' => 'index'));
	}

	public function reporteListadoSociosMora($detallar = 0)
	{
		$this->params['controller'] = 'Reportes';
		set_time_limit(0);
		
		$this->loadModel('Lote');
		$this->loadModel('Recibo');
		$this->loadModel('Cuota');


		# TRAIGO TODOS LOS LOTES DE LOS SOCIOS
		$lotes = $this->Lote->find('all', array('conditions' => array('Lote.activo' => 1), 'recursive' => 0, 'order' => array('Lote.numero')));
		$aux_lotes = array();
		# ITERO POR LOS LOTES
		foreach ($lotes as $key => $lote) {
			$cant_cuotas_adeudadas = 0;
			# consulto la fecha de adquisicion
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
		    
		    # Itero por los meses obtenidos desde la f de adqu hasta hoy
		    foreach ($listaMeses as $key => $value) {
		    	$aux[$key]['Fecha'] = $value;
		    	$cuota = $this->Cuota->find('first', array('conditions' => array(
		    		'Cuota.activo' => 1,
		    		'Cuota.anio_pago' => date('Y', strtotime($value)),
		    		'Cuota.mes_desde <=' => date('m', strtotime($value)),
		    		'Cuota.mes_hasta >=' => date('m', strtotime($value)),
		    		'Cuota.lote_id' => $lote['Lote']['id'],
		    	)));

		    	# Si existe la cuota
		    	if(sizeof($cuota)>0){
		    		$recibo = $this->Recibo->find('first', array('conditions' => array('Recibo.id' => $cuota['Cuota']['recibo_id']), 'recursive' => -1, 'fields' => array('Recibo.numero')));
		    		$aux[$key]['Cuota'] = $cuota['Cuota'];
		    		$aux[$key]['Recibo'] = @$recibo['Recibo'];
		    	} else {
		    		# Esa cuota no la ha pagado el chimpa
		    		$aux_lotes[$lote['Lote']['id']]['Detalle'][$cant_cuotas_adeudadas] = $value;
		    		$cant_cuotas_adeudadas++;
		    	}
		    }
		    $aux_lotes[$lote['Lote']['id']]['Cabecera']['cantidad_total'] = $cant_cuotas_adeudadas;
		    $aux_lotes[$lote['Lote']['id']]['Cabecera']['numero_lote'] = $lote['Lote']['numero'];
		    $aux_lotes[$lote['Lote']['id']]['Cabecera']['Socio'] = $lote['Socio'];
		    $aux_lotes[$lote['Lote']['id']]['Cabecera']['fecha_adq'] = $lote['Lote']['fecha_adquisicion'];
		    $this->log('El socio del lote '.$lote['Lote']['numero']. ' debe todas estas cuotas ' . $cant_cuotas_adeudadas, 'debug');
		}
		
		$this->set(compact('aux_lotes'));

		if($detallar){
			$this->autoRender = false;
			$this->render('/Socios/reporte_listado_socios_mora_detalle');
		}
	}

	public function getReportesIndex(){
		$this->autoRender = false;
		$this->render('/Elements/Reportes/index');
	}
}
