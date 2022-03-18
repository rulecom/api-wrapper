<?php namespace Rule\ApiWrapper\Client;

use Rule\ApiWrapper\Client\Request;

abstract class Client
{
    /**
     * @var string 
     * Base url for the requests
     */
    protected $baseUrl;

    /**
     * @var string
     * Api key for the RULE account.
     */
    protected $apiKey;

    /**
     * @var string
     * RULE api version
     */
    protected $version;

    /**
     * Client constructor.
     * @param $apiKey
     * @param string $version
     * @param string $baseUrl
     */
    public function __construct(
        $apiKey,
        $version = 'v2',
        $baseUrl = "https://app.rule.io/api/")
    {
        $this->apiKey = $apiKey;
        $this->version = $version;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get Rule api key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Get Rule api version
     *
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

    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Make get request to api
     *
     * @param Request $request Request instance
     * 
     * @return Response
     */
    abstract public function get(Request $request);

    /**
     * Make post request to api
     *
     * @param Request $request Request instance
     * 
     * @return Response
     */
    abstract public function post(Request $request);

    /**
     * Make put request to api
     *
     * @param Request $request Request instance
     * 
     * @return Response
     */
    abstract public function put(Request $request);

    /**
     * Make delete request to api
     *
     * @param Request $request Request instance
     * 
     * @return Response
     */
    abstract public function delete(Request $request);
}
