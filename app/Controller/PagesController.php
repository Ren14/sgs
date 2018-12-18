<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return void
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function display() {
		$this->loadModel('Parametro');

		$noticias = $this->Parametro->find('all', array('conditions' => array('Parametro.nombre' => array('noticia1', 'noticia2', 'noticia3')), 'order' => array('Parametro.modified' => 'DESC')));
		$noticia_1 = $noticias[0];
		$noticia_2 = $noticias[1];
		$noticia_3 = $noticias[2];

		$this->set(compact('noticia_1', 'noticia_2', 'noticia_3'));
	}

	public function homeMovil()
	{
		# code...
	}
}
