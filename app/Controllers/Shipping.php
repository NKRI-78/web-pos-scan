<?php

namespace App\Controllers;

use GuzzleHttp\Client;

use App\Controllers\Base;

class Shipping extends BaseController
{
    
    public function index(): string
    {
        $client = new Client();
        
        $responseOrder = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/order-pos');
        $responseProvince = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/province-pos');
         
        $dataOrder = json_decode($responseOrder->getBody(), true);

        $dataProvince = json_decode($responseProvince->getBody(), true);

        $totalPrice = $dataOrder["data"]["order"]["total_price"];

        $products = $dataOrder["data"]["products"];

        $provinces = $dataProvince["data"];

        return view('shipping/index', [
            "products" => $products,
            "provinces" => $provinces,
            "total_price" => $totalPrice
        ]);
    }

    public function getCity() 
    {
        $provinceId = $this->request->getPost('province_id');

        try {
            $postData = [
                'province_id' => $provinceId,          
            ];

            $client = new Client();

            $response = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/city-pos',
                [
                    'json' => $postData,
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true); 
            
            return $this->response->setJSON([
                'status' => 200, 
                'message' => 'Ok.',
                'data' => $data["data"]
            ]);
        } catch(\GuzzleHttp\Exception\RequestException $e) {
            return $this->response->setJSON([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function savePersonalInfo() 
    {  
        $session = session();

        if (strtolower($this->request->getMethod()) === 'post') {
            $fullname = $this->request->getPost('fullname');
            $phone = $this->request->getPost('phone');
            $address = $this->request->getPost('address');
            $province = $this->request->getPost('province');
            $city = $this->request->getPost('city');
            $postalcode = $this->request->getPost('postal_code');

            $session->set('fullname', $fullname);
            $session->set('phone', $phone);
            $session->set('address', $address);
            $session->set('province', $province);
            $session->set('city', $city);
            $session->set('postal_code', $postalcode);
        }

        return $this->response->setJSON(['status' => 200, 'message' => 'Ok.']);
    }

}
