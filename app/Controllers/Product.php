<?php

namespace App\Controllers;

use GuzzleHttp\Client;

use App\Controllers\Base;

class Product extends BaseController
{
    
    public function categories($id): string
    {
        try {
            $postData = [
                'cat_id' => $id,          
            ];
            
            $client = new Client();
            $response = $client->request('POST', 'https://api-hp3ki.langitdigital78.com/api/v1/admin/catalog-category-pos',
                [
                    'json' => $postData,
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ]
                ]
            );
            
            $data = json_decode($response->getBody(), true);

            return view('product/categories', ["data" =>  $data["data"]]);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    } 
    
}
