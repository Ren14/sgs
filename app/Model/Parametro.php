<?php
App::uses('AppModel', 'Model');
/**
 * Parametro Model
 *
 */
class Parametro extends AppModel {

	public $estados_label = array(
		0 => '<span class="label label-danger">Inactivo</span>',
		1 => '<span class="label label-primary">Activo</span>'
		);
}
