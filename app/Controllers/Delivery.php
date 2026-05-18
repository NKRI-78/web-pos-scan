<?php

namespace App\Controllers;

use GuzzleHttp\Client;

use App\Controllers\Base;

class Delivery extends BaseController
{
    public function index(): string
    {
        $client = new Client();
        $response = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/order-pos');

        $data = json_decode($response->getBody(), true);

        $totalPrice = $data["data"]["order"]["total_price"];

        $products = $data["data"]["products"];

        $session = session();
        
        $payment = $session->get('payment');
        $courier = $session->get('courier');

        $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/clear-cart-pos');

        return view('delivery/index', [
            "products" => $products,
            "total_price" => $totalPrice,
            "payment" => $payment,
            "courier" => $courier
        ]);
    }

    public function savePaymentCourier() 
    {
        $session = session();

        if ($this->request->getMethod() === 'post') {
            
            $payment = $this->request->getPost('payment');
            $courier = $this->request->getPost('courier');

            $session->set('payment', $payment);
            $session->set('courier', $courier);
        }

        return $this->response->setJSON(['status' => 200, 'message' => 'Ok.']);
    }
}
