<?php namespace Rule\ApiWrapper\Api\V2\Template;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Template
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getTemplates()
    {
        $request = new Request('templates');

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function getTemplate($id)
    {
        $this->assertValidTemplateId($id);
        
        $request = new Request('templates');
        $request->setIdParam($id);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    private function assertValidTemplateId($id)
    {
        if(!is_int($id)) {
            throw new InvalidArgumentException('Template id is invalid');
        }
    }

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }
}