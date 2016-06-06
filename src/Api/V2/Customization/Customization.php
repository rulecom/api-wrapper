<?php namespace Rule\ApiWrapper\Api\V2\Customization;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Customization
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(array $fields)
    {
        $this->assertValidFields($fields);

        $request = new Request('customizations');
        $request->setParams($fields);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();

    }

    public function getGroups($limit = 100)
    {
        $request = new Request('customizations');
        $request->setQuery(['limit' =>$limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function getGroup($id)
    {
        $request = new Request('customizations');
        $request->setIdParam(urlencode($id));

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    private function assertValidFields($fields)
    {
        if(!isset($fields)) {
            throw new InvalidArgumentException("Fields are empty");
        }

        foreach($fields as $key=>$value) {
            if(count(explode('.', $key)) !== 2) {
                throw new InvalidArgumentException('Key has wrong format');
            }
        }
    }

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }
}