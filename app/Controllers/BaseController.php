<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');

		helper('currency');
		helper('dummy');
		helper('utils');
		helper('text');

        $session = session();
        $shouldClearPos = (bool) $session->get('clear_pos_after_success');

        if ($shouldClearPos) {
            $path = trim((string) $request->getPath(), '/');

            // Tetap biarkan halaman sukses tampil; clear saat user lanjut ke halaman/aksi lain
            if ($path !== 'delivery') {
                try {
                    $client = new Client();
                    $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/clear-cart-pos');
                    $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/clear-order-pos');
                } catch (\Throwable $e) {
                    // silent fail agar request user tidak terganggu
                }

                $session->remove('clear_pos_after_success');
                $session->remove('payment');
                $session->remove('courier');
                $session->remove('last_order_products');
                $session->remove('last_order_total_price');
                $session->remove('last_order_payment');
                $session->remove('last_order_courier');
            }
        }
    }
}
