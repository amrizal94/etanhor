<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\AuthModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->AuthModel = new AuthModel();
		$this->Group = "Lasbon Technology Indonesia | IT Solution For Your Bussines";
		helper('date');
		// <--Vertifikasi login -->
		if (session()->getTempdata()) {
			$this->sesi = session()->getTempdata();
		} else {
			$this->sesi = false;
		}
		if (!$this->sesi) {
			session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Please Login</b></div>');
			$this->sesi = 400;
		} else {
			$cek = $this->AuthModel->get_user($this->sesi['username']);
			// dd($cek);
			if ($cek) {
				$cek = $cek['token'];
				if (!$cek == $this->sesi['token']) {
					session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Please Login</b></div>');
					$this->sesi = 400;
				}
			} else {
				session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Username is not registered!</b></div>');
				$this->sesi = 400;
			}
		}
		// <--Vertifikasi login -->
	}
}
