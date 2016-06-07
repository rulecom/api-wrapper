<?php namespace Rule\ApiWrapper\Api;

use Rule\ApiWrapper\Client\Client;

class Api
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Create api instance
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Check if request was successfully processed
     * 
     * @param Response $response
     * @throws ResponseErrorException
     */
    protected function assertSuccessResponse(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            throw new ResponseErrorException($response->getData()['message']);
        }
    }
}