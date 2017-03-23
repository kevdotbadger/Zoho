<?php

namespace KevinRuscoe\Zoho\Entities;

class Entity {

    protected $client;

    /**
     * Create a new client.
     *
     * @param string $token Authentication Token
     **/
    public function __construct($client)
    {
        $this->client = $client;
    }

}