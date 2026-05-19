<?php

namespace App\Controllers;

use GuzzleHttp\Client;

use App\Controllers\Base;

class Order extends BaseController
{
    public function index()
    {
        $client = new Client();
        $response = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/cart-pos');
         
        $data = json_decode($response->getBody(), true);

        $totalPrice = 0;

        foreach ($data["data"] as $key => $val) {
            $totalPrice += $val["price"] * $val["qty"]; 
        }

        return view('order/index', [
            "data" => $data["data"],
            "totalprice" => $totalPrice
        ]);
    }

    public function myOrders()
    {
        $session = session();

        $products = [];
        $totalPrice = 0;

        try {
            $client = new Client();
            $response = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/order-pos');
            $data = json_decode($response->getBody(), true);

            $products = $data["data"]["products"] ?? [];
            $totalPrice = $data["data"]["order"]["total_price"] ?? 0;
        } catch (\Throwable $e) {
            // fallback ke session snapshot
        }

        if (empty($products)) {
            $products = $session->get('last_order_products') ?? [];
            $totalPrice = $session->get('last_order_total_price') ?? 0;
        }

        $payment = $session->get('payment') ?? $session->get('last_order_payment');
        $courier = $session->get('courier') ?? $session->get('last_order_courier');

        return view('order/my_orders', [
            "products" => $products,
            "total_price" => $totalPrice,
            "payment" => $payment,
            "courier" => $courier
        ]);
    }

    public function tracking() 
    {
        $id = $this->request->getGet('id');

        return view('order/tracking', [
            "id" => $id,
        ]);
    }

    public function trackingDummy()
    {
        $products = [
            [
                'name' => 'Men\'s Biore Bright Oil Clear 100gr',
                'img' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=200',
                'price' => 25000,
                'qty' => 2,
            ],
            [
                'name' => 'Vitamin C Serum 30ml',
                'img' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=200',
                'price' => 89000,
                'qty' => 1,
            ],
        ];

        $totalPrice = 0;
        foreach ($products as $p) {
            $totalPrice += ((int) $p['price'] * (int) $p['qty']);
        }

        return view('order/tracking_dummy', [
            'id' => $this->request->getGet('id') ?? 'process',
            'products' => $products,
            'total_price' => $totalPrice,
            'payment' => 'BCA',
            'courier' => 'Kurir (POS Indonesia)',
            'customer' => [
                'fullname' => 'John Doe',
                'phone' => '0812-3456-7890',
                'address' => 'Jl. Contoh No. 123, Jakarta',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12345',
            ],
        ]);
    }

    public function removeCart()
    {
        $catId = $this->request->getPost('cat_id');

        try {
            $postData = [
                'cat_id' => $catId,          
            ];
            
            $client = new Client();
            $response = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/delete-cart-pos',
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
                'message' => 'Ok.'
            ]);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
