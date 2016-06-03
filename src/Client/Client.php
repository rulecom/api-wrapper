<?php namespace Rule\ApiWrapper\Client;

use Rule\ApiWrapper\Client\Request;

abstract class Client
{
    /**
     * @var string 
     * Base url for the requests
     */
    private $baseUrl;

    /**
     * @var string 
     * Api key for the RULE account.
     */
    private $apiKey;

    /**
     * @var string
     * RULE api version
     */
    private $version;

    /**
     * Create new Client instance
     *
     * @param string $apiKey 
     */
    public function __construct(
        string $apiKey,
        string $version = 'v2',
        string $baseUrl = "http://rule.io/api/")
    {
        $this->apiKey = $apiKey;
        $this->version = $version;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get Rule api key
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Get Rule api version
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get base Rule url
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Make get request to api
     *
     * @param Request $request Request instance
     * 
     * @return Response
     */
    public function get(Request $request);

    /**
     * Make post request to api
     *
     * @param Request $request Request instance
     * 
     * @return Response
     */
    public function post(Request $request);

    /**
     * Make put request to api
     *
     * @param Request $request Request instance
     * 
     * @return Response
     */
    public function put(Request $request);

    /**
     * Make delete request to api
     *
     * @param Request $request Request instance
     * 
     * @return Response
     */
    public function delete(Request $request);
}