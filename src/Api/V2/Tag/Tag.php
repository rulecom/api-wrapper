<?php namespace Rule\ApiWrapper\Api\V2\Tag;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Tag
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get($limit = 100)
    {
        $request = new Request('tags');
        $request->setQuery(['limit' => $limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function delete($id)
    {
        $request = new Request('tags');
        $request->setIdParam(urlencode($id));

        $response = $this->client->delete($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    public function clear($id)
    {
        $request = new Request('tags');
        $request->setIdParam(urlencode($id));
        $request->addSubresource(['name' => 'clear']);
        $response = $this->client->delete($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    private function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getData()['message']);
        }
    }

}