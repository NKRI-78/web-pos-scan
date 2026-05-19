<?php

namespace App\Controllers;

use GuzzleHttp\Client;

use App\Controllers\Base;

class Delivery extends BaseController
{
    public function index()
    {
        $client = new Client();
        $response = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/order-pos');

        $data = json_decode($response->getBody(), true);

        $totalPrice = $data["data"]["order"]["total_price"];

        $products = $data["data"]["products"];

        $session = session();
        
        $payment = $session->get('payment');
        $courier = $session->get('courier');

        // Simpan snapshot order terakhir agar halaman tracking/detail tidak kosong
        $session->set('last_order_products', $products);
        $session->set('last_order_total_price', $totalPrice);
        $session->set('last_order_payment', $payment);
        $session->set('last_order_courier', $courier);

        // tandai agar cart+order dibersihkan saat user kembali ke Home
        $session->set('clear_pos_after_success', true);

        $qrisCode = null;
        if (strtoupper((string) $payment) === 'QRIS') {
            $qrisCode = 'QRIS-' . strtoupper(substr(md5((string) microtime(true) . rand(1000, 9999)), 0, 16));
        }

        return view('delivery/index', [
            "products" => $products,
            "total_price" => $totalPrice,
            "payment" => $payment,
            "courier" => $courier,
            "qris_code" => $qrisCode
        ]);
    }

    public function savePaymentCourier() 
    {
        $session = session();

        if (strtolower($this->request->getMethod()) === 'post') {
            
            $payment = $this->request->getPost('payment');
            $courier = $this->request->getPost('courier');

            $session->set('payment', $payment);
            $session->set('courier', $courier);
        }

        return $this->response->setJSON(['status' => 200, 'message' => 'Ok.']);
    }
}
