<?php

namespace KevinRuscoe\Zoho\Entities;

use KevinRuscoe\Zoho\Utils;

class Lead extends Entity {

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

        $query = Utils::normaliseArray([
            'xmlData' => [
                'Lead Source' => 'Testing API',
                'Company' => 'Testing',
                'First Name' => 'Testing',
                'Last Name' => 'API',
                'Email' => 'testing@api.testing',
                'Primary Phone' => '00000000000',
            ]
        ], $args);

        $query['xmlData'] = Utils::toXmlEntity('Lead', $query['xmlData']);

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
            'query' => Utils::normaliseArray([
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