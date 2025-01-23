<?php
namespace App\Services;

use GuzzleHttp\Client;

class FacePPService
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('FACEPP_API_KEY');
        $this->apiSecret = env('FACEPP_API_SECRET');
    }

    public function detectFace($imagePath)
    {
        $response = $this->client->post('https://api-us.faceplusplus.com/facepp/v3/detect', [
            'multipart' => [
                [
                    'name'     => 'api_key',
                    'contents' => $this->apiKey
                ],
                [
                    'name'     => 'api_secret',
                    'contents' => $this->apiSecret
                ],
                [
                    'name'     => 'image_file',
                    'contents' => fopen($imagePath, 'r')
                ],
                [
                    'name'     => 'return_attributes',
                    'contents' => 'age,gender,smiling,headpose,facequality,blur,eyestatus,emotion'
                ]
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}