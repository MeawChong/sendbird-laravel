<?php

namespace SendBird\Requests;

use GuzzleHttp\Client;

abstract class BaseRequest
{
    protected $app_id;
    protected $base_url;

    private $httpOptions;

    public function __construct()
    {
        $this->app_id = env('SENDBIRD_APP_ID', '');

        $this->base_url = "https://api-{$this->app_id}.sendbird.com/v3";

        $this->configureHttpOptions();
    }

    private function configureHttpOptions()
    {
        $this->httpOptions = [
            'http_errors' => false,
            'headers' => [
                'Content-Type' => "application/json, charset=utf8",
                'Api-Token' => env('SENDBIRD_MASTER_TOKEN', ''),
                'Accept' => "application/json"
            ]
        ];
    }

    protected function request($endpoint, $method = 'post', $body = [])
    {
        $url = $this->base_url.str_start($endpoint, '/');

        $httpOptions = $this->httpOptions;

        if (strtolower($method) !== 'get') {
            $httpOptions['body'] = json_encode($body);
        }

        $http = new Client();

        $response = (string)$http->request($method, $url, $httpOptions)->getBody();

        return json_decode($response, true);
    }
}
