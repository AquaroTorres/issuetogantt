<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TestController extends Controller
{
    public function sendIp()
    {

        $client = new Client(['base_uri' => "https://i.saludiquique.cl/" ]);
        $headers = array();
        $response = $client->request('GET', "test-getip", $headers);
        echo "get content: ";
        return $response->getBody();
    }
}
