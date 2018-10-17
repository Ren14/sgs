<?php
App::uses('AppController', 'Controller');
/**
 * Localidades Controller
 *
 * @property Localidade $Localidade
 * @property PaginatorComponent $Paginator
 */
class BackupsController extends AppController {

	public function crearBackupDB()
	{
		$this->autoRender = false;
		
		$backup = new BackupExport();

		$filename = $backup->export();

		return $filename;
	}

}