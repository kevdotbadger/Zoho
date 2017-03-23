<?php

namespace KevinRuscoe\Zoho;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Middleware;

class Client extends Guzzle {

    private $token;

    public function __construct(array $config = [])
    {
        $config['base_uri'] = 'https://crm.zoho.com/crm/private/json/';

        parent::__construct($config);
    }

    public function setToken($token)
    {

        $this->token = $token;

        $this->getConfig('handler')->unshift(Middleware::mapRequest(function($request) use ($token) {
            return $request->withUri(Uri::withQueryValue($request->getUri(), 'authtoken', $token));
        }));
    }

    public function __get($property)
    {

        if (!isset($this->token)) {
            throw new \Exception('Zoho requires a token.');
        }

        $classname = 'KevinRuscoe\Zoho\Entities\\'.ucfirst($property);

        if (class_exists($classname)) {
            return new $classname($this);
        }

        throw new \Exception('Entity not supported.');
    }

}