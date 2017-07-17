<?php namespace Rule\ApiWrapper\Api;

use Rule\ApiWrapper\Client\Client;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;
use Rule\ApiWrapper\Api\Exception\ResponseErrorException;

class Api
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Create api instance
     * @param Client $client HTTP client implementation for api
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get http client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
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
