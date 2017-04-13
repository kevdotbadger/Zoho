<?php

namespace Kevdotbadger\Zoho;

use GuzzleHttp\Client;

class Lead {

    private $token;
    private $endpoint;
    private $client;

    /**
     * Create a new client.
     *
     * @param string $token Authentication Token
     **/
    public function __construct($token)
    {
        $this->endpoint = 'https://crm.zoho.com/crm/private/json/Leads/';
        $this->token = $token;

        $this->client = new Client([
            'base_uri' => $this->endpoint,
        ]);
    }

    /**
     * Creates a new Lead
     *
     * Argument list can be found at https://www.zoho.com/crm/help/customization/standard-fields.html#Leads
     *
     * @param array $args The fields to create a new lead from.
     *
     * @return mixed False if failed, the response from Zoho if success
     **/
    public function create($args = [])
    {

        $args = [
            'xmlData' => $args
        ];

        $query = Kevdotbadger\Zoho\Utils::normaliseArray([
            'authtoken' => $this->token,
            'xmlData' => [
                'Lead Source' => 'Testing API',
                'Company' => 'Testing',
                'First Name' => 'Testing',
                'Last Name' => 'API',
                'Email' => 'testing@api.testing',
                'Primary Phone' => '00000000000',
            ]
        ], $args);

        $query['xmlData'] = Kevdotbadger\Zoho\Utils::toXmlEntity('Lead', $query['xmlData']);

        $response = $this->client->post('insertRecords', [
            'query' => $query
        ]);

        if ($response->getStatusCode() !== 200) {
            return false;
        }

        return json_decode($response->getBody())->response->result->recorddetail;

    }

    public function get($args = [])
    {

        $response = $this->client->get('getRecords', [
            'query' => Kevdotbadger\Zoho\Utils::normaliseArray([
                'authtoken' => $this->token,
                'fromIndex' => 0,
                'toIndex' => 10
            ], $args)
        ]);

        if ($response->getStatusCode() !== 200) {
            return false;
        }

        return json_decode($response->getBody())->response->result->Leads->row;

    }

}
