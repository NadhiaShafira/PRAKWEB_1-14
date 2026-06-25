<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Helpers yang otomatis dimuat di semua controller
     */
    protected $helpers = ['url', 'form'];

    /**
     * Variabel session
     */
    protected $session;

    /**
     * Inisialisasi Controller
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Wajib dipanggil
        parent::initController($request, $response, $logger);

        // Load session
        $this->session = service('session');
    }
}
