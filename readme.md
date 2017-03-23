# kevinruscoe\zoho

A simple zoho wrapper

# Sample Usage

    $client = new KevinRuscoe\Zoho\Client;
    $client->setToken('my-shitty-secret');

    $client->lead->get([
        'dfgsdfg' => 'saaa'
    ]);

    $client->lead->create([
        'xmlData' => [
            'Lead Source' => 'Testing API',
            'Company' => 'Testing',
            'First Name' => 'Testing',
            'Last Name' => 'API',
            'Email' => 'testing@api.testing',
            'Primary Phone' => '00000000000',
        ]
    ]);